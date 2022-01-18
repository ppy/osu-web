# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import core from 'osu-core-singleton'
import { bottomPage } from 'utils/html'
import { hideLoadingOverlay } from 'utils/loading-overlay'
import { currentUrl } from 'utils/turbolinks'

replaceUrl = (url) ->
  Turbolinks.controller.replaceHistory url

# browsers have limit on replaceState calls
debouncedReplaceUrl = _.debounce replaceUrl, 250

class window.Forum
  boot: =>
    @refreshCounterPaused = true
    @refreshLoadMoreLinks()

    @initialScrollTo()


  constructor: ->
    @_totalPostsDiv = document.getElementsByClassName('js-forum__total-count')
    @_deletedPostsDiv = document.getElementsByClassName('js-forum__deleted-count')
    @_postsCounter = document.getElementsByClassName('js-forum__posts-counter')
    @_postsProgress = document.getElementsByClassName('js-forum__posts-progress')
    @posts = document.getElementsByClassName('js-forum-post')
    @loadMoreLinks = document.getElementsByClassName('js-forum-posts-show-more')
    @throttledBoot = _.throttle @boot, 100
    @refreshCounterPaused = true

    @maxPosts = 250

    $(document).on 'turbolinks:load', @throttledBoot
    $.subscribe 'osu:page:change', @throttledBoot

    $(window).on 'scroll', @refreshCounter
    $(document).on 'click', '.js-forum-posts-show-more', @showMore
    $(document).on 'click', '.js-post-url', @postUrlClick
    $(document).on 'submit', '.js-forum-posts-jump-to', @jumpToSubmit
    $(document).on 'keyup', @keyboardNavigation
    $(document).on 'click', '.js-forum-topic-moderate--toggle-deleted', @toggleDeleted
    $(document).on 'turbolinks:before-cache', debouncedReplaceUrl.cancel


  userCanModerate: ->
    @topicMeta().userCanModerate == '1'


  postPosition: (el) =>
    parseInt(el.getAttribute('data-post-position'), 10)


  firstPostId: ->
    parseInt @topicMeta().firstPostId, 10


  postId: (el) ->
    parseInt el.getAttribute('data-post-id'), 10


  topicMeta: ->
    newBody.querySelector('.js-forum--topic-meta')?.dataset


  totalPosts: =>
    return null if @_totalPostsDiv.length == 0
    parseInt @_totalPostsDiv[0].dataset.total, 10


  # null if option not available (not moderator), false/true accordingly otherwise
  showDeleted: =>
    toggle = document.querySelector('.js-forum-topic-moderate--toggle-deleted')

    return unless toggle?

    toggle.dataset.showDeleted == '1'


  setTotalPosts: (n) =>
    $(@_totalPostsDiv)
      .text osu.formatNumber(n)
      .attr 'data-total', n


  deletedPosts: ->
    return null if @_deletedPostsDiv.length == 0
    parseInt @_deletedPostsDiv[0].dataset.total, 10


  setDeletedPosts: (n) ->
    $(@_deletedPostsDiv)
      .text osu.formatNumber(n)
      .attr 'data-total', n


  setCounter: (currentPost) =>
    @currentPostPosition = @postPosition(currentPost)

    @setTotalPosts(@currentPostPosition) if @currentPostPosition > @totalPosts()
    debouncedReplaceUrl @postUrlN(@currentPostPosition)

    @_postsCounter[0].textContent = osu.formatNumber @currentPostPosition
    @_postsProgress[0].style.width = "#{100 * @currentPostPosition / @totalPosts()}%"


  endPost: => @posts[@posts.length - 1]


  startingPostLoaded: =>
    morePrevious = document.querySelector('.js-forum__posts-show-more--previous')
    startingPostLoaded = morePrevious.dataset.noMore == '1'

    if !startingPostLoaded
      # Less than or equal in case the first post id data is wrong due to the
      # earlier version allowing deleting "first" post.
      startingPostLoaded = @postId(@posts[0]) <= @firstPostId()
      morePrevious.dataset.noMore = '1' if startingPostLoaded

    startingPostLoaded


  lastPostLoaded: =>
    moreNext = document.querySelector('.js-forum__posts-show-more--next')
    lastPostLoaded = moreNext.dataset.noMore == '1'

    if !lastPostLoaded
      # Greater than or equal to allow handling more posts than initially known
      lastPostLoaded = @postPosition(@endPost()) >= @totalPosts()
      moreNext.dataset.noMore = '1' if lastPostLoaded

    lastPostLoaded


  refreshLoadMoreLinks: =>
    return unless @loadMoreLinks.length

    startingPostLoaded = @startingPostLoaded()

    $('.js-header--main').toggleClass 'hidden', !startingPostLoaded
    $('.js-header--alt').toggleClass 'hidden', startingPostLoaded

    lastPostLoaded = @lastPostLoaded()

    $('.js-forum__posts-show-more--next')
      .toggleClass 'hidden', lastPostLoaded

    if !@userCanModerate()
      $('.js-post-delete-toggle').hide()

    if lastPostLoaded
      $(@endPost()).find('.js-post-delete-toggle').css(display: '')

    for link in @loadMoreLinks
      link.href = @moreMeta(link).url


  refreshCounter: =>
    return if @refreshCounterPaused

    return if @_postsCounter.length == 0

    currentPost = null

    if bottomPage()
      currentPost = @posts[@posts.length - 1]
    else
      scrollOffset = core.stickyHeader.scrollOffsetValue

      for post in @posts
        postTop = post.getBoundingClientRect().top
        if Math.floor(postTop - scrollOffset) <= 0
          currentPost = post
        else
          break

    # no post visible?
    currentPost ?= @posts[0]

    @setCounter(currentPost)


  jumpTo: (postN) =>
    postN = parseInt postN, 10
    return false unless isFinite(postN)

    postN = Math.max(postN, 1)
    postN = Math.min(postN, @totalPosts())

    $post = $(".js-forum-post[data-post-position='#{postN}']")
    @_postsCounter[0].textContent = osu.formatNumber postN

    if $post.length
      @scrollTo $post.attr('data-post-id')
    else
      Turbolinks.visit @postUrlN(postN)

    true

  keyboardNavigation: (e) =>
    return if osu.isInputElement(e.target) or not @_postsCounter.length

    e.preventDefault()

    n = switch e.which
      when 37 then @currentPostPosition - 1
      when 39 then @currentPostPosition + 1

    try @jumpTo n


  scrollTo: (postId) =>
    post = document.querySelector(".js-forum-post[data-post-id='#{postId}']")

    return unless post

    # Mainly for post located near the end as the page scroll may hit the end
    # and thus cause the counter to show last post instead of the intended
    # post. To be resumed after scrolling.
    @refreshCounterPaused = true
    postTop = if @postPosition(post) == 1
                0
              else
                $(post).offset().top

    $.publish 'sync-height:force'
    postTop = core.stickyHeader.scrollOffset(postTop) if postTop != 0

    # using jquery smooth scrollTo will cause unwanted events to trigger on the way down.
    window.scrollTo window.pageXOffset, postTop
    @highlightPost post
    @setCounter post
    # allow scroll to finish before reenabling counter check
    reenableRefreshCounter = => @refreshCounterPaused = false
    setTimeout reenableRefreshCounter, 0


  highlightPost: (post) ->
    $('.js-forum-post--highlighted').removeClass('js-forum-post--highlighted')
    $(post).addClass('js-forum-post--highlighted')


  toggleDeleted: =>
    return if !@showDeleted()? # you don't see this option unless you're a moderator, anyway

    xhr = osuCore.userPreferences.set('forum_posts_show_deleted', !@showDeleted())

    callback = => Turbolinks.visit @postUrlN(@currentPostPosition)

    if xhr?
      xhr.done callback
    else
      callback()


  initialScrollTo: =>
    topicMeta = @topicMeta()

    return if !topicMeta?

    history.scrollRestoration = 'manual'
    $(document).one 'turbolinks:before-cache', ->
      history.scrollRestoration = 'auto'

    shouldScroll = currentUrl().hash == '' && osu.present(topicMeta.postJumpTo)

    if shouldScroll
      @scrollTo parseInt(topicMeta.postJumpTo, 10)
      topicMeta.postJumpTo = ''
    else
      @refreshCounterPaused = false
      @refreshCounter()


  postUrlClick: (e) =>
    e.preventDefault()

    id = $(e.target).closest('.js-forum-post').attr('data-post-id')
    @scrollTo id


  postUrlN: (postN) ->
    "#{currentUrl().pathname}?n=#{postN}"


  showMore: (e) =>
    e.preventDefault()

    link = e.currentTarget

    return if link.classList.contains('js-disabled')

    link.classList.add 'js-disabled'

    moreMeta = @moreMeta link

    $.get(moreMeta.url)
    .done (data) =>
      if !data?
        link.dataset.noMore = '1'
        @refreshLoadMoreLinks()
        return

      scrollReference = moreMeta.refPost
      scrollReferenceTop = scrollReference.getBoundingClientRect().top

      if moreMeta.mode == 'previous'
        link.insertAdjacentHTML 'afterend', data
        toRemoveStart = @maxPosts
        toRemoveEnd = @posts.length
      else
        link.insertAdjacentHTML 'beforebegin', data
        toRemoveStart = 0
        toRemoveEnd = @posts.length - @maxPosts

      if toRemoveStart < toRemoveEnd
        parent = @posts[0].parentNode
        parent.removeChild(post) for post in _.slice(@posts, toRemoveStart, toRemoveEnd)

      @refreshLoadMoreLinks()

      # Restore scroll position after adding/removing posts.
      # Called after refreshLoadMoreLinks to allow header changes
      # to be included in calculation.
      x = window.pageXOffset
      currentScrollReferenceTop = scrollReference.getBoundingClientRect().top
      currentDocumentScrollTop = window.pageYOffset
      targetDocumentScrollTop = currentDocumentScrollTop + currentScrollReferenceTop - scrollReferenceTop
      window.scrollTo x, targetDocumentScrollTop

      _exported.pageChange()
      link.dataset.failed = '0'

    .always ->
      link.classList.remove 'js-disabled'
    .fail (xhr) =>
      link.dataset.failed = '1'
      osu.ajaxError xhr


  jumpToSubmit: (e) =>
    e.preventDefault()
    hideLoadingOverlay()

    if @jumpTo $(e.target).find('[name="n"]').val()
      $.publish 'forum:topic:jumpTo'

  moreMeta: (link) =>
    mode = link.dataset.mode

    if mode == 'previous'
      refPost = @posts[0]
      sort = 'id_desc'
    else
      refPost = @endPost()
      sort = 'id_asc'

    query = $.param
      skip_layout: 1
      with_deleted: +@showDeleted()
      sort: sort
      cursor:
        id: refPost.dataset.postId

    url: "#{window.canonicalUrl}?#{query}"
    refPost: refPost
    mode: mode
