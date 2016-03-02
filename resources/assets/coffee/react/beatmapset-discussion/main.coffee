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
{a, div, h1, p} = React.DOM
el = React.createElement

BeatmapsetDiscussion.Main = React.createClass
  mixins: [React.addons.PureRenderMixin]


  getInitialState: ->
    beatmapset: initial.beatmapset.data
    currentBeatmapIndex: 0


  render: ->
    currentBeatmap = @state.beatmapset.beatmaps.data[@state.currentBeatmapIndex]

    div null,
      div
        className: 'osu-layout__row'
        div
          className: 'forum-category-header forum-category-header--topic'
          style:
            backgroundImage: "url('#{Url.beatmapsetCover @state.beatmapset.beatmapset_id}')"
          div
            className: 'forum-category-header__titles'
            h1
              className: 'forum-category-header__title'
              a
                href: 'butts'
                className: 'link link--white link--no-underline'
                @state.beatmapset.title
        div
          className: 'beatmap-discussion-overview'

          div
            className: 'beatmap-discussion-overview__beatmaps'
            div
              className: 'beatmap-list'
              div 'beatmap-list__display',
                el BeatmapIcon, beatmap: currentBeatmap, modifier: 'large'
              div className: 'beatmap-list__display beatmap-list__display--main',
                div className: 'beatmap-list__mode',
                  Lang.get("beatmaps.mode.#{currentBeatmap.mode}")
                div className: 'beatmap-list__version',
                  currentBeatmap.version
              div 'beatmap-list__display',
                div className: 'beatmap-list__switch-button',
                  el Icon, name: 'chevron-down'
          div
            className: 'beatmap-discussion-overview__timeline'

          div
            className: 'beatmap-discussion-overview__info'

            div null,
              div
                className: 'beatmap-discussion-overview__meta-text beatmap-discussion-overview__meta-text--large'
                @state.beatmapset.title
              div
                className: 'beatmap-discussion-overview__meta-text'
                @state.beatmapset.artist
              div
                className: 'beatmap-discussion-overview__meta-text'
                @state.beatmapset.user_id

            div null,
              div
                className: 'beatmap-discussion-stats beatmap-discussion-stats--resolved'
                p className: 'beatmap-discussion-stats__text beatmap-discussion-stats__text--type', 'Resolved'
                p className: 'beatmap-discussion-stats__text beatmap-discussion-stats__text--count', '∞'
              div
                className: 'beatmap-discussion-stats beatmap-discussion-stats--pending'
                p className: 'beatmap-discussion-stats__text beatmap-discussion-stats__text--type', 'Pending'
                p className: 'beatmap-discussion-stats__text beatmap-discussion-stats__text--count', '-∞'
              div
                className: 'beatmap-discussion-stats beatmap-discussion-stats--total'
                p className: 'beatmap-discussion-stats__text beatmap-discussion-stats__text--type', 'Total'
                p className: 'beatmap-discussion-stats__text beatmap-discussion-stats__text--count', 'NaN'
