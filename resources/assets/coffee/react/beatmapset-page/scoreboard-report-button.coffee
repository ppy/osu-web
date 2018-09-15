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

{button, i, span} = ReactDOMFactories

class BeatmapsetPage.ScoreboardReportButton extends React.PureComponent
  onClick: (e) =>
    return if e.button != 0
    e.preventDefault()
    $.publish 'score:report',
      mode: @props.mode
      score: @props.score

  render: ->
    if @props.reported
      span className: 'report-button',
        span null,
          i className: 'fas fa-exclamation-triangle'
          span className: 'report-button__text',
            osu.trans('beatmapsets.show.scoreboard.score.reported')
    else
      button
        className: 'report-button report-button--enabled'
        key: 'button'
        type: 'button'
        onClick: @onClick
        span null,
          i className: 'fas fa-exclamation-triangle'
          span className: 'report-button__text',
            osu.trans('beatmapsets.show.scoreboard.score.report')
