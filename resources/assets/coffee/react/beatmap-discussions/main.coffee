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

    query = @queryFromLocation(props.initial.beatmapsetDiscussion.beatmap_discussions)
    mode = query.page
    currentFilter = query.filter
    if query.beatmapId?
      currentBeatmap = _.find props.initial.beatmapsetDiscussion.beatmapset.beatmaps, id: query.beatmapId

    @state =
      beatmapset: @props.initial.beatmapsetDiscussion.beatmapset
      beatmapsetDiscussion: @props.initial.beatmapsetDiscussion
      currentBeatmap: currentBeatmap
      currentUser: currentUser
      userPermissions: @props.initial.userPermissions
      mode: mode
      readPostIds: _.chain(props.initial.beatmapsetDiscussion.beatmap_discussions)
        .map (d) =>
          d.beatmap_discussion_posts?.map (r) =>
            r.id
        .flatten()
        .value()
      currentFilter: currentFilter


  componentDidMount: =>
    $.subscribe 'beatmap:select.beatmapDiscussions', @setCurrentBeatmapId
    $.subscribe 'playmode:set.beatmapDiscussions', @setCurrentPlaymode
    $.subscribe 'beatmapsetDiscussion:update.beatmapDiscussions', @setBeatmapsetDiscussion
    $.subscribe 'beatmapsetWatch:update.beatmapDiscussions', @setWatchStatus
    $.subscribe 'beatmapDiscussion:jump.beatmapDiscussions', @jumpTo
    $.subscribe 'beatmapDiscussion:setMode.beatmapDiscussions', @setMode
    $.subscribe 'beatmapDiscussionPost:markRead.beatmapDiscussions', @markPostRead
    $.subscribe 'beatmapDiscussion:filter.beatmapDiscussions', @setFilter
    $(document).on 'ajax:success.beatmapDiscussions', '.js-beatmapset-discussion-update', @ujsDiscussionUpdate
    $(document).on 'click.beatmapDiscussions', '.js-beatmap-discussion--jump', @jumpToClick

    @jumpByHash()
    @checkNewTimeout = Timeout.set @checkNewTimeoutDefault, @checkNew


  componentWillUpdate: =>
    @cache = {}


  componentDidUpdate: =>
    Turbolinks.controller.advanceHistory "#{@urlFromState()}#{document.location.hash}"


  componentWillUnmount: =>
    $.unsubscribe '.beatmapDiscussions'
    $(document).off '.beatmapDiscussions'

    Timeout.clear @checkNewTimeout
    @checkNewAjax?.abort()


  render: =>
    div className: 'osu-layout osu-layout--full',
      el BeatmapDiscussions.Header,
        beatmapset: @state.beatmapset
        beatmaps: @groupedBeatmaps()
        currentBeatmap: @currentBeatmap()
        currentDiscussions: @currentDiscussions()
        currentUser: @state.currentUser
        currentFilter: @state.currentFilter
        beatmapsetDiscussion: @state.beatmapsetDiscussion
        users: @users()
        mode: @state.mode

      el BeatmapDiscussions.ModeSwitcher,
        mode: @state.mode
        beatmapset: @state.beatmapset
        currentBeatmap: @currentBeatmap()
        currentDiscussions: @currentDiscussions()
        currentFilter: @state.currentFilter

      if @state.mode == 'events'
        div
          className: 'osu-layout__section osu-layout__section--extra'
          el BeatmapDiscussions.Events,
            events: @state.beatmapsetDiscussion.beatmapset_events
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
            mode: @state.mode

          el BeatmapDiscussions.Discussions,
            beatmapset: @state.beatmapset
            beatmapsetDiscussion: @state.beatmapsetDiscussion
            currentBeatmap: @currentBeatmap()
            currentDiscussions: @currentDiscussions()
            currentFilter: @state.currentFilter
            currentUser: @state.currentUser
            mode: @state.mode
            readPostIds: @state.readPostIds
            userPermissions: @state.userPermissions
            users: @users()


  beatmaps: =>
    return @cache.beatmaps if @cache.beatmaps?

    hasDiscussion = {}
    hasDiscussion[d.beatmap_id] = true for d in @state.beatmapsetDiscussion.beatmap_discussions

    @cache.beatmaps ?=
      _(@state.beatmapset.beatmaps)
      .filter (beatmap) ->
        !beatmap.deleted_at? || hasDiscussion[beatmap.id]
      .keyBy 'id'
      .value()


  checkNew: =>
    @nextTimeout ?= @checkNewTimeoutDefault

    Timeout.clear @checkNewTimeout

    params = format: 'json'

    if @state.beatmapsetDiscussion.updated_at?
      params.last_updated = moment(@state.beatmapsetDiscussion.updated_at).unix()

    if !_.isEmpty @state.beatmapsetDiscussion.beatmapset_events
      params.last_updated = _.max [params?.last_updated, moment(_.last(@state.beatmapsetDiscussion.beatmapset_events).created_at).unix()]

    @checkNewAjax = $.get laroute.route('beatmapsets.discussion', beatmapset: @state.beatmapset.id), params
    .done (data, _textStatus, xhr) =>
      if xhr.status == 304
        @nextTimeout *= 2
        return

      @nextTimeout = @checkNewTimeoutDefault

      @setBeatmapsetDiscussion null, beatmapsetDiscussion: data.beatmapsetDiscussion

    .always =>
      @nextTimeout = Math.min @nextTimeout, @checkNewTimeoutMax

      @checkNewTimeout = Timeout.set @nextTimeout, @checkNew


  currentBeatmap: =>
    @state.currentBeatmap ? BeatmapHelper.default(group: @groupedBeatmaps())


  currentDiscussions: =>
    if !@cache.currentDiscussions?

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


      for d in @state.beatmapsetDiscussion.beatmap_discussions
        # skipped discussion
        # - not privileged (deleted discussion)
        # - deleted beatmap
        continue if _.isEmpty(d)

        if !d.deleted_at && d.can_be_resolved && !d.resolved
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

    @cache.currentDiscussions


  discussions: =>
    @cache.discussions ?=
      _.keyBy @state.beatmapsetDiscussion.beatmap_discussions, 'id'


  groupedBeatmaps: (discussionSet) =>
    return @cache.groupedBeatmaps if @cache.groupedBeatmaps?

    @cache.groupedBeatmaps = BeatmapHelper.group _.values(@beatmaps())


  jumpByHash: =>
    target = BeatmapDiscussionHelper.urlParse(null, @state.beatmapsetDiscussion.beatmap_discussions)

    if target.discussionId?
      return $.publish 'beatmapDiscussion:jump', id: target.discussionId

    if target.mode == 'events'
      return @setMode null, mode: 'events'

    target.beatmapId ?= @currentBeatmap().id
    $.publish 'beatmap:select', id: target.beatmapId


  jumpTo: (_e, {id}) =>
    discussion = @discussions()[id]

    return if !discussion?

    mode =
      if discussion.beatmap_id?
        if discussion.timestamp? then 'timeline' else 'general'
      else
        'generalAll'

    filter =
      if @state.currentFilter == 'total' || @currentDiscussions().byFilter[@state.currentFilter][mode][id]?
        @state.currentFilter
      else
        'total'

    setCurrentBeatmapId = =>
      @setCurrentBeatmapId null, id: discussion.beatmap_id, callback: setMode
    setMode = =>
      @setMode null, mode: mode, callback: setFilter
    setFilter = =>
      @setFilter null, filter: filter, callback: jump
    jump = =>
      $.publish 'beatmapDiscussionEntry:highlight', id: discussion.id

      target = $(".js-beatmap-discussion-jump[data-id='#{id}']")
      offset = 0
      for header in [modeSwitcher, newDiscussion]
        continue if !header[0]?
        offset += header[0].getBoundingClientRect().height * -1

      $(window).stop().scrollTo target, 500,
        offset: offset

    setCurrentBeatmapId()


  jumpToClick: (e) =>
    url = e.currentTarget.getAttribute('href')
    id = BeatmapDiscussionHelper.urlParse(url, @state.beatmapsetDiscussion.beatmap_discussions).discussionId

    return if !@discussions()[id]?

    Turbolinks.controller.advanceHistory url
    e.preventDefault()
    @jumpTo null, {id}


  markPostRead: (_e, {id}) =>
    return if _.includes @state.readPostIds, id

    @setState readPostIds: @state.readPostIds.concat(id)


  queryFromLocation: (discussions = @state.beatmapsetDiscussion.beatmap_discussions) =>
    BeatmapDiscussionHelper.urlParse(null, discussions)


  setBeatmapsetDiscussion: (_e, {beatmapsetDiscussion, callback}) =>
    @setState
      beatmapsetDiscussion: beatmapsetDiscussion
      beatmapset: beatmapsetDiscussion.beatmapset
      callback


  setCurrentBeatmapId: (_e, {id, callback}) =>
    return callback?() if !id?
    return callback?() if id == @currentBeatmap().id

    beatmap = @beatmaps()[id]

    return callback?() if !beatmap?

    @setState currentBeatmap: beatmap, callback


  setCurrentPlaymode: (_e, {mode}) =>
    beatmap = BeatmapHelper.default items: @groupedBeatmaps()[mode]
    @setCurrentBeatmapId null, id: beatmap?.id


  setFilter: (_e, {filter, callback}) =>
    return callback?() if filter == @state.currentFilter && @state.mode != 'events'

    newState = currentFilter: filter
    # restore last mode on clicking filter when viewing events
    newState.mode = @lastMode ? 'timeline' if @state.mode == 'events'

    @setState newState, callback


  setMode: (_e, {mode, callback}) =>
    return callback?() if mode == @state.mode

    newState = {mode}

    # switching to events:
    # - record last filter, to be restored when setMode is called
    # - record last mode, to be restored when setFilter is called
    # - set filter to total
    if mode == 'events'
      @lastMode = @state.mode
      @lastFilter = @state.currentFilter
      newState.currentFilter = 'total'
    # switching from events:
    # - restore whatever last filter set or default to total
    else if @state.mode == 'events'
      newState.currentFilter = @lastFilter ? 'total'

    @setState newState, callback


  setWatchStatus: (_e, {watching}) =>
    beatmapset = _.assign {}, @state.beatmapset, is_watched: watching
    @setState {beatmapset}


  urlFromState: =>
    beatmapsetId = @state.beatmapset.id
    beatmapId = @currentBeatmap().id
    page = @state.mode
    filter = @state.currentFilter

    BeatmapDiscussionHelper.url({beatmapsetId, beatmapId, page, filter})


  users: =>
    if !@cache.users?
      @cache.users = _.keyBy @state.beatmapsetDiscussion.users, 'id'
      @cache.users[null] = @cache.users[undefined] =
        username: osu.trans 'users.deleted'

    @cache.users

  ujsDiscussionUpdate: (_e, data) =>
    # to allow ajax:complete to be run
    Timeout.set 0, =>
      @setBeatmapsetDiscussion null, beatmapsetDiscussion: data
