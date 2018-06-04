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

class @TurbolinksDisqus
  constructor: (@turbolinksReload) ->
    # FIXME: remove this when disqus stops overriding _
    @origLodash = _

    @el = document.getElementsByClassName('js-turbolinks-disqus')

    addEventListener 'turbolinks:load', @initialize
    $.subscribe 'turbolinksDisqusReload', @initialize


  attributes: =>
    JSON.parse @el[0].dataset.turbolinksDisqus


  buildConfig: =>
    attrs = @attributes()

    ->
      @page.shortname = disqusShortName
      @page.url = document.location.href
      @page.identifier = attrs.identifier
      @page.title = attrs.title

      if currentUser.disqus_auth?
        @page.remote_auth_s3 = currentUser.disqus_auth.auth_data
        @page.api_key = currentUser.disqus_auth.public_key


  prepareContainer: =>
    content = document.createElement('div')
    content.id = 'disqus_thread'

    container = @el[0]

    container.removeChild(container.firstChild) while container.firstChild
    container.appendChild(content)


  initialize: =>
    return if @el.length == 0

    @prepareContainer()

    if !DISQUS?
      @initializeEmbed()
    else
      @reload()


  initializeEmbed: =>
    window.disqus_config = @buildConfig()
    @turbolinksReload.load "https://#{disqusShortName}.disqus.com/embed.js", =>
      # FIXME: remove this when disqus stops overriding _
      window._ = @origLodash


  reload: =>
    DISQUS.reset
      reload: true
      config: @buildConfig()
