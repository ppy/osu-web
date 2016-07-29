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
{div, span, a} = React.DOM
el = React.createElement

class BeatmapsetPage.Header extends React.Component
  render: ->
    dateFormat = 'MMM D, YYYY'

    div className: 'osu-layout__row osu-layout__row--page-compact',
      div
        className: 'beatmapset-header'
        style:
          backgroundImage: "url(#{@props.beatmapset.covers.cover})"

        div className: 'beatmapset-header__tabs header-tabs',
          for mode in BeatmapHelper.modes
            continue if _.isEmpty @props.beatmapList[mode]

            el BeatmapsetPage.HeaderTab,
              key: mode
              playmode: mode
              currentBeatmapId: @props.currentBeatmap.id
              newBeatmapId: _.last @props.beatmapList[mode]
              currentPlaymode: @props.currentBeatmap.mode

        div className: 'beatmapset-header__overlay'

        div className: 'beatmapset-header__beatmap-picker-box',
          el BeatmapsetPage.BeatmapPicker,
            beatmaps: @props.beatmaps
            beatmapList: @props.beatmapList
            currentMode: @props.currentBeatmap.mode
            currentBeatmapId: @props.currentBeatmap.id

          span className: 'beatmapset-header__diff-name',
            if @props.hoveredBeatmap? then @props.hoveredBeatmap.version else @props.currentBeatmap.version

          div {},
            span className: 'beatmapset-header__value',
              span className: 'beatmapset-header__value-icon', el Icon, name: 'play-circle'
              span className: 'beatmapset-header__value-name', @props.playcount.toLocaleString()

            span className: 'beatmapset-header__value',
              span className: 'beatmapset-header__value-icon', el Icon, name: 'heart'
              span className: 'beatmapset-header__value-name', @props.favcount.toLocaleString()

          if @props.hoveredBeatmap
            span className: 'beatmapset-header__star-difficulty',
              "#{osu.trans 'beatmaps.beatmapset.show.stats.stars'} #{@props.hoveredBeatmap.difficulty_rating.toFixed 2}"

        div className: 'beatmapset-header__details-box',
          div className: 'beatmapset-header__details-text beatmapset-header__details-text--title',
            a
              href: laroute.route 'beatmapsets.index', q: @props.beatmapset.title
              @props.beatmapset.title
          div className: 'beatmapset-header__details-text beatmapset-header__details-text--artist',
            a
              href: laroute.route 'beatmapsets.index', q: @props.beatmapset.artist
              @props.beatmapset.artist

          div className: 'beatmapset-header__avatar-box',
            div
              className: 'beatmapset-header__avatar avatar avatar--beatmapset'
              style:
                backgroundImage: "url(#{@props.beatmapset.user.data.avatarUrl})"

            div className: 'beatmapset-header__user-box',
              div className: 'beatmapset-header__user-text',
                osu.trans 'beatmaps.beatmapset.show.details.made-by'
                a
                  className: 'beatmapset-header__user-text beatmapset-header__user-text--mapper'
                  href: laroute.route 'users.show', users: @props.beatmapset.user.data.id
                  @props.beatmapset.user.data.username

              div className: 'beatmapset-header__user-text',
                osu.trans 'beatmaps.beatmapset.show.details.submitted'
                span
                  className: 'beatmapset-header__user-text beatmapset-header__user-text--date'
                  moment(@props.beatmapset.submitted_date).format dateFormat

              if @props.beatmapset.ranked_date
                div className: 'beatmapset-header__user-text',
                  osu.trans 'beatmaps.beatmapset.show.details.ranked'
                  span
                    className: 'beatmapset-header__user-text beatmapset-header__user-text--date'
                    moment(@props.beatmapset.ranked_date).format dateFormat

        el BeatmapsetPage.Stats,
          beatmapset: @props.beatmapset
          beatmap: @props.currentBeatmap
