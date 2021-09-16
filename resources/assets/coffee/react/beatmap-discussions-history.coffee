# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import core from 'osu-core-singleton'
import { createElement } from 'react'
import { Main } from './beatmap-discussions-history/main'

core.reactTurbolinks.register 'beatmap-discussions-history', (container) ->
  bundle = osu.parseJson 'json-index'

  # TODO: rename props to match
  createElement Main,
    discussions: bundle.discussions
    users: bundle.users
    relatedBeatmaps: bundle.beatmaps
    relatedDiscussions: bundle.included_discussions
    reviewsConfig: bundle.reviews_config
    container: container
