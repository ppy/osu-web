# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import HeaderV4 from 'components/header-v4'
import Img2x from 'components/img2x'
import ProfileTournamentBanner from 'components/profile-tournament-banner'
import Badges from 'profile-page/badges'
import Detail from 'profile-page/detail'
import HeaderInfo from 'profile-page/header-info'
import headerLinks from 'profile-page/header-links'
import Links from 'profile-page/links'
import * as React from 'react'
import { a, div, h1, li, span, ul } from 'react-dom-factories'
import { Stats } from './stats'

el = React.createElement

export class Header extends React.Component
  render: =>
    div
      className: 'js-switchable-mode-page--scrollspy js-switchable-mode-page--page'
      'data-page-id': 'main'
      el HeaderV4,
        backgroundImage: @props.user.cover.url
        contentPrepend: el ProfileTournamentBanner,
          banner: @props.user.active_tournament_banner
        links: headerLinks(@props.user, 'modding')
        theme: 'users'
      div className: 'osu-page osu-page--users',
        div className: 'profile-header',
          div className: 'profile-header__top',
            el HeaderInfo, user: @props.user, currentMode: @props.user.playmode, coverUrl: @props.user.cover.url

            if !@props.user.is_bot
              el Stats, user: @props.user

          el Detail,
            stats: @props.stats
            type: 'modding'
            user: @props.user

          el Badges, badges: @props.user.badges

          el Links, user: @props.user
