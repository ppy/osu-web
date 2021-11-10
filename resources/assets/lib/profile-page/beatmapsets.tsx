// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BeatmapsetPanel from 'beatmapset-panel';
import BeatmapsetExtendedJson from 'interfaces/beatmapset-extended-json';
import { route } from 'laroute';
import { observable } from 'mobx';
import * as React from 'react';
import ShowMoreLink from 'show-more-link';
import ExtraHeader from './extra-header';
import ExtraPageProps, { BeatmapsetSection, ProfilePagePaginationData } from './extra-page-props';

const sectionKeys: [BeatmapsetSection, string][] = [
  ['favouriteBeatmapsets', 'favourite'],
  ['rankedBeatmapsets', 'ranked'],
  ['lovedBeatmapsets', 'loved'],
  ['pendingBeatmapsets', 'pending'],
  ['graveyardBeatmapsets', 'graveyard'],
];

type Props = {
  counts: Record<BeatmapsetSection, number>;
  pagination: ProfilePagePaginationData;
} & {
  [key in BeatmapsetSection]: BeatmapsetExtendedJson[];
} & ExtraPageProps;

export default class Beatmapsets extends React.PureComponent<Props> {
  render() {
    return (
      <div className='page-extra'>
        <ExtraHeader name={this.props.name} withEdit={this.props.withEdit} />
        {sectionKeys.map(([section, key]) => this.renderBeatmapsets(section, key))}
      </div>
    );
  }

  private readonly renderBeatmapsets = (section: BeatmapsetSection, key: string) => {
    const count = this.props.counts[section];
    const beatmapsets = this.props[section];
    const pagination = this.props.pagination[section];

    return (
      <React.Fragment key={section}>
        <h3 className='title title--page-extra-small'>
          {osu.trans(`users.show.extra.beatmaps.${key}.title`)}
          <span className='title__count'>{osu.formatNumber(count)}</span>
        </h3>

        {beatmapsets.length > 0 && (
          <div className='osu-layout__col-container osu-layout__col-container--with-gutter js-audio--group'>
            {beatmapsets.map((beatmapset) => (
              <div
                key={beatmapset.id}
                className='osu-layout__col osu-layout__col--sm-6'
              >
                <BeatmapsetPanel beatmapset={observable(beatmapset)} />
              </div>
            ))}

            <div className='osu-layout__col'>
              <ShowMoreLink
                data={{
                  name: section,
                  url: route('users.beatmapsets', {
                    type: key,
                    user: this.props.user.id,
                  }),
                }}
                event='profile:showMore'
                hasMore={pagination.hasMore}
                loading={pagination.loading}
                modifiers='profile-page'
              />
            </div>
          </div>
        )}
      </React.Fragment>
    );
  };
}
