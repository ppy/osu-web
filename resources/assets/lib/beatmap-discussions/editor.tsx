// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { CircularProgress } from 'components/circular-progress';
import { Spinner } from 'components/spinner';
import { EmbedElement } from 'editor';
import BeatmapExtendedJson from 'interfaces/beatmap-extended-json';
import BeatmapsetDiscussionJson, { BeatmapsetDiscussionJsonForBundle, BeatmapsetDiscussionJsonForShow } from 'interfaces/beatmapset-discussion-json';
import BeatmapsetJson from 'interfaces/beatmapset-json';
import isHotkey from 'is-hotkey';
import { route } from 'laroute';
import { filter } from 'lodash';
import core from 'osu-core-singleton';
import * as React from 'react';
import { createEditor, Editor as SlateEditor, Element as SlateElement, Node as SlateNode, NodeEntry, Range, Text, Transforms } from 'slate';
import { withHistory } from 'slate-history';
import { Editable, ReactEditor, RenderElementProps, RenderLeafProps, Slate, withReact } from 'slate-react';
import { DOMRange } from 'slate-react/dist/utils/dom';
import { onError } from 'utils/ajax';
import { sortWithMode } from 'utils/beatmap-helper';
import { timestampRegex } from 'utils/beatmapset-discussion-helper';
import { nominationsCount } from 'utils/beatmapset-helper';
import { classWithModifiers } from 'utils/css';
import { DraftsContext } from './drafts-context';
import EditorDiscussionComponent from './editor-discussion-component';
import {
  blockCount,
  insideEmbed,
  insideEmptyNode,
  serializeSlateDocument,
  slateDocumentContainsNewProblem,
  slateDocumentIsEmpty,
  toggleFormat,
} from './editor-helpers';
import { EditorInsertionMenu } from './editor-insertion-menu';
import { EditorToolbar } from './editor-toolbar';
import { parseFromJson } from './review-document';
import { ReviewEditorConfigContext } from './review-editor-config-context';
import { SlateContext } from './slate-context';

interface CacheInterface {
  draftEmbeds?: EmbedElement[];
  sortedBeatmaps?: BeatmapExtendedJson[];
}

interface Props {
  beatmaps: Partial<Record<number, BeatmapExtendedJson>>;
  beatmapset: BeatmapsetJson;
  currentBeatmap: BeatmapExtendedJson;
  discussion?: BeatmapsetDiscussionJson;
  discussions: Partial<Record<number, BeatmapsetDiscussionJsonForBundle | BeatmapsetDiscussionJsonForShow>>; // passed in via context at parent
  document?: string;
  editing: boolean;
  onChange?: () => void;
  onFocus?: () => void;
}

interface State {
  blockCount: number;
  posting: boolean;
  value: SlateElement[]; // TODO: remove from state? or use slateEditor.children?
}

interface TimestampRange extends Range {
  timestamp: string;
}

const emptyParagraph = Object.freeze({ children: [{ text: '' }], type: 'paragraph' });
const emptyDocTemplate = [emptyParagraph];

function isDraftEmbed(block: SlateElement): block is EmbedElement {
  return block.type === 'embed' && block.discussionId == null;
}

export default class Editor extends React.Component<Props, State> {
  static contextType = ReviewEditorConfigContext;
  static defaultProps = {
    editing: false,
  };

  bn = 'beatmap-discussion-editor';
  cache: CacheInterface = {};
  declare context: React.ContextType<typeof ReviewEditorConfigContext>;
  insertMenuRef: React.RefObject<EditorInsertionMenu>;
  localStorageKey: string;
  scrollContainerRef: React.RefObject<HTMLDivElement>;
  slateEditor: SlateEditor;
  toolbarRef: React.RefObject<EditorToolbar>;
  private readonly initialValue: SlateElement[] = emptyDocTemplate;
  private xhr?: JQueryXHR | null;

  private get editMode() {
    return this.props.document != null;
  }

