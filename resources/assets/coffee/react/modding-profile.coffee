# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import core from 'osu-core-singleton'
import { createElement } from 'react'
import { parseJson } from 'utils/json'
import { Main } from './modding-profile/main'

core.reactTurbolinks.register 'modding-profile', (container) ->
  createElement Main,
    beatmaps: parseJson('json-beatmaps')
    container: container
    discussions: parseJson('json-discussions')
    events: parseJson('json-events')
    extras: parseJson('json-extras')
    perPage: parseJson('json-perPage')
    posts: parseJson('json-posts')
    reviewsConfig: parseJson('json-reviewsConfig')
    user: parseJson('json-user')
    users: parseJson('json-users')
    votes: parseJson('json-votes')
