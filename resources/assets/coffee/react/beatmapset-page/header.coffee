###
# Copyright 2015-2016 ppy Pty. Ltd.
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
{div} = React.DOM
el = React.createElement

class BeatmapsetPage.Header extends React.Component
  render: ->
    div className: 'osu-layout__row osu-layout__row--page-compact',
      div
        className: 'beatmapset-header'
        style:
          backgroundImage: "url(#{@props.covers.cover})"

        div className: 'header-tabs',
          for mode in BeatmapHelper.modes
            continue if _.isEmpty @props.beatmapList[mode]

            el BeatmapsetPage.HeaderTab,
              key: mode
              playmode: mode
              currentBeatmapId: @props.currentBeatmap.id
              newBeatmapId: _.last @props.beatmapList[mode]
              currentPlaymode: @props.currentBeatmap.mode

        div className: 'beatmapset-header__overlay'
