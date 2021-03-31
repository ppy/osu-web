# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

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
    location: ->
      icon: 'fas fa-map-marker-alt'
    occupation: ->
      icon: 'fas fa-suitcase'
    website: (val) ->
      icon: 'fas fa-link'
      url: val
      text: val.replace(/^https?:\/\//, '')


  textMapping =
    comments_count: (val, user) ->
      count = osu.transChoice 'users.show.comments_count.count', val
      url = laroute.route('comments.index', user_id: user.id)

      html:
        osu.trans 'users.show.comments_count._', link: rowValue(count, href: url)

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
      count = osu.transChoice 'users.show.post_count.count', val
      url = laroute.route('users.posts', user: user.id)

      html:
        osu.trans 'users.show.post_count._', link: rowValue(count, href: url)


  render: =>
    rows = [
      ['join_date', 'last_visit', 'playstyle', 'post_count', 'comments_count'].map @renderText
      ['location', 'interests', 'occupation'].map @renderLink
      ['twitter', 'discord', 'website'].map @renderLink
    ]

    div className: bn,
      for row, j in rows when _.compact(row).length > 0
        div key: j, className: "#{bn}__row #{bn}__row--#{j}", row

      if @props.user.id == currentUser.id
        div
          className: "#{bn}__edit"
          a
            className: 'profile-page-toggle'
            href: laroute.route('account.edit')
            title: osu.trans('users.show.page.button')
            span className: 'fas fa-pencil-alt'


  renderLink: (key) =>
    value = @props.user[key]

    return unless value?

    {url, icon, text, title} = linkMapping[key](value)

    title ?= osu.trans "users.show.info.#{key}"
    text ?= value

    componentClass = "#{bn}__value"

    component = if url? then a else span

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
