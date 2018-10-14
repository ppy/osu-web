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

# Anchor navigation with turbolinks. Works around [1].
# [1] https://github.com/turbolinks/turbolinks/issues/75
$(document).on 'click', 'a[href^="#"]', (e) ->
  href = e.currentTarget.href
  targetId = decodeURIComponent href[href.indexOf('#') + 1..]
  target = document.getElementById targetId

  return if !target?

  e.preventDefault()
  target.scrollIntoView()


# Monkey patch Turbolinks to render 403, 404, and 500 normally
# Reference: https://github.com/turbolinks/turbolinks/issues/179
Turbolinks.HttpRequest::requestLoaded = ->
  @endRequest =>
    if 200 <= @xhr.status < 300 || @xhr.status in [403, 404, 500]
      @delegate.requestCompletedWithResponse(@xhr.responseText, @xhr.getResponseHeader("Turbolinks-Location"))
    else
      @failed = true
      @delegate.requestFailedWithStatusCode(@xhr.status, @xhr.responseText)


# may or may not actually work
Turbolinks.Controller::advanceHistory = (url) ->
  return if url == document.location.href

  @cacheSnapshot()
  @lastRenderedLocation = Turbolinks.Location.wrap(url)
  @pushHistoryWithLocationAndRestorationIdentifier url, Turbolinks.uuid()


# Ignore anchor check on loading snapshot to prevent repeating requesting page
# when the target doesn't exist.
Turbolinks.Snapshot::hasAnchor = -> true

Turbolinks.Controller::locationIsVisitable = (location) ->
  location.isPrefixedBy(@view.getRootLocation()) && Url.isInternal(location) && Url.isHTML(location)
