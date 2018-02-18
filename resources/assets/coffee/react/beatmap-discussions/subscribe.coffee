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

{a, button, div, h1, h2, p} = ReactDOMFactories
el = React.createElement

class BeatmapDiscussions.Subscribe extends React.PureComponent
  constructor: (props) ->
    super props

    @state = loading: false


  componentWillUnmount: =>
    @xhr?.abort()


  render: =>
    el BigButton,
      text: osu.trans "beatmapset_watches.button.action.to_#{+!@props.beatmapset.is_watched}"
      icon: if @props.beatmapset.is_watched then 'eye-slash' else 'eye'
      modifiers: ['full']
      props:
        onClick: @toggleWatch
        disabled: @state.loading


  toggleWatch: =>
    @setState loading: true

    @xhr = $.ajax laroute.route('beatmapsets.watches.update', watch: @props.beatmapset.id),
      type: if @props.beatmapset.is_watched then 'DELETE' else 'PUT'
      dataType: 'json'
    .done (data) =>
      $.publish 'beatmapsetDiscussions:update', watching: !@props.beatmapset.is_watched
    .fail (xhr) =>
      osu.emitAjaxError() xhr
    .always =>
      @setState loading: false
