###
#    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
#    See the LICENCE file in the repository root for full licence text.
###

import { Badges } from './badges'
import { CoverSelector } from './cover-selector'
import { Detail } from './detail'
import { DetailMobile } from './detail-mobile'
import { GameModeSwitcher } from './game-mode-switcher'
import { HeaderInfo } from './header-info'
import { Links } from './links'
import { Stats } from './stats'
import * as React from 'react'
import { Img2x } from 'img2x'
import { a, button, div, dd, dl, dt, h1, i, img, li, span, ul } from 'react-dom-factories'
import { Spinner } from 'spinner'
el = React.createElement


export class Header extends React.Component
  constructor: (props) ->
    super props

    @state =
      editing: false
      coverUrl: props.user.cover_url
      isCoverUpdating: false
      settingDefaultMode: false

    @coverSelector = React.createRef()
    @debouncedCoverSet = _.debounce @coverSet, 300


  componentDidMount: =>
    $.subscribe 'user:cover:reset.profilePageHeaderMain', @coverReset
    $.subscribe 'user:cover:set.profilePageHeaderMain', @debouncedCoverSet
    $.subscribe 'user:cover:upload:state.profilePageHeaderMain', @coverUploadState

    $.subscribe 'key:esc.profilePageHeaderMain', @closeEdit
    $(document).on 'click.profilePageHeaderMain', @closeEdit


  componentWillReceiveProps: (newProps) =>
    @debouncedCoverSet null, newProps.user.cover.url


  componentWillUnmount: =>
    $.unsubscribe '.profilePageHeaderMain'
    $(document).off '.profilePageHeaderMain'

    @closeEdit()
    @debouncedCoverSet.cancel()
    @xhr?.abort()


  render: =>
    div
      className: 'js-switchable-mode-page--scrollspy js-switchable-mode-page--page'
      'data-page-id': 'main'
      div className: 'header-v3 header-v3--users',
        div
          className: 'header-v3__bg'
          style:
            backgroundImage: osu.urlPresence(@state.coverUrl)
        if @props.withEdit
          div
            className: 'header-v3__spinner'
            'data-visibility': if @state.isCoverUpdating then 'visible' else 'hidden'
            el Spinner
        div className: 'header-v3__overlay'
        div className: 'osu-page osu-page--header-v3',
          @renderTournamentBanner()
          @renderTitle()
          @renderTabs()
          el GameModeSwitcher,
            currentMode: @props.currentMode
            user: @props.user
            withEdit: @props.withEdit
      div className: 'osu-page osu-page--users',
        div className: 'profile-header',
          div className: 'profile-header__top',
            el HeaderInfo, user: @props.user, currentMode: @props.currentMode, coverUrl: @state.coverUrl

            if !@props.user.is_bot
              el React.Fragment, null,
                el DetailMobile,
                  stats: @props.stats
                  userAchievements: @props.userAchievements
                  rankHistory: @props.rankHistory

                el Stats, stats: @props.stats

          if !@props.user.is_bot
            el Detail,
              stats: @props.stats
              userAchievements: @props.userAchievements
              rankHistory: @props.rankHistory
              user: @props.user

          if @props.user.badges.length > 0
            el Badges, badges: @props.user.badges

          el Links, user: @props.user

          @renderCoverSelector()


  renderCoverSelector: =>
    if @props.withEdit
      div
        ref: @coverSelector
        className: 'profile-header__cover-editor'
        button
          className: 'profile-page-toggle'
          title: osu.trans('users.show.edit.cover.button')
          onClick: @toggleEdit
          span className: 'fas fa-pencil-alt'
        if @state.editing
          el CoverSelector,
            canUpload: @props.user.is_supporter
            cover: @props.user.cover


  renderTabs: =>
    ul className: 'page-mode-v2 page-mode-v2--users',
      li
        className: 'page-mode-v2__item'
        a
          href: laroute.route('users.show', user: @props.user.id)
          className: 'page-mode-v2__link page-mode-v2__link--active'
          osu.trans 'users.show.header_title.info'
      if !@props.user.is_bot
        li
          className: 'page-mode-v2__item'
          a
            href: laroute.route('users.modding.index', user: @props.user.id)
            className: 'page-mode-v2__link'
            osu.trans 'users.beatmapset_activities.title_compact'


  renderTitle: =>
    div className: 'osu-page-header-v3 osu-page-header-v3--users',
      div className: 'osu-page-header-v3__title',
        div className: 'osu-page-header-v3__title-icon',
          div className: 'osu-page-header-v3__icon'
        h1
          className: 'osu-page-header-v3__title-text'
          dangerouslySetInnerHTML:
            __html: osu.trans 'users.show.header_title._',
            info: "<span class='osu-page-header-v3__title-highlight'>#{osu.trans('users.show.header_title.info')}</span>"


  renderTournamentBanner: ({modifiers} = {}) =>
    return if !@props.user.active_tournament_banner.id?

    a
      href: laroute.route('tournaments.show', tournament: @props.user.active_tournament_banner.tournament_id)
      className: osu.classWithModifiers 'profile-tournament-banner', modifiers
      el Img2x,
        src: @props.user.active_tournament_banner.image
        className: 'profile-tournament-banner__image'


  closeEdit: (e) =>
    return unless @state.editing

    if e?
      return if e.button != 0
      return if $(e.target).closest(@coverSelector.current).length

    return if $('#overlay').is(':visible')
    return if document.body.classList.contains('modal-open')

    @setState editing: false, @coverReset


  coverReset: =>
    @debouncedCoverSet null, @props.user.cover.url


  coverSet: (_e, url) =>
    return if @state.isCoverUpdating

    @setState coverUrl: url


  coverUploadState: (_e, state) =>
    @setState isCoverUpdating: state


  openEdit: =>
    @setState editing: true


  toggleEdit: =>
    if @state.editing
      @closeEdit()
    else
      @openEdit()


  setDefaultMode: =>
    @setState settingDefaultMode: true

    @xhr = $.ajax laroute.route('account.update'),
      method: 'PUT'
      data:
        user:
          playmode: @props.currentMode
    .done (data) ->
      $.publish 'user:update', data
    .fail (xhr, status) ->
      return if status == 'abort'

      osu.emitAjaxError() xhr
    .always =>
      @setState settingDefaultMode: false
