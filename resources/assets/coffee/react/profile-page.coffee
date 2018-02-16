###
#    Copyright 2015-2017 ppy Pty. Ltd.
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

reactTurbolinks.register 'profile-page', ProfilePage.Main, ->
  user = osu.parseJson('json-user')

  user: user
  userPage: user.page
  userAchievements: user.user_achievements
  currentMode: osu.parseJson('json-currentMode')
  rankHistory: osu.parseJson('json-rankHistory')
  scores: osu.parseJson('json-scores')
  statistics: osu.parseJson('json-statistics')
  beatmapsets: osu.parseJson('json-beatmapsets')
  withEdit: user.id == window.currentUser.id
  recentActivity: user.recent_activity
  recentlyReceivedKudosu: osu.parseJson('json-kudosu')
  achievements: _.keyBy osu.parseJson('json-achievements'), 'id'
  perPage: osu.parseJson('json-perPage')
