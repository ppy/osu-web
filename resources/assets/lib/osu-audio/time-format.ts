// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

export type TimeFormat = 'minute_minimal' | 'minute' | 'hour_minimal' | 'hour';

const pad = (num: number) => num.toString().padStart(2, '0');

interface FormatTimeCache {
  format?: TimeFormat;
  formatted?: string;
  time?: number;
}

const formatTimeCache: FormatTimeCache = {};

export const format = (time: number, fmt: TimeFormat) => {
  const secondTotal = Math.floor(time);

  if (formatTimeCache.time !== secondTotal || formatTimeCache.format !== fmt) {
    formatTimeCache.format = fmt;
    formatTimeCache.time = secondTotal;

    const second = secondTotal % 60;
    const minuteTotal = Math.floor(secondTotal / 60);

    if (fmt === 'minute_minimal') {
      formatTimeCache.formatted = `'${minuteTotal}:${pad(second)}'`;
    } else if (fmt === 'minute') {
      formatTimeCache.formatted = `'${pad(minuteTotal)}:${pad(second)}'`;
    } else {
      const minute = minuteTotal % 60;
      const hourTotal = Math.floor(minuteTotal / 60);

      if (fmt === 'hour_minimal') {
        formatTimeCache.formatted = `'${hourTotal}:${pad(minute)}:${pad(second)}'`;
      } else {
        formatTimeCache.formatted = `'${pad(hourTotal)}:${pad(minute)}:${pad(second)}'`;
      }
    }
  }

  return formatTimeCache.formatted ?? '';
};
