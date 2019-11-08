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

import ClickToCopy from 'click-to-copy'
import * as React from 'react'
import { a, div, span } from 'react-dom-factories'
el = React.createElement


export class Links extends React.PureComponent
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
    twitter: (val) ->
      icon: 'fab fa-twitter'
      url: "https://twitter.com/#{val}"
      text: "@#{val}"
    discord: (val) ->
      icon: 'fab fa-discord'
      text:
        el ClickToCopy, value: val, showIcon: true
    interests: ->
      icon: 'far fa-heart'
    skype: (val) ->
      icon: 'fab fa-skype'
      url: "skype:#{val}?chat"
    lastfm: (val) ->
      icon: 'fab fa-lastfm'
      url: "https://last.fm/user/#{val}"
    location: ->
      icon: 'fas fa-map-marker-alt'
    occupation: ->
      icon: 'fas fa-suitcase'
    website: (val) ->
      icon: 'fas fa-link'
      url: val
      text: val.replace(/^https?:\/\//, '')


  textMapping =
    join_date: (val) ->
      joinDate = moment(val)
      joinDateTitle = joinDate.toISOString()

      if joinDate.isBefore moment.utc([2008])
        title: joinDateTitle
        extraClasses: 'js-tooltip-time'
        html: osu.trans 'users.show.first_members'
      else
        html: osu.trans 'users.show.joined_at',
          date: rowValue joinDate.format(osu.trans('common.datetime.year_month.moment')),
            className: 'js-tooltip-time'
            title: joinDateTitle

    last_visit: (val, user) ->
      return html: osu.trans('users.show.lastvisit_online') if user.is_online

      html: osu.trans 'users.show.lastvisit',
        date: rowValue osu.timeago(val)

    playstyle: (val) ->
      playsWith = val.map (s) ->
        osu.trans "common.device.#{s}"
      .join ', '

      html: osu.trans 'users.show.plays_with', devices: rowValue(playsWith)

    post_count: (val, user) ->
      count = osu.transChoice 'users.show.post_count.count', osu.formatNumber(val)
      url = laroute.route('users.posts', user: user.id)

      html:
        osu.trans 'users.show.post_count._', link: rowValue(count, href: url)


  render: =>
    rows = [
      ['join_date', 'last_visit', 'playstyle', 'post_count'].map @renderText
      ['location', 'interests', 'occupation'].map @renderLink
      ['twitter', 'discord', 'skype', 'lastfm', 'website'].map @renderLink
    ]

    div className: bn,
      for row, j in rows when _.compact(row).length > 0
        div key: j, className: "#{bn}__row #{bn}__row--#{j}", row


  renderLink: (key) =>
    value = @props.user[key]

    return unless value?

    {url, icon, text, title} = linkMapping[key](value)

    title ?= osu.trans "users.show.info.#{key}"
    text ?= value

    componentClass = "#{bn}__value"

    if url?
      component = a
      componentClass += " #{bn}__value--link"
    else
      component = span

    div
      className: "#{bn}__item"
      key: key

      span
        className: "#{bn}__icon"
        title: title
        span className: "fa-fw #{icon}"

      component
        href: url
        className: componentClass
        text


  renderText: (key) =>
    value = @props.user[key]

    return unless value?

    {extraClasses, html, title} = textMapping[key](value, @props.user)

    div
      className: "#{bn}__item #{extraClasses ? ''}"
      key: key
      title: title
      dangerouslySetInnerHTML:
        __html: html
