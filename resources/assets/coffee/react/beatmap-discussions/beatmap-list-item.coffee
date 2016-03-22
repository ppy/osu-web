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
{div} = React.DOM
el = React.createElement

bn = 'beatmap-list-item'

BeatmapDiscussions.BeatmapListItem = React.createClass
  mixins: [React.addons.PureRenderMixin]


  render: ->
    div
      className: bn

      div className: "#{bn}__col",
        el BeatmapIcon, beatmap: @props.beatmap, modifier: 'large'

      div className: "#{bn}__col #{bn}__col--main",
        div className: "#{bn}__mode",
          Lang.get("beatmaps.mode.#{@props.beatmap.mode}")
        div className: "#{bn}__version",
          @props.beatmap.version

      if @props.withSwitchButton
        div className: "#{bn}__col",
          div className: 'beatmap-list-item__switch-button',
            el Icon, name: 'chevron-down'
