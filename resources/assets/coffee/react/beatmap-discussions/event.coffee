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

{a, div, li, span, ul, time} = ReactDOMFactories
el = React.createElement

class BeatmapDiscussions.Event extends React.PureComponent
  constructor: (props) ->
    super props


  render: =>
    eventTime = @props.time ? moment(@props.event.created_at)

    div className: 'beatmapset-event',
      div className: "beatmapset-event__icon beatmapset-event__icon--#{_.kebabCase @props.event.type}"
      time
        className: 'beatmapset-event__time js-tooltip-time'
        dateTime: @props.event.created_at
        title: @props.event.created_at
        eventTime.format 'LT'
      div
        className: 'beatmapset-event__content'
        dangerouslySetInnerHTML:
          __html: @contentText()


  contentText: =>
    discussionId = @props.event.comment?.beatmap_discussion_id

    if discussionId?
      discussion = @props.discussions[discussionId]

      url =
        if discussion?
          BeatmapDiscussionHelper.url discussion: discussion
        else
          laroute.route 'beatmap-discussions.show', beatmap_discussion: discussionId

      # TODO: get discussion starter to show more detail.
      discussion = osu.link(url, "##{discussionId}", classNames: ['js-beatmap-discussion--jump'])
    else
      text = @props.event.comment

    if @props.event.user_id?
      user = osu.link(laroute.route('users.show', user: @props.event.user_id), @props.users[@props.event.user_id].username)

    message = osu.trans "beatmapset_events.event.#{@props.event.type}", {discussion, text, user}

    # append owner of the event if not already included in main message
    if user? && @props.event.type not in ['disqualify', 'kudosu_gain', 'kudosu_lost', 'nominate']
      message += " (#{user})"

    message
