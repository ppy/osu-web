// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BeatmapsetExtendedJson from 'interfaces/beatmapset-extended-json';
import HeaderLink from 'interfaces/header-link';
import { route } from 'laroute';
import { switchNever } from 'utils/switch-never';

const linkModes = ['index', 'show', 'discussions'] as const;
type LinkMode = typeof linkModes[number];

const requireBeatmapset = {
  discussions: true,
  index: false,
  show: true,
};

function url(mode: LinkMode, beatmapset?: BeatmapsetExtendedJson) {
  switch (mode) {
    case 'discussions':
      if (beatmapset == null) {
        throw new Error("can't make discussions url without beatmapset");
      }
      return beatmapset.discussion_enabled
        ? route('beatmapsets.discussion', { beatmapset: beatmapset.id })
        : (beatmapset.legacy_thread_url ?? '#');
    case 'index':
      return route('beatmapsets.index');
    case 'show':
      if (beatmapset == null) {
        throw new Error("can't make show url without beatmapset");
      }
      return route('beatmapsets.show', { beatmapset: beatmapset.id });
    default: {
      switchNever(mode);
      return '';
    }
  }
}

export default function headerLinks(active: LinkMode, beatmapset?: BeatmapsetExtendedJson) {
  const ret: HeaderLink[] = [];

  for (const mode of linkModes) {
    if (beatmapset == null && requireBeatmapset[mode]) {
      continue;
    }

    ret.push({
      active: mode === active,
      title: osu.trans(`layout.header.beatmapsets.${mode}`),
      url: url(mode, beatmapset),
    });
  }

  return ret;
}
