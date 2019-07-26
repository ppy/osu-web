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
import { ValueDisplay } from 'value-display'
import { Discussion } from "../beatmap-discussions/discussion"
el = React.createElement

export class Discussions extends React.Component
  render: =>
    div className: 'page-extra',
      h2 className: 'page-extra__title', osu.trans("users.show.extra.#{@props.name}.title_longer")
      div className: 'osu-layout',
        [
          for discussion in @props.discussions
            div key: discussion.id, style: { 'display': 'flex' },
              a href: laroute.route('beatmapsets.show', {beatmapset: discussion.beatmapset_id}), style: {margin: '20px 10px'},
                img className: 'beatmapset-activities__beatmapset-cover', src: discussion.beatmapset.covers.list,

              el Discussion,
                discussion: discussion
                users: @props.users
                currentUser: currentUser
                beatmapset: discussion.beatmapset
                isTimelineVisible: false
                visible: false
                showDeleted: true
                preview: true
        ]
