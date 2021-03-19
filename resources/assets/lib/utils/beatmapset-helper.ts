// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { BeatmapsetJson, BeatmapsetNominationsInterface, isLegacyNominationsInterface } from 'beatmapsets/beatmapset-json';
import { route } from 'laroute';
import { sum } from 'lodash';
import { error } from 'utils/ajax';

interface FavouriteResponse {
  favourite_count: number;
}

export function nominationsCount(nominations: BeatmapsetNominationsInterface, type: 'current' | 'required'): number {
  if (isLegacyNominationsInterface(nominations)) {
    return nominations[type];
  }

  return sum(Object.values(nominations[type]));
}

export function showVisual(beatmapset: BeatmapsetJson) {
  return !beatmapset.nsfw || (currentUser?.user_preferences?.beatmapset_show_nsfw ?? false);
}

export function toggleFavourite(beatmapset: BeatmapsetJson) {
  const add = !beatmapset.has_favourited;

  // fake immediate change
  beatmapset.has_favourited = add;
  beatmapset.favourite_count += add ? 1 : -1;

  $.ajax(route('beatmapsets.favourites.store', { beatmapset: beatmapset.id }), {
    data: {
      action: add ? 'favourite' : 'unfavourite',
    },
    method: 'POST',
  })
  .fail((xhr: JQuery.jqXHR, status: string) => {
    // undo faked change
    beatmapset.has_favourited = !add;
    beatmapset.favourite_count += add ? -1 : 1;

    error(xhr, status, () => toggleFavourite(beatmapset));
  })
  .done((data: FavouriteResponse) => {
    beatmapset.favourite_count = data.favourite_count;
  });
}
