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

{a, div, h2, li, ul} = ReactDOMFactories
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
      profileOrder: props.user.profile_order[..]
      recentActivity: @props.extras.recentActivity
      scoresBest: @props.extras.scoresBest
      scoresFirsts: @props.extras.scoresFirsts
      scoresRecent: @props.extras.scoresRecent
      beatmapPlaycounts: @props.extras.beatmapPlaycounts
      favouriteBeatmapsets: @props.extras.favouriteBeatmapsets
      rankedAndApprovedBeatmapsets: @props.extras.rankedAndApprovedBeatmapsets
      unrankedBeatmapsets: @props.extras.unrankedBeatmapsets
      graveyardBeatmapsets: @props.extras.graveyardBeatmapsets
      recentlyReceivedKudosu: @props.extras.recentlyReceivedKudosu
      showMorePagination: {}

    if @props.user.is_bot
      @state.profileOrder = ['me']

    for own elem, perPage of @props.perPage
      @state.showMorePagination[elem] ?= {}
      @state.showMorePagination[elem].hasMore = @state[elem].length > perPage

      if @state.showMorePagination[elem].hasMore
        @state[elem].pop()

  componentDidMount: =>
    $.subscribe 'user:update.profilePage', @userUpdate
    $.subscribe 'user:page:update.profilePage', @userPageUpdate
    $.subscribe 'profile:showMore.profilePage', @showMore
    $.subscribe 'profile:page:jump.profilePage', @pageJump
    $.subscribe 'stickyHeader.profilePage', @_tabsStick
    $(window).on 'throttled-scroll.profilePage', @pageScan

    $(@pages).sortable
      cursor: 'move'
      handle: '.js-profile-page-extra--sortable-handle'
      revert: 150
      scrollSpeed: 10
      update: @updateOrder

    $(@tabs).sortable
      containment: 'parent'
      cursor: 'move'
      disabled: !@props.withEdit
      revert: 150
      scrollSpeed: 0
      update: @updateOrder
      start: =>
        # Somehow click event still goes through when dragging.
        # This prevents triggering @tabClick.
        Timeout.clear @draggingTabTimeout
        @draggingTab = true
      stop: =>
        @draggingTabTimeout = Timeout.set 500, => @draggingTab = false

    osu.pageChange()

    @modeScrollUrl = currentLocation()

    Timeout.set 0, =>
      @pageJump null, @initialPage


  componentWillUnmount: =>
    $.unsubscribe '.profilePage'
    $(window).off '.profilePage'

    for sortable in [@pages, @tabs]
      $(sortable).sortable 'destroy'

    document.body.dataset.profilePageState = JSON.stringify(@state)

    $(window).stop()
    Timeout.clear @modeScrollTimeout


  render: =>
    withMePage = @state.userPage.initialRaw.trim() != '' || @props.withEdit

    extraPageParams =
      me:
        extraClass: ('hidden' if !withMePage)
        props:
          userPage: @state.userPage
          user: @state.user
        component: ProfilePage.UserPage

      recent_activity:
        props:
          pagination: @state.showMorePagination
          recentActivity: @state.recentActivity
          user: @state.user
        component: ProfilePage.RecentActivity

      kudosu:
        props:
          user: @state.user
          recentlyReceivedKudosu: @state.recentlyReceivedKudosu
          pagination: @state.showMorePagination
        component: ProfilePage.Kudosu

      top_ranks:
        props:
          user: @state.user
          scoresBest: @state.scoresBest
          scoresFirsts: @state.scoresFirsts
          currentMode: @state.currentMode
          pagination: @state.showMorePagination
        component: ProfilePage.TopRanks

      beatmaps:
        props:
          user: @state.user
          favouriteBeatmapsets: @state.favouriteBeatmapsets
          rankedAndApprovedBeatmapsets: @state.rankedAndApprovedBeatmapsets
          unrankedBeatmapsets: @state.unrankedBeatmapsets
          graveyardBeatmapsets: @state.graveyardBeatmapsets
          counts:
            favouriteBeatmapsets: @state.user.favourite_beatmapset_count[0]
            rankedAndApprovedBeatmapsets: @state.user.ranked_and_approved_beatmapset_count[0]
            unrankedBeatmapsets: @state.user.unranked_beatmapset_count[0]
            graveyardBeatmapsets: @state.user.graveyard_beatmapset_count[0]
          pagination: @state.showMorePagination
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
          pagination: @state.showMorePagination
        component: ProfilePage.Historical

    div className: 'osu-layout osu-layout--full',
      el ProfilePage.Header,
        user: @state.user
        stats: @props.statistics
        currentMode: @state.currentMode
        withEdit: @props.withEdit
        rankHistory: @props.rankHistory

      div
        className: "hidden-xs page-extra-tabs #{'page-extra-tabs--floating' if @state.tabsSticky}"

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
            div
              className: 'page-mode page-mode--page-extra-tabs'
              ref: (el) => @tabs = el
              for m in @state.profileOrder
                continue if m == 'me' && !withMePage

                a
                  className: 'page-mode__item'
                  key: m
                  'data-page-id': m
                  onClick: @tabClick
                  href: "##{m}"
                  el ProfilePage.ExtraTab,
                    page: m
                    currentPage: @state.currentPage
                    currentMode: @state.currentMode

      div
        className: 'osu-layout__section osu-layout__section--extra'
        div
          className: 'osu-layout__row'
          ref: (el) => @pages = el
          for name in @state.profileOrder
            @extraPage name, extraPageParams[name]


  _tabsStick: (_e, target) =>
    newState = (target == 'page-extra-tabs')
    @setState(tabsSticky: newState) if newState != @state.tabsSticky


  extraPage: (name, {extraClass, props, component}) =>
    topClassName = 'js-switchable-mode-page--scrollspy js-switchable-mode-page--page'
    props.withEdit = @props.withEdit
    props.name = name

    @extraPages ?= {}

    div
      key: name
      'data-page-id': name
      className: "#{topClassName} #{extraClass}"
      ref: (el) => @extraPages[name] = el
      el component, props


  showMore: (e, {showMoreLink}) =>
    propertyName = showMoreLink.dataset.showMore
    url = showMoreLink.dataset.showMoreUrl
    offset = @state[propertyName].length
    perPage = parseInt(showMoreLink.dataset.showMorePerPage)
    maxResults = parseInt(showMoreLink.dataset.showMoreMaxResults)

    paginationState = _.cloneDeep @state.showMorePagination
    paginationState[propertyName] ?= {}
    paginationState[propertyName].loading = true

    @setState showMorePagination: paginationState, ->
      $.get osu.updateQueryString(url, offset: offset, limit: perPage + 1), (data) =>
        state = _.cloneDeep(@state[propertyName]).concat(data)
        hasMore = data.length > perPage

        state.pop() if hasMore

        paginationState = _.cloneDeep @state.showMorePagination
        paginationState[propertyName].loading = false
        paginationState[propertyName].hasMore = hasMore

        @setState
          "#{propertyName}": state
          showMorePagination: paginationState


  pageJump: (_e, page) =>
    if page == 'main'
      @setCurrentPage null, page
      return

    target = $(@extraPages[page])

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


  tabClick: (e) =>
    e.preventDefault()

    # See $(@tabs).sortable.
    return if @draggingTab

    @pageJump null, e.currentTarget.dataset.pageId


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

        @setState profileOrder: @state.user.profile_order

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
