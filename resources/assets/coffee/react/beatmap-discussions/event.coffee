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

{a, div, li, span, ul} = ReactDOMFactories
el = React.createElement

class BeatmapDiscussions.Event extends React.PureComponent
  constructor: (props) ->
    super props


  render: =>
    time = @props.time ? moment(@props.event.created_at)

    div className: 'beatmapset-event',
      div className: "beatmapset-event__icon beatmapset-event__icon--#{@props.event.type}"
      div
        className: 'beatmapset-event__time'
        time.format 'LT'
      div
        className: 'beatmapset-event__content'
        dangerouslySetInnerHTML:
          __html: @contentText()


  contentText: =>
    discussionId = @props.event.comment?.beatmap_discussion_id

    if discussionId?
      discussion = osu.link(BeatmapDiscussionHelper.hash({discussionId}), "##{discussionId}", ['js-beatmap-discussion--jump'])
    else
      text = @props.event.comment

    message = osu.trans "beatmapset_events.event.#{@props.event.type}", {discussion, text}

    if @props.event.user_id?
      message += " (#{osu.link(laroute.route('users.show', user: @props.event.user_id), @props.users[@props.event.user_id].username)})"

    message
