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
  DEFAULT_PAGE = 'timeline'
  DEFAULT_FILTER = 'total'

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
        when user.isAdmin then 'admin'
        when user.isQAT then 'qat'
        when user.isBNG then 'bng'


  # don't forget to update BeatmapDiscussionsController@show
  # when changing this.
  @url: ({discussionId, beatmapId, page, filter} = {}) =>
    params = new URLSearchParams

    if beatmapId?
      params.set 'beatmap_id', beatmapId

    if page? && page != DEFAULT_PAGE
      params.set 'page', page

    if filter? && filter != DEFAULT_FILTER
      params.set 'filter', filter

    hash = if discussionId? then "#/#{discussionId}" else ''

    url = new URL(document.location)
    url.hash = hash
    url.search = params.toString()

    url.toString()


  # see @hash
  @urlParse: (urlString, discussions) ->
    url = new URL(urlString ? document.location.href)
    params = url.searchParams

    beatmapId = parseInt(params.get('beatmap_id'), 10)
    beatmapId = null if !isFinite(beatmapId)

    ret =
      beatmapId: beatmapId
      page: params.get('page') ? DEFAULT_PAGE
      filter: params.get('filter') ? DEFAULT_FILTER

    if url.hash[1] == '/'
      discussionId = parseInt(url.hash[2..], 10)

      if isFinite(discussionId) && discussions?
        discussion = _.find discussions, id: discussionId

        if discussion?
          ret.discussionId = discussion.id
          ret.beatmapId = discussion.beatmap_id
          ret.page = if discussion.timestamp? then 'timeline' else 'general'

    ret


  @validMessageLength: (message) =>
    message.length > 0 && message.length <= @maxlength
