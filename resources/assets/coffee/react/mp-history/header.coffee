###
#    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
#    See the LICENCE file in the repository root for full licence text.
###

import * as React from 'react'
import { div, h1, h2 } from 'react-dom-factories'

export Header = (props) ->
  div className: 'osu-layout__row osu-layout__row--page-compact',
    div className: 'osu-page-header osu-page-header--mp-history',
      div className: 'osu-page-header__title-box',
        h2 className: 'osu-page-header__title osu-page-header__title--small',
          osu.trans 'multiplayer.match.header'
        h1 className: 'osu-page-header__title',
          props.name
