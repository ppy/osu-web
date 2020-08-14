# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import { Main } from './beatmap-discussions-history/main'

reactTurbolinks.registerPersistent 'beatmap-discussions-history', Main, true, (target) ->
  discussions: osu.parseJson 'json-discussions'
  users: osu.parseJson 'json-users'
  relatedBeatmaps: osu.parseJson 'json-related-beatmaps'
  relatedDiscussions: osu.parseJson 'json-related-discussions'
  reviewsConfig: osu.parseJson 'json-reviews-config'
  container: target
