// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { BeatmapsetJson } from 'beatmapsets/beatmapset-json';
import BeatmapJsonExtended from 'interfaces/beatmap-json-extended';
import isHotkey from 'is-hotkey';
import { route } from 'laroute';
import * as _ from 'lodash';
import * as React from 'react';
import { createEditor, Editor as SlateEditor, Element as SlateElement, Node as SlateNode, NodeEntry, Range, Text, Transforms } from 'slate';
import { withHistory } from 'slate-history';
import { Editable, ReactEditor, RenderElementProps, RenderLeafProps, Slate, withReact } from 'slate-react';
import { Spinner } from 'spinner';
import { sortWithMode } from 'utils/beatmap-helper';
import EditorDiscussionComponent from './editor-discussion-component';
import {
  serializeSlateDocument,
  slateDocumentContainsProblem,
  slateDocumentIsEmpty,
  toggleFormat,
} from './editor-helpers';
import { EditorToolbar } from './editor-toolbar';
import { parseFromJson } from './review-document';
import { SlateContext } from './slate-context';

interface CacheInterface {
  sortedBeatmaps?: BeatmapJsonExtended[];
}

interface Props {
  beatmaps: Record<number, BeatmapJsonExtended>;
  beatmapset: BeatmapsetJson;
  currentBeatmap: BeatmapJsonExtended;
  currentDiscussions: BeatmapDiscussion[];
  discussion?: BeatmapDiscussion;
  discussions: Record<number, BeatmapDiscussion>;
  document?: string;
  editing: boolean;
  editMode?: boolean;
  onFocus?: () => void;
}

interface State {
  posting: boolean;
  value: SlateNode[];
}

interface TimestampRange extends Range {
  timestamp: string;
}

export default class Editor extends React.Component<Props, State> {
  static defaultProps = {
    editing: false,
  };

  bn = 'beatmap-discussion-editor';
  cache: CacheInterface = {};
  emptyDocTemplate = [{children: [{text: ''}], type: 'paragraph'}];
  localStorageKey: string;
  scrollContainerRef: React.RefObject<HTMLDivElement>;
  slateEditor: ReactEditor;
  toolbarRef: React.RefObject<EditorToolbar>;

  private xhr?: JQueryXHR;

  constructor(props: Props) {
    super(props);

    this.slateEditor = this.withNormalization(withHistory(withReact(createEditor())));
    this.scrollContainerRef = React.createRef();
    this.toolbarRef = React.createRef();

    let initialValue = this.emptyDocTemplate;
    this.localStorageKey = `newDiscussion-${this.props.beatmapset.id}`;
    const saved = localStorage.getItem(this.localStorageKey);
    if (!props.editMode && saved) {
      try {
        initialValue = JSON.parse(saved);
      } catch (error) {
        // tslint:disable-next-line:no-console
        console.error('invalid json in localStorage, ignoring');
        localStorage.removeItem(this.localStorageKey);
      }
    }

    this.state = {
      posting: false,
      value: initialValue,
    };
  }

  blockWrapper = (children: JSX.Element) => {
    return (
      <div className={`${this.bn}__block`}>
        <div className={`${this.bn}__hover-menu`} contentEditable={false}>
          <i className='fas fa-plus-circle' />
          <div className={`${this.bn}__menu-content`}>
            {this.insertButton('suggestion')}
            {this.insertButton('problem')}
            {this.insertButton('praise')}
            {this.insertButton('paragraph')}
          </div>
        </div>
        {children}
      </div>
    );
  }

  componentDidMount() {
    if (this.scrollContainerRef.current && this.toolbarRef.current) {
      this.toolbarRef.current.setScrollContainer(this.scrollContainerRef.current);
    }
  }

  componentDidUpdate(prevProps: Readonly<Props>, prevState: Readonly<any>, snapshot?: any): void {
    if (this.props.editing !== prevProps.editing) {
      this.toggleEditing();
    }
  }

  componentWillUnmount() {
    if (this.xhr) {
      this.xhr.abort();
    }
    if (this.scrollContainerRef.current) {
      $(this.scrollContainerRef.current).off('scroll');
    }
  }

  componentWillUpdate(): void {
    this.cache = {};
  }

  decorateTimestamps = (entry: NodeEntry) => {
    const [node, path] = entry;
    const ranges: TimestampRange[] = [];

    if (!Text.isText(node)) {
      return ranges;
    }

    const regex = RegExp(BeatmapDiscussionHelper.TIMESTAMP_REGEX, 'g');
    let match;

    // tslint:disable-next-line:no-conditional-assignment
    while ((match = regex.exec(node.text)) !== null) {
      ranges.push({
        anchor: {path, offset: match.index},
        focus: {path, offset: match.index + match[0].length},
        timestamp: match[0],
      });
    }

    return ranges;
  }

