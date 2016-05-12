###
# Copyright 2015 ppy Pty. Ltd.
#
# This file is part of osu!web. osu!web is distributed with the hope of
# attracting more community contributions to the core ecosystem of osu!.
#
# osu!web is free software: you can redistribute it and/or modify
# it under the terms of the Affero GNU General Public License version 3
# as published by the Free Software Foundation.
#
# osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
# warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
# See the GNU Affero General Public License for more details.
#
# You should have received a copy of the GNU Affero General Public License
# along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
###
{a, div, h1, p} = React.DOM
el = React.createElement

BeatmapDiscussions.Main = React.createClass
  mixins: [React.addons.PureRenderMixin]


  getInitialState: ->
    initial = osu.parseJson 'json-beatmapset-discussion'

    beatmapset: initial.beatmapset.data
    beatmapsetDiscussion: initial.beatmapsetDiscussion.data
    currentBeatmap: initial.beatmapset.data.beatmaps.data[0]
    currentUser: currentUser
    userPermissions: initial.userPermissions
    users: @indexUsers initial.beatmapsetDiscussion.data.users.data
    mode: 'timeline'
    readPostIds: _.chain(initial.beatmapsetDiscussion.data.beatmap_discussions.data)
      .map (d) => d.beatmap_discussion_posts.data.map (r) => r.id
      .flatten()
      .value()
    highlightedDiscussionId: null
    collapsedBeatmapDiscussionIds: []
    currentFilter: 'total'


  componentDidMount: ->
    $.subscribe 'beatmap:select.beatmapDiscussions', @setCurrentBeatmapId
    $.subscribe 'beatmapsetDiscussion:update.beatmapDiscussions', @setBeatmapsetDiscussion
    $.subscribe 'beatmapDiscussion:collapse.beatmapDiscussions', @collapseBeatmapDiscussion
    $.subscribe 'beatmapDiscussion:jump.beatmapDiscussions', @jumpTo
    $.subscribe 'beatmapDiscussion:setMode.beatmapDiscussions', @setMode
    $.subscribe 'beatmapDiscussionPost:markRead.beatmapDiscussions', @markPostRead
    $.subscribe 'beatmapDiscussion:setHighlight.beatmapDiscussions', @setHighlight
    $.subscribe 'beatmapDiscussion:filter.beatmapDiscussions', @setFilter

    @jumpByHash()

    @checkNewTimeout = setTimeout @checkNew, @checkNewTimeoutDefault


  componentWillUnmount: ->
    $.unsubscribe '.beatmapDiscussions'

    clearTimeout @checkNewTimeout
    @checkNewAjax?.abort?()


  render: ->
    div null,
      div
        className: 'osu-layout__row'

        div
          className: 'forum-category-header forum-category-header--topic'
          style:
            backgroundImage: "url('#{@state.beatmapset.covers.cover}')"
          div
            className: 'forum-category-header__titles'
            h1
              className: 'forum-category-header__title'
              a
                href: laroute.route('beatmapsets.show', beatmapsets: @state.beatmapset.beatmapset_id)
                className: 'link link--white link--no-underline'
                @state.beatmapset.title

        el BeatmapDiscussions.Overview,
          beatmapset: @state.beatmapset
          currentBeatmap: @state.currentBeatmap
          currentFilter: @state.currentFilter
          beatmapsetDiscussion: @state.beatmapsetDiscussion
          lookupUser: @lookupUser

      div
        className: 'osu-layout__row osu-layout__row--sm1 osu-layout__row--page-compact'
        el BeatmapDiscussions.NewDiscussion, currentUser: @state.currentUser, currentBeatmap: @state.currentBeatmap

        el BeatmapDiscussions.Discussions,
          beatmapset: @state.beatmapset
          currentBeatmap: @state.currentBeatmap
          currentUser: @state.currentUser
          beatmapsetDiscussion: @state.beatmapsetDiscussion
          lookupUser: @lookupUser
          userPermissions: @state.userPermissions
          mode: @state.mode
          highlightedDiscussionId: @state.highlightedDiscussionId
          readPostIds: @state.readPostIds
          collapsedBeatmapDiscussionIds: @state.collapsedBeatmapDiscussionIds
          currentFilter: @state.currentFilter


  setBeatmapsetDiscussion: (_e, {beatmapsetDiscussion, callback}) ->
    @setState
      beatmapsetDiscussion: beatmapsetDiscussion
      users: @indexUsers beatmapsetDiscussion.users.data
      callback


  setCurrentBeatmapId: (_e, {id, callback}) ->
    osu.setHash "#:#{id}"

    return callback?() if id == @state.currentBeatmap.id

    beatmap = @state.beatmapset.beatmaps.data.find (bm) =>
      bm.id == id

    return callback?() if !beatmap?

    @setState currentBeatmap: beatmap, callback


  indexUsers: (usersArray) ->
    _.keyBy usersArray, (u) => u.id


  lookupUser: (id) ->
    @state.users[id]


  jumpTo: (_e, {id}) ->
    discussion = @state.beatmapsetDiscussion.beatmap_discussions.data.find (d) => d.id == id

    return if !discussion?

    mode = if discussion.timestamp? then 'timeline' else 'general'

    @setMode null, mode, =>
      @setCurrentBeatmapId null,
        id: discussion.beatmap_id
        callback: =>
          $.publish 'beatmapDiscussion:setHighlight', id: discussion.id

        target = $(".js-beatmap-discussion-jump[data-id='#{id}']")
        $(window).stop().scrollTo target, 500


  setMode: (_e, mode, callback) ->
    return callback?() if mode == @state.mode

    @setState mode: mode, callback


  jumpByHash: ->
    jumpId = document.location.hash.match(/\/(\d+)/)?[1]

    if jumpId?
      return $.publish 'beatmapDiscussion:jump', id: parseInt(jumpId, 10)

    beatmapId = document.location.hash.match(/:(\d+)/)?[1]
    beatmapId ?= @state.currentBeatmap.id
    $.publish 'beatmap:select', id: parseInt(beatmapId, 10)


  checkNewTimeoutDefault: 10000
  checkNewTimeoutMax: 60000

  checkNew: ->
    @nextTimeout ?= @checkNewTimeoutDefault

    clearTimeout @checkNewTimeout

    @checkNewAjax = $.ajax document.location.pathname,
      data:
        format: 'json'
        last_updated: moment(@state.beatmapsetDiscussion.updated_at).unix()

    .done (data) =>
      if data.updated? && !data.updated
        @nextTimeout *= 2
        return

      @nextTimeout = @checkNewTimeoutDefault

      @setBeatmapsetDiscussion null, beatmapsetDiscussion: data.beatmapsetDiscussion.data

    .always =>
      @nextTimeout = Math.min @nextTimeout, @checkNewTimeoutMax

      @checkNewTimeout = setTimeout @checkNew, @nextTimeout


  setHighlight: (_e, {id}) ->
    return if @state.highlightedDiscussionId == id

    @setState highlightedDiscussionId: id


  markPostRead: (_e, {id}) ->
    return if _.includes @state.readPostIds, id

    @setState readPostIds: @state.readPostIds.concat(id)


  collapseBeatmapDiscussion: (_e, {all, id}) ->
    newIds =
      if all == 'collapse'
        @state.beatmapsetDiscussion.beatmap_discussions.data.map (d) =>
          d.id
      else if all == 'expand'
        []
      else if _.includes @state.collapsedBeatmapDiscussionIds, id
        _.filter @state.collapsedBeatmapDiscussionIds, (i) => i != id
      else
        _.concat @state.collapsedBeatmapDiscussionIds, id

    @setState collapsedBeatmapDiscussionIds: newIds


  setFilter: (_e, {filter}) ->
    return if filter == @state.currentFilter

    @setState currentFilter: filter
