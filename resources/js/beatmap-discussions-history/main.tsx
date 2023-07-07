// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { BeatmapsContext } from 'beatmap-discussions/beatmaps-context';
import { BeatmapsetsContext } from 'beatmap-discussions/beatmapsets-context';
import { Discussion } from 'beatmap-discussions/discussion';
import { DiscussionsContext } from 'beatmap-discussions/discussions-context';
import BeatmapsetCover from 'components/beatmapset-cover';
import BeatmapExtendedJson from 'interfaces/beatmap-extended-json';
import { BeatmapsetDiscussionJsonForBundle } from 'interfaces/beatmapset-discussion-json';
import BeatmapsetExtendedJson from 'interfaces/beatmapset-extended-json';
import UserJson from 'interfaces/user-json';
import { isEmpty, keyBy } from 'lodash';
import { computed, makeObservable } from 'mobx';
import { observer } from 'mobx-react';
import { deletedUser } from 'models/user';
import * as React from 'react';
import { makeUrl } from 'utils/beatmapset-discussion-helper';
import { trans } from 'utils/lang';

interface Props {
  beatmapsets: BeatmapsetExtendedJson[];
  discussions: BeatmapsetDiscussionJsonForBundle[];
  relatedBeatmaps: BeatmapExtendedJson[];
  relatedDiscussions: BeatmapsetDiscussionJsonForBundle[];
  users: UserJson[];
}

@observer
export class Main extends React.Component<Props> {
  @computed
  private get beatmaps() {
    return keyBy(this.props.relatedBeatmaps, 'id');
  }

  @computed
  private get beatmapsets() {
    return keyBy(this.props.beatmapsets, 'id');
  }

  @computed
  private get discussions() {
    // skipped discussions
    // - not privileged (deleted discussion)
    // - deleted beatmap
    return keyBy(this.props.relatedDiscussions.filter((d) => !isEmpty(d)), 'id');
  }

  @computed
  private get users() {
    const values = keyBy(this.props.users, 'id');
    // eslint-disable-next-line id-blacklist
    values.null = values.undefined = deletedUser.toJson();

    return values;
  }

  constructor(props: Props) {
    super(props);

    makeObservable(this);
  }

  render() {
    return (
      <DiscussionsContext.Provider value={this.discussions}>
        <BeatmapsetsContext.Provider value={this.beatmapsets}>
          <BeatmapsContext.Provider value={this.beatmaps}>
            <div className='modding-profile-list modding-profile-list--index'>
              {this.props.discussions.length === 0 ? (
                <div className='modding-profile-list__empty'>
                  {trans('beatmap_discussions.index.none_found')}
                </div>
              ) : (this.props.discussions.map((discussion) => (
                <div key={discussion.id} className='modding-profile-list__row'>
                  <a
                    className='modding-profile-list__thumbnail'
                    href={makeUrl({ discussion })}
                  >
                    <BeatmapsetCover
                      beatmapset={this.beatmapsets[discussion.beatmapset_id]}
                      size='list'
                    />
                  </a>
                  <Discussion
                    beatmapset={this.beatmapsets[discussion.beatmapset_id]}
                    currentBeatmap={discussion.beatmap_id != null ? this.beatmaps[discussion.beatmap_id] : null}
                    discussion={discussion}
                    isTimelineVisible={false}
                    preview
                    readonly
                    showDeleted
                    users={this.users}
                  />
                </div>
              )))}
            </div>
          </BeatmapsContext.Provider>
        </BeatmapsetsContext.Provider>
      </DiscussionsContext.Provider>
    );
  }
}