  insertBlock = (event: React.MouseEvent<HTMLElement>) => {
    const type = event.currentTarget.dataset.dtype;
    const beatmapId = this.props.currentBeatmap?.id;

    // find where to insert the new embed (relative to the dropdown menu)
    const lastChild = event.currentTarget.closest(`.${this.bn}__block`)?.lastChild;

    if (!lastChild) {
      return;
    }

    // convert from dom node to document path
    const node = ReactEditor.toSlateNode(this.slateEditor, lastChild);
    const path = ReactEditor.findPath(this.slateEditor, node);
    const at = SlateEditor.end(this.slateEditor, path);
    let insertNode;

    switch (type) {
      case 'suggestion': case 'problem': case 'praise':
        insertNode = {
          beatmapId,
          children: [{text: ''}],
          discussionType: type,
          type: 'embed',
        };
        break;
      case 'paragraph':
        insertNode = {
          children: [{text: ''}],
          type: 'paragraph',
        };
        break;
    }

    if (!insertNode) {
      return;
    }

    Transforms.insertNodes(this.slateEditor, insertNode, { at });
  }

  insertButton = (type: string) => {
    let icon = 'fas fa-question';

    switch (type) {
      case 'praise':
      case 'problem':
      case 'suggestion':
        icon = BeatmapDiscussionHelper.messageType.icon[type];
        break;
      case 'paragraph':
        icon = 'fas fa-indent';
        break;
    }

    return (
      <button
        type='button'
        className={`${this.bn}__menu-button ${this.bn}__menu-button--${type}`}
        data-dtype={type}
        onClick={this.insertBlock}
        title={osu.trans(`beatmaps.discussions.review.insert-block.${type}`)}
      >
        <i className={icon}/>
      </button>
    );
  }

  onChange = (value: SlateNode[]) => {
    if (!this.props.editMode) {
      const content = JSON.stringify(value);

      if (slateDocumentIsEmpty(value)) {
        localStorage.removeItem(this.localStorageKey);
      } else {
        localStorage.setItem(this.localStorageKey, content);
      }
    }

    this.setState({value});

    if (ReactEditor.isFocused(this.slateEditor) && this.props.onFocus) {
      this.props.onFocus();
    }
  }

  onKeyDown = (event: KeyboardEvent) => {
    if (isHotkey('mod+b', event)) {
      event.preventDefault();
      toggleFormat(this.slateEditor, 'bold');
    } else if (isHotkey('mod+i', event)) {
      event.preventDefault();
      toggleFormat(this.slateEditor, 'italic');
    }
  }

  post = () => {
    if (this.showConfirmationIfRequired()) {
      this.setState({posting: true}, () => {
        this.xhr = $.ajax(route('beatmapsets.discussion.review', {beatmapset: this.props.beatmapset.id}), {
          data: {document: this.serialize()},
          method: 'POST',
        })
        .done((data) => {
          $.publish('beatmapsetDiscussions:update', {beatmapset: data});
          this.resetInput();
        })
        .fail(osu.ajaxError)
        .always(() => this.setState({posting: false}));
      });
    }
  }

  render(): React.ReactNode {
    const editorClass = 'beatmap-discussion-editor';
    const modifiers = this.props.editMode ? ['edit-mode'] : [];
    if (this.state.posting) {
      modifiers.push('readonly');
    }

    return (
      <div className={osu.classWithModifiers(editorClass, modifiers)}>
        <div className={`${editorClass}__content`}>
          <SlateContext.Provider value={this.slateEditor}>
            <Slate
              editor={this.slateEditor}
              value={this.state.value}
              onChange={this.onChange}
            >
              <div ref={this.scrollContainerRef} className={`${editorClass}__input-area`}>
                <EditorToolbar ref={this.toolbarRef} />
                <Editable
                  decorate={this.decorateTimestamps}
                  onKeyDown={this.onKeyDown}
                  readOnly={this.state.posting}
                  renderElement={this.renderElement}
                  renderLeaf={this.renderLeaf}
                  placeholder={osu.trans('beatmaps.discussions.message_placeholder.review')}
                />
              </div>
              { !this.props.editMode &&
                <div className={`${editorClass}__button-bar`}>
                  <button
                    className='btn-osu-big btn-osu-big--forum-secondary'
                    disabled={this.state.posting}
                    type='button'
                    onClick={this.resetInput}
                  >
                    {osu.trans('common.buttons.clear')}
                  </button>
                  <button
                    className='btn-osu-big btn-osu-big--forum-primary'
                    disabled={this.state.posting}
                    type='submit'
                    onClick={this.post}
                  >
                    {this.state.posting ? <Spinner /> : osu.trans('common.buttons.post')}
                  </button>
                </div>
              }
            </Slate>
          </SlateContext.Provider>
        </div>
      </div>
    );
  }