  constructor(props: Props) {
    super(props);

    // Slate editor typing is weird
    // https://docs.slatejs.org/concepts/12-typescript#defining-editor-element-and-text-types
    this.slateEditor = this.withNormalization(withReact(withHistory(createEditor())));
    this.scrollContainerRef = React.createRef();
    this.toolbarRef = React.createRef();
    this.insertMenuRef = React.createRef();
    this.localStorageKey = `newDiscussion-${this.props.beatmapset.id}`;

    if (this.editMode) {
      this.initialValue = this.valueFromProps();
    } else {
      const saved = localStorage.getItem(this.localStorageKey);

      if (saved != null) {
        try {
          this.initialValue = JSON.parse(saved) as SlateElement[];
        } catch (error) {
          console.error('invalid json in localStorage, ignoring');
          localStorage.removeItem(this.localStorageKey);
        }
      }
    }

    this.state = {
      blockCount: blockCount(this.initialValue),
      posting: false,
      value: this.initialValue,
    };
  }

  blockWrapper = (children: React.ReactNode) => (
    <div className={`${this.bn}__block`}>
      {children}
    </div>
  );

  get canSave() {
    return !this.state.posting && this.state.blockCount <= this.context.max_blocks;
  }

  componentDidMount() {
    if (this.scrollContainerRef.current) {
      if (this.toolbarRef.current) {
        this.toolbarRef.current.setScrollContainer(this.scrollContainerRef.current);
      }
      if (this.insertMenuRef.current) {
        this.insertMenuRef.current.setScrollContainer(this.scrollContainerRef.current);
      }
    }
  }

  componentDidUpdate(prevProps: Readonly<Props>): void {
    if (this.props.document !== prevProps.document) {
      const newValue = this.valueFromProps();

      this.setState({
        blockCount: blockCount(newValue),
        value: newValue,
      });
    }
  }

  componentWillUnmount() {
    this.xhr?.abort();
  }

  decorateTimestamps = (entry: NodeEntry) => {
    const [node, path] = entry;
    const ranges: TimestampRange[] = [];

    if (!Text.isText(node)) {
      return ranges;
    }

    const regex = RegExp(timestampRegex, 'g');
    let match;

    while ((match = regex.exec(node.text)) !== null) {
      ranges.push({
        anchor: { offset: match.index, path },
        focus: { offset: match.index + match[0].length, path },
        timestamp: match[0],
      });
    }

    return ranges;
  };

  /**
   * Type guard for checking if the beatmap is part of currently selected beatmapset
   *
   * @param beatmap
   * @returns boolean
   */
  isCurrentBeatmap = (beatmap?: BeatmapExtendedJson): beatmap is BeatmapExtendedJson => (
    beatmap != null && beatmap.beatmapset_id === this.props.beatmapset.id
  );

  onChange = (value: SlateElement[]) => {
    // Anything that triggers this needs to be fixed!
    // Slate.value is only used for initial value.
    if (value.length === 0) {
      console.error('value is empty in Editor.onChange');
      value = emptyDocTemplate;
    }

    if (!this.editMode) {
      const content = JSON.stringify(value);

      if (slateDocumentIsEmpty(value)) {
        localStorage.removeItem(this.localStorageKey);
      } else {
        localStorage.setItem(this.localStorageKey, content);
      }
    }

    this.setState(
      {
        blockCount: blockCount(value),
        value,
      },
      () => {
        if (ReactEditor.isFocused(this.slateEditor) && this.props.onFocus) {
          this.props.onFocus();
        }

        this.props.onChange?.();
      },
    );
  };

  onKeyDown = (event: KeyboardEvent) => {
    if (isHotkey('mod+b', event)) {
      event.preventDefault();
      toggleFormat(this.slateEditor, 'bold');
    } else if (isHotkey('mod+i', event)) {
      event.preventDefault();
      toggleFormat(this.slateEditor, 'italic');
    } else if (isHotkey('shift+enter', event)) {
      if (insideEmbed(this.slateEditor)) {
        event.preventDefault();
        this.slateEditor.insertText('\n');
      }
    } else if (isHotkey('delete', event) || isHotkey('backspace', event)) {
      if (insideEmptyNode(this.slateEditor)) {
        event.preventDefault();

        Transforms.removeNodes(this.slateEditor);

        // Slate editor must never be empty - empty editor makes no sense when initialized with default value.
        if (this.slateEditor.children.length === 0) {
          this.resetEditorValue();
        }
      }
    }
  };

