// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import isHotkey from 'is-hotkey';
import * as laroute from 'laroute';
import * as _ from 'lodash';
import * as React from 'react';
import { createEditor, Editor as SlateEditor, Element as SlateElement, Node as SlateNode, NodeEntry, Range, Text, Transforms } from 'slate';
import { withHistory } from 'slate-history';
import { Editable, ReactEditor, RenderElementProps, RenderLeafProps, Slate, withReact } from 'slate-react';
import { Spinner } from 'spinner';
import { BeatmapDiscussionReview, DocumentIssueEmbed } from '../interfaces/beatmap-discussion-review';
import EditorDiscussionComponent from './editor-discussion-component';
import { toggleFormat } from './editor-formatting';
import { EditorToolbar } from './editor-toolbar';
import { parseFromJson } from './review-document';
import { SlateContext } from './slate-context';

interface CacheInterface {
  beatmaps?: Beatmap[];
}

interface Props {
  beatmaps: Record<number, Beatmap>;
  beatmapset: Beatmapset;
  currentBeatmap: Beatmap;
  currentDiscussions: BeatmapDiscussion[];
  discussion?: BeatmapDiscussion;
  discussions: Record<number, BeatmapDiscussion>;
  document?: string;
  editing: boolean;
  editMode?: boolean;
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
  slateEditor: ReactEditor;

  private xhr?: JQueryXHR;

  constructor(props: Props) {
    super(props);

    this.slateEditor = this.withNormalization(withHistory(withReact(createEditor())));

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
            {this.embedButton('suggestion')}
            {this.embedButton('problem')}
            {this.embedButton('praise')}
          </div>
        </div>
        {children}
      </div>
    );
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

  embedButton = (type: string) => {
    return (
      <button type='button' className={`${this.bn}__menu-button ${this.bn}__menu-button--${type}`} data-dtype={type} onClick={this.insertEmbed}>
        <i className={BeatmapDiscussionHelper.messageType.icon[type]}/>
      </button>
    );
  }

  insertEmbed = (event: React.MouseEvent<HTMLElement>) => {
    const type = event.currentTarget.dataset.dtype;
    const beatmapId = this.props.currentBeatmap ? this.props.currentBeatmap.id : this.props.beatmaps[this.props.beatmapset.beatmaps[0].id];

    // find where to insert the new embed (relative to the dropdown menu)
    const lastChild = $(event.currentTarget).closest(`.${this.bn}__block`)[0].lastChild;

    if (!lastChild) {
      return;
    }

    // convert from dom node to document path
    const node = ReactEditor.toSlateNode(this.slateEditor, lastChild);
    const path = ReactEditor.findPath(this.slateEditor, node);
    const at = SlateEditor.end(this.slateEditor, path);

    Transforms.insertNodes(this.slateEditor, {
      beatmapId,
      children: [{text: ''}],
      discussionType: type,
      type: 'embed',
    },
    {
      at,
    });
  }

  onChange = (value: SlateNode[]) => {
    if (!this.props.editMode) {
      const content = JSON.stringify(value);

      if (content !== JSON.stringify(this.emptyDocTemplate)) {
        localStorage.setItem(this.localStorageKey, content);
      } else {
        localStorage.removeItem(this.localStorageKey);
      }
    }

    this.setState({value});
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
    this.setState({posting: true}, () => {
      this.xhr = $.ajax(laroute.route('beatmapsets.discussion.review', {beatmapset: this.props.beatmapset.id}), {
        data: { document: this.serialize() },
        method: 'POST',
      });

      this.xhr.then((data) => {
        $.publish('beatmapsetDiscussions:update', {beatmapset: data});
        this.resetInput();
      })
      .always(() => {
        this.setState({posting: false});
      })
      .catch(osu.ajaxError);
    });
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
              <div className={`${editorClass}__input-area`}>
                <EditorToolbar />
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

  serialize = (): string => {
    const review: BeatmapDiscussionReview = [];

    this.state.value.forEach((node: SlateNode) => {
      switch (node.type) {
        case 'paragraph':
          const childOutput: string[] = [];
          const currentMarks = {
            bold: false,
            italic: false,
          };

          node.children.forEach((child: SlateNode) => {
            if (child.text !== '') {
              if (currentMarks.bold !== (child.bold ?? false)) {
                currentMarks.bold = child.bold;
                childOutput.push('**');
              }

              if (currentMarks.italic !== (child.italic ?? false)) {
                currentMarks.italic = child.italic;
                childOutput.push('*');
              }
            }

            childOutput.push(child.text.replace('*', '\\*'));
          });

          // ensure closing of open tags
          if (currentMarks.bold) {
            childOutput.push('**');
          }
          if (currentMarks.italic) {
            childOutput.push('*');
          }

          review.push({
            text: childOutput.join(''),
            type: 'paragraph',
          });

          currentMarks.bold = currentMarks.italic = false;
          break;

        case 'embed':
          const doc: DocumentIssueEmbed = {
            beatmap_id: node.beatmapId,
            discussion_type: node.discussionType,
            text: node.children[0].text,
            timestamp: node.timestamp ? BeatmapDiscussionHelper.parseTimestamp(node.timestamp) : null,
            type: 'embed',
          };

          if (node.discussionId) {
            doc.discussion_id = node.discussionId;
          }

          review.push(doc);
          break;
      }
    });

    return JSON.stringify(review);
  }

  sortedBeatmaps = () => {
    if (this.cache.beatmaps == null) {
      this.cache.beatmaps = BeatmapHelper.sort(_.values(this.props.beatmaps));
    }

    return this.cache.beatmaps;
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
          if (node.beatmapId && !this.props.beatmaps[node.beatmapId]) {
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
