# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import * as React from 'react'
import { div } from 'react-dom-factories'
import { nextVal } from 'utils/seq'
el = React.createElement

bn = 'notification-banner-v2'
notificationBanners = document.getElementsByClassName('js-notification-banners')

export class NotificationBanner extends React.PureComponent
  constructor: (props) ->
    super props

    @eventId = "notification-banner-#{nextVal()}"
    @createPortalContainer()


  componentDidMount: =>
    $(document).on "turbolinks:before-cache.#{@eventId}", @removePortalContainer


  componentWillUnmount: =>
    $(document).off ".#{@eventId}"
    @removePortalContainer()


  render: =>
    notification =
      div className: "#{bn} #{bn}--#{@props.type}",
        div className: "#{bn}__col #{bn}__col--icon"
        div className: "#{bn}__col #{bn}__col--label",
          div className: "#{bn}__type", @props.type
          div className: "#{bn}__text", @props.title
        div className: "#{bn}__col",
          div className: "#{bn}__text", @props.message
    ReactDOM.createPortal notification, @portalContainer


  removePortalContainer: =>
    @portalContainer.remove()


  createPortalContainer: =>
    @portalContainer = document.createElement 'div'
    notificationBanners[0].appendChild @portalContainer
