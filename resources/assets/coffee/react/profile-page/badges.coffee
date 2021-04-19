# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import * as React from 'react'
import { div, img, a } from 'react-dom-factories'
el = React.createElement

export class Badges extends React.PureComponent
  render: =>
    return null unless @props.badges.length > 0

    div className: 'profile-badges',
      for badge in @props.badges
        element = if osu.present badge.url then a else div

        element
          key: badge.image_url
          href: badge.url if osu.present badge.url
          className: 'profile-badges__badge'
          style: backgroundImage: osu.urlPresence(badge.image_url)
          title: badge.description
