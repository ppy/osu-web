# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import * as React from 'react'
import { span } from 'react-dom-factories'
el = React.createElement

bn = 'flag-country'

export FlagCountry = ({country, modifiers}) ->
  return null if !country?.code?

  blockClass = osu.classWithModifiers(bn, modifiers)

  span
    className: blockClass
    title: country.name
    style:
      backgroundImage: "url('/images/flags/#{country.code}.png')"
