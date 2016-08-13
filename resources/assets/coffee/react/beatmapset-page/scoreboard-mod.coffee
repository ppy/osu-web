###
# Copyright 2015-2016 ppy Pty. Ltd.
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
{img} = React.DOM

class BeatmapsetPage.ScoreboardMod extends React.Component
  constructor: (props) ->
    super props

    @state =
      status: 'disabled'

  componentDidMount: ->
    $.subscribe 'scoreboard-mod:enabled:set.scoreboardMod', @setEnabled
    $.subscribe 'scoreboard-mod:status:set.scoreboardMod', @setStatus

  componentWillUnmount: ->
    $.unsubscribe '.scoreboardMod'

  onClick: =>
    return if @state.status == 'loading'

    @setState status: if @state.status == 'disabled' then 'loading' else 'disabled'
    $.publish 'beatmapset:scoreboard:set', enabledMod: ModsHelper.getBit @props.mod

  setEnabled: (_e, enabled) =>
    if @state.status == 'loading'
      @setState status: if enabled then 'enabled' else 'disabled'

  setStatus: (_e, status) =>
    @setState status: status

  render: ->
    modName = osu.trans "beatmaps.mods.#{@props.mod}"

    img _.extend
      className: "beatmapset-scoreboard__mod beatmapset-scoreboard__mod--#{@state.status}"
      title: modName
      onClick: @onClick
      osu.src2x "/images/badges/mods/#{_.kebabCase modName}.png"
