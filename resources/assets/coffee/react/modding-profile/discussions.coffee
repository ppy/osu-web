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
import { Discussion } from "../beatmap-discussions/discussion"
el = React.createElement

export class Discussions extends React.Component
  render: =>
    div className: 'page-extra',
      h2 className: 'title title--page-extra', osu.trans("users.show.extra.discussions.title_longer")
      div className: 'modding-profile-list',
        if @props.discussions.length == 0
          div className: 'modding-profile-list__empty', osu.trans('users.show.extra.none')
        else
          [
            for discussion in @props.discussions
              div
                className: 'modding-profile-list__row'
                key: discussion.id,

                a
                  className: 'modding-profile-list__thumbnail'
                  href: BeatmapDiscussionHelper.url(discussion: discussion),

                  img className: 'beatmapset-activities__beatmapset-cover', src: discussion.beatmapset.covers.list

                el Discussion,
                  discussion: discussion
                  users: @props.users
                  currentUser: currentUser
                  beatmapset: discussion.beatmapset
                  isTimelineVisible: false
                  visible: false
                  showDeleted: true
                  preview: true
            a
              key: 'show-more'
              className: 'modding-profile-list__show-more'
              href: laroute.route('beatmap-discussions.index', {user: @props.user.id}),
              osu.trans('users.show.extra.discussions.show_more')
          ]
