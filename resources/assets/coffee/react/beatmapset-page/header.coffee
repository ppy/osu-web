# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import { Stats } from './stats'
import { BeatmapsetMapping } from 'beatmapset-mapping'
import BeatmapPicker from 'beatmapsets-show/beatmap-picker'
import BeatmapsetMenu from 'beatmapsets-show/beatmapset-menu'
import { BigButton } from 'big-button'
import { route } from 'laroute'
import core from 'osu-core-singleton'
import * as React from 'react'
import { div, span, a, img, ol, li, i } from 'react-dom-factories'
import UserAvatar from 'user-avatar'
import { getArtist, getTitle } from 'utils/beatmap-helper'
import { createClickCallback } from 'utils/html'
import { beatmapDownloadDirect, wikiUrl } from 'utils/url'
el = React.createElement

export class Header extends React.Component
  favouritesToShow: 50


  constructor: (props) ->
    super props

    @filteredFavourites = []


  hasAvailabilityInfo: =>
    @props.beatmapset.availability.download_disabled || @props.beatmapset.availability.more_information?


  showFavourites: (event) =>
    target = event.currentTarget

    if @filteredFavourites.length < 1
      if target._tooltip
        target._tooltip = false
        $(target).qtip 'destroy', true

      return

    return if target._tooltip

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
    @filteredFavourites = @props.beatmapset.recent_favourites.filter (f) -> f.id != currentUser.id
    @filteredFavourites.unshift(currentUser) if @props.hasFavourited
    @filteredFavourites = @filteredFavourites[...@favouritesToShow]

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
              beatmaps: @props.beatmaps.get(@props.currentBeatmap.mode)
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
                  span className: 'beatmapset-header__value-name',
                    @props.beatmapset.nominations_summary.current

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
              @filteredFavourites.map (user) ->
                a
                  href: laroute.route('users.show', user: user.id)
                  className: 'js-usercard user-list-popup__user'
                  key: user.id
                  'data-user-id': user.id
                  el UserAvatar, user: user, modifiers: ['full']
              if @props.favcount > @filteredFavourites.length
                div className: 'user-list-popup__remainder-count',
                  osu.transChoice 'common.count.plus_others', @props.favcount - @filteredFavourites.length

          span className: 'beatmapset-header__details-text beatmapset-header__details-text--title',
            a
              className: 'beatmapset-header__details-text-link'
              href: laroute.route 'beatmapsets.index', q: getTitle(@props.beatmapset)
              getTitle(@props.beatmapset)
            if @props.beatmapset.nsfw
              span className: 'beatmapset-badge beatmapset-badge--nsfw', osu.trans('beatmapsets.nsfw_badge.label')

          span className: 'beatmapset-header__details-text beatmapset-header__details-text--artist',
            a
              className: 'beatmapset-header__details-text-link'
              href: laroute.route 'beatmapsets.index', q: getArtist(@props.beatmapset)
              getArtist(@props.beatmapset)
            if @props.beatmapset.track?
              a
                className: 'beatmapset-badge beatmapset-badge--featured-artist'
                href: laroute.route 'tracks.show', @props.beatmapset.track_id
                osu.trans('beatmapsets.featured_artist_badge.label')

          el BeatmapsetMapping, beatmapset: @props.beatmapset

          @renderAvailabilityInfo()

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

            if currentUser.id? && currentUser.id != @props.beatmapset.user_id
              div className: 'beatmapset-header__more',
                div className: 'btn-circle btn-circle--page-toggle btn-circle--page-toggle-detail',
                  el BeatmapsetMenu,
                    beatmapset: @props.beatmapset

        div className: 'beatmapset-header__box beatmapset-header__box--stats',
          @renderStatusBar()
          el Stats,
            beatmapset: @props.beatmapset
            beatmap: @props.currentBeatmap
            timeElapsed: @props.timeElapsed


  renderAvailabilityInfo: =>
    return unless currentUser.id? && @hasAvailabilityInfo()

    href = if @props.beatmapset.availability.more_information == 'rule_violation'
              "#{wikiUrl('Rules')}#beatmap-submission-rules"
            else
              @props.beatmapset.availability.more_information

    div
      className: 'beatmapset-header__availability-info',
      if @props.beatmapset.availability.download_disabled
        osu.trans 'beatmapsets.availability.disabled'
      else if @props.beatmapset.availability.more_information == 'rule_violation'
        osu.trans 'beatmapsets.availability.rule_violation'
      else
        osu.trans 'beatmapsets.availability.parts-removed'

      if href?
        div className: 'beatmapset-header__availability-link',
          a
            href: href
            target: '_blank'
            osu.trans 'beatmapsets.availability.more-info'


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
              beatmapDownloadDirect @props.currentBeatmap.id
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


  renderStatusBar: =>
    div className: 'beatmapset-header__status',
      if @props.beatmapset.storyboard
        div
          className: 'beatmapset-status beatmapset-status--show-icon'
          title: osu.trans('beatmapsets.show.info.storyboard')
          i className: 'fas fa-image'
      div className: 'beatmapset-status beatmapset-status--show', osu.trans("beatmapsets.show.status.#{@props.currentBeatmap.status}")


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
    return if core.userLogin.showIfGuest(createClickCallback(e.target))

    $.publish 'beatmapset:favourite:toggle'
