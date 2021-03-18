# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import { Main } from './beatmap-discussions-history/main'

reactTurbolinks.registerPersistent 'beatmap-discussions-history', Main, true, (target) ->
  bundle = osu.parseJson 'json-index'
  # TODO: rename props to match
  discussions: bundle.discussions
  users: bundle.users
  relatedBeatmaps: bundle.beatmaps
  relatedDiscussions: bundle.included_discussions
  reviewsConfig: bundle.reviews_config
  container: target
