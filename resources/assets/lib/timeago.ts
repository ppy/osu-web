# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

class @Timeago
  constructor: ->
    @observer = new MutationObserver (mutations) ->
      # Third-party scripts may init conflicting versions of jquery
      return unless $.fn.timeago

      mutations.forEach (mutation) ->
        $nodes = $(mutation.addedNodes)
        $nodes.find('.js-timeago').add($nodes.filter('.js-timeago')).timeago()


    $(document).on 'turbolinks:load', =>
      $('.js-timeago').timeago()
      @observer.observe document.body, childList: true, subtree: true
