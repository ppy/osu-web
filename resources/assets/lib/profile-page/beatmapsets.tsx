// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BeatmapsetPanel from 'components/beatmapset-panel';
import ProfilePageExtraSectionTitle from 'components/profile-page-extra-section-title';
import ShowMoreLink from 'components/show-more-link';
import { observer } from 'mobx-react';
import * as React from 'react';
import ExtraHeader from './extra-header';
import ExtraPageProps, { BeatmapsetSection } from './extra-page-props';

const sectionKeys = [
  {
    key: 'favourite',
    urlType: 'favouriteBeatmapsets',
  },
  {
    key: 'ranked',
    urlType: 'rankedBeatmapsets',
  },
  {
    key: 'loved',
    urlType: 'lovedBeatmapsets',
  },
  {
    key: 'guest',
    urlType: 'guestBeatmapsets',
  },
  {
    key: 'pending',
    urlType: 'pendingBeatmapsets',
  },
  {
    key: 'graveyard',
    urlType: 'graveyardBeatmapsets',
  },
  {
    key: 'nominated',
    urlType: 'nominatedBeatmapsets',
  },
] as const;

@observer
export default class Beatmapsets extends React.Component<ExtraPageProps> {
  render() {
    return (
      <div className='page-extra'>
        <ExtraHeader name={this.props.name} withEdit={this.props.controller.withEdit} />
        {sectionKeys.map(this.renderBeatmapsets)}
      </div>
    );
  }

  private readonly onShowMore = (section: BeatmapsetSection) => {
    this.props.controller.apiShowMore(section);
  };

  private readonly renderBeatmapsets = (section: typeof sectionKeys[number]) => {
    const state = this.props.controller.state.beatmapsets;
    const count = state[section.key].count;
    const beatmapsets = state[section.key].items;
    const pagination = state[section.key].pagination;

    return (
      <React.Fragment key={section.key}>
        <ProfilePageExtraSectionTitle
          count={count}
          titleKey={`users.show.extra.beatmaps.${section.key}.title`}
        />

        {beatmapsets.length > 0 && (
          <div className='osu-layout__col-container osu-layout__col-container--with-gutter js-audio--group'>
            {beatmapsets.map((beatmapset) => (
              <div
                key={beatmapset.id}
                className='osu-layout__col osu-layout__col--sm-6'
              >
                <BeatmapsetPanel beatmapset={beatmapset} />
              </div>
            ))}

            <div className='osu-layout__col'>
              <ShowMoreLink
                {...pagination}
                callback={this.onShowMore}
                data={section.urlType}
                modifiers='profile-page'
              />
            </div>
          </div>
        )}
      </React.Fragment>
    );
  };
}
