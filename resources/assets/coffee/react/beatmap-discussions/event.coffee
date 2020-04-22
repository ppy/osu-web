# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import * as React from 'react'
import { a, div, li, span, ul, time } from 'react-dom-factories'
el = React.createElement

export class Event extends React.PureComponent
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

      if discussion?
        url = BeatmapDiscussionHelper.url discussion: discussion
        text = BeatmapDiscussionHelper.previewMessage(discussion.posts[0].message)
      else
        url = laroute.route 'beatmap-discussions.show', beatmap_discussion: discussionId
        text = osu.trans('beatmapset_events.item.discussion_deleted')

      discussionLink = osu.link(url, "##{discussionId}", classNames: ['js-beatmap-discussion--jump'])
    else
      text = BeatmapDiscussionHelper.format @props.event.comment, newlines: false

    if @props.event.type == 'discussion_lock'
      text = BeatmapDiscussionHelper.format @props.event.comment.reason, newlines: false

    if @props.event.user_id?
      user = osu.link(laroute.route('users.show', user: @props.event.user_id), @props.users[@props.event.user_id].username)

    key =
      if @props.event.type == 'disqualify'
        if discussionId?
          'disqualify'
        else
          'disqualify_legacy'
      else
        @props.event.type

    message = osu.trans "beatmapset_events.event.#{key}",
      discussion: discussionLink
      text: text
      user: user

    # append owner of the event if not already included in main message
    if user? && @props.event.type not in ['disqualify', 'kudosu_gain', 'kudosu_lost', 'love', 'nominate']
      message += " (#{user})"

    message
