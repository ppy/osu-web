###
#    Copyright 2015-2017 ppy Pty. Ltd.
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

el = React.createElement

class ProfilePage.Kudosu extends React.Component
  render: =>
    el 'div',
      className: 'page-extra'

      el ProfilePage.ExtraHeader, name: @props.name, withEdit: @props.withEdit

      el 'div', className: 'kudosu-box',
        el 'div', className: 'kudosu-box__content',
          el 'h3', className: 'kudosu-box__title',
            "#{osu.trans('users.show.extra.kudosu.total')}: "
            el 'span', className: 'kudosu-box__count', @props.user.kudosu.total
          el 'p', dangerouslySetInnerHTML:
            __html: osu.trans('users.show.extra.kudosu.total_info')
        el 'div', className: 'kudosu-box__content',
          el 'h3', className: 'kudosu-box__title',
            "#{osu.trans('users.show.extra.kudosu.available')}: "
            el 'span', className: 'kudosu-box__count', @props.user.kudosu.available
          el 'p', null, osu.trans('users.show.extra.kudosu.available_info')

      el 'div', className: 'kudosu-entries',
        el 'h3', className: 'kudosu-entries__title',
          osu.trans('users.show.extra.kudosu.recent_entries')

        if @props.recentlyReceivedKudosu.length
          el 'ul', className: 'profile-extra-entries',
            for kudosu in @props.recentlyReceivedKudosu
              continue if !kudosu.id?

              giver =
                if kudosu.giver?
                  osu.link kudosu.giver.url,
                    kudosu.giver.username
                    classNames: ['kudosu-entries__link']
                else
                  _.escape osu.trans('users.deleted')

              post = osu.link kudosu.post?.url,
                kudosu.post?.title
                classNames: ['kudosu-entries__link']

              el 'li', key: "kudosu-#{kudosu.id}", className: 'profile-extra-entries__item',
                el 'div', className: 'profile-extra-entries__detail',
                  el 'div',
                    className: 'profile-extra-entries__text'
                    dangerouslySetInnerHTML:
                      __html: osu.trans "users.show.extra.kudosu.entry.#{kudosu.model}.#{kudosu.action}",
                        amount: "<strong class='kudosu-entries__amount'>#{osu.trans 'users.show.extra.kudosu.entry.amount', amount: Math.abs(kudosu.amount)}</strong>"
                        giver: giver
                        post: post
                el 'div',
                  className: 'profile-extra-entries__time'
                  dangerouslySetInnerHTML: { __html: osu.timeago(kudosu.created_at) }
        else
          el 'div', className: 'profile-extra-entries', osu.trans('users.show.extra.kudosu.entry.empty')
