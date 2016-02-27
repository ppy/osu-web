###
# Copyright 2015 ppy Pty. Ltd.
#
# This file is part of osu!web. osu!web is distributed with the hope of
# attracting more community contributions to the core ecosystem of osu!.
#
# osu!web is free software: you can redistribute it and/or modify
# it under the terms of the Affero GNU General Public License version 3
# as published by the Free Software Foundation.
#
# osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
# warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
# See the GNU Affero General Public License for more details.
#
# You should have received a copy of the GNU Affero General Public License
# along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
###
el = React.createElement

class ProfilePage.Kudosu extends React.Component
  render: =>
    el 'div',
      className: 'profile-extra'

      @props.header

      el 'div', className: 'kudosu-box',
        el 'div', className: 'kudosu-box__content',
          el 'h3', className: 'kudosu-box__title',
            "#{Lang.get('users.show.extra.kudosu.total')}: "
            el 'span', className: 'kudosu-box__count', @props.user.kudosu.total
          el 'p', dangerouslySetInnerHTML:
            __html: Lang.get('users.show.extra.kudosu.total_info')
        el 'div', className: 'kudosu-box__content',
          el 'h3', className: 'kudosu-box__title',
            "#{Lang.get('users.show.extra.kudosu.available')}: "
            el 'span', className: 'kudosu-box__count', @props.user.kudosu.available
          el 'p', null, Lang.get('users.show.extra.kudosu.available_info')

      el 'div', className: 'kudosu-entries',
        el 'h3', className: 'kudosu-entries__title',
          Lang.get('users.show.extra.kudosu.recent_entries')

        if @props.recentlyReceivedKudosu.length
          el 'ul', className: 'profile-extra-entries',
            @props.recentlyReceivedKudosu.map (kudosu) =>
              return null unless kudosu.action == 'give' || kudosu.action == 'revoke'
              el 'li', key: "kudosu-#{kudosu.id}", className: 'profile-extra-entries__item',
                el 'div', className: 'profile-extra-entries__detail',
                  el 'div',
                    className: 'profile-extra-entries__text'
                    dangerouslySetInnerHTML:
                      __html: Lang.get "users.show.extra.kudosu.entry.#{kudosu.action}",
                        amount: kudosu.amount
                        giver: osu.link(kudosu.giver.url, kudosu.giver.name, classNames: ['kudosu-entries__link'])
                        post: osu.link(kudosu.post.url, kudosu.post.title, classNames: ['kudosu-entries__link'])
                el 'div',
                  className: 'profile-extra-entries__time'
                  dangerouslySetInnerHTML: { __html: osu.timeago(kudosu.createdAt) }
        else
          el 'div', className: 'profile-extra-entries', Lang.get('users.show.extra.kudosu.entry.empty')
