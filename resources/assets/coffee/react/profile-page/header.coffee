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

{a, button, div, dd, dl, dt, h1, i, img, li, span, ul} = ReactDOMFactories
el = React.createElement


class ProfilePage.Header extends React.Component
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
        div
          className: 'header-v3__spinner'
          'data-visibility': if @state.isCoverUpdating then 'visible' else 'hidden'
          el Spinner
        div className: 'header-v3__overlay'
        div className: 'osu-page osu-page--header-v3',
          @renderTournamentBanner()
          @renderTitle()
          @renderTabs()
          el ProfilePage.GameModeSwitcher,
            currentMode: @props.currentMode
            user: @props.user
            withEdit: @props.withEdit
      div className: 'osu-page osu-page--users',
        div className: 'profile-header',
          div className: 'profile-header__top',
            el ProfilePage.HeaderInfo, user: @props.user, currentMode: @props.currentMode, coverUrl: @state.coverUrl

            if !@props.user.is_bot
              el React.Fragment, null,
                el ProfilePage.DetailMobile,
                  stats: @props.stats
                  userAchievements: @props.userAchievements
                  rankHistory: @props.rankHistory

                el ProfilePage.Stats, stats: @props.stats

          if !@props.user.is_bot
            el ProfilePage.Detail,
              stats: @props.stats
              userAchievements: @props.userAchievements
              rankHistory: @props.rankHistory
              user: @props.user

          if @props.user.badges.length > 0
            el ProfilePage.Badges, badges: @props.user.badges

          el ProfilePage.Links, user: @props.user

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
          el ProfilePage.CoverSelector,
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
      li
        className: 'page-mode-v2__item'
        a
          href: laroute.route('users.modding.index', user: @props.user.id)
          className: 'page-mode-v2__link'
          osu.trans 'users.beatmapset_activities.title_compact'


  renderTitle: =>
    div className: 'osu-page-header-v3 osu-page-header-v3--users',
      div className: 'osu-page-header-v3__title js-nav2--hidden-on-menu-access',
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
