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
    currentMode = if @props.currentBeatmap.convert then 'osu' else @props.currentBeatmap.mode

    div
      className: 'osu-layout__row osu-layout__row--page-beatmapset js-switchable-mode-page--scrollspy js-switchable-mode-page--page',
      'data-page-id': 'main'
      div className: 'page-tabs',
        BeatmapHelper.modes.map (mode) =>
          newBeatmapId = _.last @props.beatmapList[mode]

          el BeatmapsetPage.ContentsTab,
            key: mode
            playmode: mode
            disabled: !@props.beatmaps[mode]?
            currentBeatmapId: @props.currentBeatmap.id
            newBeatmapId: newBeatmapId if newBeatmapId?
            currentPage: @props.currentPage
            currentPlaymode: @props.currentBeatmap.mode

      div className: 'beatmapset-difficulties',
        div className: 'beatmapset-difficulties__list',
          @props.beatmapList[@props.currentBeatmap.mode].map (beatmapId) =>
            beatmap = @props.beatmaps[@props.currentBeatmap.mode][beatmapId]

            el BeatmapsetPage.ContentsBeatmapIcon,
              key: beatmap.id
              beatmap: beatmap
              currentPage: @props.currentPage
              currentBeatmapId: @props.currentBeatmap.id

        div className: 'beatmapset-difficulties__name',
          osu.trans("beatmaps.mode.#{currentMode}") + " #{@props.currentBeatmap.version}"

      div className: 'page-contents',
        el BeatmapsetPage.Details,
          beatmapset: @props.beatmapset
        el BeatmapsetPage.DifficultyChart,
          currentBeatmap: @props.currentBeatmap
        el BeatmapsetPage.Stats,
          beatmapset: @props.beatmapset
          currentBeatmap: @props.currentBeatmap
