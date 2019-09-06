###
#    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
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

import { Badges } from '../profile-page/badges'
import { Detail } from './detail'
import { HeaderInfo } from '../profile-page/header-info'
import { Links } from '../profile-page/links'
import { Stats } from './stats'
import * as React from 'react'
import { Img2x } from 'img2x'
import { a, div, h1, li, ul } from 'react-dom-factories'
el = React.createElement


export class Header extends React.Component
  render: =>
    div
      className: 'js-switchable-mode-page--scrollspy js-switchable-mode-page--page'
      'data-page-id': 'main'
      div className: 'header-v3 header-v3--users',
        div
          className: 'header-v3__bg'
          style:
            backgroundImage: osu.urlPresence(@props.user.cover_url)
        div className: 'header-v3__overlay'
        div className: 'osu-page osu-page--header-v3',
          @renderTournamentBanner()
          @renderTitle()
          @renderTabs()
      div className: 'osu-page osu-page--users',
        div className: 'profile-header',
          div className: 'profile-header__top',
            el HeaderInfo, user: @props.user, currentMode: @props.currentMode, coverUrl: @props.user.cover_url

            if !@props.user.is_bot
              el Stats, user: @props.user

          if !@props.user.is_bot
            el Detail,
              stats: @props.stats
              userAchievements: @props.userAchievements
              rankHistory: @props.rankHistory
              user: @props.user

          if @props.user.badges.length > 0
            el Badges, badges: @props.user.badges

          el Links, user: @props.user


  renderTabs: =>
    ul className: 'page-mode-v2 page-mode-v2--users',
      li
        className: 'page-mode-v2__item'
        a
          href: laroute.route('users.show', user: @props.user.id)
          className: 'page-mode-v2__link'
          osu.trans 'users.show.header_title.info'
      li
        className: 'page-mode-v2__item'
        a
          href: laroute.route('users.modding.index', user: @props.user.id)
          className: 'page-mode-v2__link page-mode-v2__link--active'
          osu.trans 'users.beatmapset_activities.title_compact'


  renderTitle: =>
    div className: 'osu-page-header-v3 osu-page-header-v3--users',
      div className: 'osu-page-header-v3__title',
        div className: 'osu-page-header-v3__title-icon',
          div className: 'osu-page-header-v3__icon'
        h1
          className: 'osu-page-header-v3__title-text'
          dangerouslySetInnerHTML:
            __html: osu.trans 'users.show.header_title._',
            info: "<span class='osu-page-header-v3__title-highlight'>#{osu.trans('users.beatmapset_activities.title_compact')}</span>"


  renderTournamentBanner: ({modifiers} = {}) =>
    return if !@props.user.active_tournament_banner.id?

    a
      href: laroute.route('tournaments.show', tournament: @props.user.active_tournament_banner.tournament_id)
      className: osu.classWithModifiers 'profile-tournament-banner', modifiers
      el Img2x,
        src: @props.user.active_tournament_banner.image
        className: 'profile-tournament-banner__image'
