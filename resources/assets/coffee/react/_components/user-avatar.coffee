# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import * as React from 'react'
import { div } from 'react-dom-factories'

bn = 'avatar'

export UserAvatar = (props) ->
  if props.user.id?
    div
      className: osu.classWithModifiers(bn, props.modifiers)
      style:
        backgroundImage: osu.urlPresence(props.user.avatar_url)
  else
    div className: osu.classWithModifiers(bn, _.concat(props.modifiers, 'guest'))
