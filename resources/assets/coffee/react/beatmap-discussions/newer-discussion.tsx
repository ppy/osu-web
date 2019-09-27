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

import { BeatmapIcon } from 'beatmap-icon';
import * as _ from 'lodash';
import * as React from 'react';
import * as ReactDOM from 'react-dom';
import { Value } from 'slate';
import { Editor as CoreEditor } from 'slate';
import InstantReplace from 'slate-instant-replace';
import { Editor, findDOMNode, RenderBlockProps, RenderInlineProps } from 'slate-react';
import SoftBreak from 'slate-soft-break';

let initialValue: string = '{"document":{"nodes":[{"object":"block","type":"paragraph","nodes":[{"object":"text","text":"A line of text in a paragraph."}]}]}}';

type DiscussionType = 'hype' | 'mapperNote' | 'praise' | 'problem' | 'suggestion';

class TestDropdown extends React.Component<any, any> {
  portal: HTMLDivElement;
  private topRef: React.RefObject<HTMLDivElement>;

  constructor(props: {}) {
    super(props);
    this.portal = document.createElement('div');
    document.body.appendChild(this.portal);
    this.topRef = React.createRef<HTMLDivElement>();

    this.state = {
      visible: false,
    };
  }

  select = (event: React.MouseEvent<HTMLElement>) => {
    event.preventDefault();

    const target = event.currentTarget as HTMLElement;

    if (!target) {
      return;
    }

    const id = parseInt(target.dataset.id || '', 10);
    if (id) {
      this.setState({visible: false}, () => {
        const {editor, node} = this.props;
        const data = node.data.merge({beatmapId: id});
        editor.setNodeByKey(node.key, {data});
      });
    }
  }

  toggleMenu = (event: Event) => {
    event.preventDefault();
    this.setState({
      visible: !this.state.visible,
    });
  }

  beatmapThing = (beatmap: Beatmap) => {
    if (beatmap.deleted_at) {
      return null;
    }
    const menuItemClasses = ""

    return (
      <a
        href='#'
        className={menuItemClasses}
        key={beatmap.id}
        data-id={beatmap.id}
        style={{
          display: 'flex',
        }}
        onClick={this.select}
      >
        <BeatmapIcon
          beatmap={beatmap}
        />
        <div
          style={{
            paddingLeft: '5px',
          }}
        >
          {beatmap.version}
        </div>
      </a>
    );
  }

  componentDidUpdate(prevProps: Readonly<any>, prevState: Readonly<any>, snapshot?: any): void {
    if (!this.topRef.current) {
      return;
    }

    const position = $(this.topRef.current).offset();
    if (!position) {
      return;
    }

    const { top, left } = position;
    this.portal.style.position = 'absolute';
    this.portal.style.top = `${Math.floor(top + this.topRef.current.offsetHeight)}px`;
    this.portal.style.left = `${Math.floor(left)}px`;

  }

  renderList = () => {
    return ReactDOM.createPortal(
        <div className='beatmap-discussion-newer__dropdown-menu' contentEditable={false}>
          {this.props.beatmaps.map((bm: Beatmap) => this.beatmapThing(bm))}
        </div>
      , this.portal);
  }

  render(): React.ReactNode {
    const beatmap = this.props.node.data.get('beatmapId') ? _.find(this.props.beatmaps, (b) => b.id === this.props.node.data.get('beatmapId')) : this.props.currentBeatmap;
    return (
      <React.Fragment>
        <a href='#' className='beatmap-discussion-newer__dropdown' onClick={this.toggleMenu} contentEditable={false} {...this.props.attributes} ref={this.topRef}>
          <BeatmapIcon
            beatmap={beatmap}
          />
        </a>
        {this.state.visible && this.renderList()}
      </React.Fragment>
    );
  }
}

class TestComponent extends React.Component<any, any> {
  remove = (event: React.MouseEvent<HTMLElement>) => {
    const { editor, node } = this.props;

    event.preventDefault();
    editor.removeNodeByKey(node.key);
  }

