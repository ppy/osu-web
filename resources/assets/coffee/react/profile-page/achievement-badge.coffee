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
el = React.createElement

class ProfilePage.AchievementBadge extends React.Component
  render: =>
    filename = "/images/badges/user-achievements/#{@props.achievement.slug}.png"
    filename2x = "/images/badges/user-achievements/#{@props.achievement.slug}@2x.png"

    el 'div',
      className: "badge-achievement #{@props.additionalClasses}",
      el 'img',
        src: filename
        srcSet: "#{filename} 1x, #{filename2x} 2x"
        alt: @props.achievement.name
        title: @props.achievement.name
        className: 'badge-achievement__image'
