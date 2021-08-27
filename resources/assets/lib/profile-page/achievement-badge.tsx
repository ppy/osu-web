# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import * as React from 'react'
import Img2x from 'img2x'
import { div, img } from 'react-dom-factories'
import { classWithModifiers } from 'utils/css'
import { nextVal } from 'utils/seq'

el = React.createElement

export class AchievementBadge extends React.PureComponent
  constructor: (props) ->
    super props

    @tooltip = React.createRef()


  render: =>
    @tooltipId = "#{@props.achievement.slug}-#{nextVal()}"

    badgeClass = classWithModifiers('badge-achievement', @props.modifiers)
    tooltipBadgeClass = 'badge-achievement badge-achievement--dynamic-height'

    if !@props.userAchievement?
      tooltipBadgeClass += ' badge-achievement--locked'
      badgeClass += ' badge-achievement--locked'

    div
      className: "js-tooltip-achievement #{badgeClass} #{@props.additionalClasses}",
      el Img2x,
        alt: @props.achievement.name
        className: 'badge-achievement__image'
        onMouseOver: @onMouseOver
        src: @props.achievement.icon_url

      div
        className: 'hidden'
        div
          className: 'js-tooltip-achievement--content tooltip-achievement__main'
          ref: @tooltip
          div
            className: 'tooltip-achievement__badge'
            div
              className: tooltipBadgeClass
              el Img2x,
                alt: @props.achievement.name
                className: 'badge-achievement__image'
                src: @props.achievement.icon_url
          div
            className: 'tooltip-achievement__grouping'
            @props.achievement.grouping

          div
            className: "tooltip-achievement__detail-container #{if @props.achievement.instructions? then 'tooltip-achievement__detail-container--hoverable' else ''}"
            div
              className: "tooltip-achievement__detail tooltip-achievement__detail--normal"
              div
                className: 'tooltip-achievement__name'
                @props.achievement.name
              div
                className: 'tooltip-achievement__description'
                dangerouslySetInnerHTML:
                  __html: @props.achievement.description
            if @props.achievement.instructions?
              div
                className: 'tooltip-achievement__detail tooltip-achievement__detail--hover'
                div
                  className: 'tooltip-achievement__instructions'
                  dangerouslySetInnerHTML:
                    __html: @props.achievement.instructions

          if @props.userAchievement?
            div
              className: 'tooltip-achievement__date'
              dangerouslySetInnerHTML:
                __html: osu.trans('users.show.extra.achievements.achieved-on', date: @achievementDateElem())
          else
            div
              className: 'tooltip-achievement__date'
              osu.trans('users.show.extra.achievements.locked')


  achievementDateElem: =>
    ret = document.createElement 'span'
    ret.classList.add 'js-tooltip-time'
    ret.title = @props.userAchievement.achieved_at
    ret.textContent = moment(@props.userAchievement.achieved_at).format 'll'

    ret.outerHTML


  onMouseOver: (event) =>
    event.persist()
    elem = event.currentTarget

    return if elem._loadedTooltipId == @tooltipId

    $content = $(@tooltip.current).clone()

    if elem._loadedTooltipId?
      elem._loadedTooltipId = @tooltipId
      $(elem).qtip 'set', 'content.text': $content
      return

    elem._loadedTooltipId = @tooltipId
    classes = 'qtip tooltip-achievement'
    classes += ' tooltip-achievement--locked' if !@props.userAchievement?

    options =
      overwrite: false
      content: $content
      position:
        my: 'bottom center'
        at: 'top center'
        viewport: $(window)
        adjust:
          scroll: false
      show:
        event: event.type
        ready: true
        delay: 200
      hide:
        fixed: true
        delay: 200
      style:
        classes: classes
        tip:
          width: 30
          height: 20

    $(elem).qtip options, event
