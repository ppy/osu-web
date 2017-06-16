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

@polyfills ?= new Polyfills


# loading animation overlay
# fired from turbolinks
$(document).on 'turbolinks:request-start', LoadingOverlay.show
$(document).on 'turbolinks:request-end', LoadingOverlay.hide
# form submission is not covered by turbolinks
$(document).on 'submit', 'form', (e) ->
  LoadingOverlay.show() if e.currentTarget.dataset.loadingOverlay != '0'

$(document).on 'turbolinks:load', ->
  StoreSupporterTag.initialize()

@accountEdit ?= new AccountEdit
@accountEditPlaystyle ?= new AccountEditPlaystyle
@accountEditAvatar ?= new AccountEditAvatar
@checkboxValidation ?= new CheckboxValidation
@currentUserObserver ?= new CurrentUserObserver
@editorZoom ?= new EditorZoom
@fancyGraph ?= new FancyGraph
@formClear ?= new FormClear
@formError ?= new FormError
@formPlaceholderHide ?= new FormPlaceholderHide
@formToggle ?= new FormToggle
@forum ?= new Forum
@forumAutoClick ?= new ForumAutoClick
@forumCover ?= new ForumCover
@gallery ?= new Gallery
@globalDrag ?= new GlobalDrag
@landingGraph ?= new LandingGraph
@landingHero ?= new LandingHero
@menu ?= new Menu
@nav ?= new Nav
# FIXME: enable later.
#@navSearch ?= new NavSearch
@osuAudio ?= new OsuAudio
@osuLayzr ?= new OsuLayzr
@parentFocus ?= new ParentFocus
@postPreview ?= new PostPreview
@reactTurbolinks ||= new ReactTurbolinks
@replyPreview ?= new ReplyPreview
@scale ?= new Scale
@stickyFooter ?= new StickyFooter
@stickyHeader ?= new StickyHeader
@syncHeight ?= new SyncHeight
@throttledWindowEvents ?= new ThrottledWindowEvents
@timeago ?= new Timeago
@tooltipDefault ?= new TooltipDefault
@turbolinksDisable ?= new TurbolinksDisable
@turbolinksDisqus ?= new TurbolinksDisqus
@turbolinksReload ?= new TurbolinksReload
@twitchPlayer ?= new TwitchPlayer
@wiki ?= new Wiki

@formConfirmation ?= new FormConfirmation(@formError)
@forumPostsSeek ?= new ForumPostsSeek(@forum)
@forumSearchModal ?= new ForumSearchModal(@forum)
@forumTopicPostJump ?= new ForumTopicPostJump(@forum)
@forumTopicReply ?= new ForumTopicReply(@forum, @stickyFooter)
@userLogin ?= new UserLogin(@nav)
@userVerification ?= new UserVerification(@nav)


$(document).on 'change', '.js-url-selector', (e) ->
  osu.navigate e.target.value, (e.target.dataset.keepScroll == '1')


$(document).on 'keydown', (e) ->
  $.publish 'key:esc' if e.keyCode == 27

# Globally init countdown timers
reactTurbolinks.register 'countdownTimer', CountdownTimer, (e) ->
  deadline: e.dataset.deadline

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
