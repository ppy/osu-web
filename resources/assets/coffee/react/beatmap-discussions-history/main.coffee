###
#    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
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

import { Discussion } from '../beatmap-discussions/discussion'
import { BeatmapsContext } from 'beatmap-discussions/beatmaps-context'
import { DiscussionsContext } from 'beatmap-discussions/discussions-context'
import * as React from 'react'
import { a, div, img } from 'react-dom-factories'
el = React.createElement

export class Main extends React.PureComponent
  constructor: (props) ->
    super props

    @cache = {}
    @state = JSON.parse(props.container.dataset.discussionsState ? null)
    @restoredState = @state?

    if !@restoredState
      @state =
        discussions: props.discussions
        users: props.users
        relatedDiscussions: props.relatedDiscussions


  componentDidMount: =>
    $.subscribe 'beatmapsetDiscussions:update.discussionHistory', @discussionUpdate
    $(document).on 'ajax:success.discussionHistory', '.js-beatmapset-discussion-update', @ujsDiscussionUpdate


  componentWillUnmount: =>
    $.unsubscribe '.discussionHistory'
    $(window).off '.discussionHistory'

    $(window).stop()


  discussionUpdate: (_e, options) =>
    {beatmapset} = options
    return unless beatmapset?

    discussions = @state.discussions
    users = @state.users

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

    _.each beatmapset.related_users, (newUser) ->
      if userIds.includes(newUser.id)
        users = _.reject users, id: newUser.id

      users.push(newUser)

    @cache.users = @cache.discussions = @cache.beatmaps = null
    @setState
      discussions: _.reverse(_.sortBy(discussions, (d) -> Date.parse(d.starting_post.created_at)))
      users: users


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

    beatmaps = _.map(@discussions(), (d) => d.beatmap)
                .filter((b) => b != undefined)

    @cache.beatmaps = _.keyBy(beatmaps, 'id')


  saveStateToContainer: =>
    @props.container.dataset.discussionsState = JSON.stringify(@state)


  render: =>
    el DiscussionsContext.Provider,
      value: @discussions()
      el BeatmapsContext.Provider,
        value: @beatmaps()
        div className: 'modding-profile-list modding-profile-list--index',
          if @props.discussions.length == 0
            div className: 'modding-profile-list__empty', osu.trans('beatmap_discussions.index.none_found')
          else
            for discussion in @props.discussions
              div
                className: 'modding-profile-list__row'
                key: discussion.id,

                a
                  className: 'modding-profile-list__thumbnail'
                  href: BeatmapDiscussionHelper.url(discussion: discussion),

                  img className: 'beatmapset-activities__beatmapset-cover', src: discussion.beatmapset.covers.list

                el Discussion,
                  discussion: discussion
                  users: @users()
                  currentUser: currentUser
                  beatmapset: discussion.beatmapset
                  isTimelineVisible: false
                  visible: false
                  showDeleted: true
                  preview: true


  users: =>
    if !@cache.users?
      @cache.users = _.keyBy @state.users, 'id'
      @cache.users[null] = @cache.users[undefined] =
        username: osu.trans 'users.deleted'

    @cache.users


  ujsDiscussionUpdate: (_e, data) =>
    # to allow ajax:complete to be run
    Timeout.set 0, => @discussionUpdate(null, beatmapset: data)
