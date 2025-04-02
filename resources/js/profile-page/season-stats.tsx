// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import Img2x from 'components/img2x';
import SeasonStatsJson from 'interfaces/season-stats-json';
import { route } from 'laroute';
import { autorun } from 'mobx';
import * as React from 'react';
import { renderToStaticMarkup } from 'react-dom/server';
import { formatNumber } from 'utils/html';
import { trans } from 'utils/lang';

function colourStyle(tier: string) {
  return {
    '--colour': `var(--level-tier-${tier})`,
  } as React.CSSProperties;
}

interface Props {
  stats: SeasonStatsJson;
}

const popup = (stats: SeasonStatsJson) => (
  <div className='season-stats-popup'>
    <div className='season-stats-popup__content season-stats-popup__content--top'>
      <div className='season-stats-popup__main'>
        <div className='season-stats-popup__rank'>
          #{formatNumber(stats.rank)}
        </div>
        <div
          className='season-stats-popup__line'
          style={colourStyle(stats.division.colour_tier)}
        />
        <div className='season-stats-popup__division'>
          <Img2x
            className='season-stats-popup__img'
            src={stats.division.image_url}
          />
          <div className='season-stats-popup__name'>
            {stats.division.name}
          </div>
          <div className='season-stats-popup__threshold'>
            {trans('users.show.season_stats.division_top_percentage', {
              value: formatNumber(stats.division.threshold, 0, { style: 'percent' }),
            })}
          </div>
        </div>
      </div>
      <a
        className='season-stats-popup__season'
        href={route('seasons.show', { season: stats.season.id })}
      >
        {stats.season.name}
      </a>
    </div>
    <div className='season-stats-popup__content season-stats-popup__content--stats'>
      <div className='season-stats-popup__key'>{trans('users.show.season_stats.total_score')}</div>
      <div className='season-stats-popup__value'>{formatNumber(stats.total_score)}</div>
    </div>
  </div>
);

export default class SeasonStats extends React.Component<Props> {
  private disposer?: () => void;
  private readonly valueRef = React.createRef<HTMLDivElement>();

  componentWillUnmount() {
    this.disposer?.();
  }

  render() {
    return (
      <div
        ref={this.valueRef}
        className='season-stats'
        onMouseOver={this.onMouseOver}
      >
        <div
          className='season-stats__line'
          style={colourStyle(this.props.stats.division.colour_tier)}
        />
        <Img2x
          className='season-stats__division'
          src={this.props.stats.division.image_url}
        />
        <div className='season-stats__name'>
          {this.props.stats.division.name}
        </div>
      </div>
    );
  }

  private readonly onMouseOver = (event: React.MouseEvent<HTMLDivElement>) => {
    if (this.disposer != null) return;

    $(this.valueRef.current ?? []).qtip({
      content: '[placeholder]',
      hide: {
        delay: 200,
        fixed: true,
      },
      overwrite: false,
      position: {
        adjust: {
          method: 'shift flip',
          scroll: false,
        },
        at: 'top center',
        my: 'bottom center',
        viewport: $(window),
      },
      show: {
        delay: 200,
        event: event.type,
        ready: true,
      },
      style: {
        classes: 'qtip qtip--daily-challenge',
        tip: false,
      },
    }, event);

    this.disposer = autorun(() => {
      const content = renderToStaticMarkup(popup(this.props.stats));
      $(this.valueRef.current ?? []).qtip('set', { 'content.text': content });
    });
  };
}
