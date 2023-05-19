// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BeatmapsetExtendedJson from 'interfaces/beatmapset-extended-json';
import HeaderLink from 'interfaces/header-link';
import { route } from 'laroute';
import { trans } from 'utils/lang';
import { switchNever } from 'utils/switch-never';

const linkModes = ['show', 'discussions'] as const;
type LinkMode = typeof linkModes[number];

function url(mode: LinkMode, beatmapset: BeatmapsetExtendedJson) {
  switch (mode) {
    case 'discussions':
      return route('beatmapsets.discussion', { beatmapset: beatmapset.id });
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

export default function headerLinks(active: LinkMode, beatmapset: BeatmapsetExtendedJson): HeaderLink[] {
  return linkModes.map((mode) => ({
    active: mode === active,
    title: trans(`layout.header.beatmapsets.${mode}`),
    url: url(mode, beatmapset),
  }));
}
