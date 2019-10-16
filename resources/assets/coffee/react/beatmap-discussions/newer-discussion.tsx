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

import * as React from 'react';
import { Value } from 'slate';
import { Editor } from 'slate-react';

// interface State {
//   editorState: EditorState;
// }

// interface Props {
//   beatmapset: any;
//   discussion: any;
//   users: any;
// }

const existingValue: any = localStorage.getItem('content') || '{"document":{"nodes":[{"object":"block","type":"paragraph","nodes":[{"object":"text","text":"A line of text in a paragraph."}]}]}}';

const initialValue = Value.fromJSON(JSON.parse(existingValue));

class TestComponent extends React.Component<any, any> {
  remove = (event) => {
    const { editor, node } = this.props;

    event.preventDefault();
    editor.removeNodeByKey(node.key);
  }

  render(): React.ReactNode {
    return (
      <div className="beatmap-discussion beatmap-discussion--preview" {...this.props.attributes}>
          <div className="beatmap-discussion__discussion">
              <div className="beatmap-discussion-post beatmap-discussion-post--reply beatmap-discussion-post--dev">
                  <div className="beatmap-discussion-post__content">
                      <div className="beatmap-discussion-post__user-container">
                          <div className="beatmap-discussion-post__avatar">
                              <a className="beatmap-discussion-post__user-link" href="/users/102">
                                  <div className="avatar avatar--full-rounded"
                                       style={{backgroundImage: 'url(https://a.ppy.sh/102?1500537068)'}}>
                                  </div>
                              </a>
                          </div>
                          <div className="beatmap-discussion-post__user">
                              <div className="beatmap-discussion-post__user-row">
                                  <a className="beatmap-discussion-post__user-link" href="/users/102">
                                      <span className="beatmap-discussion-post__user-text u-ellipsis-overflow">nekodex</span>
                                  </a>
                                  <a className="beatmap-discussion-post__user-modding-history-link" href="/users/102/modding" title="View modding history">
                                      <i className="fas fa-align-left"></i>
                                  </a>
                              </div>
                              <div className="beatmap-discussion-post__user-badge">
                                  <div className="user-group-badge user-group-badge--dev"></div>
                              </div>
                          </div>
                          <div className="beatmap-discussion-post__user-stripe"></div>
                      </div>
                      <div className="beatmap-discussion-post__message-container undefined">
                          <div className="beatmap-discussion-post__message">
                              <div className="beatmapset-discussion-message">{this.props.children}</div>
                          </div>
                          <div className="beatmap-discussion-post__info-container">
                              <span className="beatmap-discussion-post__info">
                                  {/*<time className="timeago" dateTime="2019-09-05T08:04:17+00:00" title="2019-09-05T08:04:17+00:00">8 days ago</time>*/}
                              </span>
                          </div>
                          <div className="beatmap-discussion-post__actions">
                              <div className="beatmap-discussion-post__actions-group">
                                  {/*<button className="beatmap-discussion-post__action beatmap-discussion-post__action--button">edit</button>*/}
                                  <a className="beatmap-discussion-post__action beatmap-discussion-post__action--button" href="#" onClick={this.remove}>delete</a>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
    );
  }
}
/*
  <Post
    key={osu.uuid()}
    beatmapset={this.props.beatmapset}
    discussion={this.props.discussion}
    // post={post}
    type={'reply'}
    users={this.props.users}
    user={this.props.users[currentUser.user_id]}
    currentUser={currentUser}
    />
 */
export default class NewerDiscussion extends React.Component<any, any> {
  // private TIMESTAMP_REGEX = /\b(\d{2,}):([0-5]\d)[:.](\d{3})\b/g;

  editor = React.createRef<Editor>();

  constructor(props: {}) {
    super(props);

    // const compositeDecorator = new CompositeDecorator([
    //   // {
    //   //   component: this.HandleSpan,
    //   //   strategy: this.handleStrategy,
    //   // },
    //   // {
    //   //   component: this.HashtagSpan,
    //   //   strategy: this.hashtagStrategy,
    //   // },
    //   {
    //     component: this.TimestampSpan,
    //     strategy: this.timestampStrategy,
    //   },
    // ]);

    this.state = {
      value: initialValue,
    };

    // this.onChange = (editorState) => this.setState({editorState});
  }

  // componentDidUpdate(prevProps: Readonly<any>, prevState: Readonly<State>, snapshot?: any): void {
  //   console.log('waaaaaaaaaangs', prevProps, prevState, snapshot);
  // }

