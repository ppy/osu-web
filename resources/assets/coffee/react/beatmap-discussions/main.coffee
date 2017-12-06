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

    beatmaps = BeatmapHelper.group props.initial.beatmapset.beatmaps

    @state =
      beatmapset: @props.initial.beatmapset
      beatmaps: beatmaps
      beatmapsetDiscussion: @props.initial.beatmapsetDiscussion
      currentBeatmap: BeatmapHelper.default(group: beatmaps)
      currentUser: currentUser
      userPermissions: @props.initial.userPermissions
      mode: 'timeline'
      readPostIds: _.chain(props.initial.beatmapsetDiscussion.beatmap_discussions)
        .map (d) =>
          d.beatmap_discussion_posts?.map (r) =>
            r.id
        .flatten()
        .value()
      currentFilter: 'total'


  componentDidMount: =>
    $.subscribe 'beatmap:select.beatmapDiscussions', @setCurrentBeatmapId
    $.subscribe 'playmode:set.beatmapDiscussions', @setCurrentPlaymode
    $.subscribe 'beatmapsetDiscussion:update.beatmapDiscussions', @setBeatmapsetDiscussion
    $.subscribe 'beatmapset:update.beatmapDiscussions', @setBeatmapset
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


  componentWillUnmount: =>
    $.unsubscribe '.beatmapDiscussions'
    $(document).off '.beatmapDiscussions'

    Timeout.clear @checkNewTimeout
    @checkNewAjax?.abort()


  render: =>
    div className: 'osu-layout osu-layout--full',
      el BeatmapDiscussions.Header,
        beatmapset: @state.beatmapset
        beatmaps: @state.beatmaps
        currentBeatmap: @state.currentBeatmap
        currentDiscussions: @currentDiscussions()
        currentUser: @state.currentUser
        currentFilter: @state.currentFilter
        beatmapsetDiscussion: @state.beatmapsetDiscussion
        users: @users()
        mode: @state.mode

      el BeatmapDiscussions.ModeSwitcher,
        mode: @state.mode
        currentDiscussions: @currentDiscussions()
        currentFilter: @state.currentFilter

      if @state.mode == 'events'
        div
          className: 'osu-layout__section osu-layout__section--extra'
          el BeatmapDiscussions.Events,
            events: @state.beatmapsetDiscussion.beatmapset_events
            users: @users()

      else
        div
          className: 'osu-layout__section osu-layout__section--extra'
          el BeatmapDiscussions.NewDiscussion,
            beatmapset: @state.beatmapset
            currentUser: @state.currentUser
            currentBeatmap: @state.currentBeatmap
            currentDiscussions: @currentDiscussions()
            mode: @state.mode

          el BeatmapDiscussions.Discussions,
            beatmapset: @state.beatmapset
            beatmapsetDiscussion: @state.beatmapsetDiscussion
            currentBeatmap: @state.currentBeatmap
            currentDiscussions: @currentDiscussions()
            currentFilter: @state.currentFilter
            currentUser: @state.currentUser
            mode: @state.mode
            readPostIds: @state.readPostIds
            userPermissions: @state.userPermissions
            users: @users()


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

      @setBeatmapset null, beatmapset: data.beatmapset, callback: ->
        @setBeatmapsetDiscussion null, beatmapsetDiscussion: data.beatmapsetDiscussion

    .always =>
      @nextTimeout = Math.min @nextTimeout, @checkNewTimeoutMax

      @checkNewTimeout = Timeout.set @nextTimeout, @checkNew


  currentDiscussions: =>
    if !@cache.currentDiscussions?

      byMode =
        timeline: []
        general: []
        generalAll: []
      byFilter =
        total: {}
        mapperNotes: {}
        deleted: {}
        praises: {}
        resolved: {}
        pending: {}
        mine: {}
      for own mode, _items of byMode
        for own filter, modes of byFilter
          modes[mode] = {}


      for d in @state.beatmapsetDiscussion.beatmap_discussions
        # skipped discussion
        # - not privileged (deleted discussion)
        # - deleted beatmap
        continue if _.isEmpty(d)

        mode =
          if d.beatmap_id?
            if d.beatmap_id == @state.currentBeatmap.id
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
        else if d.message_type == 'praise'
          filters.push 'praises'
        else
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

      timeline = _.orderBy byMode.timeline, ['timestamp', 'id']
      general = _.orderBy byMode.general, 'id'
      generalAll = _.orderBy byMode.generalAll, 'id'

      @cache.currentDiscussions =
        general: general
        generalAll: generalAll
        timeline: timeline
        byFilter: byFilter

    @cache.currentDiscussions


  jumpByHash: =>
    target = BeatmapDiscussionHelper.hashParse()

    if target.discussionId?
      return $.publish 'beatmapDiscussion:jump', id: target.discussionId

    if target.mode == 'events'
      return @setMode null, mode: 'events'

    target.beatmapId ?= @state.currentBeatmap.id
    $.publish 'beatmap:select', id: target.beatmapId


  jumpTo: (_e, {id}) =>
    discussion = _.find @state.beatmapsetDiscussion.beatmap_discussions, id: id

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

    setFilter = =>
      @setFilter null, filter: filter, callback: setMode
    setMode = =>
      @setMode null, mode: mode, callback: setCurrentBeatmapId
    setCurrentBeatmapId = =>
      @setCurrentBeatmapId null, id: discussion.beatmap_id, callback: jump
    jump = =>
      $.publish 'beatmapDiscussionEntry:highlight', id: discussion.id

      target = $(".js-beatmap-discussion-jump[data-id='#{id}']")
      offset = 0
      for header in [modeSwitcher, newDiscussion]
        continue if !header[0]?
        offset += header[0].getBoundingClientRect().height * -1

      $(window).stop().scrollTo target, 500,
        offset: offset

    setFilter()


  jumpToClick: (e) =>
    e.preventDefault()
    url = e.currentTarget.getAttribute('href')

    id = BeatmapDiscussionHelper.hashParse(url).discussionId

    @jumpTo null, {id}


  markPostRead: (_e, {id}) =>
    return if _.includes @state.readPostIds, id

    @setState readPostIds: @state.readPostIds.concat(id)


  setBeatmapset: (_e, {beatmapset, callback}) =>
    @setState
      beatmapset: beatmapset
      beatmaps: BeatmapHelper.group beatmapset.beatmaps
      callback


  setBeatmapsetDiscussion: (_e, {beatmapsetDiscussion, callback}) =>
    @setState
      beatmapsetDiscussion: beatmapsetDiscussion
      callback

  setCurrentBeatmapId: (_e, {id, callback}) =>
    return callback?() if !id?
    return callback?() if id == @state.currentBeatmap.id

    beatmap = _.find @state.beatmapset.beatmaps, id: id

    return callback?() if !beatmap?

    @setState currentBeatmap: beatmap, callback


  setCurrentPlaymode: (_e, {mode}) =>
    beatmap = BeatmapHelper.default items: @state.beatmaps[mode]
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
