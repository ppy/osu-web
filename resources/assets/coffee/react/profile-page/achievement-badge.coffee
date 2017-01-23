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

{div, img} = React.DOM
el = React.createElement

class ProfilePage.AchievementBadge extends React.Component
  onMouseOver: (event) =>
    elem = event.currentTarget

    return if elem._loadedTooltipId == @tooltipId

    content = $(@refs.tooltip).clone()

    if elem._loadedTooltipId?
      elem._loadedTooltipId = @tooltipId
      $(elem).qtip 'set', 'content.text': content
      return

    elem._loadedTooltipId = @tooltipId
    classes = 'qtip tooltip-achievement'
    classes += ' tooltip-achievement--locked' if !@props.userAchievement?

    options =
      overwrite: false
      content: content
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
          width: 10
          height: 8

    $(elem).qtip options, event


  iconUrl: =>
    "/images/badges/user-achievements/#{@props.achievement.slug}.png"

  render: =>
    @tooltipId = "#{@props.achievement.slug}-#{Math.floor(Math.random() * 1000000)}"

    badgeClasses = 'badge-achievement'
    badgeClasses += ' badge-achievement--locked' if !@props.userAchievement?

    div
      className: "js-tooltip-achievement #{badgeClasses} #{@props.additionalClasses}",
      el Img2x,
        alt: @props.achievement.name
        className: 'badge-achievement__image'
        onMouseOver: @onMouseOver
        src: @iconUrl()

      div
        className: 'hidden'
        div
          className: 'js-tooltip-achievement--content tooltip-achievement__main'
          ref: 'tooltip'
          div
            className: 'tooltip-achievement__title'
            @props.achievement.grouping
          div
            className: 'tooltip-achievement__badge'
            div
              className: badgeClasses
              div className: 'badge-achievement__locked-bg badge-achievement__locked-bg--big'
              el Img2x,
                alt: @props.achievement.name
                className: 'badge-achievement__image badge-achievement__image--big'
                src: @iconUrl()
          div
            className: 'tooltip-achievement__content'
            div
              className: 'tooltip-achievement__nickname'
              @props.achievement.name
            div
              className: 'tooltip-achievement__description'
              dangerouslySetInnerHTML:
                __html: @props.achievement.description
            if @props.userAchievement?
              div
                className: 'tooltip-achievement__date'
                osu.trans 'users.show.extra.achievements.achieved-on',
                  date: moment(@props.userAchievement.achieved_at).format 'Do MMM YYYY'
