###
#    Copyright 2015-2018 ppy Pty. Ltd.
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

{a, button, div, h1, li, ol, p, span} = ReactDOMFactories
el = React.createElement

class CommentsShow.Main extends React.PureComponent
  render: =>
    commentsByParentId = _.groupBy(@props.sortedComments, 'parent_id')

    mainComment = commentsByParentId[@props.comment.parent_id][0]
    children = commentsByParentId[mainComment.id] ? []

    div null,
      div className: 'header-v3 header-v3--comments',
        div className: 'header-v3__bg'
        div className: 'header-v3__overlay'
        div className: 'osu-page osu-page--header-v3',
          @renderHeaderTitle()
          @renderHeaderTabs()

      div className: 'osu-page osu-page--comment',
        el Comment,
          comment: mainComment
          parent: @props.comment.parent
          usersById: @props.usersById
          userVotesByCommentId: @props.userVotesByCommentId
          commentableMetaById: @props.commentableMetaById
          commentsByParentId: commentsByParentId
          showCommentableMeta: true
          depth: 0
          linkParent: true


  renderHeaderTabs: =>
    ol className: 'page-mode-v2 page-mode-v2--comments',
      li
        className: 'page-mode-v2__item'
        a
          href: laroute.route('comments.index')
          className: 'page-mode-v2__link'
          osu.trans 'comments.index.title.info'
      li
        className: 'page-mode-v2__item'
        span
          className: 'page-mode-v2__link page-mode-v2__link--active'
          osu.trans 'comments.show.title.info'


  renderHeaderTitle: =>
    div className: 'osu-page-header-v3 osu-page-header-v3--comments',
      div className: 'osu-page-header-v3__title js-nav2--hidden-on-menu-access',
        div className: 'osu-page-header-v3__title-icon',
          div className: 'osu-page-header-v3__icon'
        h1
          className: 'osu-page-header-v3__title-text'
          dangerouslySetInnerHTML:
            __html: osu.trans 'comments.show.title._',
              info: "<span class='osu-page-header-v3__title-highlight'>#{osu.trans('comments.show.title.info')}</span>"
