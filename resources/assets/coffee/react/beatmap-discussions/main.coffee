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


  componentDidMount: ->
    $.subscribe 'beatmap:select.beatmapDiscussions', @setCurrentBeatmapIndex
    $.subscribe 'beatmapsetDiscussion:update.beatmapDiscussions', @setBeatmapsetDiscussion


  componentWillUnmount: ->
    $.unsubscribe '.beatmapDiscussions'


  render: ->
    div null,
      div
        className: 'osu-layout__row'

        div
          className: 'forum-category-header forum-category-header--topic'
          style:
            backgroundImage: "url('#{Url.beatmapsetCover @state.beatmapset.beatmapset_id}')"
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

      div
        className: 'osu-layout__row osu-layout__row--sm1 osu-layout__row--page-compact'
        el BeatmapDiscussions.NewDiscussion, currentUser: @state.currentUser, currentBeatmap: @state.currentBeatmap

        el BeatmapDiscussions.Discussions,
          beatmapset: @state.beatmapset
          currentBeatmap: @state.currentBeatmap
          currentUser: @state.currentUser
          beatmapsetDiscussion: @state.beatmapsetDiscussion
          userPermissions: @state.userPermissions


  setBeatmapsetDiscussion: (_e, beatmapsetDiscussion) ->
    @setState beatmapsetDiscussion: beatmapsetDiscussion


  setCurrentBeatmapIndex: (_e, id) ->
    return if id == @state.currentBeatmap.id

    beatmap = @state.beatmapset.beatmaps.data.find (bm) =>
      bm.id == id

    return if beatmap == undefined

    @setState currentBeatmap: beatmap
