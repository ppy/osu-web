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

# loading animation overlay
# fired from turbolinks
$(document).on 'page:fetch', osu.showLoadingOverlay
$(document).on 'page:receive', osu.hideLoadingOverlay
# form submission is not covered by turbolinks
$(document).on 'submit', 'form', osu.showLoadingOverlay


@reactTurbolinks ||= new ReactTurbolinks

reactTurbolinks.register 'user-card', UserCard


$(document).on 'ready page:load', =>
  LocalStoragePolyfill.fillIn()

  @editorZoom ||= new EditorZoom
  @stickyFooter ||= new StickyFooter
  @stickyHeader ||= new StickyHeader
  @globalDrag ||= new GlobalDrag
  @gallery ||= new Gallery
  @fade ||= new Fade
  @formPlaceholderHide ||= new FormPlaceholderHide
  @headerMenu ||= new HeaderMenu
  @tooltipDefault ||= new TooltipDefault
  @throttledEvents ||= new ThrottledEvents

  @syncHeight ||= new SyncHeight

  @forum ||= new Forum
  @forumAutoClick ||= new ForumAutoClick
  @forumPostsSeek ||= new ForumPostsSeek(@forum)
  @forumSearchModal ||= new ForumSearchModal(@forum)
  @forumTopicPostJump ||= new ForumTopicPostJump(@forum)
  @forumTopicReply ||= new ForumTopicReply(@forum, @stickyFooter)
  @forumCover ||= new ForumCover(@forum)

  @menu ||= new Menu
  @logoMenu ||= new LogoMenu

  @layzr ||= Layzr()


initPage = =>
  osu.initTimeago()
  @layzr.update().check().handlers(true)

# Don't bother moving initPage to osu junk drawer and removing the
# osu:page:change. It's intended to allow other scripts to attach
# callbacks to osu:page:change.
$(document).on 'ready page:load', initPage
$(document).on 'osu:page:change', _.debounce(initPage, 500)


$(document).on 'change', '.js-url-selector', (e) ->
  $target = $(e.target)
  osu.navigate $target.val(), $target.attr('data-keep-scroll') == '1'


$(document).on 'keydown', (e) ->
  $.publish 'key:esc' if e.keyCode == 27


rootUrl = "#{document.location.protocol}//#{document.location.host}"
rootUrl += ":#{document.location.port}" if document.location.port
rootUrl += '/'

# Internal Helper
$.expr[':'].internal = (obj, index, meta, stack) ->
  # Prepare
  $this = $(obj)
  url = $this.attr('href') or ''
  url.substring(0, rootUrl.length) == rootUrl or url.indexOf(':') == -1

$.fn.moddify = ->
  regex = /(\d\d:\d\d:\d\d\d(?: \([0-9,#&;\|]+\))*)/ig
  $(this).each ->
    $(this).html $(this).html().replace(regex, '<code><a class="osu-modtime" href="osu://edit/$1" rel="nofollow">$1</a></code>')
  $ this

$.fn.linkify = ->
  regex = /(https?:\/\/(?:(?:[a-z0-9]\.|[a-z0-9][a-z0-9-]*[a-z0-9]\.)*[a-z][a-z0-9-]*[a-z0-9](?::\d+)?)(?:(?:(?:\/+(?:[a-z0-9$_\.\+!\*',;:@&=-]|%[0-9a-f]{2})*)*(?:\?(?:[a-z0-9$_\.\+!\*',;:@&=-]|%[0-9a-f]{2})*)?)?(?:#(?:[a-z0-9$_\.\+!\*',;:@&=-]|%[0-9a-f]{2})*)?)?)/ig
  $(this).each ->
    $(this).html $(this).html().replace(regex, '<a href="$1" rel="nofollow" target="_blank">$1</a>')
  $ this
