/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */

// quick and dirty search store

import Filters from 'beatmap-search-filters';
import * as _ from 'lodash';

declare global {
  interface Window {
    results: Map<string, any[]>;
    cursors: Map<string, any>;
    totals: Map<string, number>;
    requests: Map<string, Promise<SearchResults>>;
    getBeatmaps: Promise<SearchResults>;
  }
}

const requests = new Map<string, Promise<SearchResults>>();
const results = new Map<string, any[]>();
const cursors = new Map<string, any>();
const totals = new Map<string, number>();

interface SearchResponse {
  beatmapsets: any[];
  cursor: JSON;
  recommended_difficulty: number;
  total: number;
}

interface SearchResults {
  beatmapsets: any[];
  hasMore: boolean;
  recommended_difficulty: number;
  total: number;
}

export function initialize(filters: Filters, data: SearchResponse) {
  const key = stringFromFilters(filters);

  // FIXME: do something else; this is currently here because I like speed
  if (cursors.has(key)) {
    console.log(`already initialized ${key}`);
    return;
  }

  console.log(`initialize ${key}`);
  cursors.set(key, data.cursor);
  results.set(key, data.beatmapsets);
  totals.set(key, data.total);
}

export async function get(filters: Filters, from = 0): Promise<SearchResults> {
  const key = stringFromFilters(filters);
  const beatmapsets = results.get(key) || [];
  const sufficient = from < beatmapsets.length;

  if (sufficient) {
    return Promise.resolve({
      beatmapsets,
      hasMore: hasMore(key),
      recommended_difficulty: 0,
      total: totals.get(key) || 0,
    });
  }

  // skip making multiple requests for the same key.
  let request = requests.get(key);
  if (request) { return request; }

  request = fetch(filters).then((data: SearchResponse) => {
    if (data.beatmapsets != null) {
      append(key, data);
    }

    requests.delete(key);

    return {
      beatmapsets: results.get(key) || [],
      hasMore: hasMore(key),
      recommended_difficulty: data.recommended_difficulty,
      total: totals.get(key) || 0,
    };
  });
  requests.set(key, request);

  return request;
}

function append(url: string, data: SearchResponse) {
  const beatmapsets = _.concat(results.get(url) || [], data.beatmapsets);
  store(url, {
    ...data,
    beatmapsets,
  });
}

async function fetch(filters: Filters) {
  const params = BeatmapsetFilter.queryParamsFromFilters(filters) as any;
  const key = stringFromFilters(filters);

  const cursor = cursors.get(key);
  if (cursors.has(key)) {
    if (cursor == null) {
      return Promise.resolve({});
    }

    params.cursor = cursor;
  }

  const url = laroute.route('beatmapsets.search');
  return $.ajax(url, {
    data: params,
    dataType: 'json',
    method: 'get',
  });
}

function hasMore(url: string) {
  // should return false only if it's known to have received a null cursor in .
  return !(cursors.has(url) && cursors.get(url) == null);
}

function remove(url: string) {
  results.delete(url);
}

function store(url: string, data: SearchResponse) {
  cursors.set(url, data.cursor);
  results.set(url, data.beatmapsets);
  totals.set(url, data.total);
}

function stringFromFilters(filters: Filters) {
  const normalized = BeatmapsetFilter.fillDefaults(filters) as any;
  const parts = [];
  for (const key of Object.keys(normalized)) {
    parts.push(`${key}=${normalized[key]}`);
  }

  return parts.join('&');
}

// debugging
window.results = results;
window.cursors = cursors;
window.totals = totals;
window.requests = requests;
window.getBeatmaps = get;
