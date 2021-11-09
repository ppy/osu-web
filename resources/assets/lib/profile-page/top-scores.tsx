// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import GameMode from 'interfaces/game-mode';
import ScoreJson from 'interfaces/score-json';
import { route } from 'laroute';
import PlayDetailList from 'play-detail-list';
import ExtraHeader from 'profile-page/extra-header';
import * as React from 'react';
import ShowMoreLink from 'show-more-link';
import ExtraPageProps, { ProfilePagePaginationData, TopScoreSection } from './extra-page-props';

interface SectionMap {
  count: 'scores_best_count' | 'scores_first_count';
  key: TopScoreSection;
  type: string;
}

const sectionMaps: SectionMap[] = [
  {
    count: 'scores_best_count',
    key: 'scoresBest',
    type: 'best',
  },
  {
    count: 'scores_first_count',
    key: 'scoresFirsts',
    type: 'firsts',
  },
];

type ScoreData = ScoreJson[] | { error: string };

type Props = {
  currentMode: GameMode;
  pagination: ProfilePagePaginationData;
} & {
  [key in TopScoreSection]?: ScoreData;
} & ExtraPageProps;

export default class TopScores extends React.PureComponent<Props> {
  render() {
    return (
      <div className='page-extra'>
        <ExtraHeader name={this.props.name} withEdit={this.props.withEdit} />

        {sectionMaps.map((section) => (
          <div key={section.key}>
            <h3 className='title title--page-extra-small'>
              {osu.trans('users.show.extra.top_ranks.best.title')}
              <span className='title__count'>
                {osu.formatNumber(this.props.user[section.count])}
              </span>
            </h3>

            {this.renderScores(section)}
          </div>
        ))}
      </div>
    );
  }

  private renderScores(section: SectionMap) {
    const pagination = this.props.pagination[section.key];
    const scores = this.props[section.key];

    if (scores == null) return null;

    if (Array.isArray(scores)) {
      return (
        <div className='profile-extra-entries'>
          <PlayDetailList scores={scores} />

          <div className='profile-extra-entries__item'>
            <ShowMoreLink
              data={{
                name: section.key,
                url: route('users.scores', {
                  mode: this.props.currentMode,
                  type: section.type,
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
      );
    }

    return <p>{scores.error}</p>;
  }
}
