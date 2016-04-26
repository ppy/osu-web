###
# Copyright 2016 ppy Pty. Ltd.
#
# This file is part of osu!web. osu!web is distributed with the hope of
# attracting more community
# osu!web is free software: yocontributions to the core ecosystem of osu!.
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
{div, span} = React.DOM

class BeatmapsetPage.NoVideoToggle extends React.Component
  render: ->
    className = 'beatmapset-details__novideo-tick'
    className += ' beatmapset-details__novideo-tick--enabled' if not @props.enabled

    div className: 'beatmapset-details__novideo',
      div className: className
      span className: 'beatmapset-details__text',
        Lang.get 'beatmaps.beatmapset.show.details.download.no-video'
