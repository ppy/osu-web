# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

class window.TurbolinksUjs
  constructor: ->
    @xhr = []

    $(document).on 'ajax:beforeSend', @record
    $(document).on 'turbolinks:before-cache', @abort


  abort: =>
    xhr?.abort() while xhr = @xhr.pop()


  record: (_event, xhr) =>
    @xhr.push xhr
