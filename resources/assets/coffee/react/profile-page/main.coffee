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

{div, h2, li, ul} = ReactDOMFactories
el = React.createElement

pages = document.getElementsByClassName("js-switchable-mode-page--scrollspy")
pagesOffset = document.getElementsByClassName("js-switchable-mode-page--scrollspy-offset")

currentLocation = ->
  "#{document.location.pathname}#{document.location.search}"


class ProfilePage.Main extends React.PureComponent
  constructor: (props) ->
    super props

    savedStateString = document.body.dataset.profilePageState

    if savedStateString?
      @state = JSON.parse(savedStateString)
      delete document.body.dataset.profilePageState
      return

    page = location.hash.slice(1)
    @initialPage = page if page?

    @state =
      currentMode: props.currentMode
      user: props.user
      userPage:
        html: props.userPage.html
        initialRaw: props.userPage.raw
        raw: props.userPage.raw
        editing: false
        selection: [0, 0]
      tabsSticky: false
      profileOrder: props.user.profileOrder[..]
      scoresBest: @props.scores.best
      scoresFirst: @props.scores.first
      scoresRecent: @props.scores.recent
      beatmapPlaycounts: @props.beatmapsets.most_played
      favouriteBeatmapsets: @props.beatmapsets.favourite
      rankedAndApprovedBeatmapsets: @props.beatmapsets.ranked_and_approved
      recentlyReceivedKudosu: @props.recentlyReceivedKudosu
      pagination:
        favouriteBeatmapsets:
          perPage: 6
        rankedAndApprovedBeatmapsets:
          perPage: 6

  componentDidMount: =>
    $.subscribe 'user:update.profilePage', @userUpdate
    $.subscribe 'user:page:update.profilePage', @userPageUpdate
    $.subscribe 'showMore.profilePage', @loadMore
    $.subscribe 'profile:page:jump.profilePage', @pageJump
    $.subscribe 'stickyHeader.profilePage', @_tabsStick
    $(window).on 'throttled-scroll.profilePage', @pageScan

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

    @modeScrollUrl = currentLocation()

    Timeout.set 0, =>
      @pageJump null, @initialPage


  componentWillUnmount: =>
    $.unsubscribe '.profilePage'
    $(window).off '.profilePage'

    for sortable in ['pages', 'tabs']
      $(@refs[sortable]).sortable 'destroy'

    document.body.dataset.profilePageState = JSON.stringify(@state)

    $(window).stop()
    Timeout.clear @modeScrollTimeout


  render: =>
    rankHistories = @props.allRankHistories[@state.currentMode]
    stats = @props.allStats[@state.currentMode]
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
          recentlyReceivedKudosu: @state.recentlyReceivedKudosu
          pagination: @state.pagination
        component: ProfilePage.Kudosu

      top_ranks:
        props:
          user: @state.user
          scoresBest: @state.scoresBest
          scoresFirst: @state.scoresFirst
          currentMode: @state.currentMode
          pagination: @state.pagination
        component: ProfilePage.TopRanks

      beatmaps:
        props:
          user: @state.user
          favouriteBeatmapsets: @state.favouriteBeatmapsets
          rankedAndApprovedBeatmapsets: @state.rankedAndApprovedBeatmapsets
          counts:
            favouriteBeatmapsets: @state.user.favouriteBeatmapsetCount[0]
            rankedAndApprovedBeatmapsets: @state.user.rankedAndApprovedBeatmapsetCount[0]
          pagination: @state.pagination
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
          beatmapPlaycounts: @state.beatmapPlaycounts
          scoresRecent: @state.scoresRecent
          user: @state.user
          currentMode: @state.currentMode
          pagination: @state.pagination
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


  _tabsStick: (_e, target) =>
    newState = (target == 'page-extra-tabs')
    @setState(tabsSticky: newState) if newState != @state.tabsSticky


  extraPage: (name, {extraClass, props, component}) =>
    topClassName = 'js-switchable-mode-page--scrollspy js-switchable-mode-page--page'
    props.withEdit = @props.withEdit
    props.name = name

    div
      key: name
      'data-page-id': name
      className: "#{topClassName} #{extraClass}"
      el component, props


  loadMore: (e, {showMoreLink}) =>
    type = showMoreLink.dataset.showMore
    endpoint = showMoreLink.dataset.showMoreUrl
    offset = @state[type].length

    paginationState = _.cloneDeep @state.pagination
    if paginationState[type]?
      paginationState[type].loading = true
    else
      paginationState[type] = {}
      paginationState[type].loading = true

    @setState pagination: paginationState, ->
      $.get osu.updateQueryString('offset', offset, endpoint), (data) =>
        state = _.cloneDeep @state[type]
        state = state.concat(data)

        paginationState[type].loading = false
        maxResults = paginationState[type].maxResults || 100
        paginationState[type].hasMore = data.length == (paginationState[type].perPage ? 5) && state.length < maxResults

        @setState
          "#{type}": state
          pagination: paginationState

  pageJump: (_e, page) =>
    if page == 'main'
      @setCurrentPage null, page
      return

    target = $(".js-switchable-mode-page--page[data-page-id='#{page}']")

    # if invalid page is specified, scan current position
    if target.length == 0
      @pageScan()
      return

    # Don't bother scanning the current position.
    # The result will be wrong when target page is too short anyway.
    @scrolling = true
    Timeout.clear @modeScrollTimeout

    $(window).stop().scrollTo target, 500,
      onAfter: =>
        # Manually set the mode to avoid confusion (wrong highlight).
        # Scrolling will obviously break it but that's unfortunate result
        # from having the scrollspy marker at middle of page.
        @setCurrentPage null, page, =>
          # Doesn't work:
          # - part of state (callback, part of mode setting)
          # - simple variable in callback
          # Both still change the switch too soon.
          @modeScrollTimeout = Timeout.set 100, => @scrolling = false
      # count for the tabs height
      offset: pagesOffset[0].getBoundingClientRect().height * -1


  pageScan: =>
    return if @modeScrollUrl != currentLocation()

    return if @scrolling
    return if pages.length == 0

    anchorHeight = pagesOffset[0].getBoundingClientRect().height

    if osu.bottomPage()
      @setCurrentPage null, _.last(pages).dataset.pageId
      return

    for page in pages
      pageDims = page.getBoundingClientRect()
      pageBottom = pageDims.bottom - Math.min(pageDims.height * 0.75, 200)
      continue unless pageBottom > anchorHeight

      @setCurrentPage null, page.dataset.pageId
      return

    @setCurrentPage null, page.dataset.pageId


  setCurrentPage: (_e, page, extraCallback) =>
    callback = =>
      extraCallback?()
      @setHash?()

    if @state.currentPage == page
      return callback()

    @setState currentPage: page, callback


  updateOrder: (event) =>
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


  userUpdate: (_e, user) =>
    return if user?.id != @state.user.id
    # this component needs full user object but sometimes this event only sends part of it
    @setState user: _.assign({}, @state.user, user)


  userPageUpdate: (_e, newUserPage) =>
    currentUserPage = _.cloneDeep @state.userPage
    @setState userPage: _.extend(currentUserPage, newUserPage)


  validMode: (mode) =>
    modes = BeatmapHelper.modes

    if _.includes(modes, mode)
      mode
    else
      modes[0]
