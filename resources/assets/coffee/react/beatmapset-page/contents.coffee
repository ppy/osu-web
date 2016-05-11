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
{div, p} = React.DOM
el = React.createElement

class BeatmapsetPage.Contents extends React.Component
  render: ->
    beatmap = @props.beatmaps[@props.currentBeatmapId]

    div
      className: 'osu-layout__row osu-layout__row--page-beatmapset js-switchable-mode-page--scrollspy js-switchable-mode-page--page',
      'data-page-id': 'main'
      div className: 'page-tabs',
        BeatmapHelper.modes.map (mode) =>
          newBeatmap = _.last @props.beatmapsByMode[mode]

          el BeatmapsetPage.ContentsTab,
            key: mode
            playmode: mode
            disabled: !@props.beatmapsByMode[mode]?
            currentBeatmapId: @props.currentBeatmapId
            newBeatmapId: newBeatmap.id if newBeatmap
            currentPage: @props.currentPage
            currentPlaymode: @props.currentPlaymode

      div className: 'beatmapset-difficulties',
        div className: 'beatmapset-difficulties__list',
          @props.beatmapsByMode[@props.currentPlaymode].map (beatmap) =>
            el BeatmapsetPage.ContentsBeatmapIcon,
              key: beatmap.id
              beatmap: beatmap
              currentPage: @props.currentPage
              currentBeatmapId: @props.currentBeatmapId

        p className: 'beatmapset-difficulties__name',
          Lang.get("beatmaps.mode.#{@props.currentPlaymode}") + " #{beatmap.version}"

      div className: 'page-contents',
        el BeatmapsetPage.Details,
          set: @props.set
        el BeatmapsetPage.DifficultyChart,
          beatmap: beatmap
        el BeatmapsetPage.Stats,
          set: @props.set
          beatmap: beatmap
