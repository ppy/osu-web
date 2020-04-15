// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import isHotkey from 'is-hotkey';
import * as laroute from 'laroute';
import * as _ from 'lodash';
import * as React from 'react';
import { createEditor, Editor as SlateEditor, Element as SlateElement, Node as SlateNode, NodeEntry, Range, Text, Transforms } from 'slate';
import { withHistory } from 'slate-history';
import { Editable, ReactEditor, RenderElementProps, RenderLeafProps, Slate, withReact } from 'slate-react';
import { BeatmapDiscussionReview, DocumentIssueEmbed } from '../interfaces/beatmap-discussion-review';
import EditorDiscussionComponent from './editor-discussion-component';
import { EditorToolbar } from './editor-toolbar';
import { parseFromMarkdown } from './review-document';
import { SlateContext } from './slate-context';

const placeholder: string = '[{"children": [{"text": "placeholder"}], "type": "paragraph"}]';
let initialValue: string = placeholder;

interface TimestampRange extends Range {
  timestamp: string;
}

interface Props {
  beatmaps: Beatmap[];
  beatmapset: Beatmapset;
  currentBeatmap: Beatmap;
  currentDiscussions: BeatmapDiscussion[];
  discussion?: BeatmapDiscussion;
  discussions: BeatmapDiscussion[];
  document?: string;
  editing?: boolean;
  editMode?: boolean;
  initialValue: string;
}

interface CacheInterface {
  beatmaps?: Beatmap[];
}

export default class Editor extends React.Component<Props, any> {
  cache: CacheInterface = {};
  editor = React.createRef<HTMLDivElement>();
  menu = React.createRef<HTMLDivElement>();
  menuBody = React.createRef<HTMLDivElement>();
  slateEditor: ReactEditor;

  constructor(props: Props) {
    super(props);

    this.slateEditor = this.withNormalization(withHistory(withReact(createEditor())));

    if (props.editMode) {
      this.state = {
        menuOffset: -1000,
        menuShown: false,
        value: [],
      };

      return;
    }

    const savedValue = localStorage.getItem(`newDiscussion-${this.props.beatmapset.id}`);
    if (savedValue) {
      initialValue = savedValue;
    }

    try {
      initialValue = JSON.parse(initialValue);
    } catch (error) {
      console.log('invalid json in localstorage, resetting');
      initialValue = JSON.parse(placeholder);
    }

    this.state = {
      menuOffset: -1000,
      menuShown: false,
      value: initialValue,
    };
  }

  componentDidUpdate(prevProps: Readonly<Props>, prevState: Readonly<any>, snapshot?: any): void {
    const editing = this.props.editing ?? false;
    if (editing !== (prevProps.editing ?? false)) {
      this.toggleEditMode(editing);
    }
  }

  decorate = (entry: NodeEntry) => {
    const node = entry[0];
    const path = entry[1];
    const ranges: TimestampRange[] = [];

    if (!Text.isText(node)) {
      return ranges;
    }

    const TS_REGEX = /\b((\d{2,}):([0-5]\d)[:.](\d{3})( \((?:\d[,|])*\d\))?)/;
    const regex = RegExp(TS_REGEX, 'g');
    let match;

    // tslint:disable-next-line:no-conditional-assignment
    while ((match = regex.exec(node.text)) !== null) {
      if (match && match.index !== undefined) {
        ranges.push({
          anchor: {path, offset: match.index},
          focus: {path, offset: match.index + match[0].length},
          timestamp: match[0],
        });
      }
    }

    return ranges;
  }

  hideMenu = () => {
    if (!this.menuBody.current) {
      return;
    }

    this.setState({menuShown: false});
  }

  insertEmbed = (event: React.MouseEvent<HTMLElement>) => {
    const type = event.currentTarget.dataset.dtype;
    const beatmapId = this.props.currentBeatmap ? this.props.currentBeatmap.id : this.props.beatmaps[this.props.beatmapset.beatmaps[0].id];

    Transforms.insertNodes(this.slateEditor, {
      beatmapId,
      children: [{text: ''}],
      discussionType: type,
      type: 'embed',
    });
  }

  log = () => console.dir(this.state.value);

  onChange = (value: SlateNode[]) => {
    if (!this.props.editMode) {
      const content = JSON.stringify(value);
      localStorage.setItem(`newDiscussion-${this.props.beatmapset.id}`, content);
    }

    this.setState({value}, () => {
      if (!ReactEditor.isFocused(this.slateEditor) && !this.state.menuShown) {
        this.setState({menuOffset: -1000});

        return;
      }

      const selection = window.getSelection();
      let menuOffset: number = -1000;
      if (selection && selection.anchorNode !== null) {
        const selectionTop = window.getSelection()?.getRangeAt(0).getBoundingClientRect().top ?? -1000;
        const editorTop = this.editor.current?.getBoundingClientRect().top ?? 0;
        menuOffset = selectionTop - editorTop - 5;
      } else {
        console.log('[explosion caught]', 'selection', selection, 'rangeCount', selection?.rangeCount);
      }

      this.setState({menuOffset});
    });
  }

  onKeyDown = (event: KeyboardEvent) => {
    if (isHotkey('mod+b', event)) {
      event.preventDefault();
      this.toggleMark('bold');
    } else if (isHotkey('mod+i', event)) {
      event.preventDefault();
      this.toggleMark('italic');
    }
  }

  post = () => {
    $.ajax(laroute.route('beatmapsets.discussion.review', {beatmapset: this.props.beatmapset.id}),
      {
        data: {
          document: this.serialize(),
        },
        method: 'POST',
      }).then(() => {
        this.resetInput();
    });
  }

