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
{a, button, div, p, span} = React.DOM
el = React.createElement

bd = 'beatmap-discussion'
bdn = 'beatmap-discussion-nomination'

BeatmapDiscussions.Nominations = React.createClass
  mixins: [React.addons.PureRenderMixin]

  nominate: ->
    @doAjax 'nominate'

  disqualify: ->
    reason = prompt('Reason for disqualification?')
    return unless reason

    @doAjax 'disqualify', reason

  doAjax: (action, comment) ->
    LoadingOverlay.show()

    params =
      method: 'PUT'

    if comment
      params['data'] = {'comment': comment}

    $.ajax laroute.route("beatmapsets.#{action}", beatmapsets: @props.beatmapset.beatmapset_id), params

    .done (response) =>
      $.publish 'beatmapset:update', beatmapset: response.beatmapset.data

    .fail osu.ajaxError
    .always LoadingOverlay.hide

  componentDidMount: ->
    $.subscribe 'beatmapset:nominate.beatmapset-nominations', @nominate
    $.subscribe 'beatmapset:disqualify.beatmapset-nominations', @disqualify

  componentWillUnmount: ->
    $.unsubscribe '.beatmapset-nominations'

  render: ->
    @reboot()

    disqualificationBanner =
      if @disqualification
        div className: 'osu-layout__row osu-layout__row--sm1 osu-layout__row--page-compact',
          div className: "#{bdn}__disqualification-notice",
            span null,
              "#{@disqualification.reason}"
            span className: "#{bdn}__disqualification-time", dangerouslySetInnerHTML:
              __html: osu.trans 'beatmaps.nominations.disqualifed-at', time_ago: osu.timeago(@disqualification.created_at)

    nominationBanner =
      if @mapCanBeNominated or @mapIsQualified
        div className: bdn,
          disqualificationBanner

          div className: 'osu-layout__row osu-layout__row--sm1 osu-layout__row--page-compact',
            div className: "#{bdn}__count-area#{(if @mapIsQualified then '-qualified' else '')}",
              span className: "#{bdn}__count-text",
                if @mapCanBeNominated
                  osu.trans 'beatmaps.nominations.required-text',
                    current: @currentNominations,
                    required: @nominationsRequired
                else if @mapIsQualified
                  if @rankingETA
                    span dangerouslySetInnerHTML:
                      __html: osu.trans 'beatmaps.nominations.qualified', date: osu.timeago(@rankingETA)
                  else
                    span dangerouslySetInnerHTML:
                      __html: osu.trans 'beatmaps.nominations.qualified-soon'

              if @userCanPerformNominations
                span className: "#{bdn}__button-area",
                  if @mapIsQualified
                    button
                      className: "btn-osu-lite btn-osu-lite--pink"
                      onClick: => $.publish 'beatmapset:disqualify', all: 'disqualify'
                      el Icon, name: 'thumbs-down'
                      span className: "#{bd}s__collapse-button-text",
                        osu.trans 'beatmaps.nominations.disqualify'
                  else if @mapCanBeNominated
                    button
                      className: "btn-osu-lite btn-osu-lite--green"
                      disabled: @alreadyNominated
                      onClick: => $.publish 'beatmapset:nominate', all: 'nominate'
                      el Icon, name: 'thumbs-up'
                      span className: "#{bd}s__collapse-button-text",
                        osu.trans 'beatmaps.nominations.nominate'

    return nominationBanner or null

  reboot: ->
    osu.pageChange()
    @userCanPerformNominations = @props.currentUser.isAdmin or @props.currentUser.isGMT or @props.currentUser.isBAT
    @mapCanBeNominated = (@props.beatmapset.status == 'pending')
    @mapIsQualified = (@props.beatmapset.status == 'qualified')

    if @mapIsQualified
      @rankingETA = @props.beatmapset.nominations.data.ranking_eta

    if @mapCanBeNominated
      nominations = @props.beatmapset.nominations.data
      @nominationsRequired = nominations.required
      @currentNominations = nominations.current
      @disqualification = nominations.disqualification
      if @userCanPerformNominations
        @alreadyNominated = nominations.nominated
