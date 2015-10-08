###
# Copyright 2015 ppy Pty. Ltd.
#
# This file is part of osu!web. osu!web is distributed with the hope of
# attracting more community contributions to the core ecosystem of osu!.
#
# osu!web is free software: you can redistribute it and/or modify
# it under the terms of the Affero GNU General Public License as published by
# the Free Software Foundation, either version 3 of the License, or
# (at your option) any later version.
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
    if @props.user.country.name != null
      keys.push 'country'
    if @props.user.age != null
      keys.push 'age'

    return keys


  render: =>
    el 'div', className: 'profile-content flex-col-33',
      el 'div', className: 'profile-icons profile-row',
        if @props.user.isSupporter
          el 'div',
            className: 'user-icon forum__user-icon--supporter profile-icon'
            title: Lang.get 'users.show.is_supporter'
            el 'i', className: 'fa fa-heart'

      el 'div', className: 'profile-icons profile-row',
        if @props.user.country.code
          el 'span',
            className: 'flag-country'
            title: @props.user.country.name
            style:
              backgroundImage: "url('/images/flags/#{@props.user.country.code}.png')"

      el 'div', className: 'compact profile-row',
        if @props.user.isSupporter
          el 'p', className: 'profile-title profile-title--supporter',
            Lang.get('users.show.is_supporter')

        if @props.user.title != null
          el 'p', className: 'profile-title', @props.user.title

      el 'div', className: 'compact profile-row',
        if @originKeys().length
          el 'p', null,
            Lang.get "users.show.origin.#{@originKeys().join('_')}",
              country: @props.user.country.name
              age: @props.user.age

        if @props.user.location
          el 'p', null,
            Lang.get 'users.show.current_location', location: @props.user.location

      el 'p',
        className: 'profile-row'
        dangerouslySetInnerHTML:
          __html: Lang.get 'users.show.lastvisit', date: osu.timeago(@props.user.lastvisit)

      if @props.user.twitter
        el 'dl', className: 'profile-data profile-row',
          el 'dt', null, 'Twitter'
          el 'dd', null,
            el 'a', href: "https://twitter.com/#{@props.user.twitter}",
              "@#{@props.user.twitter}"

      if @props.user.skype
        el 'dl', className: 'profile-data profile-row',
          el 'dt', null, 'Skype'
          el 'dd', null,
            el 'a', href: "skype:#{@props.user.skype}?chat", @props.user.skype

      if @props.user.lastfm
        el 'dl', className: 'profile-data profile-row',
          el 'dt', null, 'Last.fm'
          el 'dd', null,
            el 'a', href: "https://last.fm/user/#{@props.user.lastfm}",
              @props.user.lastfm

      if @props.user.playstyle.length
        el 'dl', className: 'profile-data profile-row',
          el 'dt', null, Lang.get('users.show.plays_with._')
          el 'dd', null,
            @props.user.playstyle.map (s) ->
              Lang.get "users.show.plays_with.#{s}"
            .join ', '
