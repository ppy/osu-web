# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import { ExtraTab } from './extra-tab'
import { Header } from './header'
import { Historical } from './historical'
import { Medals } from './medals'
import { TopRanks } from './top-ranks'
import { UserPage } from './user-page'
import { BlockButton } from 'block-button'
import { NotificationBanner } from 'notification-banner'
import core from 'osu-core-singleton'
import AccountStanding from 'profile-page/account-standing'
import Beatmapsets from 'profile-page/beatmapsets'
import Kudosu from 'profile-page/kudosu'
import RecentActivity from 'profile-page/recent-activity'
import * as React from 'react'
import { a, button, div, i, li, span, ul } from 'react-dom-factories'
import UserProfileContainer from 'user-profile-container'
import * as BeatmapHelper from 'utils/beatmap-helper'
import { hideLoadingOverlay, showLoadingOverlay } from 'utils/loading-overlay'
import { pageChange } from 'utils/page-change'
import { nextVal } from 'utils/seq'
import { currentUrl, currentUrlRelative } from 'utils/turbolinks'

el = React.createElement

pages = document.getElementsByClassName("js-switchable-mode-page--scrollspy")
pagesOffset = document.getElementsByClassName("js-switchable-mode-page--scrollspy-offset")

export class Main extends React.PureComponent
  constructor: (props) ->
    super props

    @eventId = "users-show-#{nextVal()}"
    @tabs = React.createRef()
    @pages = React.createRef()
    @state = JSON.parse(props.container.dataset.profilePageState ? null)
    @restoredState = @state?

    if !@restoredState
      page = currentUrl().hash.slice(1)
      @initialPage = page if page?

      @state =
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
        rankedBeatmapsets: @props.extras.rankedBeatmapsets
        lovedBeatmapsets: @props.extras.lovedBeatmapsets
        pendingBeatmapsets: @props.extras.pendingBeatmapsets
        graveyardBeatmapsets: @props.extras.graveyardBeatmapsets
        recentlyReceivedKudosu: @props.extras.recentlyReceivedKudosu
        showMorePagination: {}

      for own elem, perPage of @props.perPage
        @state.showMorePagination[elem] ?= {}
        @state.showMorePagination[elem].hasMore = @state[elem].length > perPage

        if @state.showMorePagination[elem].hasMore
          @state[elem].pop()


  componentDidMount: =>
    $.subscribe "user:update.#{@eventId}", @userUpdate
    $.subscribe "user:page:update.#{@eventId}", @userPageUpdate
    $.subscribe "profile:showMore.#{@eventId}", @showMore
    $.subscribe "profile:page:jump.#{@eventId}", @pageJump
    $(window).on "scroll.#{@eventId}", @pageScan
    $(document).on "turbolinks:before-cache.#{@eventId}", @saveStateToContainer

    $(@pages.current).sortable
      cursor: 'move'
      handle: '.js-profile-page-extra--sortable-handle'
      items: '.js-sortable--page'
      revert: 150
      scrollSpeed: 10
      update: @updateOrder

    $(@tabs.current).sortable
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

    pageChange()

    @modeScrollUrl = currentUrlRelative()

    if !@restoredState
      core.reactTurbolinks.runAfterPageLoad @eventId, =>
        # The scroll is a bit off on Firefox if not using timeout.
        Timeout.set 0, => @pageJump(null, @initialPage)


  componentWillUnmount: =>
    $.unsubscribe ".#{@eventId}"
    $(window).off ".#{@eventId}"
    $(document).off ".#{@eventId}"

    for sortable in [@pages, @tabs]
      $(sortable.current).sortable 'destroy'

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

    el UserProfileContainer,
      user: @state.user,
      el Header,
        user: @state.user
        stats: @state.user.statistics
        currentMode: @props.currentMode
        withEdit: @props.withEdit
        userAchievements: @props.userAchievements

      div
        className: 'hidden-xs page-extra-tabs page-extra-tabs--profile-page js-switchable-mode-page--scrollspy-offset'
        if profileOrder.length > 1
          div className: 'osu-page',
            div
              className: 'page-mode page-mode--profile-page-extra'
              ref: @tabs
              for m in profileOrder
                a
                  className: "page-mode__item #{'js-sortable--tab' if @isSortablePage m}"
                  key: m
                  'data-page-id': m
                  onClick: @tabClick
                  href: "##{m}"
                  el ExtraTab,
                    page: m
                    currentPage: @state.currentPage
                    currentMode: @props.currentMode

      div
        className: 'user-profile-pages'
        ref: @pages
        @extraPage name for name in profileOrder


  extraPage: (name) =>
    {extraClass, props, component} = @extraPageParams name
    topClassName = 'user-profile-pages__item js-switchable-mode-page--scrollspy js-switchable-mode-page--page'
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
        component: UserPage

      when 'recent_activity'
        props:
          pagination: @state.showMorePagination
          recentActivity: @state.recentActivity
          user: @state.user
        component: RecentActivity

      when 'kudosu'
        props:
          user: @state.user
          recentlyReceivedKudosu: @state.recentlyReceivedKudosu
          pagination: @state.showMorePagination
        component: Kudosu

      when 'top_ranks'
        props:
          user: @state.user
          scoresBest: @state.scoresBest
          scoresFirsts: @state.scoresFirsts
          currentMode: @props.currentMode
          pagination: @state.showMorePagination
        component: TopRanks

      when 'beatmaps'
        props:
          user: @state.user
          favouriteBeatmapsets: @state.favouriteBeatmapsets
          rankedBeatmapsets: @state.rankedBeatmapsets
          lovedBeatmapsets: @state.lovedBeatmapsets
          pendingBeatmapsets: @state.pendingBeatmapsets
          graveyardBeatmapsets: @state.graveyardBeatmapsets
          counts:
            favouriteBeatmapsets: @state.user.favourite_beatmapset_count
            rankedBeatmapsets: @state.user.ranked_beatmapset_count
            lovedBeatmapsets: @state.user.loved_beatmapset_count
            pendingBeatmapsets: @state.user.pending_beatmapset_count
            graveyardBeatmapsets: @state.user.graveyard_beatmapset_count
          pagination: @state.showMorePagination
        component: Beatmapsets

      when 'medals'
        props:
          achievements: @props.achievements
          userAchievements: @props.userAchievements
          currentMode: @props.currentMode
          user: @state.user
        component: Medals

      when 'historical'
        props:
          beatmapPlaycounts: @state.beatmapPlaycounts
          scoresRecent: @state.scoresRecent
          user: @state.user
          currentMode: @props.currentMode
          pagination: @state.showMorePagination
        component: Historical

      when 'account_standing'
        props:
          user: @state.user
        component: AccountStanding


  showMore: (e, {name, url, perPage = 50}) =>
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

      .catch (error) =>
        osu.ajaxError error

        paginationState = _.cloneDeep @state.showMorePagination
        paginationState[name].loading = false

        @setState
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
    return if @modeScrollUrl != currentUrlRelative()

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

    # See $(@tabs.current).sortable.
    return if @draggingTab

    @pageJump null, e.currentTarget.dataset.pageId


  updateOrder: (event) =>
    $elems = $(event.target)

    newOrder = $elems.sortable('toArray', attribute: 'data-page-id')

    showLoadingOverlay()

    $elems.sortable('cancel')

    @setState profileOrder: newOrder, =>
      $.ajax laroute.route('account.options'),
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

      .always hideLoadingOverlay


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
