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

import { runInAction } from 'mobx'
import core from 'osu-core-singleton'

commentableMetaStore = core.dataStore.commentableMetaStore
commentStore = core.dataStore.commentStore
userStore = core.dataStore.userStore

uiState = core.dataStore.uiState

el = React.createElement

export class CommentsManager extends React.PureComponent
  SORTS: ['new', 'old', 'top']


  constructor: (props) ->
    super props

    json = if @props.commentBundle?
             @props.commentBundle
           else if @props.commentableType? && @props.commentableId?
             json = osu.parseJson("json-comments-#{@props.commentableType}-#{@props.commentableId}") ? {}

    if json?
      core.dataStore.commentStore.updateWithJSON(json.comments)
      core.dataStore.userStore.updateWithJSON(json.users)
      core.dataStore.commentableMetaStore.updateWithJSON(json.commentable_meta)

    @id = "comments-#{osu.uuid()}"

    @state = osu.parseJson @jsonStorageId()

    if !@state?
      uiState.comments.currentSort = json.sort
      # also props of the containing component
      @state =
        userVotes: json.user_votes
        loadingFollow: false
        userFollow: json.user_follow
        topLevelCount: json.top_level_count
        total: json.total
        moreComments: {}


  componentDidMount: =>
    $.subscribe "comments:added.#{@id}", @appendBundle
    $.subscribe "comments:sort.#{@id}", @updateSort
    $.subscribe "comments:toggle-show-deleted.#{@id}", @toggleShowDeleted
    $.subscribe "comments:toggle-follow.#{@id}", @toggleFollow
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

    el @props.component, componentProps


  appendBundle: (_event, {commentBundle, prepend}) =>
    moreComments = osu.jsonClone @state.moreComments
    moreComments[commentBundle.has_more_id] = commentBundle.has_more

    commentableMetaStore.updateWithJSON commentBundle.commentable_meta
    commentStore.updateWithJSON commentBundle.comments
    userStore.updateWithJSON commentBundle.users

    @setState
      moreComments: moreComments
      total: commentBundle.total ? @state.total


  update: (_event, {commentable_meta, comments, users}) =>
    commentableMetaStore.updateWithJSON commentable_meta
    commentStore.updateWithJSON comments
    userStore.updateWithJSON users


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


  toggleShowDeleted: =>
    uiState.comments.isShowDeleted = !uiState.comments.isShowDeleted


  toggleFollow: =>
    params = follow:
      notifiable_type: @props.commentableType
      notifiable_id: @props.commentableId
      subtype: 'comment'

    return if @state.loadingFollow

    @setState loadingFollow: true

    $.ajax laroute.route('follows.store'),
      data: params
      dataType: 'json'
      method: if @state.userFollow then 'DELETE' else 'POST'
    .always =>
      @setState loadingFollow: false
    .done =>
      @setState userFollow: !@state.userFollow
    .fail (xhr, status) =>
      return if status == 'abort'

      osu.ajaxError xhr


  updateSort: (_event, {sort}) =>
    return unless @props.commentableType && @props.commentableId

    return unless sort in @SORTS

    runInAction () ->
      uiState.comments.loadingSort = sort

    params =
      commentable_type: @props.commentableType
      commentable_id: @props.commentableId
      sort: sort
      parent_id: 0

    $.ajax laroute.route('comments.index'),
      data: params
      dataType: 'json'
    .done (data) =>
      $.ajax laroute.route('account.options'),
        method: 'PUT'
        data: user_profile_customization: comments_sort: sort

      runInAction () ->
        uiState.comments.currentSort = data.sort

      @setState
        users: data.users ? []
        commentableMeta: data.commentable_meta ? []
        userVotes: data.user_votes ? []
        userFollow: data.user_follow
        topLevelCount: data.top_level_count
        total: data.total ? @state.total
        moreComments: {}
    .always =>
      runInAction () ->
        uiState.comments.loadingSort = null

