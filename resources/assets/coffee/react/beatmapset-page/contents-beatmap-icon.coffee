###
# Copyright 2016 ppy Pty. Ltd.
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
{a} = React.DOM
el = React.createElement

class BeatmapsetPage.ContentsBeatmapIcon extends React.Component
  modeSwitch: (e) =>
    e.preventDefault()
    $.publish 'beatmapset:beatmap:set', beatmapId: @props.beatmap.id, playmode: @props.beatmap.mode

  render: ->
    className = 'beatmapset-difficulties__icon'
    if @props.currentBeatmapId == @props.beatmap.id
      className += " beatmapset-difficulties__icon--active"
      className += " beatmapset-difficulties__icon--active-#{BeatmapHelper.getDiffRating @props.beatmap.difficulty_rating}"

    a
      className: className
      onClick: @modeSwitch
      href: BeatmapsetPageHash.generate beatmapId: @props.beatmap.id, page: @props.currentPage, playmode: @props.beatmap.mode
      el BeatmapIcon,
        beatmap: @props.beatmap
        showTitle: false
        modifier: 'beatmapset'
