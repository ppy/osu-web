# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import { Discussions } from './discussions'
import { Events } from './events'
import { Header } from './header'
import { ModeSwitcher } from './mode-switcher'
import { NewDiscussion } from './new-discussion'
import { BackToTop } from 'back-to-top'
import { deletedUser } from 'models/user'
import * as React from 'react'
import { DiscussionsContext } from 'beatmap-discussions/discussions-context'
import { BeatmapsContext } from 'beatmap-discussions/beatmaps-context'
import { ReviewEditorConfigContext } from 'beatmap-discussions/review-editor-config-context'
import { div } from 'react-dom-factories'
import NewReview from 'beatmap-discussions/new-review'
import * as BeatmapHelper from 'utils/beatmap-helper'

el = React.createElement

export class Main extends React.PureComponent
  constructor: (props) ->
    super props

    @modeSwitcherRef = React.createRef()
    @newDiscussionRef = React.createRef()

    @checkNewTimeoutDefault = 10000
    @checkNewTimeoutMax = 60000
    @cache = {}
    @timeouts = {}
    @xhr = {}
    @state = JSON.parse(props.container.dataset.beatmapsetDiscussionState ? null)
    @restoredState = @state?
    # FIXME: update url handler to recognize this instead
    @focusNewDiscussion = document.location.hash == '#new'

    if @restoredState
      @state.readPostIds = new Set(@state.readPostIdsArray)
    else
      beatmapset = props.initial.beatmapset
      reviewsConfig = props.initial.reviews_config
      showDeleted = true
      readPostIds = new Set

      for discussion in beatmapset.discussions
        for post in discussion?.posts ? []
          readPostIds.add(post.id) if post?

      @state = {beatmapset, currentUser, readPostIds, reviewsConfig, showDeleted}

    # Current url takes priority over saved state.
    query = @queryFromLocation(@state.beatmapset.discussions)
    @state.currentMode = query.mode
    @state.currentFilter = query.filter
    @state.currentBeatmapId = query.beatmapId if query.beatmapId?
    @state.selectedUserId = query.user


  componentDidMount: =>
    $.subscribe 'playmode:set.beatmapDiscussions', @setCurrentPlaymode

    $.subscribe 'beatmapsetDiscussions:update.beatmapDiscussions', @update
    $.subscribe 'beatmapDiscussion:jump.beatmapDiscussions', @jumpTo
    $.subscribe 'beatmapDiscussionPost:markRead.beatmapDiscussions', @markPostRead
    $.subscribe 'beatmapDiscussionPost:toggleShowDeleted.beatmapDiscussions', @toggleShowDeleted

    $(document).on 'ajax:success.beatmapDiscussions', '.js-beatmapset-discussion-update', @ujsDiscussionUpdate
    $(document).on 'click.beatmapDiscussions', '.js-beatmap-discussion--jump', @jumpToClick
    $(document).on 'turbolinks:before-cache.beatmapDiscussions', @saveStateToContainer

    @jumpToDiscussionByHash() if !@restoredState
    @timeouts.checkNew = Timeout.set @checkNewTimeoutDefault, @checkNew


  componentWillUpdate: =>
    @cache = {}
    @focusNewDiscussion = false


  componentDidUpdate: (_prevProps, prevState) =>
    return if prevState.currentBeatmapId == @state.currentBeatmapId &&
      prevState.currentFilter == @state.currentFilter &&
      prevState.currentMode == @state.currentMode &&
      prevState.selectedUserId == @state.selectedUserId &&
      prevState.showDeleted == @state.showDeleted

    Turbolinks.controller.advanceHistory @urlFromState()


  componentWillUnmount: =>
    $.unsubscribe '.beatmapDiscussions'
    $(document).off '.beatmapDiscussions'

    Timeout.clear(timeout) for _name, timeout of @timeouts
    xhr?.abort() for _name, xhr of @xhr


  render: =>
    div className: 'osu-layout osu-layout--full',
      el Header,
        beatmaps: @groupedBeatmaps()
        beatmapset: @state.beatmapset
        currentBeatmap: @currentBeatmap()
        currentDiscussions: @currentDiscussions()
        currentFilter: @state.currentFilter
        currentUser: @state.currentUser
        discussions: @discussions()
        discussionStarters: @discussionStarters()
        events: @state.beatmapset.events
        mode: @state.currentMode
        selectedUserId: @state.selectedUserId
        users: @users()

      el ModeSwitcher,
        innerRef: @modeSwitcherRef
        mode: @state.currentMode
        beatmapset: @state.beatmapset
        currentBeatmap: @currentBeatmap()
        currentDiscussions: @currentDiscussions()
        currentFilter: @state.currentFilter

      if @state.currentMode == 'events'
        div
          className: 'osu-layout__section osu-layout__section--extra'
          el Events,
            events: @state.beatmapset.events
            users: @users()
            discussions: @discussions()

      else
        div
          className: 'osu-layout__section osu-layout__section--extra'
          el DiscussionsContext.Provider,
            value: @discussions()
            el BeatmapsContext.Provider,
              value: @beatmaps()
              el ReviewEditorConfigContext.Provider,
                value: @state.reviewsConfig

                if @state.currentMode == 'reviews'
                  el NewReview,
                    beatmapset: @state.beatmapset
                    beatmaps: @beatmaps()
                    currentBeatmap: @currentBeatmap()
                    currentDiscussions: @currentDiscussions()
                    currentUser: @state.currentUser
                    pinned: @state.pinnedNewDiscussion
                    setPinned: @setPinnedNewDiscussion
                    stickTo: @modeSwitcherRef
                else
                  el NewDiscussion,
                    beatmapset: @state.beatmapset
                    currentUser: @state.currentUser
                    currentBeatmap: @currentBeatmap()
                    currentDiscussions: @currentDiscussions()
                    innerRef: @newDiscussionRef
                    mode: @state.currentMode
                    pinned: @state.pinnedNewDiscussion
                    setPinned: @setPinnedNewDiscussion
                    stickTo: @modeSwitcherRef
                    autoFocus: @focusNewDiscussion

                el Discussions,
                  beatmapset: @state.beatmapset
                  currentBeatmap: @currentBeatmap()
                  currentDiscussions: @currentDiscussions()
                  currentFilter: @state.currentFilter
                  currentUser: @state.currentUser
                  mode: @state.currentMode
                  readPostIds: @state.readPostIds
                  showDeleted: @state.showDeleted
                  users: @users()

      el BackToTop


  beatmaps: =>
    return @cache.beatmaps if @cache.beatmaps?

    hasDiscussion = {}
    for discussion in @state.beatmapset.discussions
      hasDiscussion[discussion.beatmap_id] = true if discussion?

    @cache.beatmaps ?=
      _(@state.beatmapset.beatmaps)
      .filter (beatmap) ->
        !_.isEmpty(beatmap) && (!beatmap.deleted_at? || hasDiscussion[beatmap.id]?)
      .keyBy 'id'
      .value()


  checkNew: =>
    @nextTimeout ?= @checkNewTimeoutDefault

    Timeout.clear @timeouts.checkNew
    @xhr.checkNew?.abort()

    @xhr.checkNew = $.get laroute.route('beatmapsets.discussion', beatmapset: @state.beatmapset.id),
      format: 'json'
      last_updated: @lastUpdate()?.unix()
    .done (data, _textStatus, xhr) =>
      if xhr.status == 304
        @nextTimeout *= 2
        return

      @nextTimeout = @checkNewTimeoutDefault

      @update null, beatmapset: data.beatmapset

    .always =>
      @nextTimeout = Math.min @nextTimeout, @checkNewTimeoutMax

      @timeouts.checkNew = Timeout.set @nextTimeout, @checkNew


  currentBeatmap: =>
    @beatmaps()[@state.currentBeatmapId] ? BeatmapHelper.findDefault(group: @groupedBeatmaps())


  currentDiscussions: =>
    return @cache.currentDiscussions if @cache.currentDiscussions?

    countsByBeatmap = {}
    countsByPlaymode = {}
    totalHype = 0
    unresolvedIssues = 0
    byMode =
      timeline: []
      general: []
      generalAll: []
      reviews: []
    byFilter =
      deleted: {}
      hype: {}
      mapperNotes: {}
      mine: {}
      pending: {}
      praises: {}
      resolved: {}
      total: {}
    timelineAllUsers = []

    for own mode, _items of byMode
      for own _filter, modes of byFilter
        modes[mode] = {}

    for own _id, d of @discussions()
      if !d.deleted_at?
        totalHype++ if d.message_type == 'hype'

        if d.can_be_resolved && !d.resolved
          beatmap = @beatmaps()[d.beatmap_id]

          if !d.beatmap_id? || (beatmap? && !beatmap.deleted_at?)
            unresolvedIssues++

          if beatmap?
            countsByBeatmap[beatmap.id] ?= 0
            countsByBeatmap[beatmap.id]++

            if !beatmap.deleted_at?
              countsByPlaymode[beatmap.mode] ?= 0
              countsByPlaymode[beatmap.mode]++

      if d.message_type == 'review'
        mode = 'reviews'
      else
        if d.beatmap_id?
          if d.beatmap_id == @currentBeatmap().id
            if d.timestamp?
              mode = 'timeline'
              timelineAllUsers.push d
            else
              mode = 'general'
          else
            mode = null
        else
          mode = 'generalAll'

      # belongs to different beatmap, excluded
      continue unless mode?

      # skip if filtering users
      continue if @state.selectedUserId? && d.user_id != @state.selectedUserId

      filters = total: true

      if d.deleted_at?
        filters.deleted = true
      else if d.message_type == 'hype'
        filters.hype = true
        filters.praises = true
      else if d.message_type == 'praise'
        filters.praises = true
      else if d.can_be_resolved
        if d.resolved
          filters.resolved = true
        else
          filters.pending = true

      if d.user_id == @state.currentUser.id
        filters.mine = true

      if d.message_type == 'mapper_note'
        filters.mapperNotes = true

      # the value should always be true
      for own filter, _isSet of filters
        byFilter[filter][mode][d.id] = d

      if filters.pending && d.parent_id?
        parentDiscussion = @discussions()[d.parent_id]

        if parentDiscussion? && parentDiscussion.message_type == 'review'
          byFilter.pending.reviews[parentDiscussion.id] = parentDiscussion

      byMode[mode].push d

    timeline = byMode.timeline
    general = byMode.general
    generalAll = byMode.generalAll
    reviews = byMode.reviews

    @cache.currentDiscussions = {general, generalAll, timeline, reviews, timelineAllUsers, byFilter, countsByBeatmap, countsByPlaymode, totalHype, unresolvedIssues}


  discussions: =>
    # skipped discussions
    # - not privileged (deleted discussion)
    # - deleted beatmap
    @cache.discussions ?= _ @state.beatmapset.discussions
                            .filter (d) -> !_.isEmpty(d)
                            .keyBy 'id'
                            .value()


  discussionStarters: =>
    _ @discussions()
      .map 'user_id'
      .uniq()
      .map (user_id) => @users()[user_id]
      .orderBy (user) -> user.username.toLocaleLowerCase()
      .value()


  groupedBeatmaps: (discussionSet) =>
    @cache.groupedBeatmaps ?= BeatmapHelper.group _.values(@beatmaps())


  jumpToDiscussionByHash: =>
    target = BeatmapDiscussionHelper.urlParse(null, @state.beatmapset.discussions)

    @jumpTo(null, id: target.discussionId) if target.discussionId?


  jumpTo: (_e, {id}) =>
    discussion = @discussions()[id]

    return if !discussion?

    newState = BeatmapDiscussionHelper.stateFromDiscussion(discussion)

    newState.filter =
      if @currentDiscussions().byFilter[@state.currentFilter][newState.mode][id]?
        @state.currentFilter
      else
        BeatmapDiscussionHelper.DEFAULT_FILTER

    if @state.selectedUserId? && @state.selectedUserId != discussion.user_id
      newState.selectedUserId = null

    newState.callback = =>
      $.publish 'beatmapset-discussions:highlight', discussionId: discussion.id

      target = $(".js-beatmap-discussion-jump[data-id='#{id}']")

      return if target.length == 0

      offsetTop = target.offset().top - @modeSwitcherRef.current.getBoundingClientRect().height
      offsetTop -= @newDiscussionRef.current.getBoundingClientRect().height if @state.pinnedNewDiscussion

      $(window).stop().scrollTo window.stickyHeader.scrollOffset(offsetTop), 500

    @update null, newState


  jumpToClick: (e) =>
    url = e.currentTarget.getAttribute('href')
    id = BeatmapDiscussionHelper.urlParse(url, @state.beatmapset.discussions).discussionId

    return if !id?

    e.preventDefault()
    @jumpTo null, {id}


  lastUpdate: =>
    lastUpdate = _.max [
      @state.beatmapset.last_updated
      _.maxBy(@state.beatmapset.discussions, 'updated_at')?.updated_at
      _.maxBy(@state.beatmapset.events, 'created_at')?.created_at
    ]

    moment(lastUpdate) if lastUpdate?


  markPostRead: (_e, {id}) =>
    return if @state.readPostIds.has(id)

    newSet = new Set(@state.readPostIds)
    if Array.isArray(id)
      newSet.add(i) for i in id
    else
      newSet.add(id)

    @setState readPostIds: newSet


  queryFromLocation: (discussions = @state.beatmapsetDiscussion.beatmap_discussions) =>
    BeatmapDiscussionHelper.urlParse(null, discussions)


  saveStateToContainer: =>
    # This is only so it can be stored with JSON.stringify.
    @state.readPostIdsArray = Array.from(@state.readPostIds)
    @props.container.dataset.beatmapsetDiscussionState = JSON.stringify(@state)


  setCurrentPlaymode: (e, {mode}) =>
    @update e, playmode: mode


  setPinnedNewDiscussion: (pinned) =>
    @setState pinnedNewDiscussion: pinned


  toggleShowDeleted: =>
    @setState showDeleted: !@state.showDeleted


  update: (_e, options) =>
    {
      callback
      mode
      modeIf
      beatmapId
      playmode
      beatmapset
      watching
      filter
      selectedUserId
    } = options
    newState = {}

    if beatmapset?
      newState.beatmapset = beatmapset

    if watching?
      newState.beatmapset ?= _.assign {}, @state.beatmapset
      newState.beatmapset.current_user_attributes.is_watching = watching

    if playmode?
      beatmap = BeatmapHelper.findDefault items: @groupedBeatmaps()[playmode]
      beatmapId = beatmap?.id

    if beatmapId? && beatmapId != @currentBeatmap().id
      newState.currentBeatmapId = beatmapId

    if filter?
      if @state.currentMode == 'events'
        newState.currentMode = @lastMode ? BeatmapDiscussionHelper.DEFAULT_MODE

      if filter != @state.currentFilter
        newState.currentFilter = filter

    if mode? && mode != @state.currentMode
      if !modeIf? || modeIf == @state.currentMode
        newState.currentMode = mode

      # switching to events:
      # - record last filter, to be restored when setMode is called
      # - record last mode, to be restored when setFilter is called
      # - set filter to total
      if mode == 'events'
        @lastMode = @state.currentMode
        @lastFilter = @state.currentFilter
        newState.currentFilter = 'total'
      # switching from events:
      # - restore whatever last filter set or default to total
      else if @state.currentMode == 'events'
        newState.currentFilter = @lastFilter ? 'total'

    newState.selectedUserId = selectedUserId if selectedUserId != undefined # need to setState if null

    @setState newState, callback


  urlFromState: =>
    BeatmapDiscussionHelper.url
      beatmap: @currentBeatmap()
      mode: @state.currentMode
      filter: @state.currentFilter
      user: @state.selectedUserId


  users: =>
    if !@cache.users?
      @cache.users = _.keyBy @state.beatmapset.related_users, 'id'
      @cache.users[null] = @cache.users[undefined] = deletedUser.toJson()

    @cache.users


  ujsDiscussionUpdate: (_e, data) =>
    # to allow ajax:complete to be run
    Timeout.set 0, => @update(null, beatmapset: data)
