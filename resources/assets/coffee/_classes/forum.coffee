# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

class @Forum
  boot: =>
    @refreshCounter()
    @refreshLoadMoreLinks()

    # Scroll last because other actions may change page's height.
    @initialScrollTo()


  constructor: ->
    @_totalPostsDiv = document.getElementsByClassName('js-forum__total-count')
    @_deletedPostsDiv = document.getElementsByClassName('js-forum__deleted-count')
    @_firstPostDiv = document.getElementsByClassName('js-forum__topic-first-post-id')
    @_userCanModerateDiv = document.getElementsByClassName('js-forum__topic-user-can-moderate')
    @_postsCounter = document.getElementsByClassName('js-forum__posts-counter')
    @_postsProgress = document.getElementsByClassName('js-forum__posts-progress')
    @posts = document.getElementsByClassName('js-forum-post')
    @loadMoreLinks = document.getElementsByClassName('js-forum-posts-show-more')
    @throttledBoot = _.throttle @boot, 100

    @maxPosts = 250

    $(document).on 'turbolinks:load', @throttledBoot
    $.subscribe 'osu:page:change', @throttledBoot

    $(window).on 'scroll', @refreshCounter
    $(document).on 'click', '.js-forum-posts-show-more', @showMore
    $(document).on 'click', '.js-post-url', @postUrlClick
    $(document).on 'submit', '.js-forum-posts-jump-to', @jumpToSubmit
    $(document).on 'keyup', @keyboardNavigation
    $(document).on 'click', '.js-forum-topic-moderate--toggle-deleted', @toggleDeleted


  userCanModerate: ->
    @_userCanModerateDiv[0].getAttribute('data-user-can-moderate') == '1'


  postPosition: (el) =>
    parseInt(el.getAttribute('data-post-position'), 10)


  firstPostId: ->
    parseInt @_firstPostDiv[0].getAttribute('data-first-post-id'), 10


  postId: (el) ->
    parseInt el.getAttribute('data-post-id'), 10


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
    window.reloadUrl = @postUrlN @currentPostPosition

    @_postsCounter[0].textContent = osu.formatNumber @currentPostPosition
    @_postsProgress[0].style.width = "#{100 * @currentPostPosition / @totalPosts()}%"


  endPost: => @posts[@posts.length - 1]


  firstPostLoaded: =>
    @postId(@posts[0]) == @firstPostId()


  lastPostLoaded: =>
    @postPosition(@endPost()) == @totalPosts()


  refreshLoadMoreLinks: =>
    return unless @loadMoreLinks.length

    firstPostLoaded = @firstPostLoaded()

    $('.js-header--main').toggleClass 'hidden', !firstPostLoaded
    $('.js-header--alt').toggleClass 'hidden', firstPostLoaded

    lastPostLoaded = @lastPostLoaded()

    $('.js-forum__posts-show-more--next')
      .toggleClass 'hidden', lastPostLoaded

    if !@userCanModerate()
      $('.js-post-delete-toggle').hide()

    if lastPostLoaded
      $(@endPost()).find('.js-post-delete-toggle').css(display: '')


  refreshCounter: =>
    return if @_postsCounter.length == 0

    currentPost = null

    if osu.bottomPage()
      currentPost = @posts[@posts.length - 1]
    else
      for post in @posts
        postTop = post.getBoundingClientRect().top
        if Math.floor(window.stickyHeader.scrollOffset(postTop)) <= 0
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

    postTop = if @postPosition(post) == 1
                0
              else
                $(post).offset().top

    postTop = window.stickyHeader.scrollOffset(postTop) if postTop != 0

    # using jquery smooth scrollTo will cause unwanted events to trigger on the way down.
    window.scrollTo window.pageXOffset, postTop
    @highlightPost post


  highlightPost: (post) ->
    $('.js-forum-post--highlighted').removeClass('js-forum-post--highlighted')
    $(post).addClass('js-forum-post--highlighted')


  toggleDeleted: =>
    return if !@showDeleted()? # you don't see this option unless you're a moderator, anyway

    $.ajax laroute.route('account.options'),
      method: 'PUT'
      data:
        user_profile_customization:
          forum_posts_show_deleted: !@showDeleted()
    .done (user) =>
      $.publish 'user:update', user
      Turbolinks.visit @postUrlN(@currentPostPosition)


  initialScrollTo: =>
    return if location.hash != '' ||
      !window.postJumpTo? ||
      window.postJumpTo == 0

    @scrollTo window.postJumpTo
    window.postJumpTo = 0


  postUrlClick: (e) =>
    e.preventDefault()

    id = $(e.target).closest('.js-forum-post').attr('data-post-id')
    @scrollTo id


  postUrlN: (postN) ->
    "#{document.location.pathname}?n=#{postN}"


  showMore: (e) =>
    e.preventDefault()

    return if e.currentTarget.classList.contains('js-disabled')

    $link = $(e.currentTarget)
    mode = $link.data('mode')

    options =
      start: null
      end: null
      skip_layout: 1
      with_deleted: +@showDeleted()

    if mode == 'previous'
      $refPost = $('.js-forum-post').first()
      options['end'] = $refPost.data('post-id') - 1
    else
      $refPost = $('.js-forum-post').last()
      options['start'] = $refPost.data('post-id') + 1

    $link.addClass 'js-disabled'

    $.get(window.canonicalUrl, options)
    .done (data) =>
      scrollReference = $refPost[0]
      scrollReferenceTop = scrollReference.getBoundingClientRect().top

      if mode == 'previous'
        $link.after data
        toRemoveStart = @maxPosts
        toRemoveEnd = @posts.length
      else
        $link.before data
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

      osu.pageChange()
      $link.attr 'data-failed', '0'

    .always ->
      $link.removeClass 'js-disabled'
    .fail ->
      $link.attr 'data-failed', '1'


  jumpToSubmit: (e) =>
    e.preventDefault()
    LoadingOverlay.hide()

    if @jumpTo $(e.target).find('[name="n"]').val()
      $.publish 'forum:topic:jumpTo'
