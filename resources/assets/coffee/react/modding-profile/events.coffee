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

import * as React from 'react'
import { div, h2, a, img } from 'react-dom-factories'
el = React.createElement

export class Events extends React.Component
  render: =>
    div className: 'page-extra',
      h2 className: 'title title--page-extra', osu.trans('users.show.extra.events.title_longer')
      div className: 'modding-profile-list',
        if @props.events.length == 0
          div className: 'modding-profile-list__empty', osu.trans('users.show.extra.none')
        else
          div className: 'beatmapset-events beatmapset-events--profile',
            [
              for event in @props.events
                if !event.beatmapset
                  continue

                cover = if event.beatmapset then event.beatmapset.covers.list else ''
                discussionId = event.comment?.beatmap_discussion_id ? null
                discussionLink = laroute.route('beatmapsets.discussion', beatmapset: event.beatmapset.id)
                if (discussionId)
                    discussionLink = "#{discussionLink}#/#{discussionId}"

                div className: 'beatmapset-events__event', key: event.id,
                  div className: 'beatmapset-event',
                    a href: discussionLink,
                      img className: 'beatmapset-activities__beatmapset-cover', src: cover,

                    div className: "beatmapset-event__icon beatmapset-event__icon--#{_.kebabCase(event.type)} beatmapset-activities__event-icon-spacer"

                    div {},
                      div
                        className: "beatmapset-event__content"
                        dangerouslySetInnerHTML:
                          __html: osu.trans "beatmapset_events.event.#{@typeForTranslation(event)}",
                            user: @props.users[event.user_id].username
                            discussion: (if discussionId then "<a href='#{discussionLink}'>##{discussionId}</a>" else '')
                            text: (if event.discussion?.starting_post? then _.truncate(event.discussion.starting_post.message, {length: 100}) else '[no preview]')

                      div
                        className: 'beatmap-discussion-post__info'
                        dangerouslySetInnerHTML:
                          __html: osu.timeago(event.created_at)

              a
                className: 'modding-profile-list__show-more'
                key: 'show-more'
                href: laroute.route('users.modding.events', {user: @props.user.id}),
                osu.trans('users.show.extra.events.show_more')
            ]


  typeForTranslation: (event) =>
    if event.type == 'disqualify' && !_.isArray(event.comment)
      'disqualify_legacy'

    event.type
