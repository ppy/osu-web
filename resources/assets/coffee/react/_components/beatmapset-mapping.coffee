# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import * as React from 'react'
import { div, span, a, time } from 'react-dom-factories'
el = React.createElement

bn = 'beatmapset-mapping'
dateFormat = 'LL'

export class BeatmapsetMapping extends React.PureComponent
  render: =>
    user =
      id: @props.beatmapset.user_id
      username: @props.beatmapset.creator
      avatar_url: (@props.user ? @props.beatmapset.user)?.avatar_url

    div className: bn,
      if user.id?
        a
          href: laroute.route 'users.show', user: user.id
          className: 'avatar avatar--beatmapset'
          style:
            backgroundImage: osu.urlPresence(user.avatar_url)
      else
        span className: 'avatar avatar--beatmapset avatar--guest'

      div className: "#{bn}__content",
        div
          className: "#{bn}__mapper"
          dangerouslySetInnerHTML:
            __html: osu.trans 'beatmapsets.show.details.mapped_by',
              mapper: @userLink(user)

        @renderDate 'submitted', 'submitted_date'

        if @props.beatmapset.ranked > 0
          @renderDate @props.beatmapset.status, 'ranked_date'
        else
          @renderDate 'updated', 'last_updated'


  renderDate: (key, attribute) =>
    div
      className: "#{bn}__date"
      dangerouslySetInnerHTML: __html:
        osu.trans "beatmapsets.show.details_date.#{key}",
          timeago: osu.timeago(@props.beatmapset[attribute])


  userLink: (user) ->
    if user.id?
      laroute.link_to_route 'users.show',
        user.username
        { user: user.id }
        class: "#{bn}__user js-usercard"
        'data-user-id': user.id
    else
      "<span class='#{bn}__user'>#{_.escape(user.username ? osu.trans('users.deleted'))}</span>"
