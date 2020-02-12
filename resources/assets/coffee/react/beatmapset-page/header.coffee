###
#    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
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

import { BeatmapPicker } from './beatmap-picker'
import { Stats } from './stats'
import { BeatmapsetMapping } from 'beatmapset-mapping'
import { BigButton } from 'big-button'
import * as React from 'react'
import { div, span, a, img, ol, li, i } from 'react-dom-factories'
import { UserAvatar } from 'user-avatar'
el = React.createElement

export class Header extends React.Component
  favouritesToShow: 50

  hasAvailabilityInfo: =>
    @props.beatmapset.availability.download_disabled || @props.beatmapset.availability.more_information?


  showFavourites: (event) =>
    target = event.currentTarget

    if @props.favcount < 1 || target._tooltip
      return

    target._tooltip = true

    $(target).qtip
      style:
        classes: 'user-list-popup'
        def: false
        tip: false
      content:
        text: (event, api) => $('.user-list-popup__template').html()
      position:
        at: 'right center'
        my: 'left center'
        viewport: $(window)
      show:
        delay: 100
        ready: true
        effect: -> $(this).fadeTo(110, 1)
      hide:
        fixed: true
        delay: 500
        effect: -> $(this).fadeTo(250, 0)

  render: ->
    favouriteButton =
      if @props.hasFavourited
        action: 'unfavourite'
        icon: 'fas fa-heart'
      else
        action: 'favourite'
        icon: 'far fa-heart'

    div className: 'beatmapset-header',
      div
        className: 'beatmapset-header__content'
        style:
          backgroundImage: osu.urlPresence(@props.beatmapset.covers.cover)

        div className: 'beatmapset-header__overlay beatmapset-header__overlay--gradient'

        div className: 'beatmapset-header__box beatmapset-header__box--main',
          div className: 'beatmapset-header__beatmap-picker-box',
            el BeatmapPicker,
              beatmaps: @props.beatmaps[@props.currentBeatmap.mode]
              currentBeatmap: @props.currentBeatmap

            span className: 'beatmapset-header__diff-name',
              if @props.hoveredBeatmap? then @props.hoveredBeatmap.version else @props.currentBeatmap.version

            span
              className: 'beatmapset-header__star-difficulty'
              style:
                visibility: 'hidden' if !@props.hoveredBeatmap?
              "#{osu.trans 'beatmapsets.show.stats.stars'} #{if @props.hoveredBeatmap then osu.formatNumber(@props.hoveredBeatmap.difficulty_rating, 2) else ''}"

            div {},
              span className: 'beatmapset-header__value', title: osu.trans('beatmapsets.show.stats.playcount'),
                span className: 'beatmapset-header__value-icon', i className: 'fas fa-play-circle'
                span className: 'beatmapset-header__value-name', osu.formatNumber(@props.beatmapset.play_count)

              if @props.beatmapset.status == 'pending'
                span className: 'beatmapset-header__value', title: osu.trans('beatmapsets.show.stats.nominations'),
                  span className: 'beatmapset-header__value-icon', i className: 'fas fa-thumbs-up'
                  span className: 'beatmapset-header__value-name', @props.beatmapset.nominations.current

              span
                className: "beatmapset-header__value#{if @props.favcount > 0 then ' beatmapset-header__value--has-favourites' else ''}"
                onMouseOver: @showFavourites
                onTouchStart: @showFavourites
                span className: 'beatmapset-header__value-icon',
                  i className: 'fas fa-heart'
                span className: 'beatmapset-header__value-name',
                  osu.formatNumber(@props.favcount)

            # this content of this div is used as a template for the on-hover/touch above
            div
              className: 'user-list-popup user-list-popup__template'
              style:
                display: 'none'
              @props.beatmapset.recent_favourites.map (user) ->
                a
                  href: laroute.route('users.show', user: user.id)
                  className: 'js-usercard user-list-popup__user'
                  key: user.id
                  'data-user-id': user.id
                  el UserAvatar, user: user, modifiers: ['full']
              if @props.favcount > @favouritesToShow
                div className: 'user-list-popup__remainder-count',
                  osu.transChoice 'common.count.plus_others', @props.favcount - @favouritesToShow

          a
            className: 'beatmapset-header__details-text beatmapset-header__details-text--title u-ellipsis-overflow'
            href: laroute.route 'beatmapsets.index', q: @props.beatmapset.title
            @props.beatmapset.title

          a
            className: 'beatmapset-header__details-text beatmapset-header__details-text--artist'
            href: laroute.route 'beatmapsets.index', q: @props.beatmapset.artist
            @props.beatmapset.artist

          el BeatmapsetMapping, beatmapset: @props.beatmapset

          if currentUser.id? && @hasAvailabilityInfo()
            div
              className: 'beatmapset-header__availability-info',
              if @props.beatmapset.availability.download_disabled
                osu.trans 'beatmapsets.availability.disabled'
              else
                osu.trans 'beatmapsets.availability.parts-removed'

              if @props.beatmapset.availability.more_information?
                div className: 'beatmapset-header__availability-link',
                  a
                    href: @props.beatmapset.availability.more_information
                    target: '_blank'
                    osu.trans 'beatmapsets.availability.more-info'

          div
            className: 'beatmapset-header__buttons'

            if currentUser.id?
              el BigButton,
                props:
                  onClick: @toggleFavourite
                  title: osu.trans "beatmapsets.show.details.#{favouriteButton.action}"
                modifiers: ['beatmapset-header-square', "beatmapset-header-square-#{favouriteButton.action}"]
                icon: favouriteButton.icon

            @renderDownloadButtons()

            if @props.beatmapset.discussion_enabled
              el BigButton,
                modifiers: ['beatmapset-header']
                text:
                  top: osu.trans 'beatmapsets.show.discussion'
                icon: 'far fa-comments'
                props:
                  href: laroute.route 'beatmapsets.discussion', beatmapset: @props.beatmapset.id
            else if @props.beatmapset.legacy_thread_url
              el BigButton,
                modifiers: ['beatmapset-header']
                text:
                  top: osu.trans 'beatmapsets.show.discussion'
                icon: 'far fa-comments'
                props:
                  href: @props.beatmapset.legacy_thread_url

            @renderLoginButton()

        div className: 'beatmapset-header__box beatmapset-header__box--stats',
          div className: 'beatmapset-status beatmapset-status--show', osu.trans("beatmapsets.show.status.#{@props.currentBeatmap.status}")
          el Stats,
            beatmapset: @props.beatmapset
            beatmap: @props.currentBeatmap
            timeElapsed: @props.timeElapsed


  renderDownloadButtons: =>
    if currentUser.id? && !@props.beatmapset.availability?.download_disabled
      [
        if @props.beatmapset.video
          [
            @downloadButton
              key: 'video'
              href: laroute.route 'beatmapsets.download', beatmapset: @props.beatmapset.id
              bottomTextKey: 'video'

            @downloadButton
              key: 'no-video'
              href: laroute.route 'beatmapsets.download', beatmapset: @props.beatmapset.id, noVideo: 1
              bottomTextKey: 'no-video'
          ]
        else
          @downloadButton
            key: 'default'
            href: laroute.route 'beatmapsets.download', beatmapset: @props.beatmapset.id

        @downloadButton
          key: 'direct'
          topTextKey: 'direct'
          osuDirect: true
          href:
            if currentUser.is_supporter
              _exported.OsuUrlHelper.beatmapDownloadDirect @props.currentBeatmap.id
            else
              laroute.route 'support-the-game'
      ]


  renderLoginButton: ->
    if !currentUser.id?
      el BigButton,
        extraClasses: ['js-user-link']
        modifiers: ['beatmapset-header']
        text:
          top: osu.trans 'beatmapsets.show.details.login_required.top'
          bottom: osu.trans 'beatmapsets.show.details.login_required.bottom'
        icon: 'fas fa-lock'


  downloadButton: ({key, href, icon = 'fas fa-download', topTextKey = '_', bottomTextKey, osuDirect = false}) =>
    el BigButton,
      key: key
      modifiers: ['beatmapset-header']
      text:
        top: osu.trans "beatmapsets.show.details.download.#{topTextKey}"
        bottom: if bottomTextKey? then osu.trans "beatmapsets.show.details.download.#{bottomTextKey}"
      icon: icon
      extraClasses: if !osuDirect then ['js-beatmapset-download-link']
      props:
        href: href
        'data-turbolinks': 'false'


  toggleFavourite: (e) ->
    if !currentUser.id?
      userLogin.show e.target
    else
      $.publish 'beatmapset:favourite:toggle'
