# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

@polyfills ?= new Polyfills

Turbolinks.start()
Turbolinks.setProgressBarDelay(0)

Lang.setLocale(@currentLocale)
moment.relativeTimeThreshold('ss', 44)
moment.relativeTimeThreshold('s', 120)
moment.relativeTimeThreshold('m', 120)
moment.relativeTimeThreshold('h', 48)
moment.relativeTimeThreshold('d', 62)
moment.relativeTimeThreshold('M', 24)
jQuery.timeago.inWords = (distanceMillis) ->
  moment.duration(-1 * distanceMillis).humanize(true)

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
@syncHeight ?= new SyncHeight
@stickyHeader ?= new StickyHeader

@accountEdit ?= new AccountEdit
@accountEditAvatar ?= new AccountEditAvatar
@accountEditBlocklist ?= new AccountEditBlocklist
@bbcodePreview ?= new BbcodePreview
@beatmapsetDownloadObserver ?= new BeatmapsetDownloadObserver
@captcha ?= new _exported.Captcha
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
@forumTopicTitle ?= new ForumTopicTitle
@forumTopicWatchAjax ?= new ForumTopicWatchAjax
@globalDrag ?= new GlobalDrag
@landingGraph ?= new LandingGraph
@localtime ?= new _exported.Localtime
@menu ?= new Menu
@mobileToggle ?= new _exported.MobileToggle
@navButton ?= new NavButton
@osuAudio ?= new _exported.OsuAudio
@osuLayzr ?= new _exported.OsuLayzr
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
@forumTopicReply ?= new ForumTopicReply({ @bbcodePreview, @forum, @stickyFooter })
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
