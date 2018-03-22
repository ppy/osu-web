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

class @BeatmapDiscussionHelper
  @DEFAULT_BEATMAP_ID: '-'
  @DEFAULT_MODE: 'timeline'
  @DEFAULT_FILTER: 'total'

  @MODES = ['events', 'general', 'generalAll', 'timeline']
  @FILTERS = ['deleted', 'hype', 'mapperNotes', 'mine', 'pending', 'praises', 'resolved', 'total']


  @discussionLinkify: (text) =>
    matches = text.match osu.urlRegex
    currentUrl = new URL(window.location)
    currentBeatmapsetDiscussions = BeatmapDiscussionHelper.urlParse(currentUrl.href)

    _.each matches, (url) ->
      targetUrl = new URL(url)

      if targetUrl.host == currentUrl.host
        targetBeatmapsetDiscussions = BeatmapDiscussionHelper.urlParse targetUrl.href, null, forceDiscussionId: true
        if targetBeatmapsetDiscussions?
          if currentBeatmapsetDiscussions? &&
              currentBeatmapsetDiscussions.beatmapsetId == targetBeatmapsetDiscussions.beatmapsetId
            # same beatmapset, format: #123
            linkText = "##{targetBeatmapsetDiscussions.discussionId}"
            text = text.replace(url, "<a class='js-beatmap-discussion--jump' href='#{url}' rel='nofollow'>#{linkText}</a>")
          else
            # different beatmapset, format: 1234#567
            linkText = "#{targetBeatmapsetDiscussions.beatmapsetId}##{targetBeatmapsetDiscussions.discussionId}"
            text = text.replace(url, "<a href='#{url}' rel='nofollow'>#{linkText}</a>")
          return

      # otherwise just linkify url as normal
      text = text.replace url, osu.linkify(url)

    text


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
      .replace /\b((\d{2}):(\d{2})[:.](\d{3})( \([\d,|]+\)|\b))/g, (_, text, m, s, ms, range) =>
        "#{osu.link(Url.openBeatmapEditor("#{m}:#{s}:#{ms}#{range ? ''}"), text, classNames: classNames)}"


  @maxlength: 750


  @messageType:
    icon:
      hype: 'bullhorn'
      mapperNote: 'sticky-note-o'
      praise: 'heart'
      problem: 'exclamation-circle'
      suggestion: 'circle-o'

    # used for svg since it doesn't seem to have ::before pseudo-element
    iconText:
      mapperNote: '&#xf24a;'
      praise: '&#xf004;'
      problem: '&#xf06a;'
      resolved: '&#xf05d;'
      suggestion: '&#xf10c;'


  @moderationGroup: (user) =>
    if user.groups?
      _.intersection(user.groups, ['admin', 'qat', 'bng'])[0]
    else
      switch
        when user.is_admin then 'admin'
        when user.is_qat then 'qat'
        when user.is_bng then 'bng'


  @stateFromDiscussion: (discussion) =>
    return {} if !discussion?

    discussionId: discussion.id
    beatmapsetId: discussion.beatmapset_id
    beatmapId: discussion.beatmap_id ? @DEFAULT_BEATMAP_ID
    mode: @discussionMode(discussion)


  # Don't forget to update BeatmapDiscussionsController@show when changing this.
  @url: (options = {}) =>
    {
      beatmapsetId
      beatmapId
      beatmap
      mode
      filter
      discussionId
      discussions # for validating discussionId and getting relevant params
      discussion
    } = options

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

    url = new URL(document.location)
    url.pathname = laroute.route 'beatmapsets.discussion', params
    url.hash = if discussionId? then url.hash = "/#{discussionId}" else ''

    url.toString()


  # see @url
  @urlParse: (urlString, discussions, options = {}) ->
    options.forceDiscussionId ?= false

    url = new URL(urlString ? document.location.href)
    params = url.searchParams
    [__, pathBeatmapsets, beatmapsetId, pathDiscussions, beatmapId, mode, filter] = url.pathname.split '/'

    return if pathBeatmapsets != 'beatmapsets' || pathDiscussions != 'discussion'

    beatmapsetId = parseInt(beatmapsetId, 10)
    beatmapId = parseInt(beatmapId, 10)

    ret =
      beatmapsetId: if isFinite(beatmapsetId) then beatmapsetId
      beatmapId: if isFinite(beatmapId) then beatmapId
      # empty path segments are ''
      mode: if _.includes(@MODES, mode) then mode else @DEFAULT_MODE
      filter: if _.includes(@FILTERS, filter) then filter else @DEFAULT_FILTER

    if url.hash[1] == '/'
      discussionId = parseInt(url.hash[2..], 10)

      if isFinite(discussionId)
        if discussions?
          discussion = _.find discussions, id: discussionId

          _.assign ret, @stateFromDiscussion(discussion)
        else if options.forceDiscussionId
          ret.discussionId = discussionId

    ret


  @validMessageLength: (message) =>
    message.length > 0 && message.length <= @maxlength
