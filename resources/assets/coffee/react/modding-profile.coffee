###
#    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
#
#    This file is part of osu!web. osu!web is distributed with the hope of
#    attracting more community contributions to the core ecosystem of osu!.
#
#    osu!web is free software: you can redistribute it and/or modify
#    it under the terms of the Affero GNU General Public License version 3
#    as published by the Free Software Foundation.
#
#    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
#    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
#    See the GNU Affero General Public License for more details.
#
#    You should have received a copy of the GNU Affero General Public License
#    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
###

import { Main } from './modding-profile/main'

reactTurbolinks.registerPersistent 'modding-profile', Main, true, (target) ->
  discussions: osu.parseJson('json-discussions')
  posts: osu.parseJson('json-posts')
  events: osu.parseJson('json-events')
  votes: osu.parseJson('json-votes')
  user: osu.parseJson('json-user')
  users: osu.parseJson('json-users')
  perPage: osu.parseJson('json-perPage')
  extras: osu.parseJson('json-extras')
  container: target