  post = () => {
    if (this.xhr != null) return;

    if (this.showConfirmationIfRequired()) {
      this.setState({ posting: true }, () => {
        this.xhr = $.ajax(route('beatmapsets.discussion.review', { beatmapset: this.props.beatmapset.id }), {
          data: { document: this.serialize() },
          method: 'POST',
        })
          .done((data) => {
            $.publish('beatmapsetDiscussions:update', { beatmapset: data });
            this.resetInput();
          })
          .fail(onError)
          .always(() => {
            this.xhr = null;
            this.setState({ posting: false });
          });
      });
    }
  };

  render(): React.ReactNode {
    this.cache = {};
    const editorClass = 'beatmap-discussion-editor';
    const modifiers = this.editMode ? ['edit-mode'] : [];
    if (this.state.posting) {
      modifiers.push('readonly');
    }

    this.updateDrafts();

    return (
      <div className={classWithModifiers(editorClass, modifiers)}>
        <div className={`${editorClass}__content`}>
          <SlateContext.Provider value={this.slateEditor}>
            <Slate
              editor={this.slateEditor}
              onChange={this.onChange}
              value={this.initialValue}
            >
              <div ref={this.scrollContainerRef} className={`${editorClass}__input-area`}>
                <EditorToolbar ref={this.toolbarRef} />
                <EditorInsertionMenu ref={this.insertMenuRef} currentBeatmap={this.props.currentBeatmap} />
                <DraftsContext.Provider value={this.cache.draftEmbeds || []}>
                  <Editable
                    decorate={this.decorateTimestamps}
                    onKeyDown={this.onKeyDown}
                    placeholder={osu.trans('beatmaps.discussions.message_placeholder.review')}
                    readOnly={this.state.posting}
                    renderElement={this.renderElement}
                    renderLeaf={this.renderLeaf}
                    scrollSelectionIntoView={this.scrollSelectionIntoView}
                  />
                </DraftsContext.Provider>
              </div>
              {this.editMode &&
                <div className={`${editorClass}__inner-block-count`}>
                  {this.renderBlockCount('lighter')}
                </div>
              }
              {!this.editMode &&
                <div className={`${editorClass}__button-bar`}>
                  <button
                    className='btn-osu-big btn-osu-big--forum-secondary'
                    disabled={this.state.posting}
                    onClick={this.resetInput}
                    type='button'
                  >
                    {osu.trans('common.buttons.clear')}
                  </button>
                  <div>
                    <span className={`${editorClass}__block-count`}>
                      {this.renderBlockCount()}
                    </span>
                    <button
                      className='btn-osu-big btn-osu-big--forum-primary'
                      disabled={!this.canSave}
                      onClick={this.post}
                      type='submit'
                    >
                      {this.state.posting ? <Spinner /> : osu.trans('common.buttons.post')}
                    </button>
                  </div>
                </div>
              }
            </Slate>
          </SlateContext.Provider>
        </div>
      </div>
    );
  }

  renderBlockCount = (theme?: string) => (
    <CircularProgress
      current={this.state.blockCount}
      max={this.context.max_blocks}
      onlyShowAsWarning
      theme={theme}
      tooltip={osu.trans('beatmap_discussions.review.block_count', {
        max: this.context.max_blocks,
        used: this.state.blockCount,
      })}
    />
  );

  renderElement = (props: RenderElementProps) => {
    let el: React.ReactNode;

    switch (props.element.type) {
      case 'embed': {
        const { element, ...otherProps } = props; // spreading ..props doesn't use the narrower type.
        el = (
          <EditorDiscussionComponent
            beatmaps={this.sortedBeatmaps()}
            beatmapset={this.props.beatmapset}
            currentBeatmap={this.props.currentBeatmap}
            discussions={this.props.discussions}
            editMode={this.editMode}
            element={element}
            readOnly={this.state.posting}
            {...otherProps}
          />
        );
        break;
      }
      default:
        el = props.children as React.ReactNode;
    }

    return this.blockWrapper(el);
  };

