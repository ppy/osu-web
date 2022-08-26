# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import { route } from 'laroute'
import { maxLengthTimeline } from 'utils/beatmapset-discussion-helper'
import { currentUrl } from 'utils/turbolinks'
import { getInt } from 'utils/math'

class window.BeatmapDiscussionHelper
  @DEFAULT_BEATMAP_ID: '-'
  @DEFAULT_FILTER: 'total'
  @TIMESTAMP_REGEX: /\b(((\d{2,}):([0-5]\d)[:.](\d{3}))(\s\((?:\d+[,|])*\d+\))?)/

  @MODES = new Set(['events', 'general', 'generalAll', 'timeline', 'reviews'])
  @FILTERS = new Set(['deleted', 'hype', 'mapperNotes', 'mine', 'pending', 'praises', 'resolved', 'total'])


  @defaultMode: (beatmapId) =>
    if beatmapId? && beatmapId != @DEFAULT_BEATMAP_ID
      'timeline'
    else
      'generalAll'


  @discussionMode: (discussion) ->
    if discussion.message_type == 'review'
      'reviews'
    else
      if discussion.beatmap_id?
        if discussion.timestamp?
          'timeline'
        else
          'general'
      else
        'generalAll'


  @formatTimestamp: (value) =>
    return unless value?

    ms = value % 1000
    s = Math.floor(value / 1000) % 60
    # remaining duration goes here even if it's over an hour
    m = Math.floor(value / 1000 / 60)

    "#{_.padStart m, 2, 0}:#{_.padStart s, 2, 0}.#{_.padStart ms, 3, 0}"


  @nearbyDiscussions: (discussions, timestamp) =>
    return [] if !timestamp?

    nearby = {}

    for discussion in discussions
      continue if not discussion.timestamp or discussion.message_type not in ['suggestion', 'problem']

      distance = Math.abs(discussion.timestamp - timestamp)

      continue if distance > 5000

      if discussion.user_id == currentUser.id
        continue if moment(discussion.updated_at).diff(moment(), 'hour') > -24

      category = switch
        when distance == 0 then 'd0'
        when distance < 100 then 'd100'
        when distance < 1000 then 'd1000'
        else 'other'

      nearby[category] ?= []
      nearby[category].push discussion

    shownDiscussions = nearby.d0 ? nearby.d100 ? nearby.d1000 ? nearby.other ? []

    _.sortBy shownDiscussions, 'timestamp'


  @stateFromDiscussion: (discussion) =>
    return {} if !discussion?

    discussionId: discussion.id
    beatmapsetId: discussion.beatmapset_id
    beatmapId: discussion.beatmap_id ? @DEFAULT_BEATMAP_ID
    mode: @discussionMode(discussion)


  @parseTimestamp: (message) =>
    return null if !message?

    timestampRe = message.match @TIMESTAMP_REGEX

    if timestampRe?
      timestamp = timestampRe.slice(1).map getInt

      # this isn't all that smart
      (timestamp[2] * 60 + timestamp[3]) * 1000 + timestamp[4]


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
    } = if useCurrent then _.assign(@urlParse(), options) else options

    params = {}

    if beatmap?
      beatmapsetId = beatmap.beatmapset_id
      beatmapId = beatmap.id

    params.beatmapset = beatmapsetId

    params.beatmap =
      if !beatmapId? || mode in ['events', 'generalAll', 'reviews']
        @DEFAULT_BEATMAP_ID
      else
        beatmapId

    params.mode = mode ? @defaultMode(beatmapId)

    if filter? && filter != @DEFAULT_FILTER && params.mode != 'events'
      params.filter = filter

    if discussion?
      discussionId = discussion.id

    if discussionId?
      if !discussion? && discussions?
        discussion = _.find discussions, id: discussionId

      if discussion?
        discussionState = @stateFromDiscussion(discussion) if discussion?
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


  # see @url
  @urlParse: (urlString, discussions, options = {}) =>
    options.forceDiscussionId ?= false

    url = new URL(urlString ? currentUrl().href)
    [__, pathBeatmapsets, beatmapsetId, pathDiscussions, beatmapId, mode, filter] = url.pathname.split /\/+/

    return if pathBeatmapsets != 'beatmapsets' || pathDiscussions != 'discussion'

    beatmapsetId = getInt(beatmapsetId)
    beatmapId = getInt(beatmapId)

    ret =
      beatmapsetId: beatmapsetId
      beatmapId: beatmapId
      # empty path segments are ''
      mode: if @MODES.has(mode) then mode else @defaultMode(beatmapId)
      filter: if @FILTERS.has(filter) then filter else @DEFAULT_FILTER
      user: getInt(url.searchParams.get('user')) if url.searchParams.get('user')?

    if url.hash[1] == '/'
      [discussionId, postId] = url.hash[2..].split('/').map(getInt)

      if discussionId?
        if discussions?
          discussion = _.find discussions, id: discussionId

          if discussion?
            _.assign ret, @stateFromDiscussion(discussion)

            return ret if discussion.posts?[0]?.id == postId
        else if options.forceDiscussionId
          ret.discussionId = discussionId

    ret.postId = postId if ret.discussionId? && postId?

    ret
