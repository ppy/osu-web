// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { DiscussionsContext } from 'beatmap-discussions/discussions-context';
import * as React from 'react';
import Editor from './editor';

interface Props {
  beatmaps: Beatmap[];
  beatmapset: Beatmapset;
  currentBeatmap: Beatmap;
  currentDiscussions: BeatmapDiscussion[];
  currentUser: User;
  pinned?: boolean;
  setPinned?: (sticky: boolean) => void;
  stickTo?: React.RefObject<HTMLDivElement>;
}

// TODO: move to globals.d.ts
interface StickyHeader {
  headerHeight: () => number;
}

declare global {
  interface Window {
    stickyHeader: StickyHeader;
  }
}

export default class NewReview extends React.Component<Props> {
  initialValue: string;
  placeholder: string = '[{"children": [{"text": "placeholder"}], "type": "paragraph"}]';

  constructor(props: Props) {
    super(props);

    const savedValue = localStorage.getItem(`newDiscussion-${this.props.beatmapset.id}`);
    this.initialValue = savedValue || this.placeholder;
    this.state = {
      cssTop: null,
    };
  }

  componentDidMount(): void {
    this.setTop();
    $(window).on('throttled-resize.new-review', this.setTop);
  }

  componentWillUnmount(): void {
    $(window).off('.new-review');
  }

  cssTop = (sticky: boolean) => {
    if (!sticky || !this.props.stickTo?.current) {
      return;
    }

    return window.stickyHeader.headerHeight() + this.props.stickTo?.current?.getBoundingClientRect().height;
  }

  render(): React.ReactNode {
    const floatClass = 'beatmap-discussion-new-float';
    const floatMods = [];
    if (this.props.pinned) {
      floatMods.push('pinned');
    }
    let buttonCssClasses = 'btn-circle';
    if (this.props.pinned) {
      buttonCssClasses += ' btn-circle--activated';
    }

    return (
      <div className={osu.classWithModifiers(floatClass, floatMods)} style={{top: this.state.cssTop}}>
        <div className={`${floatClass}__floatable ${floatClass}__floatable--pinned`}>
          <div className={`${floatClass}__content`}>
            <div className='osu-page osu-page--small'>
              <div className='beatmap-discussion-new'>
                <div className='page-title'>
                  {osu.trans('beatmaps.discussions.new.title')}
                  <span className='page-title__button'>
                    <span
                      className={buttonCssClasses}
                      onClick={this.toggleSticky}
                      title={osu.trans(`beatmaps.discussions.new.${this.props.pinned ? 'unpin' : 'pin'}`)}
                    >
                      <span className='btn-circle__content'><i className='fas fa-thumbtack' /></span>
                    </span>
                  </span>
                </div>
                {
                  this.props.currentUser.id ?
                    <DiscussionsContext.Consumer>
                      {
                        (discussions) => {
                          return <Editor
                            beatmapset={this.props.beatmapset}
                            beatmaps={this.props.beatmaps}
                            currentBeatmap={this.props.currentBeatmap}
                            currentDiscussions={this.props.currentDiscussions}
                            discussions={discussions}
                            initialValue={this.initialValue}
                          />;
                        }
                      }
                    </DiscussionsContext.Consumer>
                  :
                    <div className='beatmap-discussion-new__login-required'>{osu.trans('beatmaps.discussions.require-login')}</div>
                }
              </div>
            </div>
          </div>
        </div>
      </div>
    );
  }

  setSticky = (sticky = true) => {
    this.setState({
      cssTop: this.cssTop(sticky),
    });

    if (this.props.setPinned) {
      this.props.setPinned(sticky);
    }
  }

  toggleSticky = () => {
    this.setSticky(!this.props.pinned);
  }

  setTop = () => {
    this.setState({
      cssTop: this.cssTop(this.props.pinned ?? false),
    });
  }
}