  render(): React.ReactNode {
    const { isFocused, node } = this.props;
    const styles = isFocused ? {} : {};
    // const styles = {};
    const type: DiscussionType = node.data.get('type');
    const icons = {
      hype: 'fas fa-bullhorn',
      mapperNote: 'far fa-sticky-note',
      praise: 'fas fa-heart',
      problem: 'fas fa-exclamation-circle',
      suggestion: 'far fa-circle',
    };

    return (
      <div className='beatmap-discussion beatmap-discussion--preview' style={styles} {...this.props.attributes}>
        <div className='beatmap-discussion__discussion'>
            <div className='beatmap-discussion-post beatmap-discussion-post--reply'>
                <div className='beatmap-discussion-post__content'>
                    <TestDropdown {...this.props}/>
                    <div className='beatmap-discussion-post__user-container' contentEditable={false}>
                      <div className='beatmap-discussion-timestamp__icons-container' style={{marginRight: '10px'}}>
                        <div className='beatmap-discussion-timestamp__icons'>
                          <div className='beatmap-discussion-timestamp__icon'>
                            <span className={`beatmap-discussion-message-type beatmap-discussion-message-type--${type}`}><i className={icons[type]} /></span>
                          </div>
                          <div className='beatmap-discussion-timestamp__icon beatmap-discussion-timestamp__icon--resolved'>
                            {/*<i className="far fa-check-circle"></i>*/}
                          </div>
                        </div>
                        <div className='beatmap-discussion-timestamp__text'>00:00.184</div>
                      </div>
                      <div className='beatmap-discussion-post__user-stripe'/>
                    </div>
                    <div className='beatmap-discussion-post__message-container undefined'>
                        <div className='beatmapset-discussion-message'>{this.props.children}</div>
                        <div className='beatmap-discussion-post__actions' contentEditable={false}>
                            <div className='beatmap-discussion-post__actions-group'>
                                <a className='beatmap-discussion-post__action beatmap-discussion-post__action--button' href='#' onClick={this.remove}>delete</a>
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

const Replacer = (editor: Editor, lastWord: string) => {
  const TIMESTAMP_REGEX = /\b(\d{2,}):([0-5]\d)[:.](\d{3})\b/;
  if (lastWord.match(TIMESTAMP_REGEX)) {
    editor.moveFocusBackward(lastWord.length); // select last word
    editor.unwrapInline('timestamp'); // remove existing urls
    editor.wrapInline({ type: 'timestamp', data: { lastWord } }); // set URL inline
    editor.moveFocusForward(lastWord.length); // deselect it
  }
};

export default class NewerDiscussion extends React.Component<any, any> {
  editor = React.createRef<Editor>();
  menu = React.createRef<HTMLDivElement>();
  menuBody = React.createRef<HTMLDivElement>();
  plugins = [
    SoftBreak({ shift: true }),
    InstantReplace(Replacer),
  ];

  constructor(props: {}) {
    super(props);

    const savedValue = localStorage.getItem(`newDiscussion-${this.props.beatmapset.id}`);
    if (savedValue) {
      initialValue = savedValue;
    }

    this.state = {
      menuOffset: -1000,
      menuShown: false,
      value: Value.fromJSON(JSON.parse(initialValue)),
    };
  }

  buttan = (event: React.MouseEvent<HTMLElement>, type: string) => {
    event.preventDefault();

    if (!this.editor.current) {
      return;
    }

    this.editor.current
      .focus()
      .moveToStart()
      .insertBlock({
        type: 'embed',
        data: {
          type,
        },
      });
  }

  hideMenu = (e: React.MouseEvent<HTMLElement>) => {
    if (!this.menuBody.current) {
      return;
    }
    this.setState({menuShown: false});
  }

  log = () => console.log(this.state.value.toJSON());

  onChange = ({ value }: { value: Value }) => {
    const content = JSON.stringify(value.toJSON());
    localStorage.setItem(`newDiscussion-${this.props.beatmapset.id}`, content);

    this.setState({value}, () => {
      if (!this.editor.current) {
        return;
      }

      if (!this.editor.current.value.selection.isFocused && !this.state.menuShown) {
        this.setState({menuOffset: -1000});
        return;
      }

      let menuOffset: number = 0;
      if (this.editor.current && this.editor.current.value.anchorBlock) {
        const node = findDOMNode(this.editor.current.value.anchorBlock.key) as HTMLElement;
        menuOffset = node.offsetTop + (node.offsetHeight / 2);
        this.setState({menuOffset});
      }
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
                <div className={`${bn}__content`}>
                  <Editor
                    value={this.state.value}
                    onChange={this.onChange}
                    plugins={this.plugins}
                    renderBlock={this.renderBlock}
                    renderInline={this.renderInline}
                    ref={this.editor}
                  />
                  <div className='forum-post-edit__buttons forum-post-edit__buttons--actions'>
                    {/*<div className='forum-post-edit__button'>*/}
                    {/*    <button type='button' className='btn-osu-big btn-osu-big--forum-secondary' onClick={this.buttan}>*/}
                    {/*        buttan*/}
                    {/*    </button>*/}
                    {/*</div>*/}

                      <div className='forum-post-edit__button'>
                          <button className='btn-osu-big btn-osu-big--forum-primary' type='submit' onClick={this.log}>
                            log
                        </button>
                    </div>
                  </div>
                  <div
                    className={`${bn}__menu`}
                    ref={this.menu}
                    style={{
                      color: 'white',
                      fontSize: '16px',
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
                      <button type='button' className='btn-circle btn-circle--bbcode' onClick={(e) => this.buttan(e, 'suggestion')}>
                        <span className='beatmap-discussion-message-type beatmap-discussion-message-type--suggestion'><i className='far fa-circle'/></span>
                      </button>
                      <button type='button' className='btn-circle btn-circle--bbcode' onClick={(e) => this.buttan(e, 'problem')}>
                        <span className='beatmap-discussion-message-type beatmap-discussion-message-type--problem'><i className='fas fa-exclamation-circle'/></span>
                      </button>
                      <button type='button' className='btn-circle btn-circle--bbcode' onClick={(e) => this.buttan(e, 'praise')}>
                        <span className='beatmap-discussion-message-type beatmap-discussion-message-type--praise'><i className='fas fa-heart'/></span>
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    );
  }

  renderBlock = (props: RenderBlockProps, editor: CoreEditor, next: () => any) => {
    switch (props.node.type) {
      case 'embed':
        return <TestComponent
          beatmapset={this.props.beatmapset}
          currentBeatmap={this.props.currentBeatmap}
          currentDiscussions={this.props.currentDiscussions}
          beatmaps={_.toArray(this.props.beatmaps)}
          {...props}
        />;
      default:
        return next();
    }
  }

  renderInline = (props: RenderInlineProps, editor: CoreEditor, next: () => any) => {
    const { node, attributes, children } = props;
    switch (node.type) {
      case 'timestamp': {
        return (
          <span className='beatmapset-discussion-message' {...attributes}>
            <a href={`osu:\/\/edit\/${children}`} className='beatmapset-discussion-message__timestamp'>
              {children}
            </a>
          </span>
        );
      }
      default:
        return next();
    }
  }

  showMenu = (event: React.MouseEvent<HTMLElement>) => {
    if (!this.menuBody.current) {
      return;
    }
    this.setState({menuShown: true});
  }
}
