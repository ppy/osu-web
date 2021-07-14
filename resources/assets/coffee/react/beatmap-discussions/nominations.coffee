# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import { BigButton } from 'big-button'
import { Modal } from 'modal'
import * as React from 'react'
import { a, div, i, span } from 'react-dom-factories'
import { StringWithComponent } from 'string-with-component'
import BeatmapsOwnerEditor from 'beatmap-discussions/beatmaps-owner-editor'
import { Nominator } from 'beatmap-discussions/nominator'
import { nominationsCount } from 'utils/beatmapset-helper'
import { pageChange } from 'utils/page-change'

el = React.createElement

bn = 'beatmap-discussion-nomination'
dateFormat = 'LL'

export class Nominations extends React.PureComponent
  constructor: (props) ->
    super props

    @xhr = {}
    @state = changeOwnerModal: false


  componentDidMount: =>
    pageChange()


  componentWillUnmount: =>
    xhr?.abort() for _name, xhr of @xhr
    Timeout.clear @hypeFocusTimeout if @hypeFocusTimeout


  componentDidUpdate: =>
    pageChange()


  render: =>
    div className: bn,
      @renderChangeOwnerModal()
      div className: "#{bn}__items #{bn}__items--messages",
        div className: "#{bn}__item", @statusMessage()
        div className: "#{bn}__item", @hypeBar()
        div className: "#{bn}__item", @nominationBar()
        div className: "#{bn}__item", @nominationResetMessage()
        div className: "#{bn}__item", @discussionLockMessage()
        div className: "#{bn}__item #{bn}__item--nominators", @nominatorsList()
      div className: "#{bn}__items #{bn}__items--buttons",
        div className: "#{bn}__items-grouping",
          div className: "#{bn}__item", @feedbackButton()
          div className: "#{bn}__item", @hypeButton()
          div className: "#{bn}__item", @disqualifyButton()
          div className: "#{bn}__item",
            el Nominator,
              beatmapset: @props.beatmapset
              currentHype: @props.currentDiscussions.totalHype
              currentUser: @props.currentUser
              unresolvedIssues: @props.currentDiscussions.unresolvedIssues
              users: @props.users
        div className: "#{bn}__items-grouping",
          div className: "#{bn}__item", @discussionLockButton()
          div className: "#{bn}__item", @loveButton()
          div className: "#{bn}__item", @removeFromLovedButton()
          div className: "#{bn}__item", @deleteButton()
          div className: "#{bn}__item", @changeOwnerButton()


  renderLights: (lightsOn, lightsTotal) ->
    div className: "#{bn}__lights",
      _.times lightsOn, (n) ->
        div
          key: n
          className: 'bar bar--beatmapset-hype bar--beatmapset-on'

      _.times (lightsTotal - lightsOn), (n) ->
        div
          key: lightsOn + n
          className: 'bar bar--beatmapset-hype bar--beatmapset-off'


  # nominations = { 'current': { 'osu': 1, 'taiko': 0, ... }, 'required': { 'osu': 2, 'taiko': 2, ... }, ... };
  renderLightsForNominations: (nominations = {}) ->
    if nominations?.legacy_mode || !@isHybridMode()
      if nominations?.legacy_mode
        current = nominations.current
        required = nominations.required
      else
        mode = _.keys(this.props.beatmapset.nominations?.required)[0]
        current = nominations.current[mode]
        required = nominations.required[mode]

      @renderLights(current, required)
    else
      div className: "#{bn}__lights",
        _.map nominations.required, (requiredLights, mode) ->
          el React.Fragment, key: mode,
            _.times nominations.current[mode], (n) ->
              div
                key: n
                className: 'bar bar--beatmapset-nomination bar--beatmapset-on'
                i className: "fal fa-extra-mode-#{mode}"

            _.times (requiredLights - nominations.current[mode]), (n) ->
              div
                key: nominations.current[mode] + n
                className: 'bar bar--beatmapset-nomination bar--beatmapset-off'
                i className: "fal fa-extra-mode-#{mode}"


  delete: =>
    message = if @userIsOwner()
                osu.trans('beatmaps.nominations.delete_own_confirm')
              else
                osu.trans('beatmaps.nominations.delete_other_confirm')

    return unless confirm(message)

    LoadingOverlay.show()

    @xhr.delete?.abort()

    user = @props.beatmapset.user_id
    url = laroute.route('beatmapsets.destroy', beatmapset: @props.beatmapset.id)
    params = method: 'DELETE'

    @xhr.delete = $.ajax(url, params)
      .done ->
        Turbolinks.visit laroute.route('users.show', { user })
      .fail osu.ajaxError
      .always LoadingOverlay.hide


  discussionLock: =>
    reason = osu.presence(prompt(osu.trans('beatmaps.discussions.lock.prompt.lock')))

    return unless reason?

    @xhr.discussionLock?.abort()

    url = laroute.route('beatmapsets.discussion-lock', beatmapset: @props.beatmapset.id)
    params =
      method: 'POST'
      data: { reason }

    @xhr.discussionLock = $.ajax(url, params)
      .done (response) =>
        $.publish 'beatmapsetDiscussions:update', beatmapset: response
      .fail osu.ajaxError
      .always LoadingOverlay.hide


  discussionUnlock: =>
    return unless confirm(osu.trans('beatmaps.discussions.lock.prompt.unlock'))

    LoadingOverlay.show()

    @xhr.discussionLock?.abort()

    url = laroute.route('beatmapsets.discussion-unlock', beatmapset: @props.beatmapset.id)
    params = method: 'POST'

    @xhr.discussionLock = $.ajax(url, params)
      .done (response) =>
        $.publish 'beatmapsetDiscussions:update', beatmapset: response
      .fail osu.ajaxError
      .always LoadingOverlay.hide


  love: =>
    return unless confirm(osu.trans('beatmaps.nominations.love_confirm'))

    LoadingOverlay.show()

    @xhr.love?.abort()

    url = laroute.route('beatmapsets.love', beatmapset: @props.beatmapset.id)
    params = method: 'PUT'

    @xhr.love = $.ajax(url, params)
      .done (response) =>
        $.publish 'beatmapsetDiscussions:update', beatmapset: response
      .fail osu.ajaxError
      .always LoadingOverlay.hide


  removeFromLoved: =>
    reason = osu.presence(prompt(osu.trans('beatmaps.nominations.remove_from_loved_prompt')))

    return unless reason?

    LoadingOverlay.show()

    @xhr.removeFromLoved?.abort()

    url = laroute.route('beatmapsets.remove-from-loved', beatmapset: @props.beatmapset.id)
    params =
      method: 'DELETE'
      data: { reason }

    @xhr.removeFromLoved = $.ajax(url, params)
      .done (response) =>
        $.publish 'beatmapsetDiscussions:update', beatmapset: response
      .fail osu.ajaxError
      .always LoadingOverlay.hide


  focusHypeInput: =>
    hypeMessage = $('.js-hype--explanation')
    flashClass = 'js-flash-border--on'

    # switch to generalAll tab, set current filter to praises
    $.publish 'beatmapsetDiscussions:update',
      mode: 'generalAll'
      filter: 'praises'

    @focusNewDiscussion ->
      # flash border of hype description to emphasize input is required
      $(hypeMessage).addClass(flashClass)
      @hypeFocusTimeout = Timeout.set 1000, ->
        $(hypeMessage).removeClass(flashClass)


  focusNewDiscussion: (callback) ->
    inputBox = $('.js-hype--input')

    osu.focus(inputBox)

    # ensure input box is in view and focus it
    $.scrollTo inputBox, 200,
      interrupt: true
      offset: -100
      onAfter: callback


  focusNewDiscussionWithModeSwitch: =>
    # Switch to generalAll tab just in case currently in event tab
    # and thus new discussion box isn't visible.
    $.publish 'beatmapsetDiscussions:update',
      mode: 'generalAll'
      modeIf: 'events'
      callback: @focusNewDiscussion


  isHybridMode: =>
    _.keys(this.props.beatmapset.nominations?.required).length > 1


  parseEventData: (event) =>
    user = @props.users[event.user_id]
    discussion = @props.discussions[event.comment.beatmap_discussion_id]

    if discussion?
      url = BeatmapDiscussionHelper.url discussion: discussion

      link = osu.link url, "##{discussion.id}", classNames: ['js-beatmap-discussion--jump']
      message = BeatmapDiscussionHelper.previewMessage(discussion.posts[0].message)
    else
      link = "##{event.comment.beatmap_discussion_id}"
      message = osu.trans('beatmaps.nominations.reset_message_deleted')

    {user, discussion, link, message}


  resetReason: (event) =>
    if event.type == 'disqualify' && typeof event.comment != 'object'
      reason =
        if event.comment?
          BeatmapDiscussionHelper.format event.comment,
            newlines: false
            modifiers: ['white']
        else
          osu.trans('beatmaps.nominations.disqualified_no_reason')

      return osu.trans 'beatmaps.nominations.disqualified_at',
        time_ago: osu.timeago(event.created_at)
        reason: reason

    parsedEvent = @parseEventData(event)

    osu.trans "beatmaps.nominations.reset_at.#{event.type}",
      time_ago: osu.timeago(event.created_at)
      discussion: parsedEvent.link
      message: parsedEvent.message
      user: osu.link laroute.route('users.show', user: parsedEvent.user.id), parsedEvent.user.username


  userCanDisqualify: =>
    @props.currentUser.is_admin || @props.currentUser.is_moderator || @props.currentUser.is_full_bn


  userIsOwner: =>
    @props.currentUser? && @props.currentUser.id == @props.beatmapset.user_id


  statusMessage: =>
    switch @props.beatmapset.status
      when 'approved', 'loved', 'ranked'
        osu.trans "beatmaps.discussions.status-messages.#{@props.beatmapset.status}",
          date: moment(@props.beatmapset.ranked_date).format(dateFormat)
      when 'graveyard'
        osu.trans 'beatmaps.discussions.status-messages.graveyard',
          date: moment(@props.beatmapset.last_updated).format(dateFormat)
      when 'wip'
        osu.trans 'beatmaps.discussions.status-messages.wip'
      when 'qualified'
        rankingETA = @props.beatmapset.nominations.ranking_eta
        date =
          if rankingETA?
            moment(rankingETA).format(dateFormat)
          else
            osu.trans 'beatmaps.nominations.rank_estimate.soon'

        el StringWithComponent,
          mappings:
            ':date': date
            ':position': @props.beatmapset.nominations.ranking_queue_position
            ':queue': a
              href: laroute.route('wiki.show', path: 'Beatmap_ranking_procedure/Ranking_queue', locale: currentLocale)
              key: 'queue'
              target: '_blank'
              osu.trans 'beatmaps.nominations.rank_estimate.queue'
          pattern: osu.trans 'beatmaps.nominations.rank_estimate._'
      else
        null


  hypeBar: =>
    return null unless @props.beatmapset.can_be_hyped

    requiredHype = @props.beatmapset.hype.required
    hypeRaw = @props.currentDiscussions.totalHype
    hype = _.min([requiredHype, hypeRaw])

    div null,
      div className: "#{bn}__header",
        span
          className: "#{bn}__title"
          osu.trans 'beatmaps.hype.section_title'
        span {},
          "#{hypeRaw} / #{requiredHype}"
      @renderLights(hype, requiredHype)


  nominationBar: =>
    requiredHype = @props.beatmapset.hype?.required
    hypeRaw = @props.currentDiscussions.totalHype
    mapCanBeNominated = @props.beatmapset.status == 'pending' && hypeRaw >= requiredHype
    mapIsQualified = @props.beatmapset.status == 'qualified'

    return null unless mapCanBeNominated || mapIsQualified

    nominations = @props.beatmapset.nominations

    div null,
      div className: "#{bn}__header",
        span
          className: "#{bn}__title"
          osu.trans 'beatmaps.nominations.title'
        span null,
          " #{nominationsCount(nominations, 'current')} / #{nominationsCount(nominations, 'required')}"

      @renderLightsForNominations(nominations)


  nominationResetMessage: =>
    showHype = @props.beatmapset.can_be_hyped
    nominationReset = @props.beatmapset.nominations.nomination_reset
    mapIsQualified = @props.beatmapset.status == 'qualified'

    return null unless showHype && !mapIsQualified && nominationReset?

    div dangerouslySetInnerHTML:
      __html: @resetReason(nominationReset)


  nominatorsList: =>
    return null unless @props.beatmapset.status in ['wip', 'pending', 'ranked', 'qualified']

    nominators = []
    for event in @props.events by -1
      if event.type == 'disqualify' || event.type == 'nomination_reset'
        break
      else if event.type == 'nominate'
        nominators.unshift @props.users[event.user_id]

    return null if nominators.length == 0

    div dangerouslySetInnerHTML:
      __html: osu.trans 'beatmaps.nominations.nominated_by',
        users: osu.transArray nominators.map (user) ->
            osu.link laroute.route('users.show', user: user.id), user.username,
              classNames: ['js-usercard']
              props:
                'data-user-id': user.id


  discussionLockMessage: =>
    return null unless @props.beatmapset.discussion_locked

    lockEvent = _.findLast @props.events, type: 'discussion_lock'

    return null unless lockEvent?

    div dangerouslySetInnerHTML:
      __html: osu.trans 'beatmapset_events.event.discussion_lock',
        text: BeatmapDiscussionHelper.format(lockEvent.comment.reason, newlines: false)


  feedbackButton: =>
    return null unless @props.currentUser.id? && !@userIsOwner() && !@props.beatmapset.can_be_hyped && !@props.beatmapset.discussion_locked

    el BigButton,
      text: osu.trans 'beatmaps.feedback.button'
      icon: 'fas fa-bullhorn'
      props:
        onClick: @focusNewDiscussionWithModeSwitch


  hypeButton: =>
    return null unless @props.beatmapset.can_be_hyped && @props.currentUser.id? && !@userIsOwner()

    userAlreadyHyped = _.find(@props.currentDiscussions.byFilter.hype.generalAll, user_id: @props.currentUser.id)?

    el BigButton,
      text: if userAlreadyHyped then osu.trans('beatmaps.hype.button_done') else osu.trans('beatmaps.hype.button')
      icon: 'fas fa-bullhorn'
      props:
        disabled: !@props.beatmapset.current_user_attributes.can_hype
        title: @props.beatmapset.current_user_attributes?.can_hype_reason
        onClick: @focusHypeInput


  disqualifyButton: =>
    mapIsQualified = @props.beatmapset.status == 'qualified'

    return null unless mapIsQualified && @userCanDisqualify()

    el BigButton,
      text: osu.trans 'beatmaps.nominations.disqualify'
      icon: 'fas fa-thumbs-down'
      modifiers: ['warning']
      props:
        onClick: @focusNewDiscussionWithModeSwitch


  discussionLockButton: =>
    canModeratePost = BeatmapDiscussionHelper.canModeratePosts(@props.currentUser)

    return null unless canModeratePost

    if @props.beatmapset.discussion_locked
      action = 'unlock'
      icon = 'fas fa-unlock'
      onClick = @discussionUnlock
    else
      action = 'lock'
      icon = 'fas fa-lock'
      onClick = @discussionLock

    el BigButton,
      text: osu.trans "beatmaps.discussions.lock.button.#{action}"
      icon: icon
      modifiers: ['warning']
      props: { onClick }


  loveButton: =>
    return null unless @props.beatmapset.current_user_attributes?.can_love

    el BigButton,
      text: osu.trans 'beatmaps.nominations.love'
      icon: 'fas fa-heart'
      modifiers: ['pink']
      props:
        onClick: @love


  removeFromLovedButton: =>
    return null unless @props.beatmapset.current_user_attributes?.can_remove_from_loved

    el BigButton,
      text: osu.trans 'beatmaps.nominations.remove_from_loved'
      icon: 'fas fa-heart-broken'
      modifiers: ['danger']
      props:
        onClick: @removeFromLoved


  deleteButton: =>
    return null unless @props.beatmapset.current_user_attributes?.can_delete

    el BigButton,
      text: osu.trans 'beatmaps.nominations.delete'
      icon: 'fas fa-trash'
      modifiers: ['danger']
      props:
        onClick: @delete


  changeOwnerButton: =>
    return null unless @props.beatmapset.current_user_attributes?.can_beatmap_update_owner

    el BigButton,
      text: osu.trans 'beatmap_discussions.owner_editor.button'
      icon: 'fas fa-pen'
      props:
        onClick: @handleChangeOwnerClick


  handleChangeOwnerClick: =>
    @setState changeOwnerModal: !@state.changeOwnerModal


  renderChangeOwnerModal: =>
    return if !@state.changeOwnerModal

    el Modal, visible: true,
      el BeatmapsOwnerEditor,
        beatmapset: @props.beatmapset,
        users: @props.users
        onClose: @handleChangeOwnerClick
