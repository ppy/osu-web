// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { Discussion } from 'beatmap-discussions/discussion';
import BeatmapsetCover from 'components/beatmapset-cover';
import BeatmapsetDiscussionsBundleJson from 'interfaces/beatmapset-discussions-bundle-json';
import { makeObservable, observable } from 'mobx';
import { observer } from 'mobx-react';
import BeatmapsetDiscussionsBundleStore from 'models/beatmapset-discussions-bundle-store';
import * as React from 'react';
import { makeUrl } from 'utils/beatmapset-discussion-helper';
import { trans } from 'utils/lang';

interface Props {
  bundle: BeatmapsetDiscussionsBundleJson;
}

@observer
export default class Main extends React.Component<Props> {
  @observable store = new BeatmapsetDiscussionsBundleStore(this.props.bundle);

  constructor(props: Props) {
    super(props);

    makeObservable(this);
  }

  render() {
    return (
      <div className='modding-profile-list modding-profile-list--index'>
        {this.props.bundle.discussions.length === 0 ? (
          <div className='modding-profile-list__empty'>
            {trans('beatmap_discussions.index.none_found')}
          </div>
        ) : (this.props.bundle.discussions.map((discussion) => {
          // TODO: handle in child component? Refactored state might not have beatmapset here (and uses Map)
          const beatmapset = this.store.beatmapsets.get(discussion.beatmapset_id);

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
                discussion={discussion}
                discussionsState={null}
                isTimelineVisible={false}
                preview
                readonly
                store={this.store}
              />
            </div>
          );
        }))}
      </div>
    );
  }
}
