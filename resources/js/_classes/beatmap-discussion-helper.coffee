# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import { route } from 'laroute'
import { defaultBeatmapId, defaultMode, stateFromDiscussion, urlParse } from 'utils/beatmapset-discussion-helper'
import { currentUrl } from 'utils/turbolinks'
import { getInt } from 'utils/math'

class window.BeatmapDiscussionHelper
  @DEFAULT_FILTER: 'total'

  # Don't forget to update BeatmapDiscussionsController@show when changing this.
  @url: (options = {}, useCurrent = false) =>
    {
      beatmapsetId
      beatmapId
      beatmap
      mode
      filter
      discussionId
      discussions # for validating discussionId and getting relevant params
      discussion
      post
      postId
      user
    } = if useCurrent then _.assign(urlParse(), options) else options

    params = {}

    if beatmap?
      beatmapsetId = beatmap.beatmapset_id
      beatmapId = beatmap.id

    params.beatmapset = beatmapsetId

    params.beatmap =
      if !beatmapId? || mode in ['events', 'generalAll', 'reviews']
        defaultBeatmapId
      else
        beatmapId

    params.mode = mode ? defaultMode(beatmapId)

    if filter? && filter != @DEFAULT_FILTER && params.mode != 'events'
      params.filter = filter

    if discussion?
      discussionId = discussion.id

    if discussionId?
      if !discussion? && discussions?
        discussion = _.find discussions, id: discussionId

      if discussion?
        discussionState = stateFromDiscussion(discussion) if discussion?
        params.beatmapset = discussionState.beatmapsetId
        params.beatmap = discussionState.beatmapId
        params.mode = discussionState.mode

    url = new URL(route('beatmapsets.discussion', params))
    if discussionId?
      url.hash = "/#{discussionId}"

      postId = post.id if post?
      url.hash += "/#{postId}" if postId?


    if user?
      url.searchParams.set('user', user)
    else
      url.searchParams.delete('user')

    url.toString()
