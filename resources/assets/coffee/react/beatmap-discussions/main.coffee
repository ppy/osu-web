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

modeSwitcher = document.getElementsByClassName('js-mode-switcher')
newDiscussion = document.getElementsByClassName('js-new-discussion')

class BeatmapDiscussions.Main extends React.PureComponent
  constructor: (props) ->
    super props

    @checkNewTimeoutDefault = 10000
    @checkNewTimeoutMax = 60000
    @cache = {}
    @timeouts = {}
    @xhr = {}
    @state = JSON.parse(props.container.dataset.beatmapsetDiscussionState ? null)

    if !@state?
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


  componentDidMount: =>
    $.subscribe 'playmode:set.beatmapDiscussions', @setCurrentPlaymode

    $.subscribe 'beatmapsetDiscussions:update.beatmapDiscussions', @update
    $.subscribe 'beatmapDiscussion:jump.beatmapDiscussions', @jumpTo
    $.subscribe 'beatmapDiscussionPost:markRead.beatmapDiscussions', @markPostRead
    $(document).on 'ajax:success.beatmapDiscussions', '.js-beatmapset-discussion-update', @ujsDiscussionUpdate
    $(document).on 'click.beatmapDiscussions', '.js-beatmap-discussion--jump', @jumpToClick
    $(document).on 'turbolinks:before-cache', @saveStateToContainer

    @jumpToDiscussionByHash()
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
        events: @state.beatmapset.events
        mode: @state.currentMode
        users: @users()

      el BeatmapDiscussions.ModeSwitcher,
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
            mode: @state.currentMode

          el BeatmapDiscussions.Discussions,
            beatmapset: @state.beatmapset
            currentBeatmap: @currentBeatmap()
            currentDiscussions: @currentDiscussions()
            currentFilter: @state.currentFilter
            currentUser: @state.currentUser
            mode: @state.currentMode
            readPostIds: @state.readPostIds
            users: @users()


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

    for own mode, _items of byMode
      for own _filter, modes of byFilter
        modes[mode] = {}


    for d in @state.beatmapset.discussions
      # skipped discussion
      # - not privileged (deleted discussion)
      # - deleted beatmap
      continue if _.isEmpty(d)

      if !d.deleted_at? && d.can_be_resolved && !d.resolved
        if !d.beatmap_id? || !@beatmaps()[d.beatmap_id]?.deleted_at?
          unresolvedIssues++

        if d.beatmap_id?
          countsByBeatmap[d.beatmap_id] ?= 0
          countsByBeatmap[d.beatmap_id]++

          mode = @beatmaps()[d.beatmap_id]?.mode
          countsByPlaymode[mode] ?= 0
          countsByPlaymode[mode]++

      mode =
        if d.beatmap_id?
          if d.beatmap_id == @currentBeatmap().id
            if d.timestamp?
              'timeline'
            else
              'general'
        else
          'generalAll'

      # belongs to different beatmap, excluded
      continue unless mode?

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

    @cache.currentDiscussions = {general, generalAll, timeline, byFilter, countsByBeatmap, countsByPlaymode, unresolvedIssues}


  discussions: =>
    @cache.discussions ?= _.keyBy @state.beatmapset.discussions, 'id'


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

    newState.callback = =>
      $.publish 'beatmapDiscussionEntry:highlight', id: discussion.id

      target = $(".js-beatmap-discussion-jump[data-id='#{id}']")
      offset = 0
      for header in [modeSwitcher, newDiscussion] when header[0]?
        offset += header[0].getBoundingClientRect().height * -1

      $(window).stop().scrollTo target, 500, offset: offset

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


  update: (_e, {mode, callback, beatmapId, playmode, beatmapset, watching, filter}) =>
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
        mode = @lastMode ? BeatmapDiscussionHelper.DEFAULT_MODE

      if filter != @state.currentFilter
        newState.currentFilter = filter

    if mode? && mode != @state.currentMode
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

    @setState newState, callback


  urlFromState: =>
    BeatmapDiscussionHelper.url
      beatmap: @currentBeatmap()
      mode: @state.currentMode
      filter: @state.currentFilter


  users: =>
    if !@cache.users?
      @cache.users = _.keyBy @state.beatmapset.related_users, 'id'
      @cache.users[null] = @cache.users[undefined] =
        username: osu.trans 'users.deleted'

    @cache.users


  ujsDiscussionUpdate: (_e, data) =>
    # to allow ajax:complete to be run
    Timeout.set 0, => @update(null, beatmapset: data)
