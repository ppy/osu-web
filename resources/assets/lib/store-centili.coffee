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

export class StoreCentili
  widget = '#c-mobile-payment-widget'

  ####################################################
  # This junk is stupid hack for a loading overlay
  # while the Centili script loads EVEN MORE SCRIPTS
  ####################################################
  needsTriggerClick = false
  fancyboxes = []
  hasWidget = ->
    document.querySelector(widget)

  observer = new MutationObserver (mutations) ->
    mutations.forEach (mutation) ->
      hasFrame = false
      hasContent = false
      for node in mutation.addedNodes
        _.startsWith(node.id, 'fancybox-') && fancyboxes.push(node)
        hasFrame |= node.id == 'fancybox-frame'
        hasContent |= node.id == 'fancybox-content'

      hasFrame && window.LoadingOverlay.hide()
      if hasContent && needsTriggerClick
        # Queue up a click event if the loading completed after clicking
        Timeout.set 0, ->
          window.centiliJQuery(widget).trigger('click')

  $(document).on 'turbolinks:load', ->
    if hasWidget()
      observer.observe document.body, childList: true, subtree: true
      # If the centili global exists at load, we probably destroyed the previous fancyboxes.
      window.centili && !fancyboxes.length && window.centili.loadFancyBox()

  $(document).on 'turbolinks:before-cache', ->
    hasWidget() && deleteFancyboxes()

  deleteFancyboxes = ->
    # force reset or else fancybox will automatically display
    needsTriggerClick = false
    $(fancyboxes).remove()
    fancyboxes = []

  ####################################################
  # End stupid
  ####################################################

  @promiseInit: ->
    # Load Centili scripts and css async.
    Promise.all([
      StoreCentili.fetchScript('w_o-0.4.js'),
      StoreCentili.fetchScript('postmessage2.js'),
      StoreCentili.fetchStyle('fancybox/jquery.fancybox-1.3.4.css'),
    ])

  @fetchScript: (name) ->
    new Promise (resolve, reject) ->
      loading = window.turbolinksReload.load "https://www.centili.com/widget/js/#{name}", resolve
      resolve() unless loading

  @fetchStyle: (name) ->
    new Promise (resolve, reject) ->
      link = document.createElement('link')
      link.rel = 'stylesheet'
      link.type = 'text/css'
      link.href = "https://www.centili.com/widget/#{name}"
      link.media = 'screen'
      link.addEventListener 'load', resolve, false

      document.body.appendChild(link)

  @fakeClick: ->
    window.LoadingOverlay.show()
    window.LoadingOverlay.show.flush()
    needsTriggerClick = true
    if window.centiliJQuery
      window.centiliJQuery(widget).trigger('click')
