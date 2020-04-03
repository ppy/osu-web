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
}

export default class NewReview extends React.Component<Props> {
  initialValue: string;
  placeholder: string = '[{"children": [{"text": "placeholder"}], "type": "paragraph"}]';

  constructor(props: Props) {
    super(props);

    const savedValue = localStorage.getItem(`newDiscussion-${this.props.beatmapset.id}`);
    this.initialValue = savedValue || this.placeholder;
  }

  render(): React.ReactNode {
    const floatClass = 'beatmap-discussion-new-float';

    return (
      <div className={floatClass}>
        <div className={`${floatClass}__floatable ${floatClass}__floatable--pinned`}>
          <div className={`${floatClass}__content`}>
            <div className='osu-page osu-page--small'>
              <div className='beatmap-discussion-new'>
                <div className='page-title'>{osu.trans('beatmaps.discussions.new.title')}</div>
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
}
