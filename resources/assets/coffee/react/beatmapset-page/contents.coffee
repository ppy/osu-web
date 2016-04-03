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

class BeatmapSetPage.Contents extends React.Component
  @modeSwitch: (e) =>
    e.preventDefault()

  render: ->
    diff = @props.diffs[@props.currentMode]

    div
      className: 'osu-layout__row osu-layout__row--page-beatmapset js-switchable-mode-page--scrollspy js-switchable-mode-page--page',
      'data-page-id': 'main'
      div className: 'page-tabs',
        Mode.modesInt.map (m) =>
          newDiff = _.last @props.diffsByMode[m]

          el BeatmapSetPage.ContentsTab,
            key: m
            playmode: m
            disabled: @props.diffCount[m] == 0
            currentMode: @props.currentMode
            newMode: newDiff.beatmap_id if newDiff
            currentPage: @props.currentPage
            currentPlaymode: @props.currentPlaymode

      div className: 'beatmapset-difficulties',
        div className: 'beatmapset-difficulties__list',
          @props.diffsByMode[@props.currentPlaymode].map (m) =>
            el BeatmapSetPage.ContentsDifficultyIcon,
              key: m.beatmap_id
              difficulty: m
              currentPage: @props.currentPage
              currentMode: @props.currentMode

        p className: 'beatmapset-difficulties__name',
          Lang.get("beatmaps.mode.#{Mode.toString @props.currentPlaymode}") + " #{diff.name}"

      div className: 'page-contents',
        el BeatmapSetPage.Details,
          set: @props.set
        el BeatmapSetPage.DifficultyChart,
          diff: diff
        el BeatmapSetPage.Stats,
          set: @props.set
          diff: diff
