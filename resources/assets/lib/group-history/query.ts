// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import * as moment from 'moment';
import { currentUrlParams } from 'utils/turbolinks';
import { updateQueryString } from 'utils/url';
import groupStore from './group-store';

export interface GroupHistoryQuery {
  after: string | undefined;
  before: string | undefined;
  group: string | undefined;
  user: string | undefined;
}

export const emptyQuery: Readonly<GroupHistoryQuery> = Object.freeze({
  after: undefined,
  before: undefined,
  group: undefined,
  user: undefined,
});

export function getQueryFromUrl(): GroupHistoryQuery {
  const params = currentUrlParams();
  const query: GroupHistoryQuery = { ...emptyQuery };

  if (params.has('after') && moment(params.get('after'), moment.HTML5_FMT.DATE, true).isValid()) {
    query.after = params.get('after') as string;
  }

  if (params.has('before') && moment(params.get('before'), moment.HTML5_FMT.DATE, true).isValid()) {
    query.before = params.get('before') as string;
  }

  if (params.has('group') && groupStore.byIdentifier.has(params.get('group') as string)) {
    query.group = params.get('group') as string;
  }

  query.user = params.get('user') ?? undefined;

  return query;
}

export function setUrlFromQuery(query: GroupHistoryQuery): void {
  history.replaceState(
    history.state,
    '',
    updateQueryString(null, query as unknown as Record<string, string | undefined>),
  );
}