  renderLeaf = (props: RenderLeafProps) => {
    let children = props.children;
    if (props.leaf.bold) {
      children = <strong {...props.attributes}>{children}</strong>;
    }

    if (props.leaf.italic) {
      children = <em {...props.attributes}>{children}</em>;
    }

    if (props.leaf.timestamp) {
      return <span className='beatmap-discussion-timestamp-decoration' {...props.attributes}>{children}</span>;
    }

    return (
      <span {...props.attributes}>{children}</span>
    );
  };

  resetInput = (event?: React.MouseEvent) => {
    if (event) {
      event.preventDefault();

      if (!confirm(osu.trans('common.confirmation'))) {
        return;
      }
    }

    this.resetEditorValue();
  };

  // Overrides slate Editable's defaultScrollSelectionIntoView and always use browser's version
  // There's something wrong with slate's range detection in the prior calling function that causes
  // letters and numbers to be differently.
  scrollSelectionIntoView = (editor: ReactEditor, domRange: DOMRange) => {
    domRange.startContainer.parentElement?.scrollIntoView({
      block: 'nearest',
      inline: 'nearest' ,
    });
  };

  serialize = () => serializeSlateDocument(this.state.value);

  showConfirmationIfRequired = () => {
    const docContainsProblem = slateDocumentContainsNewProblem(this.state.value);
    const canDisqualify = core.currentUser != null && (core.currentUser.is_admin || core.currentUser.is_moderator || core.currentUser.is_full_bn);
    const willDisqualify = this.props.beatmapset.status === 'qualified' && docContainsProblem;
    const canReset = core.currentUser != null && (core.currentUser.is_admin || core.currentUser.is_nat || core.currentUser.is_bng);
    const willReset =
      this.props.beatmapset.status === 'pending' &&
      this.props.beatmapset.nominations && nominationsCount(this.props.beatmapset.nominations, 'current') > 0 &&
      docContainsProblem;

    if (canDisqualify && willDisqualify) {
      return confirm(osu.trans('beatmaps.nominations.reset_confirm.disqualify'));
    }

    if (canReset && willReset) {
      return confirm(osu.trans('beatmaps.nominations.reset_confirm.nomination_reset'));
    }

    return true;
  };

  sortedBeatmaps = () => {
    if (this.cache.sortedBeatmaps == null) {
      // filter to only include beatmaps from the current discussion's beatmapset (for the modding profile page)
      const beatmaps = filter(this.props.beatmaps, this.isCurrentBeatmap);
      this.cache.sortedBeatmaps = sortWithMode(beatmaps);
    }

    return this.cache.sortedBeatmaps;
  };

  updateDrafts = () => {
    this.cache.draftEmbeds = this.state.value.filter(isDraftEmbed);
  };

  withNormalization = (editor: SlateEditor) => {
    const { insertData, normalizeNode } = editor;

    editor.insertData = (data) => {
      if (insideEmbed(this.slateEditor)) {
        editor.insertText(data.getData('text/plain'));
      } else {
        insertData(data);
      }
    };

    editor.normalizeNode = (entry) => {
      const [node, path] = entry;

      if (SlateElement.isElement(node) && node.type === 'embed') {
        for (const [child, childPath] of SlateNode.children(editor, path)) {
          // ensure embeds only have a single child
          if (SlateElement.isElement(child) && !editor.isInline(child)) {
            Transforms.unwrapNodes(editor, { at: childPath });

            return;
          }

          // clear formatting from content within embeds
          if (Text.isText(child) && (child.bold || child.italic)) {
            Transforms.unsetNodes(
              editor,
              ['bold', 'italic'],
              { at: childPath },
            );

            return;
          }

          if (node.beatmapId != null) {
            const beatmap = this.props.beatmaps[node.beatmapId];
            if (beatmap == null || beatmap.deleted_at != null) {
              Transforms.setNodes(editor, { beatmapId: undefined }, { at: path });
            }
          }
        }
      }

      normalizeNode(entry);
    };

    return editor;
  };

  // "correct" way to reset slate to initial value
  // https://docs.slatejs.org/walkthroughs/06-saving-to-a-database
  private resetEditorValue() {
    this.slateEditor.children = emptyDocTemplate;
    this.slateEditor.onChange();
  }

  private valueFromProps() {
    if (!this.props.editing || this.props.document == null || this.props.discussions == null) {
      return [];
    }

    return parseFromJson(this.props.document, this.props.discussions);
  }
}
