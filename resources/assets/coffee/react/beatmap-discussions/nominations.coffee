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

{a, button, div, p, span} = ReactDOMFactories
el = React.createElement

bn = 'beatmap-discussion-nomination'

class BeatmapDiscussions.Nominations extends React.PureComponent
  componentDidMount: =>
    osu.pageChange()


  componentWillUnmount: =>
    @xhr?.abort()
    Timeout.clear @hypeFocusTimeout if @hypeFocusTimeout


  componentDidUpdate: =>
    osu.pageChange()


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
      onAfter: -> callback?()


  nominationButton: (disabled = false) =>
    el BigButton,
      modifiers: ['full']
      text: osu.trans 'beatmaps.nominations.nominate'
      icon: 'thumbs-up'
      props:
        disabled: disabled
        onClick: @nominate

  render: =>
    showHype = @props.beatmapset.can_be_hyped

    if showHype
      requiredHype = @props.beatmapset.nominations.required_hype
      hypeRaw = _.size @props.currentDiscussions.byFilter.hype.generalAll
      hype = _.min([requiredHype, hypeRaw])
      userAlreadyHyped = _.find(@props.currentDiscussions.byFilter.hype.generalAll, user_id: @props.currentUser.id)?

    userCanNominate = @props.currentUser.is_admin || @props.currentUser.is_bng || @props.currentUser.is_qat
    userCanDisqualify = @props.currentUser.is_admin || @props.currentUser.is_qat
    mapCanBeNominated = @props.beatmapset.status == 'pending' && hypeRaw >= requiredHype
    mapIsQualified = (@props.beatmapset.status == 'qualified')

    dateFormat = 'LL'

    if mapIsQualified
      rankingETA = @props.beatmapset.nominations.ranking_eta

    if mapIsQualified || mapCanBeNominated
      nominations = @props.beatmapset.nominations
      if !mapIsQualified
        disqualification = nominations.disqualification
        nominationReset = nominations.nomination_reset

    nominators = []
    for event in @props.events by -1
      if event.type == 'disqualify' || event.type == 'nomination_reset'
        break
      else if event.type == 'nominate'
        nominators.unshift @props.users[event.user_id]

    if nominationReset?
      nominationResetDiscussionId = nominationReset.comment.beatmap_discussion_id
      url = BeatmapDiscussionHelper.url discussion: @props.discussions[nominationResetDiscussionId]
      nominationResetDiscussionLink = osu.link url, "##{nominationResetDiscussionId}", classNames: ['js-beatmap-discussion--jump']


    div className: bn,
      # hide hype meter and nominations when beatmapset is: ranked, approved, loved or graveyarded
      if !showHype
        div className: "#{bn}__row #{bn}__row--status-message",
          div className: "#{bn}__row-left",
              div className: "#{bn}__header",
                span
                  className: "#{bn}__status-message"
                  switch @props.beatmapset.status
                    when 'approved', 'loved', 'ranked'
                      osu.trans "beatmaps.discussions.status-messages.#{@props.beatmapset.status}",
                        date: moment(@props.beatmapset.ranked_date).format(dateFormat)
                    when 'graveyard'
                      osu.trans 'beatmaps.discussions.status-messages.graveyard',
                        date: moment(@props.beatmapset.last_updated).format(dateFormat)

          if currentUser.id?
            div className: "#{bn}__row-right",
              el BigButton,
                modifiers: ['full', 'wrap-text']
                text: osu.trans 'beatmaps.feedback.button'
                icon: 'bullhorn'
                props:
                  onClick: @focusNewDiscussion

      # show hype meter and nominations when beatmapset is: wip, pending or qualified
      else
        [
          if @props.beatmapset.status == 'wip'
            div
              className: "#{bn}__row"
              key: 'wip',
              div className: "#{bn}__row-left",
                div className: "#{bn}__header",
                  span
                    className: "#{bn}__status-message"
                    osu.trans 'beatmaps.discussions.status-messages.wip'

          div
            className: "#{bn}__row"
            key: 'hype',
            div className: "#{bn}__row-left",
              div className: "#{bn}__header",
                span
                  className: "#{bn}__title"
                  osu.trans 'beatmaps.hype.section_title'
                span {},
                  "#{hypeRaw} / #{requiredHype}"
              @renderLights(hype, requiredHype)

            if currentUser.id? && currentUser.id != @props.beatmapset.user_id
              div className: "#{bn}__row-right",
                el BigButton,
                  modifiers: ['full', 'wrap-text']
                  text: if userAlreadyHyped then osu.trans('beatmaps.hype.button_done') else osu.trans('beatmaps.hype.button')
                  icon: 'bullhorn'
                  props:
                    disabled: userAlreadyHyped
                    onClick: @focusHypeInput

          if mapCanBeNominated || mapIsQualified
            div
              className: "#{bn}__row"
              key: 'nominations',
              div className: "#{bn}__row-left",
                div className: "#{bn}__header",
                  span
                    className: "#{bn}__title"
                    osu.trans 'beatmaps.nominations.title'
                  span null,
                    " #{nominations.current}/#{nominations.required}"
                @renderLights(nominations.current, nominations.required)

              if currentUser.id?
                div className: "#{bn}__row-right",
                  if userCanDisqualify && mapIsQualified
                    el BigButton,
                      modifiers: ['full']
                      text: osu.trans 'beatmaps.nominations.disqualify'
                      icon: 'thumbs-down'
                      props:
                        onClick: @disqualify
                  else if userCanNominate && mapCanBeNominated
                    if @props.currentDiscussions.unresolvedIssues > 0
                      # wrapper 'cuz putting a title/tooltip on a disabled button is no worky...
                      div title: osu.trans('beatmaps.nominations.unresolved_issues'),
                        @nominationButton true
                    else
                      @nominationButton @props.beatmapset.nominations.nominated

          div
            className: "#{bn}__footer #{if mapCanBeNominated then "#{bn}__footer--extended" else ''}",
            key: 'footer'
            div className: "#{bn}__note #{bn}__note--disqualification",
              if mapIsQualified
                if rankingETA
                  span null,
                    osu.trans 'beatmaps.nominations.qualified',
                      date: moment(rankingETA).format(dateFormat)
                else
                  span null, osu.trans 'beatmaps.nominations.qualified_soon'

              # implies mapCanBeNominated
              else
                span null,
                  if disqualification?
                    span null,
                      span
                        dangerouslySetInnerHTML:
                          __html: osu.trans 'beatmaps.nominations.disqualified_at',
                            time_ago: osu.timeago(disqualification.created_at)
                            reason: disqualification.comment ? osu.trans('beatmaps.nominations.disqualified_no_reason')
                      ' ' # spacer
                  if nominationResetDiscussionLink?
                    span
                      dangerouslySetInnerHTML:
                        __html: osu.trans 'beatmaps.nominations.reset_at',
                          time_ago: osu.timeago(nominationReset.created_at)
                          discussion: nominationResetDiscussionLink
            if nominators.length > 0
              div
                className: "#{bn}__note #{bn}__note--nominators"
                dangerouslySetInnerHTML:
                  __html: osu.trans 'beatmaps.nominations.nominated_by',
                    users: nominators.map (user) ->
                        osu.link laroute.route('users.show', user: user.id), user.username,
                          classNames: ['js-usercard']
                          props:
                            'data-user-id': user.id
                      .join(', ')
        ]


  renderLights: (lightsOn, lightsTotal) ->
    lightsOff = lightsTotal - lightsOn

    div className: "#{bn}__lights",
      _.times lightsOn, (n) ->
        div
          key: n
          className: 'bar bar--beatmapset-nomination bar--beatmapset-nomination-on'

      _.times (lightsOff), (n) ->
        div
          key: lightsOn + n
          className: 'bar bar--beatmapset-nomination bar--beatmapset-nomination-off'


  disqualify: =>
    reason = prompt osu.trans('beatmaps.nominations.disqualification_prompt')
    return unless reason

    @doAjax 'disqualify', reason


  doAjax: (action, comment) =>
    LoadingOverlay.show()

    params =
      method: 'PUT'

    if comment
      params.data =
        comment: comment

    @xhr?.abort()

    @xhr = $.ajax laroute.route("beatmapsets.#{action}", beatmapset: @props.beatmapset.id), params

    .done (response) =>
      $.publish 'beatmapsetDiscussions:update', beatmapset: response

    .fail osu.ajaxError
    .always LoadingOverlay.hide


  nominate: =>
    return unless confirm(osu.trans('beatmaps.nominations.nominate_confirm'))

    @doAjax 'nominate'
