###
#    Copyright 2015-2017 ppy Pty. Ltd.
#
#    This file is part of osu!web. osu!web is distributed with the hope of
#    attracting more community contributions to the core ecosystem of osu!.
#
#    osu!web is free software: you can redistribute it and/or modify
#    it under the terms of the Affero GNU General Public License version 3
#    as published by the Free Software Foundation.
#
#    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
#    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
#    See the GNU Affero General Public License for more details.
#
#    You should have received a copy of the GNU Affero General Public License
#    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
###

{div, span, a, ol, li} = React.DOM
el = React.createElement

class BeatmapsetPage.Header extends React.Component
  render: ->
    dateFormat = 'MMM D, YYYY'
    favouriteButton =
      if @props.hasFavourited
        action: 'unfavourite'
        icon: 'heart'
      else
        action: 'favourite'
        icon: 'heart-o'

    div className: 'beatmapset-header',
      el PlaymodeTabs,
        beatmaps: @props.beatmaps
        currentMode: @props.currentBeatmap.mode
        hrefFunc: @tabHrefFunc

      div
        className: 'beatmapset-header__content'
        style:
          backgroundImage: "url(#{@props.beatmapset.covers.cover})"

        div className: 'beatmapset-header__overlay beatmapset-header__overlay--gradient'

        div className: 'beatmapset-header__box beatmapset-header__box--main',
          div className: 'beatmapset-header__beatmap-picker-box',
            el BeatmapsetPage.BeatmapPicker,
              beatmaps: @props.beatmaps[@props.currentBeatmap.mode]
              currentBeatmap: @props.currentBeatmap

            span className: 'beatmapset-header__diff-name',
              if @props.hoveredBeatmap? then @props.hoveredBeatmap.version else @props.currentBeatmap.version

            span
              className: 'beatmapset-header__star-difficulty'
              style:
                visibility: 'hidden' if !@props.hoveredBeatmap?
              "#{osu.trans 'beatmapsets.show.stats.stars'} #{if @props.hoveredBeatmap then @props.hoveredBeatmap.difficulty_rating.toFixed 2 else ''}"

            div {},
              span className: 'beatmapset-header__value',
                span className: 'beatmapset-header__value-icon', el Icon, name: 'play-circle'
                span className: 'beatmapset-header__value-name', @props.beatmapset.play_count.toLocaleString()

              span className: 'beatmapset-header__value',
                span className: 'beatmapset-header__value-icon',
                  el Icon, name: 'heart'
                span className: 'beatmapset-header__value-name',
                  @props.favcount.toLocaleString()

          a
            className: 'beatmapset-header__details-text beatmapset-header__details-text--title u-ellipsis-overflow'
            href: laroute.route 'beatmapsets.index', q: @props.beatmapset.title
            @props.beatmapset.title

          a
            className: 'beatmapset-header__details-text beatmapset-header__details-text--artist'
            href: laroute.route 'beatmapsets.index', q: @props.beatmapset.artist
            @props.beatmapset.artist

          el BeatmapsetMapping, beatmapset: @props.beatmapset

          if currentUser.id?
            [
              if @props.beatmapset.availability
                div
                  key: 'availability'
                  className: 'beatmapset-header__availability-info',
                  if @props.beatmapset.availability.download_disabled
                    osu.trans 'beatmapsets.availability.disabled'
                  else
                    osu.trans 'beatmapsets.availability.parts-removed'

                  if @props.beatmapset.availability.more_information
                    div className: 'beatmapset-header__availability-link',
                      a href: @props.beatmapset.availability.more_information, target: '_blank', osu.trans 'beatmapsets.availability.more-info'

              div
                key: 'buttons'
                className: 'beatmapset-header__buttons'

                el BigButton,
                  props:
                    onClick: @toggleFavourite
                    href:
                      laroute.route 'beatmapsets.update-favourite',
                        beatmapset: @props.beatmapset.id
                        action: favouriteButton.action
                    title: osu.trans "beatmapsets.show.details.#{favouriteButton.action}"
                  modifiers: ['beatmapset-header-square', "beatmapset-header-square-#{favouriteButton.action}"]
                  icon: favouriteButton.icon

                unless @props.beatmapset.availability?.download_disabled
                  [
                    if @props.beatmapset.video
                      [
                        @downloadButton
                          key: 'video'
                          href: Url.beatmapDownload @props.beatmapset.id, true
                          bottomTextKey: 'video'

                        @downloadButton
                          key: 'no-video'
                          href: Url.beatmapDownload @props.beatmapset.id, false
                          bottomTextKey: 'no-video'
                      ]
                    else
                      @downloadButton
                        key: 'default'
                        href: Url.beatmapDownload @props.beatmapset.id, false

                    @downloadButton
                      key: 'direct'
                      topTextKey: 'direct'
                      href:
                        if currentUser.isSupporter
                          Url.beatmapDownloadDirect @props.beatmapset.id
                        else
                          laroute.route 'support-the-game'
                  ]

                if @props.beatmapset.discussion_status.enabled
                  el BigButton,
                    key: 'discussion'
                    modifiers: ['beatmapset-header']
                    text:
                      top: osu.trans 'beatmapsets.show.discussion'
                    icon: 'comments-o'
                    props:
                      href: laroute.route 'beatmapsetss.show.discussion', beatmapset: @props.beatmapset.id
            ]

        div className: 'beatmapset-header__box beatmapset-header__box--stats',
          el BeatmapsetPage.Stats,
            beatmapset: @props.beatmapset
            beatmap: @props.currentBeatmap
            timeElapsed: @props.timeElapsed


  downloadButton: ({key, href, icon = 'download', topTextKey = '_', bottomTextKey}) =>
    el BigButton,
      key: key
      modifiers: ['beatmapset-header']
      text:
        top: osu.trans "beatmapsets.show.details.download.#{topTextKey}"
        bottom: if bottomTextKey? then osu.trans "beatmapsets.show.details.download.#{bottomTextKey}"
      icon: icon
      props:
        href: href


  tabHrefFunc: (mode) ->
    BeatmapsetPageHash.generate mode: mode


  toggleFavourite: (e) ->
    e.preventDefault()

    if !currentUser.id?
      userLogin.show e.target
    else
      $.publish 'beatmapset:favourite:toggle'
