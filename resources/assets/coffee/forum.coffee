###
Copyright 2015 ppy Pty. Ltd.

This file is part of osu!web. osu!web is distributed with the hope of
attracting more community contributions to the core ecosystem of osu!.

osu!web is free software: you can redistribute it and/or modify
it under the terms of the Affero GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
See the GNU Affero General Public License for more details.

You should have received a copy of the GNU Affero General Public License
along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
###
class Forum
  _totalPostsDiv: document.getElementsByClassName('js-forum__topic-total-posts')
  _postsCounter: document.getElementsByClassName('js-forum__posts-counter')
  _postsProgress: document.getElementsByClassName('js-forum__posts-progress')
  _stickyHeaderTopic: document.getElementsByClassName('js-forum-topic-headernav')
  posts: document.getElementsByClassName('forum-post')

  constructor: ->
    $(window).on 'scroll', =>
      requestAnimationFrame @refreshCounter

    $(document).on 'ready page:load osu:page:change', =>
      @refreshLoadMoreLinks()
      @refreshCounter()

    $.subscribe 'stickyHeader', @stickHeader

    $(document).on 'click', '.js-post-url', @postUrlClick


  totalPosts: =>
    return null if @_totalPostsDiv.length == 0
    parseInt @_totalPostsDiv[0].getAttribute('data-total-count'), 10

  setTotalPosts: (n) =>
    @_totalPostsDiv[0].setAttribute('data-total-count', n)
    document.getElementsByClassName('js-forum__total-count')[0].textContent = n

  setCounter: (currentPost) =>
    @currentPostPosition = parseInt currentPost.getAttribute('data-post-position'), 10
    postId = currentPost.getAttribute('data-post-id')

    @_postsCounter[0].textContent = @currentPostPosition
    @_postsProgress[0].style.width = "#{100 * @currentPostPosition / @totalPosts()}%"

  endPost: => @posts[@posts.length - 1]

  lastPostLoaded: =>
    parseInt(@endPost().getAttribute('data-post-position'), 10) == @totalPosts()

  refreshLoadMoreLinks: =>
    return if @posts.length == 0

    $('.js-forum__posts-show-more--previous')
      .closest('div')
      .toggle @posts[0].getAttribute('data-post-position') != '1'

    showNext = !@lastPostLoaded()

    $('.js-forum__posts-show-more--next').closest('div').toggle showNext

    if !window.currentUser.isAdmin
      $('.delete-post-link').hide()

    if !showNext
      $(@endPost()).find('.delete-post-link').css(display: '')
      $('#forum-topic-reply-box').css(display: 'block')

  refreshCounter: =>
    return if @_postsCounter.length == 0

    currentPost = null
    anchorHeight = window.innerHeight * 0.5

    pageBottom = document.getElementsByClassName('js-page-footer-padding')[0]
      .getBoundingClientRect()
      .bottom

    if pageBottom == window.innerHeight
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
    $post = $(".js-forum-post[data-post-position='#{postN}']")
    if $post.length
      @scrollTo $post.attr('data-post-id')
    else
      Turbolinks.visit("#{document.location.pathname}?n=#{postN}")


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


  postUrlClick: (e) =>
      e.preventDefault()

      id = $(e.target).closest('.js-forum-post').attr('data-post-id')
      @scrollTo id


  stickHeader: (_, target) =>
    return unless @_stickyHeaderTopic.length

    if target == 'forum-topic-headernav'
      return if @_stickyHeaderTopic[0]._visible
      @_stickyHeaderTopic[0]._visible = true
      fade.in @_stickyHeaderTopic[0], 'flex'
    else
      return unless @_stickyHeaderTopic[0]._visible
      @_stickyHeaderTopic[0]._visible = false
      fade.out @_stickyHeaderTopic[0]



window.forum = new Forum


class ForumAutoClick
  _triggerDistance: 1200
  nextLink: document.getElementsByClassName('js-forum__posts-show-more--next')
  previousLink: document.getElementsByClassName('js-forum__posts-show-more--previous')

  constructor: ->
    $(window).on 'scroll', _.throttle(@onScroll, 1000)

    $(document).on 'ready page:load osu:page:change', =>
      setTimeout @onScroll, 1000


  commonClick: (link) ->
    # abort if link is invisible
    if link.getBoundingClientRect().height == 0
      return
    # abort if link has previously failed loading
    if link.getAttribute('data-failed') == '1'
      return
    link.click()

  nextClick: =>
    return if @nextLink.length == 0
    # abort if link is too far above the window
    return if @nextLink[0].getBoundingClientRect().top > document.documentElement.clientHeight + @_triggerDistance
    # proceed to common link auto click function
    @commonClick @nextLink[0]

  onScroll: =>
    @previousClick()
    @nextClick()

  previousClick: =>
    return if @previousLink.length == 0
    # abort if link is too far above the window
    return if @previousLink[0].getBoundingClientRect().top < -@_triggerDistance
    # proceed to common link auto click function
    @commonClick @previousLink[0]

window.forumAutoClick = new ForumAutoClick


class RepositionForumSearchBox
  box: document.getElementsByClassName('js-forum-search-box')
  activeBox: document.getElementsByClassName('js-forum-search-box--active')
  button: document.getElementsByClassName('js-forum-search-button')

  constructor: ->
    $(window).on 'resize scroll', => requestAnimationFrame @reposition
    $(document).on 'show.bs.modal', '#forum-search-modal', @activate
    $(document).on 'hidden.bs.modal', '#forum-search-modal', @deactivate

  activate: =>
    @button[0].style.opacity = 0
    @box[0].classList.add 'js-forum-search-box--active'
    @reposition()

  deactivate: =>
    @button[0].style.opacity = 1
    @box[0].classList.remove 'js-forum-search-box--active'

  reposition: =>
    return if @activeBox.length == 0

    normalBottom = window.innerHeight - (@button[0].getBoundingClientRect().bottom)
    normalRight = window.innerWidth - (@button[0].getBoundingClientRect().right)

    @box[0].style.bottom = "#{normalBottom}px"
    @box[0].style.right = "#{normalRight}px"

window.repositionForumSearchBox = new RepositionForumSearchBox


$(document).on 'ready page:load', =>
  return if location.hash != '' ||
    @postJumpTo == undefined ||
    @postJumpTo == 0

  @forum.scrollTo @postJumpTo
  @postJumpTo = 0


$(document).on 'click', '.js-forum-posts-show-more', (e) ->
  e.preventDefault()
  $link = $(e.target)
  $linkDiv = $link.closest('div')
  mode = $link.data('mode')

  options =
    start: null
    end: null
    skip_layout: 1

  if mode == 'previous'
    $refPost = $('.forum-post').first()
    options['end'] = $refPost.data('post-id') - 1
  else
    $refPost = $('.forum-post').last()
    options['start'] = $refPost.data('post-id') + 1

  $linkDiv.addClass 'loading'

  $.get(window.canonicalUrl, options)
  .done (data) ->
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

    osu.pageChange()
    $link.attr 'data-failed', '0'

  .always ->
    $linkDiv.removeClass 'loading'
  .fail ->
    $link.attr 'data-failed', '1'
