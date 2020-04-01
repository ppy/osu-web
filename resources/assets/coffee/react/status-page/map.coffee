# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import * as React from 'react'
import { div, span } from 'react-dom-factories'
el = React.createElement

export class Map extends React.Component
  constructor: (props) ->
    super props

  componentDidMount: =>
    @_map()

  componentDidUpdate: =>
    @_map()

  _map: ->
    unless @map
      @map = new StatusMap(@refs.status__map)
    @map.update(@props.servers)

  render: =>
    div
      ref: 'status__map'
      className: 'status-map osu-layout__row--page-compact'
