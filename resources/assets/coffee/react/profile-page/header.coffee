# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import { CoverSelector } from './cover-selector'
import { DetailMobile } from './detail-mobile'
import { GameModeSwitcher } from './game-mode-switcher'
import * as React from 'react'
import HeaderV4 from 'header-v4'
import Img2x from 'img2x'
import Badges from 'profile-page/badges'
import Detail from 'profile-page/detail'
import HeaderInfo from 'profile-page/header-info'
import headerLinks from 'profile-page/header-links'
import Links from 'profile-page/links'
import RankCount from 'profile-page/rank-count'
import Stats from 'profile-page/stats'
import ProfileTournamentBanner from 'profile-tournament-banner'
import { a, button, div, dd, dl, dt, h1, i, img, li, span, ul } from 'react-dom-factories'
import { Spinner } from 'spinner'
import { nextVal } from 'utils/seq'
el = React.createElement


export class Header extends React.Component
  constructor: (props) ->
    super props

    @eventId = "users-show-header-#{nextVal()}"
    @state =
      editing: false
      coverUrl: props.user.cover.url
      isCoverUpdating: false
      settingDefaultMode: false

    @coverSelector = React.createRef()
    @debouncedCoverSet = _.debounce @coverSet, 300


  componentDidMount: =>
    $.subscribe "user:cover:reset.#{@eventId}", @coverReset
    $.subscribe "user:cover:set.#{@eventId}", @debouncedCoverSet
    $.subscribe "user:cover:upload:state.#{@eventId}", @coverUploadState

    $.subscribe "key:esc.#{@eventId}", @closeEdit
    $(document).on "click.#{@eventId}", @closeEdit


  componentWillReceiveProps: (newProps) =>
    @debouncedCoverSet null, newProps.user.cover.url


  componentWillUnmount: =>
    $.unsubscribe ".#{@eventId}"
    $(document).off ".#{@eventId}"

    @closeEdit()
    @debouncedCoverSet.cancel()
    @xhr?.abort()


  render: =>
    div
      className: 'js-switchable-mode-page--scrollspy js-switchable-mode-page--page'
      'data-page-id': 'main'
      el HeaderV4,
        backgroundImage: @state.coverUrl
        contentPrepend: el ProfileTournamentBanner,
          banner: @props.user.active_tournament_banner
        isCoverUpdating: @state.isCoverUpdating
        links: headerLinks(@props.user, 'show')
        theme: 'users'
        titleAppend: el GameModeSwitcher,
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
                  rankHistory: @props.user.rank_history

                el Stats, stats: @props.stats

                div className: 'profile-header__rank-count-mobile',
                  el RankCount, stats: @props.stats

          el Detail,
            stats: @props.stats
            type: 'user'
            user: @props.user
            userAchievements: @props.userAchievements

          el Badges, badges: @props.user.badges

          el Links, user: @props.user

          @renderCoverSelector()


  renderCoverSelector: =>
    if @props.withEdit
      div
        ref: @coverSelector
        className: 'profile-header__cover-editor'
        button
          className: 'btn-circle btn-circle--page-toggle'
          title: osu.trans('users.show.edit.cover.button')
          onClick: @toggleEdit
          span className: 'fas fa-pencil-alt'
        if @state.editing
          el CoverSelector,
            canUpload: @props.user.is_supporter
            cover: @props.user.cover


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
