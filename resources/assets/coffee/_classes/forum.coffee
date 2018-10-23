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

    @maxPosts = 250

    $(document).on 'turbolinks:load osu:page:change', @boot

    $(window).on 'throttled-scroll', @refreshCounter
    $(document).on 'click', '.js-forum-posts-show-more', @showMore
    $(document).on 'click', '.js-post-url', @postUrlClick
    $(document).on 'submit', '.js-forum-posts-jump-to', @jumpToSubmit
    $(document).on 'keyup', @keyboardNavigation


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
    parseInt @_totalPostsDiv[0].textContent, 10


  setTotalPosts: (n) =>
    $(@_totalPostsDiv).text(n)


  deletedPosts: ->
    return null if @_deletedPostsDiv.length == 0
    parseInt @_deletedPostsDiv[0].textContent, 10


  setDeletedPosts: (n) ->
    $(@_deletedPostsDiv).text(n)


  setCounter: (currentPost) =>
    @currentPostPosition = @postPosition(currentPost)

    @setTotalPosts(@currentPostPosition) if @currentPostPosition > @totalPosts()
    window.reloadUrl = @postUrlN @currentPostPosition

    @_postsCounter[0].textContent = @currentPostPosition
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
      .closest('div')
      .toggleClass 'hidden', lastPostLoaded

    if !@userCanModerate()
      $('.js-post-delete-toggle').hide()

    if lastPostLoaded
      $(@endPost()).find('.js-post-delete-toggle').css(display: '')


  refreshCounter: =>
    return if @_postsCounter.length == 0

    currentPost = null
    anchorHeight = window.innerHeight * 0.5

    if osu.bottomPage()
      currentPost = @posts[@posts.length - 1]
    else
      for post in @posts
        postTop = post.getBoundingClientRect().top
        if postTop <= anchorHeight
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
    @_postsCounter[0].textContent = postN

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
    $link = $(e.target)
    $linkDiv = $link.closest('div')
    mode = $link.data('mode')

    options =
      start: null
      end: null
      skip_layout: 1

    if mode == 'previous'
      $refPost = $('.js-forum-post').first()
      options['end'] = $refPost.data('post-id') - 1
    else
      $refPost = $('.js-forum-post').last()
      options['start'] = $refPost.data('post-id') + 1

    $linkDiv.addClass 'loading'

    $.get(window.canonicalUrl, options)
    .done (data) =>
      scrollReference = $refPost[0]
      scrollReferenceTop = scrollReference.getBoundingClientRect().top

      if mode == 'previous'
        $linkDiv.after data
        toRemoveStart = @maxPosts
        toRemoveEnd = @posts.length
      else
        $linkDiv.before data
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
      $linkDiv.removeClass 'loading'
    .fail ->
      $link.attr 'data-failed', '1'


  jumpToSubmit: (e) =>
    e.preventDefault()
    LoadingOverlay.hide()

    if @jumpTo $(e.target).find('[name="n"]').val()
      $.publish 'forum:topic:jumpTo'
