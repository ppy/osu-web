// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BeatmapsetDiscussionsStore from 'interfaces/beatmapset-discussions-store';
import { action, computed, makeObservable, observable } from 'mobx';
import { observer } from 'mobx-react';
import core from 'osu-core-singleton';
import * as React from 'react';
import { downloadLimited } from 'utils/beatmapset-helper';
import { classWithModifiers } from 'utils/css';
import { trans } from 'utils/lang';
import DiscussionsState from './discussions-state';
import Editor from './editor';

interface Props {
  discussionsState: DiscussionsState;
  innerRef: React.RefObject<HTMLDivElement>;
  onFocus?: () => void;
  stickTo?: React.RefObject<HTMLDivElement>;
  store: BeatmapsetDiscussionsStore;
}

@observer
export default class NewReview extends React.Component<Props> {
  private readonly disposers = new Set<((() => void) | undefined)>();
  @observable private mounted = false;
  @observable private stickToHeight: number | undefined;

  private get beatmapset() {
    return this.props.discussionsState.beatmapset;
  }

  @computed
  private get cssTop() {
    if (this.mounted && this.pinned && this.stickToHeight != null) {
      return core.stickyHeader.headerHeight + this.stickToHeight;
    }
  }

  private get pinned() {
    return this.props.discussionsState.pinnedNewDiscussion;
  }

  private get noPermissionText() {
    if (downloadLimited(this.beatmapset)) {
      return trans('beatmaps.discussions.message_placeholder_locked');
    }

    if (core.currentUser == null) {
      return trans('beatmaps.discussions.require-login');
    }

    return null;
  }

  constructor(props: Props) {
    super(props);

    makeObservable(this);
  }

  componentDidMount(): void {
    // watching for height changes on the stickTo element to handle horizontal scrollbars when they appear.
    $(window).on('resize', this.updateStickToHeight);
    this.disposers.add(core.reactTurbolinks.runAfterPageLoad(action(() => {
      this.mounted = true;
      this.updateStickToHeight();
    })));
  }

  componentWillUnmount(): void {
    $(window).off('resize', this.updateStickToHeight);
    this.disposers.forEach((disposer) => disposer?.());
  }

  render(): React.ReactNode {
    const floatClass = 'beatmap-discussion-new-float';
    const placeholder = this.mounted ? this.noPermissionText : '';

    return (
      <div className={classWithModifiers(floatClass, { pinned: this.pinned })} style={{ top: this.cssTop }}>
        <div className={`${floatClass}__floatable`}>
          <div ref={this.props.innerRef} className={`${floatClass}__content`}>
            <div className='osu-page osu-page--small'>
              <div className='beatmap-discussion-new'>
                <div className='page-title'>
                  {trans('beatmaps.discussions.review.new')}
                  <span className='page-title__button'>
                    <span
                      className={classWithModifiers('btn-circle', { activated: this.pinned })}
                      onClick={this.toggleSticky}
                      title={trans(`beatmaps.discussions.new.${this.pinned ? 'unpin' : 'pin'}`)}
                    >
                      <span className='btn-circle__content'><i className='fas fa-thumbtack' /></span>
                    </span>
                  </span>
                </div>
                {placeholder == null ? (
                  <Editor
                    discussionsState={this.props.discussionsState}
                    onFocus={this.handleFocus}
                    store={this.props.store}
                  />
                ) : <div className='beatmap-discussion-new__login-required'>{placeholder}</div>}
              </div>
            </div>
          </div>
        </div>
      </div>
    );
  }

  private readonly handleFocus = () => {
    this.setSticky(true);
    this.props.onFocus?.();
  };

  @action
  private setSticky(sticky: boolean) {
    this.props.discussionsState.pinnedNewDiscussion = sticky;
    this.updateStickToHeight();
  }

  private readonly toggleSticky = () => {
    this.setSticky(!this.pinned);
  };

  @action
  private readonly updateStickToHeight = () => this.stickToHeight = this.props.stickTo?.current?.getBoundingClientRect().height;
}
