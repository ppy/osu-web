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

import * as React from 'react'
import { div } from 'react-dom-factories'
el = React.createElement

bn = 'notification-banner-v2'
notificationBanners = document.getElementsByClassName('js-notification-banners')

export class NotificationBanner extends React.PureComponent
  constructor: (props) ->
    super props

    @eventId = "notification-banner-#{osu.uuid()}"
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
    notificationBanners[0].removeChild @portalContainer


  createPortalContainer: =>
    @portalContainer = document.createElement 'div'
    notificationBanners[0].appendChild @portalContainer
