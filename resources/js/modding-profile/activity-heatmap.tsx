// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { ModdingActivityHeatmapDayJson, ModdingActivityType } from 'interfaces/modding-activity-heatmap-json';
import UserModdingProfileJson from 'interfaces/user-modding-profile-json';
import * as moment from 'moment';
import * as React from 'react';
import { renderToStaticMarkup } from 'react-dom/server';
import { classWithModifiers } from 'utils/css';
import { formatNumber } from 'utils/html';
import { trans } from 'utils/lang';

const bn = 'modding-profile-heatmap';

const markerTypes = ['ranks', 'nominations'] as const;
const displayPriority: readonly ModdingActivityType[] = [...markerTypes, 'posts'];
const postLevels = [
  ['faint', 1],
  ['dim', 10],
  ['bright', 20],
] as const;
const weekdays = [1, 2, 3, 4, 5, 6, 7] as const;

interface Props {
  user: UserModdingProfileJson;
}

function cell(key: string, date: moment.Moment, day: ModdingActivityHeatmapDayJson | undefined) {
  const tooltip = cellTooltip(date, day);

  return (
    <div
      key={key}
      className={classWithModifiers(`${bn}__cell`, cellFill(day))}
      data-html-title={tooltip}
      data-tooltip-modifiers={tooltip == null ? undefined : 'extra-padding'}
      title={tooltip == null ? undefined : ''}
    >
      {markerTypes.map((type) => (day?.[type] ?? 0) > 0 && (
        <span key={type} className={classWithModifiers(`${bn}__marker`, [type, 'cell'])} />
      ))}
    </div>
  );
}

function cellFill(day: ModdingActivityHeatmapDayJson | undefined) {
  const posts = day?.posts ?? 0;

  for (let i = postLevels.length - 1; i >= 0; i--) {
    const [level, min] = postLevels[i];
    if (posts >= min) {
      return ['posts', level];
    }
  }
}

function cellTooltip(date: moment.Moment, day: ModdingActivityHeatmapDayJson | undefined) {
  if (day == null) {
    return;
  }

  const types = displayPriority.filter((type) => (day[type] ?? 0) > 0);
  if (types.length === 0) {
    return;
  }

  return renderToStaticMarkup(
    <div className={`${bn}__tooltip`}>
      {types.map((type) => (
        <div key={type} className={`${bn}__tooltip-row`}>
          <span className={`${bn}__tooltip-label`}>
            <span className={classWithModifiers(`${bn}__marker`, type)} />
            {trans(`users.show.stats.activity_heatmap.${type}`)}
          </span>
          <span className={`${bn}__tooltip-value`}>
            {formatNumber(day[type] ?? 0)}
          </span>
        </div>
      ))}
      <div className={`${bn}__tooltip-date`}>{date.format('LL')}</div>
    </div>,
  );
}

function legendKey(type: typeof markerTypes[number]) {
  return (
    <span key={type} className={`${bn}__legend-key`}>
      <span className={classWithModifiers(`${bn}__marker`, type)} />
      {trans(`users.show.stats.activity_heatmap.${type}`)}
    </span>
  );
}

function legendTooltip(min: number, next: number | undefined) {
  if (next == null) {
    return trans('users.show.stats.activity_heatmap.threshold.minimum', {
      min: formatNumber(min),
    });
  }

  return trans('users.show.stats.activity_heatmap.threshold.range', {
    max: formatNumber(next - 1),
    min: formatNumber(min),
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

function swatch([level, min]: typeof postLevels[number], i: number) {
  return (
    <span
      key={level}
      className={classWithModifiers(`${bn}__cell`, ['posts', level])}
      title={legendTooltip(min, postLevels[i + 1]?.[1])}
    />
  );
}

export default class ActivityHeatmap extends React.PureComponent<Props> {
  render() {
    const heatmap = this.props.user.modding_activity_heatmap;
    const start = moment.utc(heatmap.start_date);
    const end = moment.utc(heatmap.end_date);
    const lastDay = end.clone().isoWeekday(7);
    const weekCount = lastDay.diff(start, 'weeks') + 1;
    const months = monthLabels(start, weekCount);
    const byDate = new Map(heatmap.days.map((day) => [day.date, day]));

    return (
      <div className='profile-detail-stats-card profile-detail-stats-card--heatmap'>
        <div className='profile-detail-stats-card__top'>
          <div className={bn}>
            <div className={`profile-detail-stats-card__title ${bn}__title`}>
              <div className='profile-detail-stats-card__title-icon'>
                <span className='svg-icon svg-icon--calendar' />
              </div>
              <div>
                {trans('users.show.stats.activity_heatmap.title')}
              </div>
            </div>

            <div className={`${bn}__legend`}>
              <div className={`${bn}__legend-label`}>
                {trans('users.show.stats.activity_heatmap.posts')}
              </div>
              <div className={`${bn}__legend-scale`}>
                <span>{trans('users.show.stats.activity_heatmap.less')}</span>
                {postLevels.map(swatch)}
                <span>{trans('users.show.stats.activity_heatmap.more')}</span>
              </div>
              <div className={`${bn}__legend-keys`}>
                {markerTypes.map(legendKey)}
              </div>
            </div>

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

                      return cell(dateKey, date, byDate.get(dateKey));
                    })}
                  </React.Fragment>
                ))}
              </div>
            </div>
          </div>
        </div>
      </div>
    );
  }
}
