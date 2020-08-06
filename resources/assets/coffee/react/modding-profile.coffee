# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import { Main } from './modding-profile/main'

reactTurbolinks.registerPersistent 'modding-profile', Main, true, (target) ->
  beatmaps: osu.parseJson('json-beatmaps')
  container: target
  discussions: osu.parseJson('json-discussions')
  events: osu.parseJson('json-events')
  extras: osu.parseJson('json-extras')
  perPage: osu.parseJson('json-perPage')
  posts: osu.parseJson('json-posts')
  reviewsConfig: osu.parseJson 'json-reviewsConfig'
  user: osu.parseJson('json-user')
  users: osu.parseJson('json-users')
  votes: osu.parseJson('json-votes')
