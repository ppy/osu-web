###
# Copyright 2015-2016 ppy Pty. Ltd.
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

{a, button, div, p, span} = React.DOM
el = React.createElement

bn = 'beatmap-discussion-nomination'

BeatmapDiscussions.Nominations = React.createClass
  mixins: [React.addons.PureRenderMixin]

  nominate: ->
    return unless confirm(osu.trans('beatmaps.nominations.nominate-confirm'))

    @doAjax 'nominate'

  disqualify: ->
    reason = prompt osu.trans('beatmaps.nominations.disqualification-prompt')
    return unless reason

    @doAjax 'disqualify', reason

  doAjax: (action, comment) ->
    LoadingOverlay.show()

    params =
      method: 'PUT'

    if comment
      params.data =
        comment: comment

    $.ajax laroute.route("beatmapsets.#{action}", beatmapset: @props.beatmapset.id), params

    .done (response) =>
      $.publish 'beatmapset:update', beatmapset: response.beatmapset

    .fail osu.ajaxError
    .always LoadingOverlay.hide

  componentDidMount: ->
    osu.pageChange()

  componentDidUpdate: ->
    osu.pageChange()

  render: ->
    userCanPerformNominations = @props.currentUser.isAdmin or @props.currentUser.isGMT or @props.currentUser.isBAT
    mapCanBeNominated = (@props.beatmapset.status == 'pending')
    mapIsQualified = (@props.beatmapset.status == 'qualified')

    return null unless mapCanBeNominated || mapIsQualified

    if mapIsQualified
      rankingETA = @props.beatmapset.nominations.ranking_eta

    if mapCanBeNominated
      nominations = @props.beatmapset.nominations
      disqualification = nominations.disqualification

    div className: bn,
      div className: "#{bn}__header",
        span
          className: "#{bn}__title"
          osu.trans 'beatmaps.nominations.title'
        if mapCanBeNominated
          "#{nominations.current}/#{nominations.required}"

      if mapCanBeNominated
        div className: "#{bn}__lights",
          _.times nominations.current, (n) =>
            div
              key: n
              className: 'bar bar--beatmapset-nomination bar--beatmapset-nomination-on'
          _.times (nominations.required - nominations.current), (n) =>
            div
              key: nominations.current + n
              className: 'bar bar--beatmapset-nomination bar--beatmapset-nomination-off'

      div className: "#{bn}__footer #{"#{bn}__footer--extended" unless mapCanBeNominated}",
        div className: "#{bn}__note",
          # implies mapCanBeNominated
          if disqualification
            span
              dangerouslySetInnerHTML:
                __html: osu.trans 'beatmaps.nominations.disqualifed-at',
                  time_ago: osu.timeago(disqualification.created_at)
                  reason: disqualification.reason ? osu.trans('beatmaps.nominations.disqualifed_no_reason')
          else if mapIsQualified
            if rankingETA
              span dangerouslySetInnerHTML:
                __html: osu.trans 'beatmaps.nominations.qualified',
                  date: osu.timeago(rankingETA)
            else
              span null, osu.trans 'beatmaps.nominations.qualified-soon'

        div null,
          if userCanPerformNominations
            if mapIsQualified
              el BigButton,
                text: osu.trans 'beatmaps.nominations.disqualify'
                icon: 'thumbs-down'
                props:
                  onClick: @disqualify
            else if mapCanBeNominated
              el BigButton,
                text: osu.trans 'beatmaps.nominations.nominate'
                icon: 'thumbs-up'
                props:
                  onClick: @nominate
