// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { BeatmapsContext } from 'beatmap-discussions/beatmaps-context';
import { BeatmapsetsContext } from 'beatmap-discussions/beatmapsets-context';
import { Discussion } from 'beatmap-discussions/discussion';
import { DiscussionsContext } from 'beatmap-discussions/discussions-context';
import BeatmapsetCover from 'components/beatmapset-cover';
import BeatmapsetDiscussionsBundleJson from 'interfaces/beatmapset-discussions-bundle-json';
import { keyBy } from 'lodash';
import { computed, makeObservable } from 'mobx';
import { observer } from 'mobx-react';
import { deletedUserJson } from 'models/user';
import * as React from 'react';
import { makeUrl } from 'utils/beatmapset-discussion-helper';
import { trans } from 'utils/lang';

interface Props {
  bundle: BeatmapsetDiscussionsBundleJson;
}

@observer
export default class Main extends React.Component<Props> {
  @computed
  private get beatmaps() {
    return keyBy(this.props.bundle.beatmaps, 'id');
  }

  @computed
  private get beatmapsets() {
    return keyBy(this.props.bundle.beatmapsets, 'id');
  }

  @computed
  private get discussions() {
    return keyBy(this.props.bundle.included_discussions, 'id');
  }

  @computed
  private get users() {
    const values = keyBy(this.props.bundle.users, 'id');
    // eslint-disable-next-line id-blacklist
    values.null = values.undefined = deletedUserJson;

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
              {this.props.bundle.discussions.length === 0 ? (
                <div className='modding-profile-list__empty'>
                  {trans('beatmap_discussions.index.none_found')}
                </div>
              ) : (this.props.bundle.discussions.map((discussion) => {
                // TODO: handle in child component? Refactored state might not have beatmapset here (and uses Map)
                const beatmapset = this.beatmapsets[discussion.beatmapset_id];

                return beatmapset != null && (
                  <div key={discussion.id} className='modding-profile-list__row'>
                    <a
                      className='modding-profile-list__thumbnail'
                      href={makeUrl({ discussion })}
                    >
                      <BeatmapsetCover
                        beatmapset={beatmapset}
                        size='list'
                      />
                    </a>
                    <Discussion
                      beatmapset={beatmapset}
                      currentBeatmap={discussion.beatmap_id != null ? this.beatmaps[discussion.beatmap_id] : null}
                      discussion={discussion}
                      isTimelineVisible={false}
                      preview
                      readonly
                      showDeleted
                      users={this.users}
                    />
                  </div>
                );
              }))}
            </div>
          </BeatmapsContext.Provider>
        </BeatmapsetsContext.Provider>
      </DiscussionsContext.Provider>
    );
  }
}
