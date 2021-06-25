# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import { Events } from './events'
import { ExtraTab } from '../profile-page/extra-tab'
import { Discussions } from './discussions'
import { Header } from './header'
import { Kudosu } from '../profile-page/kudosu'
import { Votes } from './votes'
import { BeatmapsContext } from 'beatmap-discussions/beatmaps-context'
import { DiscussionsContext } from 'beatmap-discussions/discussions-context'
import { ReviewEditorConfigContext } from 'beatmap-discussions/review-editor-config-context'
import { BlockButton } from 'block-button'
import { deletedUser } from 'models/user'
import { NotificationBanner } from 'notification-banner'
import { Posts } from "./posts"
import * as React from 'react'
import { a, button, div, i, span } from 'react-dom-factories'
import UserProfileContainer from 'user-profile-container'
import { pageChange } from 'utils/page-change'

el = React.createElement

pages = document.getElementsByClassName("js-switchable-mode-page--scrollspy")
pagesOffset = document.getElementsByClassName("js-switchable-mode-page--scrollspy-offset")

currentLocation = ->
  "#{document.location.pathname}#{document.location.search}"


export class Main extends React.PureComponent
  constructor: (props) ->
    super props

    @eventId = "users-modding-history-index-#{osu.uuid()}"
    @cache = {}
    @tabs = React.createRef()
    @pages = React.createRef()
    @state = JSON.parse(props.container.dataset.profilePageState ? null)
    @restoredState = @state?

    if !@restoredState
      page = location.hash.slice(1)
      @initialPage = page if page?

      @state =
        beatmaps: props.beatmaps
        discussions: props.discussions
        events: props.events
        user: props.user
        users: props.users
        posts: props.posts
        votes: props.votes
        profileOrder: ['events', 'discussions', 'posts', 'votes', 'kudosu']
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
    $.subscribe "profile:showMore.#{@eventId}", @showMore
    $.subscribe "profile:page:jump.#{@eventId}", @pageJump
    $.subscribe "beatmapsetDiscussions:update.#{@eventId}", @discussionUpdate
    $(document).on "ajax:success.#{@eventId}", '.js-beatmapset-discussion-update', @ujsDiscussionUpdate
    $(window).on "scroll.#{@eventId}", @pageScan

    pageChange()

    @modeScrollUrl = currentLocation()

    if !@restoredState
      Timeout.set 0, => @pageJump null, @initialPage


  componentWillUnmount: =>
    $.unsubscribe ".#{@eventId}"
    $(window).off ".#{@eventId}"

    $(window).stop()
    Timeout.clear @modeScrollTimeout


  discussionUpdate: (_e, options) =>
    {beatmapset} = options
    return unless beatmapset?

    discussions = @state.discussions
    posts = @state.posts
    users = @state.users

    discussionIds = _.map discussions, 'id'
    postIds = _.map posts, 'id'
    userIds = _.map users, 'id'

    # Due to the entire hierarchy of discussions being sent back when a post is updated (instead of just the modified post),
    #   we need to iterate over each discussion and their posts to extract the updates we want.
    _.each beatmapset.discussions, (newDiscussion) ->
      if discussionIds.includes(newDiscussion.id)
        discussion = _.find discussions, id: newDiscussion.id
        discussions = _.reject discussions, id: newDiscussion.id
        newDiscussion = _.merge(discussion, newDiscussion)
      else
        # if this is a new discussion, it won't have beatmapset included ('cuz the parent is the beatmapset)
        newDiscussion.beatmapset = beatmapset

      newDiscussion.starting_post = newDiscussion.posts[0]
      discussions.push(newDiscussion)

      _.each newDiscussion.posts, (newPost) ->
        if postIds.includes(newPost.id)
          post = _.find posts, id: newPost.id
          posts = _.reject posts, id: newPost.id
          posts.push(_.merge(post, newPost))

    _.each beatmapset.related_users, (newUser) ->
      if userIds.includes(newUser.id)
        users = _.reject users, id: newUser.id

      users.push(newUser)

    @cache.users = @cache.discussions = @cache.userDiscussions = @cache.beatmaps = null
    @setState
      discussions: _.reverse(_.sortBy(discussions, (d) -> Date.parse(d.starting_post.created_at)))
      posts: _.reverse(_.sortBy(posts, (p) -> Date.parse(p.created_at)))
      users: users


  discussions: =>
    # skipped discussions
    # - not privileged (deleted discussion)
    # - deleted beatmap
    @cache.discussions ?= _ @state.discussions
                            .filter (d) -> !_.isEmpty(d)
                            .keyBy 'id'
                            .value()


  beatmaps: =>
    @cache.beatmaps ?= _.keyBy(this.state.beatmaps, 'id')


  render: =>
    profileOrder = @state.profileOrder

    el ReviewEditorConfigContext.Provider, value: @props.reviewsConfig,
      el DiscussionsContext.Provider, value: @discussions(),
        el BeatmapsContext.Provider, value: @beatmaps(),
          el UserProfileContainer,
            user: @state.user,
            el Header,
              user: @state.user
              stats: @state.user.statistics
              userAchievements: @props.userAchievements

            div
              className: 'hidden-xs page-extra-tabs page-extra-tabs--profile-page js-switchable-mode-page--scrollspy-offset'
              div className: 'osu-page',
                div
                  className: 'page-mode page-mode--profile-page-extra'
                  ref: @tabs
                  for m in profileOrder
                    a
                      className: 'page-mode__item'
                      key: m
                      'data-page-id': m
                      onClick: @tabClick
                      href: "##{m}"
                      el ExtraTab,
                        page: m
                        currentPage: @state.currentPage
                        currentMode: @state.currentMode

            div
              className: 'user-profile-pages'
              ref: @pages
              @extraPage name for name in profileOrder


  extraPage: (name) =>
    {extraClass, props, component} = @extraPageParams name
    classes = 'user-profile-pages__item js-switchable-mode-page--scrollspy js-switchable-mode-page--page'
    classes += " #{extraClass}" if extraClass?
    props.name = name

    @extraPages ?= {}

    div
      key: name
      'data-page-id': name
      className: classes
      ref: (el) => @extraPages[name] = el
      el component, props


  extraPageParams: (name) =>
    switch name
      when 'discussions'
        props:
          discussions: @userDiscussions()
          user: @state.user
          users: @users()
        component: Discussions

      when 'events'
        props:
          events: @state.events
          user: @state.user
          users: @users()
        component: Events

      when 'kudosu'
        props:
          user: @state.user
          recentlyReceivedKudosu: @state.recentlyReceivedKudosu
          pagination: @state.showMorePagination
        component: Kudosu

      when 'posts'
        props:
          posts: @state.posts
          user: @state.user
          users: @users()
        component: Posts

      when 'votes'
        props:
          votes: @state.votes
          user: @state.user
          users: @users()
        component: Votes


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


  setCurrentPage: (_e, page, extraCallback) =>
    callback = =>
      extraCallback?()
      @setHash?()

    if @state.currentPage == page
      return callback()

    @setState currentPage: page, callback


  tabClick: (e) =>
    e.preventDefault()

    @pageJump null, e.currentTarget.dataset.pageId


  userUpdate: (_e, user) =>
    return @forceUpdate() if user?.id != @state.user.id

    # this component needs full user object but sometimes this event only sends part of it
    @setState user: _.assign({}, @state.user, user)


  users: =>
    if !@cache.users?
      @cache.users = _.keyBy @state.users, 'id'
      @cache.users[null] = @cache.users[undefined] = deletedUser.toJson()

    @cache.users

  userDiscussions: =>
    if !@cache.userDiscussions
      @cache.userDiscussions = _.filter @state.discussions, (d) => d.user_id == @state.user.id

    @cache.userDiscussions


  ujsDiscussionUpdate: (_e, data) =>
    # to allow ajax:complete to be run
    Timeout.set 0, => @discussionUpdate(null, beatmapset: data)
