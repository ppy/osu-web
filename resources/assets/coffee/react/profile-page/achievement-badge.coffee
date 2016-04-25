###
# Copyright 2015 ppy Pty. Ltd.
#
# This file is part of osu!web. osu!web is distributed with the hope of
# attracting more community contributions to the core ecosystem of osu!.
#
# osu!web is free software: you can redistribute it and/or modify
# it under the terms of the Affero GNU General Public License version 3
# as published by the Free Software Foundation.
#
# osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
# warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
# See the GNU Affero General Public License for more details.
#
# You should have received a copy of the GNU Affero General Public License
# along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
###
{div, img} = React.DOM
el = React.createElement

class ProfilePage.AchievementBadge extends React.Component
  onMouseOver: (event) =>
    name = event.target.getAttribute 'data-tooltip-target'

    classes = 'qtip tooltip-achievement'
    classes += ' tooltip-achievement--locked' if @props.isLocked

    options =
      overwrite: false
      content: $(".js-tooltip-achievement--content[data-tooltip-id='#{name}']").clone()
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

    $(event.target).qtip options, event


  iconUrl: =>
    "/images/badges/user-achievements/#{@props.achievement.slug}.png"

  render: =>
    console.log @props.dateAchieved
    tooltipId = "#{@props.achievement.slug}-#{Math.floor(Math.random() * 1000000)}"

    badgeClasses = 'badge-achievement'
    badgeClasses += ' badge-achievement--locked' if @props.isLocked

    div
      className: "js-tooltip-achievement #{badgeClasses} #{@props.additionalClasses}",
      img _.extend
        alt: @props.achievement.name
        className: 'badge-achievement__image'
        'data-tooltip-target': tooltipId
        onMouseOver: @onMouseOver
        osu.src2x @iconUrl()

      div
        className: 'hidden'
        div
          className: 'js-tooltip-achievement--content tooltip-achievement__main'
          'data-tooltip-id': tooltipId
          div
            className: 'tooltip-achievement__title'
            @props.achievement.grouping
          div
            className: 'tooltip-achievement__badge'
            div
              className: badgeClasses
              div className: 'badge-achievement__locked-bg badge-achievement__locked-bg--big'
              img _.extend
                alt: @props.achievement.name
                osu.src2x @iconUrl()
                className: 'badge-achievement__image'
          div
            className: 'tooltip-achievement__content'
            div
              className: 'tooltip-achievement__nickname'
              @props.achievement.name
            div
              className: 'tooltip-achievement__description'
              dangerouslySetInnerHTML:
                __html: @props.achievement.description
            if not @props.isLocked
              div
                className: 'tooltip-achievement__date'
                Lang.get 'users.show.extra.achievements.achieved-on', date: moment(@props.dateAchieved).format 'do MMM YYYY'
