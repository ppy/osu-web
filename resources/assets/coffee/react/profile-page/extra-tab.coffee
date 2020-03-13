# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import * as React from 'react'
import { span } from 'react-dom-factories'
el = React.createElement

export class ExtraTab extends React.PureComponent
  render: =>
    className = 'page-mode-link page-mode-link--profile-page'

    if @props.page == @props.currentPage
      className += ' page-mode-link--is-active'

    span
      className: className
      span
        className: 'fake-bold'
        'data-content': osu.trans("users.show.extra.#{@props.page}.title")
        osu.trans("users.show.extra.#{@props.page}.title")
      span className: 'page-mode-link__stripe'
