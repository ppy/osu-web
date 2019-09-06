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

import { ExtraHeader } from './extra-header'
import * as React from 'react'
import { a, div, h3, ul, li, p, span } from 'react-dom-factories'
import { ShowMoreLink } from 'show-more-link'
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
                  href: laroute.route('wiki.show', page: 'Kudosu')
                  key: 'link'
                  osu.trans 'users.show.extra.kudosu.total_info.link'
              pattern: osu.trans('users.show.extra.kudosu.total_info._')

        el ValueDisplay,
          modifiers: ['kudosu']
          label: osu.trans('users.show.extra.kudosu.available')
          value: osu.formatNumber(@props.user.kudosu.available)
          description: osu.trans('users.show.extra.kudosu.available_info')

      if @props.recentlyReceivedKudosu?.length
        ul className: 'profile-extra-entries profile-extra-entries--kudosu',
          for kudosu in @props.recentlyReceivedKudosu
            continue if !kudosu.id?

            giver =
              if kudosu.giver?
                osu.link kudosu.giver.url,
                  kudosu.giver.username
                  classNames: ['profile-extra-entries__link profile-extra-entries__link--kudosu']
              else
                _.escape osu.trans('users.deleted')

            post =
              if kudosu.post?.url?
                osu.link kudosu.post?.url,
                  kudosu.post?.title
                  classNames: ['profile-extra-entries__link profile-extra-entries__link--kudosu']
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
