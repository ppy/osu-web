###
# Copyright 2015 ppy Pty. Ltd.
#
# This file is part of osu!web. osu!web is distributed with the hope of
# attracting more community contributions to the core ecosystem of osu!.
#
# osu!web is free software: you can redistribute it and/or modify
# it under the terms of the Affero GNU General Public License version 3
# as published by the Free Software Foundation.
#
# osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
# warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
# See the GNU Affero General Public License for more details.
#
# You should have received a copy of the GNU Affero General Public License
# along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
###

LocalStoragePolyfill.fillIn()
CustomEventPolyfill.fillIn()

# loading animation overlay
# fired from turbolinks
$(document).on 'turbolinks:request-start', LoadingOverlay.show
$(document).on 'turbolinks:request-end', LoadingOverlay.hide
# form submission is not covered by turbolinks
$(document).on 'submit', 'form', LoadingOverlay.show


@currentUserObserver ?= new CurrentUserObserver
@reactTurbolinks ||= new ReactTurbolinks
@twitchPlayer ?= new TwitchPlayer
@landingGraph ?= new LandingGraph
@landingHero ?= new LandingHero
@timeago ?= new Timeago
@osuLayzr ?= new OsuLayzr
@nav ?= new Nav
@userLogin ?= new UserLogin(@nav)
@throttledWindowEvents ?= new ThrottledWindowEvents
@checkboxValidation ?= new CheckboxValidation
@formToggle ?= new FormToggle


$(document).on 'ready turbolinks:load', =>

  @editorZoom ||= new EditorZoom
  @stickyFooter ||= new StickyFooter
  @stickyHeader ||= new StickyHeader
  @globalDrag ||= new GlobalDrag
  @gallery ||= new Gallery
  @formPlaceholderHide ||= new FormPlaceholderHide
  @tooltipDefault ||= new TooltipDefault

  @syncHeight ||= new SyncHeight

  @forum ||= new Forum
  @forumAutoClick ||= new ForumAutoClick
  @forumPostsSeek ||= new ForumPostsSeek(@forum)
  @forumSearchModal ||= new ForumSearchModal(@forum)
  @forumTopicPostJump ||= new ForumTopicPostJump(@forum)
  @forumTopicReply ||= new ForumTopicReply(@forum, @stickyFooter)
  @forumCover ||= new ForumCover(@forum)

  @menu ||= new Menu


$(document).on 'change', '.js-url-selector', (e) ->
  osu.navigate e.target.value, (e.target.dataset.keepScroll == '1')


$(document).on 'keydown', (e) ->
  $.publish 'key:esc' if e.keyCode == 27


rootUrl = "#{document.location.protocol}//#{document.location.host}"
rootUrl += ":#{document.location.port}" if document.location.port
rootUrl += '/'

jQuery.timeago.settings.allowFuture = true

# Internal Helper
$.expr[':'].internal = (obj, index, meta, stack) ->
  # Prepare
  $this = $(obj)
  url = $this.attr('href') or ''
  url.substring(0, rootUrl.length) == rootUrl or url.indexOf(':') == -1
