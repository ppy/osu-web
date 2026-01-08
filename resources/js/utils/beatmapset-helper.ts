// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BeatmapsetJson from 'interfaces/beatmapset-json';
import { route } from 'laroute';
import { action, runInAction } from 'mobx';
import core from 'osu-core-singleton';
import { error } from 'utils/ajax';

interface FavouriteResponse {
  favourite_count: number;
}

export function downloadLimited(beatmapset: BeatmapsetJson) {
  return beatmapset.availability == null
    || beatmapset.availability.download_disabled
    || beatmapset.availability.more_information != null;
}

// TODO: should make a Beatmapset proxy object or something
export function getArtist(beatmapset: BeatmapsetJson) {
  if (core.userPreferences.get('beatmapset_title_show_original')) {
    return beatmapset.artist_unicode;
  }

  return beatmapset.artist;
}

export function getTitle(beatmapset: BeatmapsetJson) {
  if (core.userPreferences.get('beatmapset_title_show_original')) {
    return beatmapset.title_unicode;
  }

  return beatmapset.title;
}

export function makeSearchQueryOption(key: string, value: string) {
  return `${key}=""${value.replace(/"/g, '\\"')}""`;
}

export function showAudio(beatmapset: BeatmapsetJson) {
  return !beatmapset.nsfw || core.userPreferences.get('beatmapset_show_nsfw');
}

export function showVisual(beatmapset: BeatmapsetJson, forceShowNsfw: boolean = false) {
  return (forceShowNsfw || !beatmapset.nsfw || core.userPreferences.get('beatmapset_show_nsfw'))
    && (!beatmapset.anime_cover || core.userPreferences.get('beatmapset_show_anime_cover'));
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
