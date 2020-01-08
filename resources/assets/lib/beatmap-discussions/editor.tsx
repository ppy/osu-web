/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */

import isHotkey from 'is-hotkey';
import * as laroute from 'laroute';
import * as _ from 'lodash';
import * as React from 'react';
import { createEditor, Editor as SlateEditor, Element as SlateElement, Node as SlateNode, NodeEntry, Range, Text, Transforms } from 'slate';
import { withHistory } from 'slate-history';
import { Editable, ReactEditor, RenderElementProps, RenderLeafProps, Slate, withReact } from 'slate-react';
import EditorDiscussionComponent from './editor-discussion-component';
import { SlateContext } from './slate-context';

const placeholder: string = '[{"children": [{"text": "placeholder"}], "type": "paragraph"}]';
let initialValue: string = placeholder;

interface TimestampRange extends Range {
  timestamp: string;
}

export default class Editor extends React.Component<any, any> {
  editor = React.createRef<HTMLDivElement>();
  menu = React.createRef<HTMLDivElement>();
  menuBody = React.createRef<HTMLDivElement>();
  slateEditor: ReactEditor;

  constructor(props: {}) {
    super(props);

    this.slateEditor = this.withNormalization(withHistory(withReact(createEditor())));

    const savedValue = localStorage.getItem(`newDiscussion-${this.props.beatmapset.id}`);
    if (savedValue) {
      initialValue = savedValue;
    }

    this.state = {
      menuOffset: -1000,
      menuShown: false,
      value: JSON.parse(initialValue),
    };
  }

