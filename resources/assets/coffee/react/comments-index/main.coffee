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

{button, div, h1, p, span} = ReactDOMFactories
el = React.createElement

class CommentsIndex.Main extends React.PureComponent
  constructor: (props) ->
    super props

    @pagination = React.createRef()
    @id = "comments-index-#{osu.uuid()}"
    @state =
      comments: @props.comments
      users: @props.users


  componentDidMount: =>
    $.subscribe "comment:updated.#{@id}", @update

    pagination = document.querySelector('.js-comments-pagination').cloneNode(true)
    @pagination.current.innerHTML = ''
    @pagination.current.appendChild pagination


  componentWillUnmount: =>
    $.unsubscribe ".#{@id}"


  render: =>
    usersById = _.keyBy(@state.users ? [], 'id')
    sortedComments = _(@state.comments ? [])
      .uniqBy('id')
      .orderBy(['created_at', 'id'], ['desc', 'desc'])
      .value()

    div null,
      div className: 'header-v3 header-v3--comments',
        div className: 'header-v3__bg'
        div className: 'header-v3__overlay'
        div className: 'osu-page osu-page--header-v3',
          @renderHeaderTitle()
          @renderHeaderTabs()

      div className: 'osu-page osu-page--comments',
        for comment in sortedComments
          el Comment,
            key: comment.id
            comment: comment
            usersById: usersById
            showReplies: false
            showCommentableMeta: true
            linkParent: true
            depth: 0

        div ref: @pagination


  renderHeaderTabs: =>
    div className: 'page-mode-v2 page-mode-v2--comments',
      span
        className: 'page-mode-v2__link page-mode-v2__link--active'
        osu.trans 'comments.index.title.info'


  renderHeaderTitle: =>
    div className: 'osu-page-header-v3 osu-page-header-v3--comments',
      div className: 'osu-page-header-v3__title js-nav2--hidden-on-menu-access',
        div className: 'osu-page-header-v3__title-icon',
          div className: 'osu-page-header-v3__icon'
        h1
          className: 'osu-page-header-v3__title-text'
          dangerouslySetInnerHTML:
            __html: osu.trans 'comments.index.title._',
              info: "<span class='osu-page-header-v3__title-highlight'>#{osu.trans('comments.index.title.info')}</span>"


  update: (_event, {comment}) =>
    @setState
      comments: osu.updateCollection @state.comments, [comment]
      users: osu.updateCollection @state.users, [comment.user, comment.editor]
