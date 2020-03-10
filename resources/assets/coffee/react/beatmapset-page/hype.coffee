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
import { route } from 'laroute'
import * as React from 'react'
import { a, div, p, span } from 'react-dom-factories'
import { StringWithComponent } from 'string-with-component'
el = React.createElement

bn = 'beatmapset-hype'

export class Hype extends React.PureComponent
  render: =>
    div className: bn,
      div className: "#{bn}__box #{bn}__box--description",
        div className: "#{bn}__description-row #{bn}__description-row--status",
          div className: 'beatmapset-status beatmapset-status--hype',
            osu.trans("beatmapsets.show.status.#{@props.beatmapset.status}")
        p className: "#{bn}__description-row #{bn}__description-row--current",
          osu.trans 'beatmapsets.show.hype.current._',
            status: osu.trans("beatmapsets.show.hype.current.status.#{@props.beatmapset.status}")
        if @props.beatmapset.status == 'qualified'
          p
            className: "#{bn}__description-row #{bn}__description-row--action"
            el StringWithComponent,
              mappings:
                ':link': a
                  href: @reportUrl()
                  key: 'link'
                  osu.trans 'beatmapsets.show.hype.report.link'
              pattern:
                if @userCanDisqualify()
                  osu.trans('beatmapsets.show.hype.disqualify._')
                else
                  osu.trans('beatmapsets.show.hype.report._')

        else
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
              href: "#{route 'beatmapsets.discussion',
                beatmapset: @props.beatmapset.id
                beatmap: '-'
                mode: 'generalAll'
                filter: 'praises'}#new"
              disabled:
                if @props.currentUser.id?
                  !@props.beatmapset.current_user_attributes.can_hype
                else
                  false

        if @props.beatmapset.status == 'qualified'
          div
            className: "#{bn}__button"
            if @userCanDisqualify()
              title: osu.trans('beatmapsets.show.hype.disqualify.button_title')
              el BigButton,
                modifiers: ['full']
                text: osu.trans 'beatmaps.nominations.disqualify'
                icon: 'fas fa-thumbs-down'
                props:
                  href: @reportUrl()
            else
              title: osu.trans('beatmapsets.show.hype.report.button_title')
              el BigButton,
                modifiers: ['full']
                text: osu.trans('beatmapsets.show.hype.report.button')
                icon: 'fas fa-exclamation-triangle'
                props:
                  href: @reportUrl()

  reportUrl: =>
    "#{route('beatmapsets.discussion', beatmapset: @props.beatmapset.id, beatmap: '-', mode: 'generalAll')}#new"

  userCanDisqualify: =>
    @props.currentUser? && (@props.currentUser.is_moderator || @props.currentUser.is_admin || @props.currentUser.is_full_bn)