  render(): React.ReactNode {
    const editorClass = 'beatmap-discussion-editor';
    const modifiers = this.props.editMode ? ['edit-mode'] : undefined;

    return (
      <div ref={this.editor} className={osu.classWithModifiers(editorClass, modifiers)}>
        <div className={`${editorClass}__content`}>
          <SlateContext.Provider
            value={this.slateEditor}
          >
            <Slate
              editor={this.slateEditor}
              value={this.state.value}
              onChange={this.onChange}
            >
              <div className={`${editorClass}__input-area`}>
                <EditorToolbar />
                <Editable
                  decorate={this.decorate}
                  onKeyDown={this.onKeyDown}
                  renderElement={this.renderElement}
                  renderLeaf={this.renderLeaf}
                />
              </div>
              { !this.props.editMode &&
                <div className={`${editorClass}__button-bar`}>
                  <div className='post-box-toolbar'/>
                  <div className={`${editorClass}__button-bar-button`}>
                    <button className='btn-osu-big btn-osu-big--forum-cover' type='submit' onClick={this.resetInput}>clear</button>
                    &nbsp;
                    <button className='btn-osu-big btn-osu-big--forum-primary' type='submit' onClick={this.post}>post
                    </button>
                  </div>
                </div>
              }
              <div
                className={`${editorClass}__menu`}
                ref={this.menu}
                style={{
                  left: '-13px',
                  position: 'absolute',
                  top: `${this.state.menuOffset}px`,
                }}
                onMouseEnter={this.showMenu}
                onMouseLeave={this.hideMenu}
              >
                <div className='forum-post-edit__button'><i className='fa fas fa-plus-circle' /></div>
                <div
                  className={`${editorClass}__menu-content`}
                  ref={this.menuBody}
                  style={{
                    display: this.state.menuShown ? 'block' : 'none',
                  }}
                >
                  <button type='button' className='btn-circle btn-circle--bbcode' data-dtype='suggestion' onClick={this.insertEmbed}>
                    <span className='beatmap-discussion-message-type beatmap-discussion-message-type--suggestion'><i className='far fa-circle'/></span>
                  </button>
                  <button type='button' className='btn-circle btn-circle--bbcode' data-dtype='problem' onClick={this.insertEmbed}>
                    <span className='beatmap-discussion-message-type beatmap-discussion-message-type--problem'><i className='fas fa-exclamation-circle'/></span>
                  </button>
                  <button type='button' className='btn-circle btn-circle--bbcode' data-dtype='praise' onClick={this.insertEmbed}>
                    <span className='beatmap-discussion-message-type beatmap-discussion-message-type--praise'><i className='fas fa-heart'/></span>
                  </button>
                </div>
              </div>
            </Slate>
          </SlateContext.Provider>
        </div>
      </div>
    );
  }

  renderElement = (props: RenderElementProps) => {
    switch (props.element.type) {
      case 'embed':
        return (
          <EditorDiscussionComponent
            beatmapset={this.props.beatmapset}
            currentBeatmap={this.props.currentBeatmap}
            currentDiscussions={this.props.currentDiscussions}
            editMode={this.props.editMode}
            beatmaps={this.sortedBeatmaps()}
            {...props}
          />
        );
      case 'link':
        return <a href={props.element.url} rel='nofollow'>{props.children}</a>;
      default:
        return <div {...props.attributes}>{props.children}</div>;
    }
  }

  renderLeaf = (props: RenderLeafProps) => {
    let children = props.children;
    if (props.leaf.bold) {
      children = <strong>{children}</strong>;
    }

    if (props.leaf.italic) {
      children = <em>{children}</em>;
    }

    if (props.leaf.timestamp) {
      // TODO: fix this nested stuff
      return <span className={'beatmapset-discussion-message'} {...props.attributes}><span className={'beatmapset-discussion-message__timestamp'}>{children}</span></span>;
    }

    return (
      <span {...props.attributes}>{children}</span>
    );
  }

  resetInput = (event?: React.MouseEvent) => {
    if (event) {
      event.preventDefault();
    }

    this.setState({
      value: JSON.parse(placeholder),
    });
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
            timestamp: node.timestamp ? BeatmapDiscussionHelper.timestampToNumber(node.timestamp) : null,
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

  showMenu = () => {
    if (!this.menuBody.current) {
      return;
    }
    this.setState({menuShown: true});
  }

  sortedBeatmaps = () => {
    if (this.cache.beatmaps) {
      return this.cache.beatmaps;
    }
    this.cache.beatmaps = BeatmapHelper.sort(_.flatten(_.values(this.props.beatmaps)));

    return this.cache.beatmaps;
  }

  test = () => console.dir(JSON.parse(this.serialize()));

  toggleBold = () => {
    this.toggleMark('bold');
  }

  toggleEditMode = (enabled: boolean) => {
    if (!this.props.document || !this.props.discussions || _.isEmpty(this.props.discussions)) {
      return;
    }

    if (enabled) {
      this.setState({
        value: parseFromMarkdown(this.props.document, this.props.discussions),
      });
    }
  }

  toggleItalic = () => {
    this.toggleMark('italic');
  }

  toggleMark = (format: any) => {
    const marks = SlateEditor.marks(this.slateEditor);
    const isActive = marks ? marks[format] === true : false;

    if (isActive) {
      SlateEditor.removeMark(this.slateEditor, format);
    } else {
      SlateEditor.addMark(this.slateEditor, format, true);
    }
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