  // handleStrategy = (contentBlock: any, callback: any, contentState: any) => {
  //   this.findWithRegex(this.HANDLE_REGEX, contentBlock, callback);
  // }
  //
  // hashtagStrategy = (contentBlock: any, callback: any, contentState: any) => {
  //   this.findWithRegex(this.HASHTAG_REGEX, contentBlock, callback);
  // }

  // timestampStrategy = (contentBlock: any, callback: any, contentState: any) => {
  //   this.findWithRegex(this.TIMESTAMP_REGEX, contentBlock, callback);
  // }
  //
  // findWithRegex = (regex: any, contentBlock: any, callback: any) => {
  //   const text = contentBlock.getText();
  //   let matchArr, start;
  //   while ((matchArr = regex.exec(text)) !== null) {
  //     start = matchArr.index;
  //     callback(start, start + matchArr[0].length);
  //   }
  // }

  // HandleSpan = (props: any) => {
  //   return (
  //     <span
  //       style={{color: 'green'}}
  //       data-offset-key={props.offsetKey}
  //     >
  //       {props.children}
  //     </span>
  //   );
  // }
  //
  // HashtagSpan = (props: any) => {
  //   return (
  //     <span
  //       style={{color: 'pink'}}
  //       data-offset-key={props.offsetKey}
  //     >
  //       {props.children}
  //     </span>
  //   );
  // }

  TimestampSpan = (props: any) => {
    console.log('timestamp', props);
    return (
      <span className='beatmapset-discussion-message'>
        <a href={`osu:\/\/edit\/${props.decoratedText}`} className='beatmapset-discussion-message__timestamp'>
          {props.children}
        </a>
      </span>
    );
  }

  myBlockRenderer = (contentBlock: any) => {
    const type = contentBlock.getType();
    if (type === 'atomic') {
      return {
        component: TestComponent,
        editable: false,
        props: {
          foo: 'bar',
        },
      };
    }
  }

  buttan = () => {
    if (!this.editor.current) {
      return;
    }

    this.editor.current
      .insertBlock({
        type: 'embed',
      })
      .focus();

    // value.change()
    //   .insertBlock({
    //     type: 'embed',
    //     data: {
    //       foo: 'bar',
    //     },
    //   });
    // const contentState = this.state.editorState.getCurrentContent();
    // const contentStateWithEntity = contentState.createEntity(
    //   'test',
    //   'IMMUTABLE',
    //   {},
    // );
    // const entityKey = contentStateWithEntity.getLastCreatedEntityKey();
    // const newEditorState = AtomicBlockUtils.insertAtomicBlock(
    //   this.state.editorState,
    //   entityKey,
    //   ' ',
    // );
    //
    // this.setState({
    //   editorState: EditorState.forceSelection(
    //     newEditorState,
    //     newEditorState.getCurrentContent().getSelectionAfter(),
    //   ),
    // });
  }

  renderBlock = (props, editor, next) => {
    switch (props.node.type) {
      case 'embed':
        return <TestComponent {...props} />;
      default:
        return next();
    }
  }

  log = () => {
    console.log(
      'LOGGGGGGGG',
      this.state.value.toJSON(),
    );
    // console.log(convertToRaw(this.state.editorState.getCurrentContent()));
  }

  // @ts-ignore
  onChange = ({ value }) => {
    const content = JSON.stringify(value.toJSON());
    localStorage.setItem('content', content);

    this.setState({ value });
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
                <div className={`${bn}__content`}>
                  <Editor
                    value={this.state.value}
                    onChange={this.onChange}
                    // editorState={this.state.editorState}
                    // onChange={this.onChange}
                    // placeholder='WANG ALL THE CHUNGS'
                    // blockRendererFn={this.myBlockRenderer}
                    renderBlock={this.renderBlock}
                    ref={this.editor}
                  />
                  <hr width='100%' />

                  <div className="forum-post-edit__buttons forum-post-edit__buttons--actions">
                    <div className="forum-post-edit__button">
                        <button type="button" className="btn-osu-big btn-osu-big--forum-secondary" onClick={this.buttan}>
                            buttan
                        </button>
                    </div>

                    <div className="forum-post-edit__button forum-post-edit__button--preview">
                        <button type="button" className="btn-osu-big btn-osu-big--forum-secondary" onClick={this.log}>
                            log
                        </button>
                    </div>

                      <div className="forum-post-edit__button">
                          <button className="btn-osu-big btn-osu-big--forum-primary" type="submit" data-disable-with="Saving...">
                              Post
                          </button>
                      </div>
                  </div>
                  {/*<button type='button' onClick={this.buttan}>buttan</button>*/}
                  {/*<button type='button' onClick={this.log}>log</button>*/}
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    );
  }
}
