###
# Copyright 2015 ppy Pty. Ltd.
#
# This file is part of osu!web. osu!web is distributed with the hope of
# attracting more community contributions to the core ecosystem of osu!.
#
# osu!web is free software: you can redistribute it and/or modify
# it under the terms of the Affero GNU General Public License version 3
# as published by the Free Software Foundation.
#
# osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
# warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
# See the GNU Affero General Public License for more details.
#
# You should have received a copy of the GNU Affero General Public License
# along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
###
user = osu.parseJson('json-user-info').data

element = React.createElement ProfilePage.Main,
  user: user
  userPage: osu.parseJson('json-user-page').page
  allStats: osu.parseJson('json-user-stats')
  withEdit: user.id == window.currentUser.id
  recentAchievements: osu.parseJson('json-user-recent-achievements').data
  recentActivities: osu.parseJson('json-user-recent-activities').data
  recentlyReceivedKudosu: osu.parseJson('json-user-recently-received-kudosu').data

target = document.getElementsByClassName('js-content')[0]

ReactDOM.render element, target
