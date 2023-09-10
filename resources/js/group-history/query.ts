// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import moment from 'moment';
import { currentUrlParams } from 'utils/turbolinks';
import { updateQueryString } from 'utils/url';
import groupStore from './group-store';

export interface GroupHistoryQuery {
  after?: string;
  before?: string;
  group?: string;
  user?: string;
}

export const emptyQuery: Readonly<GroupHistoryQuery> = Object.freeze({
  after: undefined,
  before: undefined,
  group: undefined,
  user: undefined,
});

const paramValidators: Record<keyof GroupHistoryQuery, (value: string) => boolean> = {
  after: (value: string) => moment(value, moment.HTML5_FMT.DATE, true).isValid(),
  before: (value: string) => moment(value, moment.HTML5_FMT.DATE, true).isValid(),
  group: (value: string) => groupStore.byIdentifier.has(value),
  user: (value: string) => value.length > 0,
};

export function getQueryFromUrl(): { parseError: boolean; query: GroupHistoryQuery } {
  const params = currentUrlParams();
  let parseError = false;
  const query: GroupHistoryQuery = {};

  for (const key of Object.keys(emptyQuery) as (keyof GroupHistoryQuery)[]) {
    const value = params.get(key);

    if (value != null && !paramValidators[key](value)) {
      parseError = true;
      query[key] = undefined;
    } else {
      query[key] = value ?? undefined;
    }
  }

  return { parseError, query };
}

export function setUrlFromQuery(query: Readonly<GroupHistoryQuery>): void {
  history.replaceState(
    history.state,
    '',
    updateQueryString(null, query),
  );
}
