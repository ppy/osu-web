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
        height: 100
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

          '<div class="usercard" style="background-image: url(/images/layout/beatmaps/default-bg.png);">
              <div class="usercard__background-overlay"></div>
              <div class="usercard__link-wrapper">
                  <div class="usercard__main-card">
                      <div class="usercard__avatar-space">
                        <div class="usercard__loader">
                          <i class="fa fa-fw fa-refresh fa-spin"></i>
                        </div>
                      </div>
                      <div class="usercard__metadata">
                          <div class="usercard__username">Loading...</div>
                          <div class="usercard__flags">
                            <span class="flag-country" style="background-image: url(/images/flags/XX.png);"></span>
                          </div>
                      </div>
                  </div>
                  <div class="usercard__status-bar usercard__status-bar--offline">
                      <span class="fa fa-fw fa-circle-o usercard__status-icon"></span>
                      <span class="usercard__status-message">Offline</span>
                  </div>
              </div>
          </div>'
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
