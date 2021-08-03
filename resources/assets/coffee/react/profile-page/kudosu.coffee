# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import { ExtraHeader } from './extra-header'
import OsuUrlHelper from 'osu-url-helper'
import * as React from 'react'
import { a, div, h3, ul, li, p, span } from 'react-dom-factories'
import ShowMoreLink from 'show-more-link'
import { StringWithComponent } from 'string-with-component'
import { ValueDisplay } from 'value-display'
el = React.createElement

export class Kudosu extends React.Component
  render: =>
    div className: 'page-extra',
      el ExtraHeader, name: @props.name, withEdit: @props.withEdit

      div className: 'kudosu-box',
        el ValueDisplay,
          modifiers: ['kudosu']
          label: osu.trans('users.show.extra.kudosu.total')
          value: osu.formatNumber(@props.user.kudosu.total)
          description:
            el StringWithComponent,
              mappings:
                ':link': a
                  href: OsuUrlHelper.wikiUrl('Kudosu')
                  key: 'link'
                  osu.trans 'users.show.extra.kudosu.total_info.link'
              pattern: osu.trans('users.show.extra.kudosu.total_info._')

      if @props.recentlyReceivedKudosu?.length
        ul className: 'profile-extra-entries profile-extra-entries--kudosu',
          for kudosu in @props.recentlyReceivedKudosu
            continue if !kudosu.id?

            giver =
              if kudosu.giver?
                osu.link kudosu.giver.url, kudosu.giver.username
              else
                _.escape osu.trans('users.deleted')

            post =
              if kudosu.post?.url?
                osu.link kudosu.post?.url, kudosu.post?.title
              else
                kudosu.post?.title

            li key: "kudosu-#{kudosu.id}", className: 'profile-extra-entries__item',
              div className: 'profile-extra-entries__detail',
                div className: 'profile-extra-entries__text', dangerouslySetInnerHTML:
                  __html: osu.trans "users.show.extra.kudosu.entry.#{kudosu.model}.#{kudosu.action}",
                    amount: "<strong class='profile-extra-entries__kudosu-amount'>#{osu.trans 'users.show.extra.kudosu.entry.amount', amount: Math.abs(kudosu.amount)}</strong>"
                    giver: giver
                    post: post
              div className: 'profile-extra-entries__time', dangerouslySetInnerHTML:
                __html: osu.timeago(kudosu.created_at)

          li className: 'profile-extra-entries__item',
            el ShowMoreLink,
              modifiers: ['profile-page', 't-greyseafoam-dark']
              event: 'profile:showMore'
              hasMore: @props.pagination.recentlyReceivedKudosu.hasMore
              loading: @props.pagination.recentlyReceivedKudosu.loading
              data:
                name: 'recentlyReceivedKudosu'
                url: laroute.route 'users.kudosu', user: @props.user.id

      else
        div
          className: 'profile-extra-entries profile-extra-entries--kudosu'
          osu.trans('users.show.extra.kudosu.entry.empty')
