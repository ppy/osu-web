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

class @BeatmapDiscussionHelper
  @DEFAULT_BEATMAP_ID: '-'
  @DEFAULT_MODE: 'timeline'
  @DEFAULT_FILTER: 'total'
  @MAX_MESSAGE_PREVIEW_LENGTH: 100
  @MAX_LENGTH_TIMELINE: 750


  @MODES = ['events', 'general', 'generalAll', 'timeline']
  @FILTERS = ['deleted', 'hype', 'mapperNotes', 'mine', 'pending', 'praises', 'resolved', 'total']


  @canModeratePosts: (user) =>
    user ?= currentUser

    user.is_admin || user.can_moderate


  # text should be pre-escaped.
  @discussionLinkify: (text) =>
    currentUrl = new URL(window.location)
    currentBeatmapsetDiscussions = @urlParse(currentUrl.href)

    text.replace osu.urlRegex, (url, _, displayUrl) =>
      targetUrl = new URL(url)

      if targetUrl.host == currentUrl.host
        targetBeatmapsetDiscussions = @urlParse targetUrl.href, null, forceDiscussionId: true
        if targetBeatmapsetDiscussions?.discussionId?
          if currentBeatmapsetDiscussions? &&
              currentBeatmapsetDiscussions.beatmapsetId == targetBeatmapsetDiscussions.beatmapsetId
            # same beatmapset, format: #123
            linkText = "##{targetBeatmapsetDiscussions.discussionId}"
            attrs = 'class="js-beatmap-discussion--jump"'
          else
            # different beatmapset, format: 1234#567
            linkText = "#{targetBeatmapsetDiscussions.beatmapsetId}##{targetBeatmapsetDiscussions.discussionId}"

      linkText ?= displayUrl

      "<a href='#{url}' rel='nofollow' #{attrs ? ''}>#{linkText ? url}</a>"



  @discussionMode: (discussion) ->
    if discussion.beatmap_id?
      if discussion.timestamp?
        'timeline'
      else
        'general'
    else
      'generalAll'


  @format: (text, options = {}) =>
    blockName = 'beatmapset-discussion-message'
    text = _.escape text
    text = text.trim()
    text = @discussionLinkify text
    text = @linkTimestamp text, ["#{blockName}__timestamp"]

    if options.newlines ? true
      # replace newlines with <br>
      # - trim trailing spaces
      # - then join with <br>
      # - limit to 2 consecutive <br>s
      text = text
        .split '\n'
        .map (x) -> x.trim()
        .join '<br>'
        .replace /(?:<br>){2,}/g, '<br><br>'

    blockClass = blockName
    blockClass += " #{blockName}--#{modifier}" for modifier in options.modifiers ? []

    "<div class='#{blockClass}'>#{text}</div>"


  @formatTimestamp: (value) =>
    return unless value?

    ms = value % 1000
    s = Math.floor(value / 1000) % 60
    # remaning duration goes here even if it's over an hour
    m = Math.floor(value / 1000 / 60)

    "#{_.padStart m, 2, 0}:#{_.padStart s, 2, 0}.#{_.padStart ms, 3, 0}"


  @linkTimestamp: (text, classNames = []) =>
    text
      .replace /\b((\d{2}):(\d{2})[:.](\d{3})( \([\d,|]+\)|\b))/g, (_match, text, m, s, ms, range) =>
        osu.link(Url.openBeatmapEditor("#{m}:#{s}:#{ms}#{range ? ''}"), text, classNames: classNames)


  @messageType:
    icon:
      hype: 'fas fa-bullhorn'
      mapperNote: 'far fa-sticky-note'
      praise: 'fas fa-heart'
      problem: 'fas fa-exclamation-circle'
      review: 'fas fa-tasks'
      suggestion: 'far fa-circle'

    # used for svg since it doesn't seem to have ::before pseudo-element
    iconText:
      mapperNote: ['far', '&#xf249;']
      praise: ['fas', '&#xf004;']
      problem: ['fas', '&#xf06a;']
      resolved: ['far', '&#xf058;']
      suggestion: ['far', '&#xf111;']


  @previewMessage = (message) =>
    if message.length > @MAX_MESSAGE_PREVIEW_LENGTH
      _.chain(message)
      .truncate length: @MAX_MESSAGE_PREVIEW_LENGTH
      .escape()
      .value()
    else
      @format message, newlines: false


  @stateFromDiscussion: (discussion) =>
    return {} if !discussion?

    discussionId: discussion.id
    beatmapsetId: discussion.beatmapset_id
    beatmapId: discussion.beatmap_id ? @DEFAULT_BEATMAP_ID
    mode: @discussionMode(discussion)


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
      user
    } = if useCurrent then _.assign(@urlParse(), options) else options

    params = {}

    if beatmap?
      beatmapsetId = beatmap.beatmapset_id
      beatmapId = beatmap.id

    params.beatmapset = beatmapsetId
    params.mode = mode ? @DEFAULT_MODE

    params.beatmap =
      if !beatmapId? || params.mode in ['events', 'generalAll']
        @DEFAULT_BEATMAP_ID
      else
        beatmapId

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

    url = new URL(laroute.route('beatmapsets.discussion', params))
    url.hash = if discussionId? then url.hash = "/#{discussionId}" else ''

    if user?
      url.searchParams.set('user', user)
    else
      url.searchParams.delete('user')

    url.toString()


  # see @url
  @urlParse: (urlString, discussions, options = {}) =>
    options.forceDiscussionId ?= false

    url = new URL(urlString ? document.location.href)
    [__, pathBeatmapsets, beatmapsetId, pathDiscussions, beatmapId, mode, filter] = url.pathname.split /\/+/

    return if pathBeatmapsets != 'beatmapsets' || pathDiscussions != 'discussion'

    beatmapsetId = parseInt(beatmapsetId, 10)
    beatmapId = parseInt(beatmapId, 10)

    ret =
      beatmapsetId: if isFinite(beatmapsetId) then beatmapsetId
      beatmapId: if isFinite(beatmapId) then beatmapId
      # empty path segments are ''
      mode: if _.includes(@MODES, mode) then mode else @DEFAULT_MODE
      filter: if _.includes(@FILTERS, filter) then filter else @DEFAULT_FILTER
      user: parseInt(url.searchParams.get('user'), 10) if url.searchParams.get('user')?

    if url.hash[1] == '/'
      discussionId = parseInt(url.hash[2..], 10)

      if isFinite(discussionId)
        if discussions?
          discussion = _.find discussions, id: discussionId

          _.assign ret, @stateFromDiscussion(discussion)
        else if options.forceDiscussionId
          ret.discussionId = discussionId

    ret


  @validMessageLength: (message, isTimeline) =>
    return false unless message?.length > 0

    if isTimeline
      message.length <= @MAX_LENGTH_TIMELINE
    else
      true
