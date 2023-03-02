// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BeatmapsetExtendedJson from 'interfaces/beatmapset-extended-json';
import BeatmapsetJson, { BeatmapsetNominationsInterface } from 'interfaces/beatmapset-json';
import { route } from 'laroute';
import { sum } from 'lodash';
import { action, runInAction } from 'mobx';
import core from 'osu-core-singleton';
import { error } from 'utils/ajax';

interface FavouriteResponse {
  favourite_count: number;
}

export function downloadLimited(beatmapset: BeatmapsetExtendedJson) {
  return beatmapset.availability.download_disabled || beatmapset.availability.more_information != null;
}

export function nominationsCount(nominations: BeatmapsetNominationsInterface, type: 'current' | 'required'): number {
  if (nominations.legacy_mode) {
    return nominations[type];
  }

  return sum(Object.values(nominations[type]));
}

export function showVisual(beatmapset: BeatmapsetJson) {
  return !beatmapset.nsfw || core.userPreferences.get('beatmapset_show_nsfw');
}

export const toggleFavourite = action((beatmapset: BeatmapsetJson) => {
  const retryCallback = () => {
    toggleFavourite(beatmapset);
  };

  if (core.userLogin.showIfGuest(retryCallback)) return;

  const add = !beatmapset.has_favourited;

  // fake immediate change
  beatmapset.has_favourited = add;
  beatmapset.favourite_count += add ? 1 : -1;

  const ret = $.ajax(route('beatmapsets.favourites.store', { beatmapset: beatmapset.id }), {
    data: {
      action: add ? 'favourite' : 'unfavourite',
    },
    method: 'POST',
  }) as JQuery.jqXHR<FavouriteResponse>;

  ret.fail((xhr, status) => runInAction(() => {
    // undo faked change
    beatmapset.has_favourited = !add;
    beatmapset.favourite_count += add ? -1 : 1;

    error(xhr, status, retryCallback);
  })).done((data) => runInAction(() => {
    beatmapset.favourite_count = data.favourite_count;
  }));

  return ret;
});
