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

{a, div, h1, p} = ReactDOMFactories
el = React.createElement

class BeatmapDiscussions.Main extends React.PureComponent
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

    if !@restoredState
      beatmapset = props.initial.beatmapset

      readPostIds = []

      for discussion in beatmapset.discussions
        for post in discussion.posts ? []
          readPostIds.push post.id

      @state = {beatmapset, currentUser, readPostIds}

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

    $(document).on 'ajax:success.beatmapDiscussions', '.js-beatmapset-discussion-update', @ujsDiscussionUpdate
    $(document).on 'click.beatmapDiscussions', '.js-beatmap-discussion--jump', @jumpToClick
    $(document).on 'turbolinks:before-cache.beatmapDiscussions', @saveStateToContainer

    @jumpToDiscussionByHash() if !@restoredState
    @timeouts.checkNew = Timeout.set @checkNewTimeoutDefault, @checkNew


  componentWillUpdate: =>
    @cache = {}


  componentDidUpdate: =>
    Turbolinks.controller.advanceHistory @urlFromState()


  componentWillUnmount: =>
    $.unsubscribe '.beatmapDiscussions'
    $(document).off '.beatmapDiscussions'

    Timeout.clear(timeout) for _name, timeout of @timeouts
    xhr?.abort() for _name, xhr of @xhr


  render: =>
    div className: 'osu-layout osu-layout--full',
      el BeatmapDiscussions.Header,
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

      el BeatmapDiscussions.ModeSwitcher,
        innerRef: @modeSwitcherRef
        mode: @state.currentMode
        beatmapset: @state.beatmapset
        currentBeatmap: @currentBeatmap()
        currentDiscussions: @currentDiscussions()
        currentFilter: @state.currentFilter

      if @state.currentMode == 'events'
        div
          className: 'osu-layout__section osu-layout__section--extra'
          el BeatmapDiscussions.Events,
            events: @state.beatmapset.events
            users: @users()
            discussions: @discussions()

      else
        div
          className: 'osu-layout__section osu-layout__section--extra'
          el BeatmapDiscussions.NewDiscussion,
            beatmapset: @state.beatmapset
            currentUser: @state.currentUser
            currentBeatmap: @currentBeatmap()
            currentDiscussions: @currentDiscussions()
            innerRef: @newDiscussionRef
            mode: @state.currentMode
            pinned: @state.pinnedNewDiscussion
            setPinned: @setPinnedNewDiscussion
            stickTo: @modeSwitcherRef

          el BeatmapDiscussions.Discussions,
            beatmapset: @state.beatmapset
            currentBeatmap: @currentBeatmap()
            currentDiscussions: @currentDiscussions()
            currentFilter: @state.currentFilter
            currentUser: @state.currentUser
            mode: @state.currentMode
            readPostIds: @state.readPostIds
            users: @users()

      el window._exported.BackToTop


  beatmaps: =>
    return @cache.beatmaps if @cache.beatmaps?

    hasDiscussion = {}
    hasDiscussion[d.beatmap_id] = true for d in @state.beatmapset.discussions

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
    @beatmaps()[@state.currentBeatmapId] ? BeatmapHelper.default(group: @groupedBeatmaps())


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

      filters = ['total']

      if d.deleted_at?
        filters.push 'deleted'
      else if d.message_type == 'hype'
        filters.push 'hype'
        filters.push 'praises'
      else if d.message_type == 'praise'
        filters.push 'praises'
      else if d.can_be_resolved
        if d.resolved
          filters.push 'resolved'
        else
          filters.push 'pending'

      if d.user_id == @state.currentUser.id
        filters.push 'mine'

      if d.message_type == 'mapper_note'
        filters.push 'mapperNotes'

      for filter in filters
        byFilter[filter][mode][d.id] = d

      byMode[mode].push d

    timeline = byMode.timeline
    general = byMode.general
    generalAll = byMode.generalAll

    @cache.currentDiscussions = {general, generalAll, timeline, timelineAllUsers, byFilter, countsByBeatmap, countsByPlaymode, totalHype, unresolvedIssues}


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
      $.publish 'beatmapDiscussionEntry:highlight', id: discussion.id

      target = $(".js-beatmap-discussion-jump[data-id='#{id}']")
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
    return if _.includes @state.readPostIds, id

    @setState readPostIds: @state.readPostIds.concat(id)


  queryFromLocation: (discussions = @state.beatmapsetDiscussion.beatmap_discussions) =>
    BeatmapDiscussionHelper.urlParse(null, discussions)


  saveStateToContainer: =>
    @props.container.dataset.beatmapsetDiscussionState = JSON.stringify(@state)


  setCurrentPlaymode: (e, {mode}) =>
    @update e, playmode: mode


  setPinnedNewDiscussion: (pinned) =>
    @setState pinnedNewDiscussion: pinned


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
      beatmap = BeatmapHelper.default items: @groupedBeatmaps()[playmode]
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
      @cache.users[null] = @cache.users[undefined] =
        username: osu.trans 'users.deleted'

    @cache.users


  ujsDiscussionUpdate: (_e, data) =>
    # to allow ajax:complete to be run
    Timeout.set 0, => @update(null, beatmapset: data)
