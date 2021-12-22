// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { observer } from 'mobx-react';
import PlayDetailList from 'play-detail-list';
import ExtraHeader from 'profile-page/extra-header';
import * as React from 'react';
import ShowMoreLink from 'show-more-link';
import ExtraPageProps, { TopScoreSection } from './extra-page-props';

interface SectionMap {
  count: 'scores_best_count' | 'scores_first_count' | 'scores_pinned_count';
  key: TopScoreSection;
  translationKey: string;
  type: string;
}

const sectionMaps: SectionMap[] = [
  {
    count: 'scores_pinned_count',
    key: 'scoresPinned',
    translationKey: 'pinned',
    type: 'pinned',
  },
  {
    count: 'scores_best_count',
    key: 'scoresBest',
    translationKey: 'best',
    type: 'best',
  },
  {
    count: 'scores_first_count',
    key: 'scoresFirsts',
    translationKey: 'first',
    type: 'firsts',
  },
];

@observer
export default class TopScores extends React.Component<ExtraPageProps> {
  render() {
    return (
      <div className='page-extra'>
        <ExtraHeader name={this.props.name} withEdit={this.props.controller.withEdit} />

        {this.props.controller.scoresNotice != null && (
          <div className='wiki-notice'>
            <span className='fas fa-exclamation-circle' />
            {' '}
            <div
              className='wiki-notice__markdown-inline-content'
              dangerouslySetInnerHTML={{ __html: this.props.controller.scoresNotice }}
            />
          </div>
        )}

        {sectionMaps.map((section) => (
          <div key={section.key}>
            <h3 className='title title--page-extra-small'>
              {osu.trans(`users.show.extra.top_ranks.${section.translationKey}.title`)}
              <span className='title__count'>
                {osu.formatNumber(this.props.controller.state.user[section.count])}
              </span>
            </h3>

            {this.renderScores(section)}
          </div>
        ))}
      </div>
    );
  }

  private readonly onShowMore = (section: TopScoreSection) => {
    this.props.controller.apiShowMore(section);
  };

  private renderScores(section: SectionMap) {
    const paginator = this.props.controller.paginatorJson(section.key);

    if (Array.isArray(paginator.items)) {
      return (
        <div className='profile-extra-entries'>
          <PlayDetailList scores={paginator.items} />

          <div className='profile-extra-entries__item'>
            <ShowMoreLink
              {...paginator.pagination}
              callback={this.onShowMore}
              data={section.key}
              modifiers='profile-page'
            />
          </div>
        </div>
      );
    }

    return <p>{paginator.items.error}</p>;
  }
}
