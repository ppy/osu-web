# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

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
