// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import KudosuHistoryJson from 'interfaces/kudosu-history-json';
import { route } from 'laroute';
import { action } from 'mobx';

type RouteParams = Partial<Record<string, string | number>>;

export interface OffsetPaginationJson {
  hasMore?: boolean;
  loading?: boolean;
}

export interface OffsetPaginatorJson<T> {
  items: T[];
  pagination: OffsetPaginationJson;
}

export const apiShowMore = action(<T>(json: OffsetPaginatorJson<T>, routeName: string, baseRouteParams: RouteParams): JQuery.jqXHR<T[]> => {
  json.pagination.loading = true;

  let limit = baseRouteParams.limit;
  if (typeof limit !== 'number' || !Number.isFinite(limit)) {
    limit = 50;
  }
  const fetchLimit = limit + 1;
  const params = {
    ...baseRouteParams,
    limit: fetchLimit,
    offset: json.items.length,
  };

  return $.ajax(route(routeName, params))
    .done((newItems: typeof json.items) => {
      appendItems(json, newItems, fetchLimit);
    }).always(action(() => {
      json.pagination.loading = false;
    })) as JQuery.jqXHR<T[]>;
});

export const apiShowMoreRecentlyReceivedKudosu = (json: OffsetPaginatorJson<KudosuHistoryJson>, userId: number): JQuery.jqXHR<KudosuHistoryJson[]> => apiShowMore(json, 'users.kudosu', { user: userId });

export const appendItems = action(<T>(json: OffsetPaginatorJson<T>, newItems: typeof json.items, fetchLimit: number) => {
  json.pagination.hasMore = hasMoreCheck(fetchLimit - 1, newItems);
  json.items.push(...newItems);
});

// mutates items and returns whether there are more items than expectedCount
export const hasMoreCheck = action(<T>(expectedCount: number, items: T[]) => {
  const hasMore = items.length > expectedCount;

  if (hasMore) {
    items.pop();
  }

  return hasMore;
});
