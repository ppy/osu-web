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
element = React.createElement ProfilePage.Main,
  user: user
  userPage: user.page.data
  allStats: user.allStatistics.data
  allScoresBest: user.allScoresBest.data
  allScoresFirst: user.allScoresFirst.data
  withEdit: user.id == window.currentUser.id
  recentAchievements: user.recentAchievements.data
  recentActivities: user.recentActivities.data
  recentlyReceivedKudosu: user.recentlyReceivedKudosu.data

target = document.getElementsByClassName('js-content')[0]

ReactDOM.render element, target
