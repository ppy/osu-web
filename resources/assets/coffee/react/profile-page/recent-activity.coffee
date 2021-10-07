# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import { snakeCase } from 'lodash'
import AchievementBadge from 'profile-page/achievement-badge'
import ExtraHeader from 'profile-page/extra-header'
import * as React from 'react'
import { a, div, em, li, p, strong, ul } from 'react-dom-factories'
import ShowMoreLink from 'show-more-link'
import StringWithComponent from 'string-with-component'
import TimeWithTooltip from 'time-with-tooltip'
el = React.createElement

export class RecentActivity extends React.PureComponent
  link = (url, title) ->
    a
      className: 'profile-extra-entries__link'
      href: url
      title


  render: =>
    div
      className: 'page-extra'
      el ExtraHeader, name: @props.name, withEdit: @props.withEdit

      if @props.recentActivity.length
        div null,
          ul
            className: 'profile-extra-entries'
            @props.recentActivity.map @_renderEntry
          div
            className: 'profile-extra-entries__item'
            el ShowMoreLink,
              modifiers: ['profile-page', 't-greyseafoam-dark']
              event: 'profile:showMore'
              hasMore: @props.pagination.recentActivity.hasMore
              loading: @props.pagination.recentActivity.loading
              data:
                name: 'recentActivity'
                url: laroute.route 'users.recent-activity', user: @props.user.id
      else
        p className: 'profile-extra-entries', osu.trans('events.empty')


  _renderEntry: (event) =>
    return if event.parse_error

    switch event.type
      when 'achievement'
        badge = div className: 'profile-extra-entries__icon',
          el AchievementBadge,
            modifiers: ['recent-activity']
            achievement: event.achievement
            userAchievement:
              achieved_at: event.created_at
              achievement_id: event.achievement.id

        mappings =
          user:
            strong null, em null, link(event.user.url, event.user.username)
          achievement: strong null, event.achievement.name

      when 'beatmapPlaycount'
        mappings =
          beatmap: link(event.beatmap.url, event.beatmap.title)
          count: event.count

      when 'beatmapsetApprove'
        mappings =
          approval: osu.trans "events.beatmapset_status.#{event.approval}"
          beatmapset: link(event.beatmapset.url, event.beatmapset.title)
          user: strong null, link(event.user.url, event.user.username)

      when 'beatmapsetDelete'
        mappings =
          beatmapset: event.beatmapset.title

      when 'beatmapsetRevive'
        mappings =
          beatmapset: link(event.beatmapset.url, event.beatmapset.title)
          user: strong null, link(event.user.url, event.user.username)

      when 'beatmapsetUpdate'
        mappings =
          user: strong null, em null, link(event.user.url, event.user.username)
          beatmapset: em null, link(event.beatmapset.url, event.beatmapset.title)

      when 'beatmapsetUpload'
        mappings =
          beatmapset: link(event.beatmapset.url, event.beatmapset.title)
          user: strong null, em null, link(event.user.url, event.user.username)

      when 'medal'
        # shouldn't exist because the type is overridden to achievement.
        return

      when 'rank'
        badge = div
          className: "profile-extra-entries__icon"
          div
            className: "score-rank score-rank--#{event.scoreRank}"

        mappings =
          user: strong null, em null, link(event.user.url, event.user.username)
          rank: event.rank
          beatmap: em null, link(event.beatmap.url, event.beatmap.title)
          mode: osu.trans "beatmaps.mode.#{event.mode}"

      when 'rankLost'
        mappings =
          user: strong null, em null, link(event.user.url, event.user.username)
          rank: event.rank
          beatmap: em null, link(event.beatmap.url, event.beatmap.title)
          mode: osu.trans "beatmaps.mode.#{event.mode}"

      when 'userSupportAgain'
        mappings =
          user: strong null, link(event.user.url, event.user.username)

      when 'userSupportFirst'
        mappings =
          user: strong null, link(event.user.url, event.user.username)

      when 'userSupportGift'
        mappings =
          user: strong null, link(event.user.url, event.user.username)

      when 'usernameChange'
        mappings =
          user: strong null, em null, link(event.user.url, event.user.username)
          previousUsername: strong null, event.user.previousUsername

      else
        # unkown event
        return

    # default, empty badge
    badge ?= div className: 'profile-extra-entries__icon'

    li
      className: 'profile-extra-entries__item'
      key: event.id
      div
        className: 'profile-extra-entries__detail'
        badge
        div
          className: 'profile-extra-entries__text'
          el StringWithComponent,
            mappings: mappings
            # remove strip tags once translations are updated
            pattern: osu.trans("events.#{snakeCase(event.type)}").replace(/<[^>]*>/g, '')

      div
        className: 'profile-extra-entries__time'
        el TimeWithTooltip,
          dateTime: event.created_at
          relative: true
