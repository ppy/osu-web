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

class @UserCard
  constructor: ->
    $(document).on 'mouseover', '.js-usercard', @onMouseOver

  onMouseOver: (event) =>
    el = event.currentTarget

    return if el._tooltip

    el._tooltip = true

    at = el.getAttribute('data-tooltip-position') ? 'right center'
    my = switch at
      when 'top center' then 'bottom center'
      when 'left center' then 'right center'
      when 'right center' then 'left center'

    options =
      style:
        def: false
        tip: false
        width: 280
        height: 130
      content:
        text: (event, api) ->
          userId = parseInt(el.getAttribute('data-user-id'))
          $.ajax
            url: laroute.route 'users.card', id: userId
          .then (content) ->
            if content
              api.set('content.text', content)

              api.tooltip.find('.usercard')
                .imagesLoaded({background: true})
                .progress (instance, image) ->
                  $(image.img).fadeTo(200, 1)
                .always (instance) ->
                  $(instance.elements[0]).find('.usercard__loader').fadeOut()

              # manually init the friend-button react component
              ReactDOM.render React.createElement(FriendButton, user_id: userId), api.tooltip.find('.js-react--friendButton')[0]
            else
              api.hide()
          , (xhr, status, error) ->
            api.set('content.text', status + ': ' + error)

          $('#js-usercard__loading-template').text()
      position:
        at: at
        my: my
        viewport: $(window)
      show:
        delay: 200
        effect: -> $(this).fadeTo(100, 1)
        ready: true
      hide:
        fixed: true
        delay: 200
        effect: -> $(this).fadeTo(100, 0)

    $(el).qtip options
