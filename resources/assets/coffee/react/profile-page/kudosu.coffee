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

{div, h3, ul, li, p, span} = ReactDOMFactories
el = React.createElement

class ProfilePage.Kudosu extends React.Component
  render: =>
    div className: 'page-extra',
      el ProfilePage.ExtraHeader, name: @props.name, withEdit: @props.withEdit

      div className: 'kudosu-box',
        el ValueDisplay,
          modifiers: ['kudosu']
          label: osu.trans('users.show.extra.kudosu.total')
          value: osu.formatNumber(@props.user.kudosu.total)
          description: span dangerouslySetInnerHTML:
            __html: osu.trans('users.show.extra.kudosu.total_info')

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

            post = osu.link kudosu.post?.url,
              kudosu.post?.title
              classNames: ['profile-extra-entries__link profile-extra-entries__link--kudosu']

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
              modifiers: ['profile-page', 't-community-user-graygreen-darker']
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
