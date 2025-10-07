// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BeatmapsetJson from 'interfaces/beatmapset-json';
import HeaderLink from 'interfaces/header-link';
import { route } from 'laroute';
import { trans } from 'utils/lang';
import { switchNever } from 'utils/switch-never';

const linkModes = ['show', 'discussions', 'versions'] as const;
type LinkMode = typeof linkModes[number];

type BeatmapsetJsonForHeaderLinks = BeatmapsetJson & Required<Pick<BeatmapsetJson, 'version_count'>>;

function generateUrl(mode: LinkMode, beatmapset: BeatmapsetJsonForHeaderLinks) {
  switch (mode) {
    case 'discussions':
      return route('beatmapsets.discussion', { beatmapset: beatmapset.id });
    case 'show':
      if (beatmapset == null) {
        throw new Error("can't make show url without beatmapset");
      }
      return route('beatmapsets.show', { beatmapset: beatmapset.id });
    case 'versions':
      if (beatmapset == null) {
        throw new Error("can't make versions url without beatmapset");
      }
      return beatmapset.version_count === 0
        ? undefined
        : route('beatmapsets.versions', { beatmapset: beatmapset.id });
    default: {
      switchNever(mode);
      return '';
    }
  }
}

export default function headerLinks(active: LinkMode, beatmapset: BeatmapsetJsonForHeaderLinks): HeaderLink[] {
  const ret: HeaderLink[] = [];

  for (const mode of linkModes) {
    const url = generateUrl(mode, beatmapset);
    const count = mode === 'versions'
      ? beatmapset.version_count
      : undefined;

    if (url != null) {
      ret.push({
        active: mode === active,
        count,
        title: trans(`layout.header.beatmapsets.${mode}`),
        url,
      });
    }
  }

  return ret;
}
