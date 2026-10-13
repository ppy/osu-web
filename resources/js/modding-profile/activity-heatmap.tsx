// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import ModdingActivityHeatmapJson, { ModdingActivityHeatmapDayJson } from 'interfaces/modding-activity-heatmap-json';
import * as moment from 'moment';
import * as React from 'react';
import { renderToStaticMarkup } from 'react-dom/server';
import { classWithModifiers } from 'utils/css';
import { formatNumber } from 'utils/html';
import { trans } from 'utils/lang';

const bn = 'modding-profile-heatmap';

const displayPriority = ['ranks', 'nominations', 'posts'] as const;

type ActivityType = typeof displayPriority[number];

const thresholds: Record<ActivityType, readonly [number, number]> = {
  nominations: [1, 3],
  posts: [1, 20],
  ranks: [1, 2],
};

const weekdays = [1, 2, 3, 4, 5, 6, 7] as const;

interface Props {
  heatmap: ModdingActivityHeatmapJson;
}

function cellModifier(day: ModdingActivityHeatmapDayJson | undefined) {
  if (day == null) {
    return;
  }

  for (const type of displayPriority) {
    const [dim, bright] = thresholds[type];
    const count = day[type];

    if (count >= bright) {
      return [type, 'bright'];
    }
    if (count >= dim) {
      return [type, 'dim'];
    }
  }
}

function cellTooltip(date: moment.Moment, day: ModdingActivityHeatmapDayJson | undefined) {
  if (day == null) {
    return;
  }

  const types = displayPriority.filter((type) => day[type] > 0);
  if (types.length === 0) {
    return;
  }

  return renderToStaticMarkup(
    <div className={`${bn}__tooltip`}>
      {types.map((type) => (
        <div key={type} className={`${bn}__tooltip-row`}>
          <span className='modding-profile-stats__label'>
            <span className={classWithModifiers(`${bn}__swatch`, [type, 'bright', 'tooltip'])} />
            {trans(`users.show.stats.activity_heatmap.${type}`)}
          </span>
          <span className='modding-profile-stats__value'>
            {formatNumber(day[type])}
          </span>
        </div>
      ))}
      <div className={`${bn}__tooltip-date`}>{date.format('LL')}</div>
    </div>,
  );
}

function legendTooltip(type: ActivityType, level: 'bright' | 'dim' | 'empty') {
  const [dim, bright] = thresholds[type];

  if (level === 'dim' && dim === bright - 1) {
    return formatNumber(dim);
  }

  return trans(`users.show.stats.activity_heatmap.threshold.${level}`, {
    max: formatNumber(bright - 1),
    min: formatNumber(level === 'bright' ? bright : dim),
  });
}

function monthLabels(start: moment.Moment, weekCount: number) {
  return Array.from({ length: weekCount }, (_, week) => {
    const monday = start.clone().add(week * 7, 'days');

    for (let i = 0; i < 7; i++) {
      const day = monday.clone().add(i, 'days');
      if (day.date() === 1) {
        return day.format('MMM');
      }
    }

    return week === 0 ? monday.format('MMM') : null;
  });
}

function swatch(type: ActivityType, level: 'bright' | 'dim' | 'empty') {
  return (
    <span
      className={classWithModifiers(`${bn}__swatch`, level === 'empty' ? undefined : [type, level])}
      title={legendTooltip(type, level)}
    />
  );
}

export default function ActivityHeatmap({ heatmap }: Props) {
  const start = moment.utc(heatmap.start_date);
  const end = moment.utc(heatmap.end_date);
  const lastDay = end.clone().isoWeekday(7);
  const weekCount = lastDay.diff(start, 'weeks') + 1;
  const months = monthLabels(start, weekCount);
  const byDate = new Map(heatmap.days.map((day) => [day.date, day]));

  return (
    <div className='profile-detail-stats-card profile-detail-stats-card--heatmap'>
      <div className={bn}>
        <div className='profile-detail-stats-card__title'>
          <div className='profile-detail-stats-card__title-icon'>
            <span className='svg-icon svg-icon--calendar' />
          </div>
          <div className={`${bn}__heading`}>
            {trans('users.show.stats.activity_heatmap.title')}
            <span
              className={`${bn}__help fas fa-question-circle`}
              title={trans('users.show.stats.activity_heatmap.help')}
            />
          </div>
        </div>

        <div className={`${bn}__body`}>
          <ul className={`${bn}__legend`}>
            {displayPriority.map((type) => (
              <li key={type} className={`${bn}__legend-item`}>
                <div className={`${bn}__legend-label`}>
                  {trans(`users.show.stats.activity_heatmap.${type}`)}
                </div>
                <div className={`${bn}__legend-scale`}>
                  <span>{trans('users.show.stats.activity_heatmap.less')}</span>
                  {swatch(type, 'empty')}
                  {swatch(type, 'dim')}
                  {swatch(type, 'bright')}
                  <span>{trans('users.show.stats.activity_heatmap.more')}</span>
                </div>
              </li>
            ))}
          </ul>

          <div className={`${bn}__calendar`}>
            <div
              className={`${bn}__grid`}
              style={{ '--weeks': weekCount } as React.CSSProperties}
            >
              <div />
              {months.map((label, week) => (
                <div key={week} className={`${bn}__month`}>
                  {label}
                </div>
              ))}
              {weekdays.map((weekday, row) => (
                <React.Fragment key={weekday}>
                  <div className={`${bn}__weekday`}>
                    {moment.utc().isoWeekday(weekday).format('ddd')}
                  </div>
                  {Array.from({ length: weekCount }, (_, week) => {
                    const date = start.clone().add(week * 7 + row, 'days');
                    const dateKey = date.format('YYYY-MM-DD');

                    if (date.isAfter(end, 'day')) {
                      return <div key={dateKey} />;
                    }

                    const day = byDate.get(dateKey);
                    const tooltip = cellTooltip(date, day);

                    return (
                      <div
                        key={dateKey}
                        className={classWithModifiers(`${bn}__cell`, cellModifier(day))}
                        data-html-title={tooltip}
                        data-tooltip-modifiers={tooltip == null ? undefined : 'extra-padding'}
                        title={tooltip == null ? undefined : ''}
                      />
                    );
                  })}
                </React.Fragment>
              ))}
            </div>
          </div>
        </div>
      </div>
      <div className='profile-detail-stats-card__decor-corner' />
      <div className='profile-detail-stats-card__decor' />
    </div>
  );
}
