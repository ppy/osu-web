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

class ProfilePage.Info extends React.Component
  componentDidMount: ->
    osu.pageChange()


  componentDidUpdate: ->
    osu.pageChange()


  originKeys: =>
    keys = []
    if @props.user.country.name?
      keys.push 'country'
    if @props.user.age?
      keys.push 'age'

    return keys

  render: =>
    elements = ['twitter', 'skype', 'lastfm', 'playstyles']

    el 'div', className: 'page-contents__content profile-info',
      el 'div', className: 'profile-info__icons page-contents__row',
        if @props.user.isSupporter
          el 'div',
            className: 'user-icon forum__user-icon--supporter profile-info__icon'
            title: Lang.get 'users.show.is_supporter'
            el 'i', className: 'fa fa-heart'

      el 'div', className: 'page-contents__row',
        if @props.user.isSupporter
          el 'p', className: 'profile-info__title profile-info__title--supporter',
            Lang.get('users.show.is_supporter')

        if @props.user.title?
          el 'p', className: 'profile-info__title', @props.user.title

      el 'div', className: 'page-contents__row',
        if @originKeys().length
          el 'p', className: 'profile-info__location', null,
            Lang.get "users.show.origin.#{@originKeys().join('_')}",
              country: @props.user.country.name
              age: @props.user.age

        if @props.user.location
          el 'p', className: 'profile-info__location', null,
            Lang.get 'users.show.current_location', location: @props.user.location

      el 'p',
        className: 'page-contents__row'
        dangerouslySetInnerHTML: { __html: Lang.get 'users.show.lastvisit', date: osu.timeago(@props.user.lastvisit) }

      elements.map (m) =>
        return if !@props.user[m]
        switch m
          when 'twitter'
            dt = 'Twitter'
            dd = el 'a', href: "https://twitter.com/#{@props.user.twitter}", "@#{@props.user.twitter}"
          when 'skype'
            dt = 'Skype'
            dd = el 'a', href: "skype:#{@props.user.skype}?chat", @props.user.skype
          when 'lastfm'
            dt = 'Last.fm'
            dd = el 'a', href: "https://last.fm/user/#{@props.user.lastfm}", @props.user.lastfm
          when 'playstyles'
            dt = Lang.get 'users.show.plays_with._'
            dd = @props.user.playstyle.map (s) ->
                  Lang.get "users.show.plays_with.#{s}"
                 .join ', '

        el 'dl', key: m, className: 'page-contents__row',
          el 'dt', className: 'profile-info__data-key', dt
          el 'dd', className: 'profile-info__data-value', dd
