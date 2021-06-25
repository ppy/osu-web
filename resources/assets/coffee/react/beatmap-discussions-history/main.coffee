# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import { Discussion } from '../beatmap-discussions/discussion'
import { BeatmapsContext } from 'beatmap-discussions/beatmaps-context'
import { DiscussionsContext } from 'beatmap-discussions/discussions-context'
import { ReviewEditorConfigContext } from 'beatmap-discussions/review-editor-config-context'
import { deletedUser } from 'models/user'
import * as React from 'react'
import { a, div, img } from 'react-dom-factories'
el = React.createElement

export class Main extends React.PureComponent
  constructor: (props) ->
    super props

    @eventId = "beatmapset-discussions-history-#{osu.uuid()}"
    @cache = {}
    @state = JSON.parse(props.container.dataset.discussionsState ? null)
    @restoredState = @state?

    if !@restoredState
      @state =
        discussions: props.discussions
        users: props.users
        relatedBeatmaps: props.relatedBeatmaps
        relatedDiscussions: props.relatedDiscussions


  componentDidMount: =>
    $.subscribe "beatmapsetDiscussions:update.#{@eventId}", @discussionUpdate
    $(document).on "ajax:success.#{@eventId}", '.js-beatmapset-discussion-update', @ujsDiscussionUpdate


  componentWillUnmount: =>
    $.unsubscribe ".#{@eventId}"
    $(window).off ".#{@eventId}"

    $(window).stop()


  discussionUpdate: (_e, options) =>
    {beatmapset} = options
    return unless beatmapset?

    discussions = [@state.discussions...]
    users = [@state.users...]
    relatedDiscussions = [@state.relatedDiscussions...]

    discussionIds = _.map discussions, 'id'
    userIds = _.map users, 'id'

    # Due to the entire hierarchy of discussions being sent back when a post is updated (instead of just the modified post),
    #   we need to iterate over each discussion and their posts to extract the updates we want.
    _.each beatmapset.discussions, (newDiscussion) ->
      if discussionIds.includes(newDiscussion.id)
        discussion = _.find discussions, id: newDiscussion.id
        discussions = _.reject discussions, id: newDiscussion.id
        newDiscussion = _.merge(discussion, newDiscussion)
        # The discussion list shows discussions started by the current user, so it can be assumed that the first post is theirs
        newDiscussion.starting_post = newDiscussion.posts[0]
        discussions.push(newDiscussion)
      else
        relatedDiscussions.push(newDiscussion)

    _.each beatmapset.related_users, (newUser) ->
      if userIds.includes(newUser.id)
        users = _.reject users, id: newUser.id

      users.push(newUser)

    @cache.users = @cache.discussions = @cache.beatmaps = @state.relatedDiscussions = null
    @setState
      discussions: _.reverse(_.sortBy(discussions, (d) -> Date.parse(d.starting_post.created_at)))
      users: users
      relatedDiscussions: relatedDiscussions


  discussions: =>
    # skipped discussions
    # - not privileged (deleted discussion)
    # - deleted beatmap
    @cache.discussions ?= _ @state.relatedDiscussions
                            .filter (d) -> !_.isEmpty(d)
                            .keyBy 'id'
                            .value()


  beatmaps: =>
    return @cache.beatmaps if @cache.beatmaps?

    @cache.beatmaps = _.keyBy(this.props.relatedBeatmaps, 'id')


  saveStateToContainer: =>
    @props.container.dataset.discussionsState = JSON.stringify(@state)


  render: =>
    el ReviewEditorConfigContext.Provider, value: @props.reviewsConfig,
      el DiscussionsContext.Provider, value: @discussions(),
        el BeatmapsContext.Provider, value: @beatmaps(),
          div className: 'modding-profile-list modding-profile-list--index',
            if @props.discussions.length == 0
              div className: 'modding-profile-list__empty', osu.trans('beatmap_discussions.index.none_found')
            else
              for discussion in @props.discussions when discussion?
                div
                  className: 'modding-profile-list__row'
                  key: discussion.id,

                  a
                    className: 'modding-profile-list__thumbnail'
                    href: BeatmapDiscussionHelper.url(discussion: discussion),

                    img className: 'beatmapset-cover', src: discussion.beatmapset.covers.list

                  el Discussion,
                    discussion: discussion
                    users: @users()
                    currentBeatmap: @beatmaps()[discussion.beatmap_id]
                    currentUser: currentUser
                    beatmapset: discussion.beatmapset
                    isTimelineVisible: false
                    visible: false
                    showDeleted: true
                    preview: true


  users: =>
    if !@cache.users?
      @cache.users = _.keyBy @state.users, 'id'
      @cache.users[null] = @cache.users[undefined] = deletedUser.toJson()

    @cache.users


  ujsDiscussionUpdate: (_e, data) =>
    # to allow ajax:complete to be run
    Timeout.set 0, => @discussionUpdate(null, beatmapset: data)
