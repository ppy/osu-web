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
    
    classModifiers = @props.classModifiers || []
    modsClassName += " mods--#{mod}" for mod in classModifiers

    div className: modsClassName,
      for mod in @props.mods
        modName = osu.trans "beatmaps.mods.#{mod}"

        div
          key: mod
          className: 'mods__mod'
          img _.extend
            className: 'mods__mod-image'
            title: modName
            osu.src2x("/images/badges/mods/#{_.kebabCase(modName)}.png")
