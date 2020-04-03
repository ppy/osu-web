# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import { Main } from './profile-page/main'

reactTurbolinks.registerPersistent 'profile-page', Main, true, (target) ->
  user = osu.parseJson('json-user')

  user: user
  userPage: user.page
  userAchievements: user.user_achievements
  currentMode: osu.parseJson('json-currentMode')
  withEdit: user.id == window.currentUser.id
  achievements: _.keyBy osu.parseJson('json-achievements'), 'id'
  perPage: osu.parseJson('json-perPage')
  extras: osu.parseJson('json-extras')
  container: target
