// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { Main } from 'beatmap-discussions-history/main';
import BeatmapExtendedJson from 'interfaces/beatmap-extended-json';
import { BeatmapsetDiscussionJsonForBundle } from 'interfaces/beatmapset-discussion-json';
import BeatmapsetExtendedJson from 'interfaces/beatmapset-extended-json';
import UserJson from 'interfaces/user-json';
import core from 'osu-core-singleton';
import React from 'react';
import { parseJson } from 'utils/json';

interface BeatmapsetDiscussionsBundleJson {
  beatmaps: BeatmapExtendedJson[];
  beatmapsets: BeatmapsetExtendedJson[];
  discussions: BeatmapsetDiscussionJsonForBundle[];
  included_discussions: BeatmapsetDiscussionJsonForBundle[];
  users: UserJson[];
}

core.reactTurbolinks.register('beatmap-discussions-history', () => {
  const bundle = parseJson<BeatmapsetDiscussionsBundleJson>('json-index');

  // TODO: rename props to match
  return (
    <Main
      beatmapsets={bundle.beatmapsets}
      discussions={bundle.discussions}
      relatedBeatmaps={bundle.beatmaps}
      relatedDiscussions={bundle.included_discussions}
      users={bundle.users}
    />
  );
});
