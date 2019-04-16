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

import { Main } from './profile-page/main'

reactTurbolinks.registerPersistent 'profile-page', Main, true, (target) ->
  user = osu.parseJson('json-user')

  user: user
  userPage: user.page
  userAchievements: user.user_achievements
  currentMode: osu.parseJson('json-currentMode')
  rankHistory: osu.parseJson('json-rankHistory')
  withEdit: user.id == window.currentUser.id
  achievements: _.keyBy osu.parseJson('json-achievements'), 'id'
  perPage: osu.parseJson('json-perPage')
  extras: osu.parseJson('json-extras')
  container: target
