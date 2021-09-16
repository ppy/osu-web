# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import BigButton from 'big-button'
import { route } from 'laroute'
import * as React from 'react'
import { a, div, p, span } from 'react-dom-factories'
import StringWithComponent from 'string-with-component'
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
                link: a
                  href: @reportUrl()
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
            state = if i < @props.beatmapset.hype.current then 'on' else 'off'
            div
              key: i
              className: "bar bar--beatmapset-hype bar--beatmapset-#{state}"

        div
          className: "#{bn}__button"
          title: @props.beatmapset.current_user_attributes?.can_hype_reason
          el BigButton,
            disabled:
              if @props.currentUser.id?
                !@props.beatmapset.current_user_attributes.can_hype
              else
                false
            href: "#{route 'beatmapsets.discussion',
              beatmapset: @props.beatmapset.id
              beatmap: '-'
              mode: 'generalAll'
              filter: 'praises'}#new"
            icon: 'fas fa-bullhorn'
            modifiers: 'full'
            text: osu.trans('beatmaps.hype.button')

        div
          className: "#{bn}__button"
          @renderReportButton()


  renderReportButton: =>
    return unless @props.beatmapset.status == 'qualified'

    if @userCanDisqualify()
      buttonParams =
        text: osu.trans 'beatmaps.nominations.disqualify'
        icon: 'fas fa-thumbs-down'
    else
      buttonParams =
        text: osu.trans('beatmapsets.show.hype.report.button')
        icon: 'fas fa-exclamation-triangle'

    el BigButton,
      href: @reportUrl()
      icon: buttonParams.icon
      modifiers: 'full'
      text: buttonParams.text


  reportUrl: =>
    "#{route('beatmapsets.discussion', beatmapset: @props.beatmapset.id, beatmap: '-', mode: 'generalAll')}#new"


  userCanDisqualify: =>
    @props.currentUser? && (@props.currentUser.is_moderator || @props.currentUser.is_admin || @props.currentUser.is_full_bn)
