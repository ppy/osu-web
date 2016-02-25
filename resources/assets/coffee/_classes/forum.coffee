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
class @Forum
  _totalPostsDiv: document.getElementsByClassName('js-forum__topic-total-posts')
  _postsCounter: document.getElementsByClassName('js-forum__posts-counter')
  _postsProgress: document.getElementsByClassName('js-forum__posts-progress')
  _stickyHeaderTopic: document.getElementsByClassName('js-forum-topic-headernav')
  posts: document.getElementsByClassName('js-forum-post')
  loadMoreLinks: document.getElementsByClassName('js-forum-posts-show-more')

  boot: =>
    @refreshCounter()
    @refreshLoadMoreLinks()

    # Scroll last because other actions may change page's height.
    @initialScrollTo()


  constructor: ->
    # `boot` is called first to avoid triggering anything when scrolling to
    # target post.
    @boot()

    $(window).on 'throttled-scroll', @refreshCounter

    $(document).on 'ready page:load osu:page:change', @boot

    $(document).on 'click', '.js-forum-posts-show-more', @showMore
    $(document).on 'click', '.js-post-url', @postUrlClick
    $(document).on 'submit', '.js-forum-posts-jump-to', @jumpToSubmit

    $.subscribe 'stickyHeader', @stickHeader


  totalPosts: =>
    return null if @_totalPostsDiv.length == 0
    parseInt @_totalPostsDiv[0].getAttribute('data-total-count'), 10


  setTotalPosts: (n) =>
    @_totalPostsDiv[0].setAttribute('data-total-count', n)
    document.getElementsByClassName('js-forum__total-count')[0].textContent = n


  setCounter: (currentPost) =>
    @currentPostPosition = parseInt currentPost.getAttribute('data-post-position'), 10

    window.reloadUrl = @postUrlN @currentPostPosition

    @_postsCounter[0].textContent = @currentPostPosition
    @_postsProgress[0].style.width = "#{100 * @currentPostPosition / @totalPosts()}%"


  endPost: => @posts[@posts.length - 1]


  firstPostLoaded: =>
    @posts[0].getAttribute('data-post-position') == '1'


  lastPostLoaded: =>
    parseInt(@endPost().getAttribute('data-post-position'), 10) == @totalPosts()


  refreshLoadMoreLinks: =>
    return unless @loadMoreLinks.length

    firstPostLoaded = @firstPostLoaded()

    $('.js-header--main').toggleClass 'hidden', !firstPostLoaded
    $('.js-header--alt').toggleClass 'hidden', firstPostLoaded

    lastPostLoaded = @lastPostLoaded()

    $('.js-forum__posts-show-more--next')
      .closest('div')
      .toggleClass 'hidden', lastPostLoaded

    if !window.currentUser.isAdmin
      $('.delete-post-link').hide()

    if lastPostLoaded
      $(@endPost()).find('.delete-post-link').css(display: '')


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


  scrollTo: (postId) =>
    post = document.querySelector(".js-forum-post[data-post-id='#{postId}']")

    return unless post

    if post.getAttribute('data-post-position') == '1'
      postTop = 0
    else
      postDim = post.getBoundingClientRect()
      windowHeight = window.innerHeight

      postTop = window.pageYOffset + postDim.top

      offset = (windowHeight - postDim.height) / 2
      # FIXME: compute height using new header target
      offset = Math.max(offset, 60)

    window.scrollTo 0, postTop - offset


  initialScrollTo: =>
    return if location.hash != '' ||
      window.postJumpTo == undefined ||
      window.postJumpTo == 0

    @scrollTo window.postJumpTo
    window.postJumpTo = 0


  postUrlClick: (e) =>
      e.preventDefault()

      id = $(e.target).closest('.js-forum-post').attr('data-post-id')
      @scrollTo id


  postUrlN: (postN) ->
    "#{document.location.pathname}?n=#{postN}"


  stickHeader: (_, target) =>
    return unless @_stickyHeaderTopic.length

    if target == 'forum-topic-headernav'
      Fade.in @_stickyHeaderTopic[0]
    else
      Fade.out @_stickyHeaderTopic[0]


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
      if mode == 'previous'
        scrollReference = $refPost[0]
        scrollReferenceTop = scrollReference.getBoundingClientRect().top

        $linkDiv.after data

        # restore scroll position after prepending the page
        x = window.pageXffset
        currentScrollReferenceTop = scrollReference.getBoundingClientRect().top
        currentDocumentScrollTop = window.pageYOffset
        targetDocumentScrollTop = currentDocumentScrollTop + currentScrollReferenceTop - scrollReferenceTop
        window.scrollTo x, targetDocumentScrollTop
      else
        $linkDiv.before data

      @refreshLoadMoreLinks()

      osu.pageChange()
      $link.attr 'data-failed', '0'

    .always ->
      $linkDiv.removeClass 'loading'
    .fail ->
      $link.attr 'data-failed', '1'


  jumpToSubmit: (e) =>
    e.preventDefault()
    osu.hideLoadingOverlay()

    if @jumpTo $(e.target).find('[name="n"]').val()
      $.publish 'forum:topic:jumpTo'
