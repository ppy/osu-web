###
# Copyright 2016 ppy Pty. Ltd.
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

class @Mods extends React.Component
  render: ->
    modsClassName = 'mods'
    modsClassName += ' mods--reversed' if @props.reversed
    modsClassName += ' mods--large' if @props.large

    imageClassName = 'mods__mod-image'
    imageClassName += ' mods__mod-image--large' if @props.large

    div className: modsClassName,
      for mod in @props.mods
        div
          key: mod.shortName
          className: 'mods__mod'
          img _.extend
            className: imageClassName
            title: mod.name
            osu.src2x("/images/badges/mods/#{_.kebabCase(mod.name)}.png")
