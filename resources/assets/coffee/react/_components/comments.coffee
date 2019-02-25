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

{button, div, h2, span} = ReactDOMFactories

el = React.createElement

class @Comments extends React.PureComponent
  render: =>
    commentsByParentId = _.groupBy(@props.comments, 'parent_id')
    comments = commentsByParentId[null]


    div className: osu.classWithModifiers('comments', @props.modifiers),
      h2 className: 'comments__title',
        osu.trans('comments.title')
        span className: 'comments__count', osu.formatNumber(@props.total)
      div className: 'comments__new',
        el CommentEditor,
          commentableType: @props.commentableType
          commentableId: @props.commentableId
          focus: false
          modifiers: @props.modifiers
      div className: 'comments__content',
        div className: 'comments__items',
          el CommentsSort,
            loadingSort: @props.loadingSort
            currentSort: @props.currentSort
            modifiers: @props.modifiers
        if comments?
          div className: "comments__items #{if @props.loadingSort? then 'comments__items--loading' else ''}",
            for comment in comments
              el Comment,
                key: comment.id
                comment: comment
                commentsByParentId: commentsByParentId
                userVotesByCommentId: @props.userVotesByCommentId
                usersById: @props.usersById
                depth: 0
                currentSort: @props.currentSort
                modifiers: @props.modifiers
                moreComments: @props.moreComments
            el CommentShowMore,
              commentableType: @props.commentableType
              commentableId: @props.commentableId
              comments: comments
              total: @props.topLevelCount
              sort: @props.currentSort
              modifiers: _.concat 'top', @props.modifiers
              moreComments: @props.moreComments
        else
          div
            className: 'comments__items comments__items--empty'
            osu.trans('comments.empty')
