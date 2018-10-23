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

{a, button, div, i, li, span, ul} = ReactDOMFactories
el = React.createElement

pages = document.getElementsByClassName("js-switchable-mode-page--scrollspy")
pagesOffset = document.getElementsByClassName("js-switchable-mode-page--scrollspy-offset")

currentLocation = ->
  "#{document.location.pathname}#{document.location.search}"


class ProfilePage.Main extends React.PureComponent
  constructor: (props) ->
    super props

    @state = JSON.parse(props.container.dataset.profilePageState ? null)
    @restoredState = @state?

    if !@restoredState
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
        profileOrder: props.user.profile_order[..]
        recentActivity: @props.extras.recentActivity
        scoresBest: @props.extras.scoresBest
        scoresFirsts: @props.extras.scoresFirsts
        scoresRecent: @props.extras.scoresRecent
        beatmapPlaycounts: @props.extras.beatmapPlaycounts
        favouriteBeatmapsets: @props.extras.favouriteBeatmapsets
        rankedAndApprovedBeatmapsets: @props.extras.rankedAndApprovedBeatmapsets
        lovedBeatmapsets: @props.extras.lovedBeatmapsets
        unrankedBeatmapsets: @props.extras.unrankedBeatmapsets
        graveyardBeatmapsets: @props.extras.graveyardBeatmapsets
        recentlyReceivedKudosu: @props.extras.recentlyReceivedKudosu
        showMorePagination: {}

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
    $(window).on 'throttled-scroll.profilePage', @pageScan
    $(document).on 'turbolinks:before-cache.profilePage', @saveStateToContainer

    $(@pages).sortable
      cursor: 'move'
      handle: '.js-profile-page-extra--sortable-handle'
      items: '.js-sortable--page'
      revert: 150
      scrollSpeed: 10
      update: @updateOrder

    $(@tabs).sortable
      containment: 'parent'
      cursor: 'move'
      disabled: !@props.withEdit
      items: '.js-sortable--tab'
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

    if !@restoredState
      Timeout.set 0, => @pageJump null, @initialPage


  componentWillUnmount: =>
    $.unsubscribe '.profilePage'
    $(window).off '.profilePage'

    for sortable in [@pages, @tabs]
      $(sortable).sortable 'destroy'

    $(window).stop()
    Timeout.clear @modeScrollTimeout


  render: =>
    if @props.user.is_bot
      profileOrder = ['me']
    else
      profileOrder = @state.profileOrder.slice()

    profileOrder.push 'account_standing' if !_.isEmpty @state.user.account_history

    if @state.userPage.initialRaw.trim() == '' && !@props.withEdit
      _.pull profileOrder, 'me'

    isBlocked = _.find(currentUser.blocks, target_id: @state.user.id)

    div
      className: 'osu-layout__no-scroll' if isBlocked
      if isBlocked
        div className: 'osu-page',
          el NotificationBanner,
            type: 'warning'
            title: osu.trans('users.blocks.banner_text')
            message:
              div className: 'notification-banner__button-group',
                div className: 'notification-banner__button',
                  el BlockButton, user_id: @props.user.id
                div className: 'notification-banner__button',
                  button
                    type: 'button'
                    className: 'textual-button'
                    onClick: =>
                      @setState forceShow: !@state.forceShow
                    span {},
                      i className: 'textual-button__icon fas fa-low-vision'
                      " "
                      if @state.forceShow
                        osu.trans('users.blocks.hide_profile')
                      else
                        osu.trans('users.blocks.show_profile')

      div className: "osu-layout osu-layout--full#{if isBlocked && !@state.forceShow then ' osu-layout--masked' else ''}",
        el ProfilePage.Header,
          user: @state.user
          stats: @state.user.statistics
          currentMode: @state.currentMode
          withEdit: @props.withEdit
          rankHistory: @props.rankHistory

        div
          className: 'page-extra-tabs-before'

        div
          className: 'hidden-xs page-extra-tabs js-switchable-mode-page--scrollspy-offset'
          if profileOrder.length > 1
            div className: 'osu-page',
              div
                className: 'page-mode page-mode--page-extra-tabs'
                ref: (el) => @tabs = el
                for m in profileOrder
                  a
                    className: "page-mode__item #{'js-sortable--tab' if @isSortablePage m}"
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
            @extraPage name for name in profileOrder


  extraPage: (name) =>
    {extraClass, props, component} = @extraPageParams name
    topClassName = 'js-switchable-mode-page--scrollspy js-switchable-mode-page--page'
    topClassName += ' js-sortable--page' if @isSortablePage name
    props.withEdit = @props.withEdit
    props.name = name

    @extraPages ?= {}

    div
      key: name
      'data-page-id': name
      className: "#{topClassName} #{extraClass}"
      ref: (el) => @extraPages[name] = el
      el component, props


  extraPageParams: (name) =>
    switch name
      when 'me'
        props:
          userPage: @state.userPage
          user: @state.user
        component: ProfilePage.UserPage

      when 'recent_activity'
        props:
          pagination: @state.showMorePagination
          recentActivity: @state.recentActivity
          user: @state.user
        component: ProfilePage.RecentActivity

      when 'kudosu'
        props:
          user: @state.user
          recentlyReceivedKudosu: @state.recentlyReceivedKudosu
          pagination: @state.showMorePagination
        component: ProfilePage.Kudosu

      when 'top_ranks'
        props:
          user: @state.user
          scoresBest: @state.scoresBest
          scoresFirsts: @state.scoresFirsts
          currentMode: @state.currentMode
          pagination: @state.showMorePagination
        component: ProfilePage.TopRanks

      when 'beatmaps'
        props:
          user: @state.user
          favouriteBeatmapsets: @state.favouriteBeatmapsets
          rankedAndApprovedBeatmapsets: @state.rankedAndApprovedBeatmapsets
          lovedBeatmapsets: @state.lovedBeatmapsets
          unrankedBeatmapsets: @state.unrankedBeatmapsets
          graveyardBeatmapsets: @state.graveyardBeatmapsets
          counts:
            favouriteBeatmapsets: @state.user.favourite_beatmapset_count[0]
            rankedAndApprovedBeatmapsets: @state.user.ranked_and_approved_beatmapset_count[0]
            lovedBeatmapsets: @state.user.loved_beatmapset_count[0]
            unrankedBeatmapsets: @state.user.unranked_beatmapset_count[0]
            graveyardBeatmapsets: @state.user.graveyard_beatmapset_count[0]
          pagination: @state.showMorePagination
        component: ProfilePage.Beatmaps

      when 'medals'
        props:
          achievements: @props.achievements
          userAchievements: @props.userAchievements
          currentMode: @state.currentMode
          user: @state.user
        component: ProfilePage.Medals

      when 'historical'
        props:
          beatmapPlaycounts: @state.beatmapPlaycounts
          scoresRecent: @state.scoresRecent
          user: @state.user
          currentMode: @state.currentMode
          pagination: @state.showMorePagination
        component: ProfilePage.Historical

      when 'account_standing'
        props:
          user: @state.user
        component: ProfilePage.AccountStanding


  showMore: (e, {name, url, perPage = 20}) =>
    offset = @state[name].length

    paginationState = _.cloneDeep @state.showMorePagination
    paginationState[name] ?= {}
    paginationState[name].loading = true

    @setState showMorePagination: paginationState, ->
      $.get osu.updateQueryString(url, offset: offset, limit: perPage + 1), (data) =>
        state = _.cloneDeep(@state[name]).concat(data)
        hasMore = data.length > perPage

        state.pop() if hasMore

        paginationState = _.cloneDeep @state.showMorePagination
        paginationState[name].loading = false
        paginationState[name].hasMore = hasMore

        @setState
          "#{name}": state
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

    # count for the tabs height; assume pageJump always causes the header to be pinned
    # otherwise the calculation needs another phase and gets a bit messy.
    offsetTop = target.offset().top - pagesOffset[0].getBoundingClientRect().height

    $(window).stop().scrollTo window.stickyHeader.scrollOffset(offsetTop), 500,
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


  saveStateToContainer: =>
    @props.container.dataset.profilePageState = JSON.stringify(@state)

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
    return @forceUpdate() if user?.id != @state.user.id

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

  isSortablePage: (page) ->
    _.includes @state.profileOrder, page
