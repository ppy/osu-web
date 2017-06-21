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

{div, h2, li, ul} = React.DOM
el = React.createElement

ProfilePage.Main = React.createClass
  mixins: [StickyTabsMixin, ScrollingPageMixin]

  getInitialState: ->
    savedStateString = document.body.dataset.profilePageState
    if savedStateString?
      return JSON.parse(savedStateString)

    optionsHash = ProfilePageHash.parse location.hash
    @initialPage = optionsHash.page

    currentMode: @validMode(optionsHash.mode ? @props.user.playmode)
    user: @props.user
    userPage:
      html: @props.userPage.html
      initialRaw: @props.userPage.raw
      raw: @props.userPage.raw
      editing: false
      selection: [0, 0]
    tabsSticky: false
    profileOrder: @props.user.profileOrder[..]


  componentDidMount: ->
    $.subscribe 'user:update.profilePage', @userUpdate
    $.subscribe 'user:page:update.profilePage', @userPageUpdate
    $.subscribe 'playmode:set.profilePage', @setCurrentMode
    $.subscribe 'profile:page:jump.profilePage', @pageJump
    $.subscribe 'stickyHeader.profilePage', @_tabsStick

    $(@refs.pages).sortable
      cursor: 'move'
      handle: '.js-profile-page-extra--sortable-handle'
      revert: 150
      scrollSpeed: 10
      update: @updateOrder

    $(@refs.tabs).sortable
      items: '[data-page-id]'
      tolerance: 'pointer'
      cursor: 'move'
      disabled: !@props.withEdit
      revert: 150
      scrollSpeed: 0
      update: @updateOrder

    osu.pageChange()

    Timeout.set 0, =>
      @pageJump null, @initialPage


  componentWillUnmount: ->
    $.unsubscribe '.profilePage'
    $(window).off '.profilePage'

    for sortable in ['pages', 'tabs']
      $(@refs[sortable]).sortable 'destroy'

    document.body.dataset.profilePageState = JSON.stringify(@state)


  render: ->
    rankHistories = @props.allRankHistories[@state.currentMode]
    stats = @props.allStats[@state.currentMode]
    scores = @props.allScores[@state.currentMode]
    scoresBest = @props.allScoresBest[@state.currentMode]
    scoresFirst = @props.allScoresFirst[@state.currentMode]
    withMePage = @state.userPage.html != '' || @props.withEdit

    extraPageParams =
      me:
        extraClass: ('hidden' if !withMePage)
        props:
          userPage: @state.userPage
          user: @state.user
        component: ProfilePage.UserPage

      recent_activities:
        props:
          recentActivities: @props.recentActivities
        component: ProfilePage.RecentActivities

      kudosu:
        props:
          user: @state.user
          recentlyReceivedKudosu: @props.recentlyReceivedKudosu
        component: ProfilePage.Kudosu

      top_ranks:
        props:
          user: @state.user
          scoresBest: scoresBest
          scoresFirst: scoresFirst
        component: ProfilePage.TopRanks

      beatmaps:
        props:
          favouriteBeatmapsets: @props.favouriteBeatmapsets
          rankedAndApprovedBeatmapsets: @props.rankedAndApprovedBeatmapsets
        component: ProfilePage.Beatmaps

      medals:
        props:
          achievements: @props.achievements
          userAchievements: @props.userAchievements
          currentMode: @state.currentMode
          user: @state.user
        component: ProfilePage.Medals

      historical:
        props:
          beatmapPlaycounts: @props.beatmapPlaycounts
          rankHistories: rankHistories
          scores: scores
        component: ProfilePage.Historical

    div className: 'osu-layout__section',
      el ProfilePage.Header,
        user: @state.user
        stats: stats
        currentMode: @state.currentMode
        withEdit: @props.withEdit
        rankHistories: rankHistories

      div
        className: "hidden-xs page-extra-tabs #{'page-extra-tabs--floating' if @state.tabsSticky}"
        ref: 'tabs'

        div
          className: 'js-sticky-header'
          'data-sticky-header-target': 'page-extra-tabs'

        div
          className: 'page-extra-tabs__padding js-sync-height--target'
          'data-sync-height-id': 'page-extra-tabs'

        div
          className: 'page-extra-tabs__floatable js-sync-height--reference js-switchable-mode-page--scrollspy-offset'
          'data-sync-height-target': 'page-extra-tabs'
          div className: 'osu-page',
            ul
              className: 'page-mode page-mode--page-extra-tabs'
              for m in @state.profileOrder
                continue if m == 'me' && !withMePage

                li
                  className: 'page-mode__item'
                  key: m
                  el ProfilePage.ExtraTab,
                    page: m
                    currentPage: @state.currentPage
                    currentMode: @state.currentMode

      div
        className: 'osu-layout__section osu-layout__section--extra'
        div className: 'osu-layout__row', ref: 'pages',
          for name in @state.profileOrder
            @extraPage name, extraPageParams[name]


  extraPage: (name, {extraClass, props, component}) ->
    topClassName = 'js-switchable-mode-page--scrollspy js-switchable-mode-page--page'
    props.withEdit = @props.withEdit
    props.name = name

    div
      key: name
      'data-page-id': name
      className: "#{topClassName} #{extraClass}"
      el component, props


  setCurrentMode: (_e, {mode}) ->
    return if @state.currentMode == mode
    @setState currentMode: @validMode(mode)


  updateOrder: (event) ->
    $elems = $(event.target)

    newOrder = $elems.sortable('toArray', attribute: 'data-page-id')

    LoadingOverlay.show()

    $elems.sortable('cancel')

    @setState profileOrder: newOrder, =>
      $.ajax laroute.route('account.update'),
        method: 'PUT'
        dataType: 'JSON'
        data:
          user_profile_customization:
            extras_order: @state.profileOrder

      .done (userData) =>
        $.publish 'user:update', userData

      .fail (xhr) =>
        osu.emitAjaxError() xhr

        @setState profileOrder: @state.user.profileOrder

      .always LoadingOverlay.hide


  userUpdate: (_e, user) ->
    return if !user?
    @setState user: user


  userPageUpdate: (_e, newUserPage) ->
    currentUserPage = _.cloneDeep @state.userPage
    @setState userPage: _.extend(currentUserPage, newUserPage)


  validMode: (mode) ->
    modes = BeatmapHelper.modes

    if _.includes(modes, mode)
      mode
    else
      modes[0]
