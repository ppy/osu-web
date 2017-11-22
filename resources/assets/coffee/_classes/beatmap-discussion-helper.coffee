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
  @formatTimestamp: (value) =>
    return unless value?

    ms = value % 1000
    s = Math.floor(value / 1000) % 60
    # remaning duration goes here even if it's over an hour
    m = Math.floor(value / 1000 / 60)

    "#{_.padStart m, 2, 0}:#{_.padStart s, 2, 0}.#{_.padStart ms, 3, 0}"


  # don't forget to update BeatmapDiscussionsController@show
  # when changing this.
  @hash: ({beatmapId, discussionId, isEvents} = {}) =>
    if discussionId?
      "#/#{discussionId}"
    else if beatmapId?
      "#:#{beatmapId}"
    else if isEvents
      '#events'
    else
      ''


  # see @hash
  @hashParse: (url = document.location.href) ->
    hashStart = url.indexOf('#')

    hash =
      if hashStart == -1
        ''
      else
        url.substr(hashStart + 1)

    id = parseInt(hash[1..], 10)

    if hash[0] == '/'
      discussionId: id
    else if hash[0] == ':'
      beatmapId: id
    else if hash == 'events'
      mode: 'events'
    else
      {}


  @linkTimestamp: (text, classNames = []) =>
    text
      .replace /(^|\s|\()((\d{2}):(\d{2})[:.](\d{3})( \([\d,|]+\))?)(?=$|\s|\)|\.|,)/g, (_, prefix, text, m, s, ms, range) =>
        "#{prefix}#{osu.link(Url.openBeatmapEditor("#{m}:#{s}:#{ms}#{range ? ''}"), text, classNames: classNames)}"


  @messageType:
    icon:
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
