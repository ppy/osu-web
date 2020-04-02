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
