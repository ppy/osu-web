###
Copyright 2015 ppy Pty. Ltd.

This file is part of osu!web. osu!web is distributed with the hope of
attracting more community contributions to the core ecosystem of osu!.

osu!web is free software: you can redistribute it and/or modify
it under the terms of the Affero GNU General Public License version 3
as published by the Free Software Foundation.

osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
See the GNU Affero General Public License for more details.

You should have received a copy of the GNU Affero General Public License
along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
###
@osu =
  isIos: /iPad|iPhone|iPod/.test(navigator.platform)

  setHash: (newHash) ->
    newUrl = location.href.replace /#.*/, ''
    newUrl += newHash

    return if newUrl == location.href

    history.replaceState history.state, null, newUrl


  bottomPage: ->
    document.body.clientHeight == (document.body.scrollHeight - document.body.scrollTop)


  ajaxError: (xhr) ->
    message = xhr?.responseJSON?.error

    unless message
      errorKey = "errors.codes.http-#{xhr?.status}"
      message = Lang.get errorKey
      message = Lang.get 'errors.unknown' if message == errorKey

    osu.popup message, 'danger'


  pageChange: ->
    callback = -> $(document).trigger('osu:page:change')
    setTimeout callback, 0


  parseJson: (id) ->
    JSON.parse document.getElementById(id).text


  isMobile: -> ! window.matchMedia('(min-width: 920px)').matches

  src2x: (mainUrl) ->
    src: mainUrl
    srcSet: "#{mainUrl} 1x, #{mainUrl.replace(/(\.[^.]+)$/, '@2x$1')} 2x"

  link: (url, text, options = {}) ->
    el = document.createElement('a')
    el.setAttribute 'href', url
    el.setAttribute 'data-remote', true if options.isRemote
    el.className = options.classNames.join(' ') if options.classNames
    el.textContent = text
    el.outerHTML

  linkify: (text) ->
    regex = /(https?:\/\/(?:(?:[a-z0-9]\.|[a-z0-9][a-z0-9-]*[a-z0-9]\.)*[a-z][a-z0-9-]*[a-z0-9](?::\d+)?)(?:(?:(?:\/+(?:[a-z0-9$_\.\+!\*',;:@&=-]|%[0-9a-f]{2})*)*(?:\?(?:[a-z0-9$_\.\+!\*',;:@&=-]|%[0-9a-f]{2})*)?)?(?:#(?:[a-z0-9$_\.\+!\*',;:@&=-]|%[0-9a-f]{2})*)?)?)/ig
    return text.replace(regex, '<a href="$1" rel="nofollow">$1</a>')

  timeago: (time) ->
    el = document.createElement('time')
    el.classList.add 'timeago-raw', 'timeago'
    el.setAttribute 'datetime', time
    el.textContent = time
    el.outerHTML


  initTimeago: ->
    $('.timeago-raw').timeago().removeClass 'timeago-raw'


  timeago: (time) ->
    el = document.createElement('time')
    el.classList.add 'timeago-raw', 'timeago'
    el.setAttribute 'datetime', time
    el.textContent = time
    el.outerHTML


  reloadPage: (keepScroll = true) ->
    $(document).off '.ujsHideLoadingOverlay'
    Turbolinks.clearCache()

    url =
      if !_.isEmpty window.reloadUrl
        window.reloadUrl
      else
        location.href

    window.reloadUrl = null

    osu.navigate url, keepScroll, action: 'replace'


  navigate: (url, keepScroll, {action = 'advance'} = {}) ->
    osu.keepScrollOnLoad() if keepScroll
    Turbolinks.visit url, action: action


  keepScrollOnLoad: ->
    position = [
      window.pageXOffset
      window.pageYOffset
    ]

    $(document).one 'turbolinks:load', ->
      window.scrollTo position[0], position[1]


  popup: (message, type = 'info') ->
    $popup = $('#popup-container')
    $alert = $('.popup-clone').clone()

    closeAlert = -> $alert.click()

    # handle types of alerts by changing the colour
    $alert.addClass('alert-' + type).addClass('popup-active').removeClass 'popup-clone'
    $alert.find('.popup-text').html message

    # warning/danger messages stay forever until clicked
    if type == 'warning' or type == 'danger'
      $('#overlay').off('click.close-alert').one('click.close-alert', closeAlert).fadeIn()
    else
      setTimeout closeAlert, 5000

    $alert.appendTo($popup).fadeIn()


  api: (method, route, params, args = {}, callback = console.log) ->
    base = '/api/'
    if method.toLowerCase() == 'put' or method.toLowerCase() == 'delete'
      args._method = method
      method = 'POST'

    url = base + route

    if params
      url = "#{url}/#{params.join('/')}"

    $.ajax
      url: url
      type: method
      dataType: 'json'
      data: args
      success: (data) ->
        if data.error
          # ya dun goof'd
          callback data.error
        else if data.success
          callback data.success
        else if data.url
          osu.navigate null, 'loading...', url
        else
          console.log data

      error: (error) -> console.log error


  loadMore: (objectName, offset) ->
    collectionName = "#{objectName}s"
    areaId = "##{collectionName}"
    objectClass = ".#{objectName}"

    $.ajax
      url: "#{document.URL}/ajax?offset=#{offset}"
      dataType: 'json'
      success: (data, textStatus, jqXHR) ->
        area = $(areaId)
        template = area.find("#{objectClass}:first")
        templateId = template.attr('objectid')

        $.each data, (k, v) ->
          return unless k == collectionName

          $.each v, (index, object) ->
            o = template.clone()
            first = true
            $.each object, (k, v) ->
              if first
                o.html template.html().replace(templateId, v)
                o.attr 'href', o.attr('href').replace(templateId, v)
                first = false
              else
                o.find("[ref=#{k}]").html v

            area.append o
