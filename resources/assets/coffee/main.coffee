###
#    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
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

Turbolinks.setProgressBarDelay(0)

Lang.setLocale(@currentLocale)
jQuery.timeago.settings.allowFuture = true

# loading animation overlay
# fired from turbolinks
$(document).on 'turbolinks:request-start', LoadingOverlay.show
$(document).on 'turbolinks:request-end', LoadingOverlay.hide
# form submission is not covered by turbolinks
$(document).on 'submit', 'form', (e) ->
  LoadingOverlay.show() if e.currentTarget.dataset.loadingOverlay != '0'

$(document).on 'turbolinks:load', ->
  BeatmapPack.initialize()
  StoreSupporterTag.initialize()
  StoreCheckout.initialize()

# ensure currentUser is updated early enough.
@currentUserObserver ?= new CurrentUserObserver
@throttledWindowEvents ?= new ThrottledWindowEvents
@syncHeight ?= new SyncHeight
@stickyHeader ?= new StickyHeader

@accountEdit ?= new AccountEdit
@accountEditAvatar ?= new AccountEditAvatar
@accountEditBlocklist ?= new AccountEditBlocklist
@beatmapsetDownloadObserver ?= new BeatmapsetDownloadObserver
@changelogChartLoader ?= new ChangelogChartLoader
@checkboxValidation ?= new CheckboxValidation
@clickMenu ?= new _exported.ClickMenu
@fancyGraph ?= new FancyGraph
@formClear ?= new FormClear
@formError ?= new FormError
@formPlaceholderHide ?= new FormPlaceholderHide
@formToggle ?= new FormToggle
@forum ?= new Forum
@forumAutoClick ?= new ForumAutoClick
@forumCover ?= new ForumCover
@forumPoll ?= new _exported.ForumPoll(@)
@forumPostPreview ?= new ForumPostPreview
@forumTopicTitle ?= new ForumTopicTitle
@forumTopicWatchAjax ?= new ForumTopicWatchAjax
@gallery ?= new Gallery
@globalDrag ?= new GlobalDrag
@landingGraph ?= new LandingGraph
@menu ?= new Menu
@navButton ?= new NavButton
@osuAudio ?= new OsuAudio
@osuLayzr ?= new OsuLayzr
@postPreview ?= new PostPreview
@scale ?= new Scale
@search ?= new Search
@stickyFooter ?= new StickyFooter
@timeago ?= new Timeago
@tooltipBeatmap ?= new TooltipBeatmap
@tooltipDefault ?= new TooltipDefault
@turbolinksReload ?= new _exported.TurbolinksReload
@userLogin ?= new UserLogin
@userVerification ?= new UserVerification

@formConfirmation ?= new FormConfirmation(@formError)
@forumPostsSeek ?= new ForumPostsSeek(@forum)
@forumTopicPostJump ?= new ForumTopicPostJump(@forum)
@forumTopicReply ?= new ForumTopicReply({ @forum, @forumPostPreview, @stickyFooter })
@nav2 ?= new Nav2(@clickMenu)
@osuEnchant ?= new _exported.Enchant(@, @turbolinksReload)
@twitchPlayer ?= new TwitchPlayer(@turbolinksReload)
_exported.WindowVHPatcher.init(window)


$(document).on 'change', '.js-url-selector', (e) ->
  osu.navigate e.target.value, (e.target.dataset.keepScroll == '1')


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