  renderElement = (props: RenderElementProps) => {
    let el;

    switch (props.element.type) {
      case 'embed':
        el = (
          <EditorDiscussionComponent
            beatmapset={this.props.beatmapset}
            currentBeatmap={this.props.currentBeatmap}
            currentDiscussions={this.props.currentDiscussions}
            editMode={this.props.editMode}
            beatmaps={this.sortedBeatmaps()}
            readOnly={this.state.posting}
            {...props}
          />
        );
        break;

      default:
        el = props.children;
    }

    return this.blockWrapper(el);
  }

  renderLeaf = (props: RenderLeafProps) => {
    let children = props.children;
    if (props.leaf.bold) {
      children = <strong {...props.attributes}>{children}</strong>;
    }

    if (props.leaf.italic) {
      children = <em {...props.attributes}>{children}</em>;
    }

    if (props.leaf.timestamp) {
      // TODO: fix this nested stuff
      return <span className='beatmapset-discussion-message' {...props.attributes}><span className={'beatmapset-discussion-message__timestamp'}>{children}</span></span>;
    }

    return (
      <span {...props.attributes}>{children}</span>
    );
  }

  resetInput = (event?: React.MouseEvent) => {
    if (event) {
      event.preventDefault();

      if (!confirm(osu.trans('common.confirmation'))) {
        return;
      }
    }

    Transforms.deselect(this.slateEditor);
    this.onChange(this.emptyDocTemplate);
  }

  serialize = () => serializeSlateDocument(this.state.value);

  showConfirmationIfRequired = () => {
    const docContainsProblem = slateDocumentContainsProblem(this.state.value);
    const canDisqualify = currentUser.is_admin || currentUser.is_moderator || currentUser.is_full_bn;
    const willDisqualify = this.props.beatmapset.status === 'qualified' && docContainsProblem;
    const canReset = currentUser.is_admin || currentUser.is_nat || currentUser.is_bng;
    const willReset =
      this.props.beatmapset.status === 'pending' &&
      this.props.beatmapset.nominations && this.props.beatmapset.nominations.current > 0 &&
      docContainsProblem;

    if (canDisqualify && willDisqualify) {
      return confirm(osu.trans('beatmaps.nominations.reset_confirm.disqualify'));
    }

    if (canReset && willReset) {
      return confirm(osu.trans('beatmaps.nominations.reset_confirm.nomination_reset'));
    }

    return true;
  }

  sortedBeatmaps = () => {
    if (this.cache.sortedBeatmaps == null) {
      this.cache.sortedBeatmaps = sortWithMode(_.values(this.props.beatmaps));
    }

    return this.cache.sortedBeatmaps;
  }

  toggleEditing = () => {
    if (!this.props.document || !this.props.discussions || _.isEmpty(this.props.discussions)) {
      return;
    }

    this.setState({
      value: this.props.editing ? parseFromJson(this.props.document, this.props.discussions) : [],
    });
  }

  withNormalization = (editor: ReactEditor) => {
    const { normalizeNode } = editor;

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
          if (child.bold || child.italic) {
            Transforms.unsetNodes(
              editor,
              ['bold', 'italic'],
              { at: childPath },
            );

            return;
          }

          // clear invalid beatmapId references (for pasted embed content)
          if (node.beatmapId && (!this.props.beatmaps[node.beatmapId] || this.props.beatmaps[node.beatmapId].deleted_at)) {
            Transforms.setNodes(editor, {beatmapId: null}, {at: path});
          }
        }
      }

      // ensure the last node is always a paragraph, (otherwise it becomes impossible to insert a normal paragraph after an embed)
      if (editor.children.length > 0) {
        const lastNode = editor.children[editor.children.length - 1];
        if (lastNode.type === 'embed') {
          const paragraph = {type: 'paragraph', children: [{text: ''}]};
          Transforms.insertNodes(editor, paragraph, {at: SlateEditor.end(editor, [])});

          return;
        }
      }

      return normalizeNode(entry);
    };

    return editor;
  }
}
