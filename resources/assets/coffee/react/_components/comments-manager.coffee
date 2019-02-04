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

el = React.createElement

class @CommentsManager extends React.PureComponent
  SORTS: ['new', 'old', 'top']


  constructor: (props) ->
    super props

    @id = "comments-#{osu.uuid()}"

    @state = osu.parseJson @jsonStorageId()

    if !@state?
      commentBundle = osu.jsonClone(@props.commentBundle) ?
        osu.parseJson("json-comments-#{@props.commentableType}-#{@props.commentableId}")


      # also props of the containing component
      @state =
        comments: commentBundle.comments ? []
        userVotes: commentBundle.user_votes
        users: commentBundle.users ? []
        topLevelCount: commentBundle.top_level_count
        total: commentBundle.total
        commentableMeta: commentBundle.commentable_meta ? []
        loadingSort: null
        currentSort: 'new'
        moreComments: {}


  componentDidMount: =>
    $.subscribe "comments:added.#{@id}", @appendBundle
    $.subscribe "comments:sort.#{@id}", @updateSort
    $.subscribe "comment:updated.#{@id}", @update
    $.subscribe "commentVote:added.#{@id}", @addVote
    $.subscribe "commentVote:removed.#{@id}", @removeVote
    $(document).on "turbolinks:before-cache.#{@id}", @saveState


  componentWillUnmount: =>
    $.unsubscribe ".#{@id}"


  render: =>
    componentProps = _.assign {}, @props.componentProps, @state
    componentProps.commentableId = @props.commentableId
    componentProps.commentableType = @props.commentableType
    componentProps.userVotesByCommentId = _.keyBy @state.userVotes
    componentProps.usersById = _.keyBy(@state.users ? [], 'id')
    componentProps.commentableMetaById = _(@state.commentableMeta ? [])
      .filter (item) -> item?
      .keyBy (item) -> "#{item.type ? ''}-#{item.id ? ''}"
      .value()

    el @props.component, componentProps


  appendBundle: (_event, {commentBundle, prepend}) =>
    moreComments = osu.jsonClone @state.moreComments
    moreComments[commentBundle.has_more_id] = commentBundle.has_more

    @setState
      comments: @mergeCollection @state.comments, commentBundle.comments, prepend
      users: @mergeCollection @state.users, commentBundle.users
      commentableMeta: _.concat @state.commentableMeta, commentBundle.commentable_meta
      moreComments: moreComments
      total: commentBundle.total ? @state.total


  update: (_event, {comment}) =>
    @setState
      comments: @mergeCollection @state.comments, [comment]
      users: @mergeCollection @state.users, [comment.user, comment.editor]
      commentableMeta: _.concat @state.commentableMeta, comment.commentable_meta


  mergeCollection: (array, values, prepend) =>
    result = osu.jsonClone array
    prepend ?= false

    method = if prepend then 'unshift' else 'push'

    for item in values
      continue unless item?

      pos = _.findIndex result, (i) -> i.id == item.id

      if pos == -1
        result[method] item
      else
        result[pos] = item

    result


  addVote: (_event, {id}) =>
    @setState userVotes: _.concat @state.userVotes, id


  removeVote: (_event, {id}) =>
    @setState userVotes: _.filter @state.userVotes, (commentId) -> commentId != id


  jsonStorageId: =>
    "json-comments-manager-state-#{@props.commentableType}-#{@props.commentableId}"


  saveState: =>
    osu.storeJson @jsonStorageId(), @state


  updateSort: (_event, {sort}) =>
    return unless @props.commentableType && @props.commentableId

    return unless sort in @SORTS

    @setState loadingSort: sort

    params =
      commentable_type: @props.commentableType
      commentable_id: @props.commentableId
      sort: sort
      parent_id: 0

    $.ajax laroute.route('comments.index'),
      data: params
      dataType: 'json'
    .done (data) =>
      @setState
        comments: data.comments ? []
        users: data.users ? []
        commentableMeta: data.commentable_meta ? []
        userVotes: data.user_votes ? []
        topLevelCount: data.top_level_count
        total: data.total ? @state.total
        currentSort: sort
        moreComments: {}
    .always =>
      @setState
        loadingSort: null
