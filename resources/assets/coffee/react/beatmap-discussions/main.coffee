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
    beatmapset: initial.beatmapset.data
    beatmapsetDiscussion: initial.beatmapsetDiscussion.data
    currentBeatmap: initial.beatmapset.data.beatmaps.data[0]
    currentUser: currentUser
    userPermissions: initial.userPermissions
    users: @indexUsers initial.beatmapsetDiscussion.data.users.data
    mode: 'timeline'


  componentDidMount: ->
    $.subscribe 'beatmap:select.beatmapDiscussions', @setCurrentBeatmapId
    $.subscribe 'beatmapsetDiscussion:update.beatmapDiscussions', @setBeatmapsetDiscussion
    $.subscribe 'beatmapDiscussion:jump.beatmapDiscussions', @jumpTo
    $.subscribe 'beatmapDiscussion:setMode.beatmapDiscussions', @setMode


  componentWillUnmount: ->
    $.unsubscribe '.beatmapDiscussions'


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
                href: 'butts'
                className: 'link link--white link--no-underline'
                @state.beatmapset.title

        el BeatmapDiscussions.Overview,
          beatmapset: @state.beatmapset
          currentBeatmap: @state.currentBeatmap
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


  setBeatmapsetDiscussion: (_e, beatmapsetDiscussion) ->
    @setState
      beatmapsetDiscussion: beatmapsetDiscussion
      users: @indexUsers beatmapsetDiscussion.users.data


  setCurrentBeatmapId: (_e, id) ->
    return if id == @state.currentBeatmap.id

    beatmap = @state.beatmapset.beatmaps.data.find (bm) =>
      bm.id == id

    return if !beatmap?

    @setState currentBeatmap: beatmap


  indexUsers: (usersArray) ->
    reducer = (prev, curr) =>
      prev[curr.id] = curr
      prev

    usersArray.reduce reducer, {}


  lookupUser: (id) ->
    @state.users[id]


  jumpTo: (_e, beatmapDiscussionId) ->
    discussion = @state.beatmapsetDiscussion.beatmap_discussions.data.find (d) => d.id == beatmapDiscussionId

    return if !discussion?

    mode = if discussion.timestamp? then 'timeline' else 'general'
    @setMode null, mode
    @setCurrentBeatmapId null, discussion.beatmap_id

    target = "#beatmap-discussion-#{beatmapDiscussionId}"

    $(window).stop().scrollTo target, 500


  setMode: (_e, mode) ->
    return if mode == @state.mode

    @setState mode: mode
