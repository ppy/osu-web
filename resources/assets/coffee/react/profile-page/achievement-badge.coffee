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
    # remove to reenable
    return

    name = event.target.getAttribute 'data-tooltip-target'

    options =
      overwrite: false
      content: $(".js-tooltip-achievement--content[data-tooltip-id='#{name}']").clone()
      position:
        my: 'bottom center'
        at: 'top center'
        viewport: $(window)
      show:
        event: event.type
        ready: true
      style:
        classes: 'qtip tooltip-achievement__main'

    $(event.target).qtip options, event


  render: =>
    filename = "/images/badges/user-achievements/#{@props.achievement.slug}.png"
    filename2x = "/images/badges/user-achievements/#{@props.achievement.slug}@2x.png"
    srcSet = "#{filename} 1x, #{filename2x} 2x"
    tooltipId = "#{@props.achievement.slug}-#{Math.floor(Math.random() * 1000000)}"
    imageClasses = 'js-tooltip-achievement badge-achievement__image'

    imageClasses += ' badge-achievement__image--locked' if @props.isLocked

    div
      className: "badge-achievement #{@props.additionalClasses}",
      img
        src: filename
        srcSet: srcSet
        alt: @props.achievement.name
        title: @props.achievement.name
        className: imageClasses
        'data-tooltip-target': tooltipId
        onMouseOver: @onMouseOver

      div
        className: 'hidden'
        div
          className: 'js-tooltip-achievement--content tooltip-achievement'
          'data-tooltip-id': tooltipId
          div
            className: 'tooltip-achievement__title'
            @props.achievement.name
          div
            className: 'tooltip-achievement__badge'
            img
              src: filename
              srcSet: srcSet
              alt: @props.achievement.name
          div
            className: 'tooltip-achievement__content'
            @props.achievement.name
