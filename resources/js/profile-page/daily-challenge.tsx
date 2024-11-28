// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import DailyChallengeUserStatsJson from 'interfaces/daily-challenge-user-stats-json';
import { autorun } from 'mobx';
import { observer } from 'mobx-react';
import * as React from 'react';
import { renderToStaticMarkup } from 'react-dom/server';
import { classWithModifiers, Modifiers } from 'utils/css';
import { formatNumber } from 'utils/html';
import { trans } from 'utils/lang';

function tier(days: number) {
  const tiers = [
    [360, 'lustrous'],
    [240, 'radiant'],
    [120, 'rhodium'],
    [60, 'platinum'],
    [30, 'gold'],
    [10, 'silver'],
    [5, 'bronze'],
    [Number.NEGATIVE_INFINITY, 'iron'],
  ] as const;
  for (const [minDays, value] of tiers) {
    if (days >= minDays) {
      return value;
    }
  }

  // this shouldn't happen
  throw new Error("couldn't find corresponding tier");
}

function tierStyle(days: number) {
  return {
    '--colour': `var(--level-tier-${tier(days)})`,
  } as React.CSSProperties;
}

function tierStylePlaycount(count: number) {
  return tierStyle(Math.floor(count / 3));
}

function tierStyleWeekly(weeks: number) {
  // subtract by one to allow starting from iron.
  return tierStyle((weeks - 1) * 7);
}

interface Props {
  stats: DailyChallengeUserStatsJson;
}

function popup(stats: DailyChallengeUserStatsJson) {
  const values = [
    [
      'daily_streak_best',
      trans('users.show.daily_challenge.unit.day', { value: formatNumber(stats.daily_streak_best) }),
      'fancy',
      tierStyle(stats.daily_streak_best),
    ],
    [
      'weekly_streak_best',
      trans('users.show.daily_challenge.unit.week', { value: formatNumber(stats.weekly_streak_best) }),
      ['fancy', 'weekly'],
      tierStyleWeekly(stats.weekly_streak_best),
    ],
    ['top_10p_placements', formatNumber(stats.top_10p_placements)],
    ['top_50p_placements', formatNumber(stats.top_50p_placements)],
  ] as [string, string, Modifiers, React.CSSProperties | undefined][];

  return (
    <div className='daily-challenge-popup'>
      <div className='daily-challenge-popup__content daily-challenge-popup__content--top'>
        {([
          ['playcount', tierStylePlaycount, 'day'],
          ['daily_streak_current', tierStyle, 'day'],
          ['weekly_streak_current', tierStyleWeekly, 'week'],
        ] as const).map(([key, tierFn, unit]) => (
          <div key={key} className='daily-challenge-popup__top-entry'>
            <div className='daily-challenge-popup__top-title'>
              {trans(`users.show.daily_challenge.${key}`)}
            </div>
            <div
              className={classWithModifiers('daily-challenge-popup__value', ['fancy', 'top'])}
              style={tierFn(stats[key])}
            >
              {trans(`users.show.daily_challenge.unit.${unit}`, { value: formatNumber(stats[key]) })}
            </div>
          </div>
        ))}
      </div>
      <div className='daily-challenge-popup__content daily-challenge-popup__content--main'>
        {values.map(([transKey, value, valueMods, valueStyle]) => (
          <div key={transKey} className='daily-challenge-popup__row'>
            <div className='daily-challenge-popup__key'>
              {trans(`users.show.daily_challenge.${transKey}`)}
            </div>
            <div
              className={classWithModifiers('daily-challenge-popup__value', valueMods)}
              style={valueStyle}
            >
              {value}
            </div>
          </div>
        ))}
      </div>
    </div>
  );
}

@observer
export default class DailyChallenge extends React.Component<Props> {
  private disposer?: () => void;
  private readonly valueRef = React.createRef<HTMLDivElement>();

  componentWillUnmount() {
    this.disposer?.();
  }

  render() {
    if (this.props.stats.playcount === 0) {
      return null;
    }

    return (
      <div
        ref={this.valueRef}
        className='daily-challenge'
        onMouseOver={this.onMouseOver}
      >
        <div className='daily-challenge__name'>
          {trans('users.show.daily_challenge.title').split('\\n').map((line, i) => (
            <div key={i}>{line}</div>
          ))}
        </div>
        <div className='daily-challenge__value-box'>
          <div
            className='daily-challenge__value'
            style={tierStylePlaycount(this.props.stats.playcount)}
          >
            {trans(
              'users.show.daily_challenge.unit.day',
              { value: formatNumber(this.props.stats.playcount) },
            )}
          </div>
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
          scroll: false,
        },
        at: 'top left',
        my: 'bottom left',
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
