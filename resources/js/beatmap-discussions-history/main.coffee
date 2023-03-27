# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import { Discussion } from 'beatmap-discussions/discussion'
import { BeatmapsContext } from 'beatmap-discussions/beatmaps-context'
import { BeatmapsetsContext } from 'beatmap-discussions/beatmapsets-context'
import { DiscussionsContext } from 'beatmap-discussions/discussions-context'
import { ReviewEditorConfigContext } from 'beatmap-discussions/review-editor-config-context'
import BeatmapsetCover from 'components/beatmapset-cover'
import { deletedUser } from 'models/user'
import * as React from 'react'
import { a, div, img } from 'react-dom-factories'
import { makeUrl } from 'utils/beatmapset-discussion-helper'
import { trans } from 'utils/lang'
import { nextVal } from 'utils/seq'
el = React.createElement

export class Main extends React.PureComponent
  constructor: (props) ->
    super props

    @eventId = "beatmapset-discussions-history-#{nextVal()}"
    @cache = {}
    @state = JSON.parse(props.container.dataset.discussionsState ? null)
    @restoredState = @state?

    if !@restoredState
      @state =
        beatmapsets: props.beatmapsets
        discussions: props.discussions
        users: props.users
        relatedBeatmaps: props.relatedBeatmaps
        relatedDiscussions: props.relatedDiscussions


  componentWillUnmount: =>
    $(window).stop()


  discussions: =>
    # skipped discussions
    # - not privileged (deleted discussion)
    # - deleted beatmap
    @cache.discussions ?= _ @state.relatedDiscussions
                            .filter (d) -> !_.isEmpty(d)
                            .keyBy 'id'
                            .value()


  beatmaps: =>
    @cache.beatmaps ?= _.keyBy(this.props.relatedBeatmaps, 'id')


  beatmapsets: =>
    @cache.beatmapsets ?= _.keyBy(this.props.beatmapsets, 'id')


  saveStateToContainer: =>
    @props.container.dataset.discussionsState = JSON.stringify(@state)


  render: =>
    beatmaps = @beatmaps()
    beatmapsets = @beatmapsets()

    el ReviewEditorConfigContext.Provider, value: @props.reviewsConfig,
      el DiscussionsContext.Provider, value: @discussions(),
        el BeatmapsetsContext.Provider, value: beatmapsets,
          el BeatmapsContext.Provider, value: beatmaps,
            div className: 'modding-profile-list modding-profile-list--index',
              if @props.discussions.length == 0
                div className: 'modding-profile-list__empty', trans('beatmap_discussions.index.none_found')
              else
                for discussion in @props.discussions when discussion?
                  div
                    className: 'modding-profile-list__row'
                    key: discussion.id,

                    a
                      className: 'modding-profile-list__thumbnail'
                      href: makeUrl(discussion: discussion),

                      el BeatmapsetCover,
                        beatmapset: beatmapsets[discussion.beatmapset_id]
                        size: 'list'

                    el Discussion,
                      discussion: discussion
                      users: @users()
                      currentBeatmap: beatmaps[discussion.beatmap_id]
                      currentUser: currentUser
                      beatmapset: beatmapsets[discussion.beatmapset_id]
                      isTimelineVisible: false
                      readonly: true
                      showDeleted: true
                      preview: true


  users: =>
    if !@cache.users?
      @cache.users = _.keyBy @state.users, 'id'
      @cache.users[null] = @cache.users[undefined] = deletedUser.toJson()

    @cache.users
