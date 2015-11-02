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
class @ForumSearchModal
  box: document.getElementsByClassName('js-forum-search-box')
  activeBox: document.getElementsByClassName('js-forum-search-box--active')
  button: document.getElementsByClassName('js-forum-search-button')

  constructor: (forum) ->
    @forum = forum

    $(window).on 'resize scroll', => requestAnimationFrame @reposition
    $(document).on 'show.bs.modal', '#forum-search-modal', @activate
    $(document).on 'hidden.bs.modal', '#forum-search-modal', @deactivate

    $.subscribe 'forum:topic:jumpTo', @hideModal


  hideModal: =>
    $('#forum-search-modal').modal('hide')


  activate: (e) =>
    @button[0].style.opacity = 0
    @box[0].classList.add 'js-forum-search-box--active'
    @reposition()

    $input = $(e.target).find('.js-forum-posts-jump-to [name="n"]')
      .val(@forum.currentPostPosition)

    $input[0].selectionStart = 0
    $input[0].selectionEnd = $input.val().length


  deactivate: =>
    @button[0].style.opacity = 1
    @box[0].classList.remove 'js-forum-search-box--active'


  reposition: =>
    return if @activeBox.length == 0

    normalBottom = window.innerHeight - (@button[0].getBoundingClientRect().bottom)
    normalRight = window.innerWidth - (@button[0].getBoundingClientRect().right)

    @box[0].style.bottom = "#{normalBottom}px"
    @box[0].style.right = "#{normalRight}px"