  buttan = (event: React.MouseEvent<HTMLElement>, type: string) => {
    event.preventDefault();

    Transforms.setNodes(this.slateEditor, {
      beatmapId: this.props.currentBeatmap.id,
      discussionType: type,
      type: 'embed',
    });
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

  hideMenu = (e: React.MouseEvent<HTMLElement>) => {
    if (!this.menuBody.current) {
      return;
    }
    this.setState({menuShown: false});
  }

  // test = () => {
  //   let output = [];
  //   const whee = this.state.value.toJSON().document.nodes;
  //
  //   whee.forEach((node) => {
  //     switch (node.type) {
  //       case 'paragraph':
  //         const temp: string[] = [];
  //         node.nodes.forEach((child) => {
  //           let marks: string[] = [];
  //           child.marks.forEach((mark) => {
  //             switch (mark.type) {
  //               case 'bold':
  //                 marks.push('**');
  //                 break;
  //               case 'italic':
  //                 marks.push('*');
  //                 break;
  //             }
  //           });
  //           temp.push([marks.join(''), child.text, marks.reverse().join('')].join(''));
  //         });
  //         output.push(temp.join('') + '\n');
  //         break;
  //       case 'embed':
  //         output.push('[embed goes here]\n');
  //         break;
  //     }
  //   });
  //
  //   console.log(output.join(''));
  // }

  log = () => console.log(JSON.stringify(this.state.value));

  onChange = (value: SlateNode[]) => {
    const content = JSON.stringify(value);
    localStorage.setItem(`newDiscussion-${this.props.beatmapset.id}`, content);

    this.setState({value}, () => {
      if (!ReactEditor.isFocused(this.slateEditor) && !this.state.menuShown) {
        this.setState({menuOffset: -1000});
        return;
      }

      const selection = window.getSelection();
      // console.log('selection', selection, 'rangeCount', selection?.rangeCount);
      // try {
      //   const derp = selection?.getRangeAt(0);
      // } catch (e) {
      //   console.log('xselection', selection, 'xrangeCount', selection?.rangeCount);
      //   // debugger
      // }
      let menuOffset: number = -1000;
      if (selection && selection.anchorNode !== null) {
        const selectionTop = window.getSelection()?.getRangeAt(0).getBoundingClientRect().top ?? -1000;
        // const selectionHeight = window.getSelection()?.getRangeAt(0).getBoundingClientRect().height ?? 0;
        const editorTop = this.editor.current?.getBoundingClientRect().top ?? 0;
        menuOffset = selectionTop - editorTop - 5;
        // if (this.editor.current && this.editor.current.value.anchorBlock) {
        // const node = findDOMNode(this.editor.current.value.anchorBlock.key) as HTMLElement;
        // menuOffset = node.offsetTop + (node.offsetHeight / 2);
      } else {
        console.log('[explosion caught]', 'selection', selection, 'rangeCount', selection?.rangeCount);
      }

      this.setState({menuOffset});
      // }
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
    const data = this.state.value.toJSON();

    $.ajax(laroute.route('beatmap-discussion-posts.review'),
      {
        data: {
          beatmapset_id: this.props.beatmapset.id,
          document: JSON.stringify(data),
        },
        method: 'POST',
      }).then(() => {
        this.resetInput();
    });
  }

  render(): React.ReactNode {
    const cssClasses = 'beatmap-discussion-new-float';
    const bn = 'beatmap-discussion-newer';

    return (
      <div className={cssClasses}>
        <div className='beatmap-discussion-new-float__floatable beatmap-discussion-new-float__floatable--pinned'>
          <div className='beatmap-discussion-new-float__content'>
            <div className='osu-page osu-page--small'>
              <div className={bn}>
                <div className='page-title'>{osu.trans('beatmaps.discussions.new.title')}</div>
                <div ref={this.editor} className={`${bn}__content`}>
                  <SlateContext.Provider
                    value={this.slateEditor}
                  >
                    <Slate
                      editor={this.slateEditor}
                      value={this.state.value}
                      onChange={this.onChange}
                    >
                      <Editable
                        decorate={this.decorate}
                        onKeyDown={this.onKeyDown}
                        renderElement={this.renderElement}
                        renderLeaf={this.renderLeaf}
                      />
                      <div className='forum-post-edit__buttons-bar'>
                        <div className='forum-post-edit__buttons forum-post-edit__buttons--toolbar'>
                          <div className='post-box-toolbar'>
                              <button
                                  className='btn-circle btn-circle--bbcode'
                                  title='Bold'
                                  type='button'
                                  onClick={this.toggleBold}
                              >
                                  <span className='btn-circle__content'>
                                      <i className='fas fa-bold'/>
                                  </span>
                              </button>
                              <button
                                  className='btn-circle btn-circle--bbcode'
                                  title='Italic'
                                  type='button'
                                  onClick={this.toggleItalic}
                              >
                                  <span className='btn-circle__content'>
                                      <i className='fas fa-italic'/>
                                  </span>
                              </button>
                          </div>
                        </div>
                        <div className='forum-post-edit__buttons forum-post-edit__buttons--actions'>
                            <div className='forum-post-edit__button'>
                              <button className='btn-osu-big btn-osu-big--forum-primary' type='submit' onClick={this.resetInput}>reset</button>
                              <button className='btn-osu-big btn-osu-big--forum-primary' type='submit' onClick={this.log}>log</button>
                              <button className='btn-osu-big btn-osu-big--forum-primary' type='submit' onClick={this.post}>post</button>
                          </div>
                        </div>
                      </div>
                      <div
                        className={`${bn}__menu`}
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
                          className={`${bn}__menu-content`}
                          ref={this.menuBody}
                          style={{
                            display: this.state.menuShown ? 'block' : 'none',
                          }}
                        >
                          <button type='button' className='btn-circle btn-circle--bbcode' onClick={(event) => this.buttan(event, 'suggestion')}>
                            <span className='beatmap-discussion-message-type beatmap-discussion-message-type--suggestion'><i className='far fa-circle'/></span>
                          </button>
                          <button type='button' className='btn-circle btn-circle--bbcode' onClick={(event) => this.buttan(event, 'problem')}>
                            <span className='beatmap-discussion-message-type beatmap-discussion-message-type--problem'><i className='fas fa-exclamation-circle'/></span>
                          </button>
                          <button type='button' className='btn-circle btn-circle--bbcode' onClick={(event) => this.buttan(event, 'praise')}>
                            <span className='beatmap-discussion-message-type beatmap-discussion-message-type--praise'><i className='fas fa-heart'/></span>
                          </button>
                        </div>
                      </div>
                    </Slate>
                  </SlateContext.Provider>
                </div>
              </div>
            </div>
          </div>
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
            beatmaps={_.flatten(_.values(this.props.beatmaps))}
            {...props}
          />
        );
      case 'other':
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
      return <span className={'beatmapset-discussion-message'} {...props.attributes}><a href={`osu:\/\/edit\/${props.leaf.timestamp}`} className={'beatmapset-discussion-message__timestamp'}>{children}</a></span>;
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

  showMenu = () => {
    if (!this.menuBody.current) {
      return;
    }
    this.setState({menuShown: true});
  }

  toggleBold = (event: React.MouseEvent) => {
    event.preventDefault();
    this.toggleMark('bold');
  }

  toggleItalic = (event: React.MouseEvent) => {
    event.preventDefault();
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
            Transforms.setNodes(
              editor,
              { bold: false, italic: false },
              { at: childPath },
            );

            return;
          }
        }
      }

      normalizeNode(entry);
    };

    return editor;
  }
}
