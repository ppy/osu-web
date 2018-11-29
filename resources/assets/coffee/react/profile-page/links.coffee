###
#    Copyright 2015-2018 ppy Pty. Ltd.
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

{a, div, span} = ReactDOMFactories
el = React.createElement


class ProfilePage.Links extends React.PureComponent
  bn = 'profile-links'

  rowValue = (value, attributes = {}, modifiers = []) ->
    if attributes.href?
      tagName = 'a'
      modifiers.push 'link'
    else
      tagName = 'span'

    elem = document.createElement(tagName)
    elem[k] = v for own k, v of attributes
    elem.className += " #{osu.classWithModifiers "#{bn}__value", modifiers}"
    elem.innerHTML = value

    elem.outerHTML


  linkMapping =
    twitter:
      icon: 'fab fa-twitter'
      url: (val) -> "https://twitter.com/#{val}"
      text: (val) -> "@#{val}"
    discord:
      icon: 'fab fa-discord'
      text: (val) ->
        el ClickToCopy, value: val, modifiers: ['profile-header-extra']
    interests:
      icon: 'far fa-heart'
    skype:
      icon: 'fab fa-skype'
      url: (val) -> "skype:#{val}?chat"
    lastfm:
      icon: 'fab fa-lastfm'
      url: (val) -> "https://last.fm/user/#{val}"
    location:
      icon: 'fas fa-map-marker-alt'
    occupation:
      icon: 'fas fa-suitcase'
    website:
      icon: 'fas fa-link'
      url: (val) -> val
      text: (val) -> val.replace(/^https?:\/\//, '')


  render: =>
    rows = [
      [
        @renderJoinDate()
        @renderLastVisit()
        @renderPlaystyle()
        @renderPostCount()
      ]
      [
        @renderLink 'location'
        @renderLink 'interests'
        @renderLink 'occupation'
      ]
      [
        @renderLink 'twitter'
        @renderLink 'discord'
        @renderLink 'skype'
        @renderLink 'lastfm'
        @renderLink 'website'
      ]
    ]

    div className: bn,
      for row, j in rows when _.compact(row).length > 0
        div key: j, className: "#{bn}__row #{bn}__row--#{j}", row


  renderJoinDate: =>
    joinDate = moment(@props.user.join_date)
    joinDateTitle = joinDate.format('LL')

    if joinDate.isBefore moment('2008-01-01')
      div
        className: "#{bn}__item"
        key: 'join_date'
        title: joinDateTitle
        osu.trans 'users.show.first_members'
    else
      div
        className: "#{bn}__item"
        key: 'join_date'
        dangerouslySetInnerHTML:
          __html:
            osu.trans 'users.show.joined_at',
              date: rowValue joinDate.format(osu.trans('common.datetime.year_month.moment')), title: joinDateTitle


  renderLastVisit: =>
    value = @props.user.last_visit

    return unless value?

    div
      className: "#{bn}__item"
      key: 'last_visit'
      dangerouslySetInnerHTML:
        __html:
          osu.trans 'users.show.lastvisit',
            date: rowValue osu.timeago(value)


  renderLink: (key) =>
    value = @props.user[key]

    return unless value?

    {url, icon, text, title} = linkMapping[key]

    componentClass = "u-ellipsis-overflow #{bn}__value"

    if url?
      component = a
      componentClass += " #{bn}__value--link"
      href = url(value)
    else
      component = span

    title ?= osu.trans "users.show.info.#{key}"

    div
      className: "#{bn}__item"
      key: key

      span
        className: "#{bn}__icon"
        title: title
        span className: "fa-fw #{icon}"

      component
        href: href
        className: componentClass
        text?(value) ? value

  renderPlaystyle: =>
    value = @props.user.playstyle

    return unless value?

    playsWith = value.map (s) ->
      osu.trans "common.device.#{s}"
    .join ', '

    div
      className: "#{bn}__item"
      key: 'playstyle'
      dangerouslySetInnerHTML:
        __html:
          osu.trans 'users.show.plays_with',
            devices: rowValue playsWith


  renderPostCount: =>
    count = osu.transChoice 'users.show.post_count.count', @props.user.post_count.toLocaleString()
    url = laroute.route('users.posts', user: @props.user.id)

    div
      className: "#{bn}__item"
      key: 'post_count'
      dangerouslySetInnerHTML:
        __html:
          osu.trans 'users.show.post_count._',
            link: rowValue count, href: url
