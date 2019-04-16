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

import { BigButton } from 'big-button'
import * as React from 'react'
import { div, p, span } from 'react-dom-factories'
el = React.createElement

bn = 'beatmapset-hype'

export class Hype extends React.PureComponent
  render: =>
    div className: bn,
      div className: "#{bn}__box #{bn}__box--description",
        div className: "#{bn}__description-row #{bn}__description-row--status",
          div className: 'beatmapset-status beatmapset-status--hype',
            @props.beatmapset.status
        p className: "#{bn}__description-row #{bn}__description-row--current",
          osu.trans 'beatmapsets.show.hype.current._',
            status: osu.trans("beatmapsets.show.hype.current.status.#{@props.beatmapset.status}")
        p
          className: "#{bn}__description-row #{bn}__description-row--action"
          dangerouslySetInnerHTML:
            __html: osu.trans('beatmapsets.show.hype.action')

      div className: "#{bn}__box #{bn}__box--float",
        div className: "#{bn}__lights-header",
          span
            className: "#{bn}__lights-title",
            osu.trans('beatmaps.hype.section_title')
          span null,
            "#{@props.beatmapset.hype.current} / #{@props.beatmapset.hype.required}"

        div className: "#{bn}__lights",
          for i in _.times(@props.beatmapset.hype.required)
            state = if i < @props.beatmapset.hype.current then 'on' else 'off-light'
            div
              key: i
              className: "bar bar--beatmapset-nomination bar--beatmapset-nomination-#{state}"

        div
          className: "#{bn}__button"
          title: @props.beatmapset.current_user_attributes?.can_hype_reason
          el BigButton,
            modifiers: ['full']
            text: osu.trans('beatmaps.hype.button')
            icon: 'fas fa-bullhorn'
            props:
              href: "#{laroute.route 'beatmapsets.discussion',
                beatmapset: @props.beatmapset.id
                beatmap: '-'
                mode: 'generalAll'
                filter: 'praises'}#new"
              disabled:
                if @props.currentUser.id?
                  !@props.beatmapset.current_user_attributes.can_hype
                else
                  false
