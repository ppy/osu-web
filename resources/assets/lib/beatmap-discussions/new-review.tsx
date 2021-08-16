// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { DiscussionsContext } from 'beatmap-discussions/discussions-context';
import { BeatmapsetJson } from 'beatmapsets/beatmapset-json';
import BeatmapJsonExtended from 'interfaces/beatmap-json-extended';
import UserJson from 'interfaces/user-json';
import * as React from 'react';
import { classWithModifiers } from 'utils/css';
import Editor from './editor';

interface Props {
  beatmaps: BeatmapJsonExtended[];
  beatmapset: BeatmapsetJson;
  currentBeatmap: BeatmapJsonExtended;
  currentDiscussions: BeatmapsetDiscussionJson[];
  currentUser: UserJson;
  pinned?: boolean;
  setPinned?: (sticky: boolean) => void;
  stickTo?: React.RefObject<HTMLDivElement>;
}

interface State {
  cssTop: string | number | undefined;
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

export default class NewReview extends React.Component<Props, State> {

  constructor(props: Props) {
    super(props);

    this.state = {
      cssTop: undefined,
    };
  }

  componentDidMount(): void {
    this.setTop();
    $(window).on('resize', this.setTop);
  }

  componentWillUnmount(): void {
    $(window).off('resize', this.setTop);
  }

  cssTop = (sticky: boolean) => {
    if (!sticky || !this.props.stickTo?.current) {
      return;
    }

    return window.stickyHeader.headerHeight() + this.props.stickTo?.current?.getBoundingClientRect().height;
  };

  onFocus = () => this.setSticky(true);

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
      <div className={classWithModifiers(floatClass, floatMods)} style={{ top: this.state.cssTop }}>
        <div className={`${floatClass}__floatable ${floatClass}__floatable--pinned`}>
          <div className={`${floatClass}__content`}>
            <div className='osu-page osu-page--small'>
              <div className='beatmap-discussion-new'>
                <div className='page-title'>
                  {osu.trans('beatmaps.discussions.review.new')}
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
                        (discussions) => (<Editor
                          beatmaps={this.props.beatmaps}
                          beatmapset={this.props.beatmapset}
                          currentBeatmap={this.props.currentBeatmap}
                          currentDiscussions={this.props.currentDiscussions}
                          discussions={discussions}
                          onFocus={this.onFocus}
                        />)
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

  // TODO: to whoever refactors this - this 'sticky' behaviour was ported from new-discussion.coffee, so remember to refactor that too
  setSticky = (sticky = true) => {
    this.setState({
      cssTop: this.cssTop(sticky),
    });

    if (this.props.setPinned) {
      this.props.setPinned(sticky);
    }
  };

  setTop = () => {
    this.setState({
      cssTop: this.cssTop(this.props.pinned ?? false),
    });
  };

  toggleSticky = () => {
    this.setSticky(!this.props.pinned);
  };
}
