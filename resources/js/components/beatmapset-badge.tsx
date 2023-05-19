// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BeatmapsetJson from 'interfaces/beatmapset-json';
import { route } from 'laroute';
import * as React from 'react';
import { classWithModifiers, Modifiers } from 'utils/css';
import { trans } from 'utils/lang';
import { wikiUrl } from 'utils/url';

interface Props {
  beatmapset: BeatmapsetJson;
  modifiers?: Modifiers;
  type: 'featured_artist' | 'nsfw' | 'spotlight';
}

export default function BeatmapsetBadge(props: Props) {
  let url: string | undefined;
  switch (props.type) {
    case 'featured_artist':
      if (props.beatmapset.track_id == null) return null;

      url = route('tracks.show', { track: props.beatmapset.track_id });
      break;
    case 'nsfw':
      if (!props.beatmapset.nsfw) return null;

      break;
    case 'spotlight':
      if (!props.beatmapset.spotlight) return null;

      url = wikiUrl('Beatmap_Spotlights');
      break;
  }
  const label = trans(`beatmapsets.${props.type}_badge.label`);
  const blockClass = classWithModifiers('beatmapset-badge', props.modifiers, props.type);

  return url == null
    ? <span className={blockClass}>{label}</span>
    : <a className={blockClass} href={url}>{label}</a>;
}
