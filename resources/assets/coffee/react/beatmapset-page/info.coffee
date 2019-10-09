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

import { BBCodeEditor } from 'bbcode-editor'
import * as React from 'react'
import { a, button, div, h3, span, i, textarea } from 'react-dom-factories'
el = React.createElement

export class Info extends React.Component
  constructor: (props) ->
    super props

    @overlay = React.createRef()

    @state =
      isBusy: false
      isEditing: false


  componentDidMount: ->
    @renderChart()


  componentDidUpdate: ->
    @renderChart()


  componentWillUnmount: =>
    $(window).off '.beatmapsetPageInfo'


  # see Modal#hideModal
  dismissEditor: (e) =>
    @setState isEditing: false if e.button == 0 &&
                                  e.target == @overlay.current &&
                                  @clickEndTarget == @clickStartTarget


  editStart: =>
    @setState isEditing: true


  handleClickEnd: (e) =>
    @clickEndTarget = e.target


  handleClickStart: (e) =>
    @clickStartTarget = e.target


  onEditorChange: (action) =>
    switch action.type
      when 'save'
        if action.hasChanged
          @saveDescription(action.value)
        else
          @setState isEditing: false

      when 'cancel'
        @setState isEditing: false


  onSelectionUpdate: (selection) =>
    @setState selection: selection


  saveDescription: (value) =>
    @setState isBusy: true
    $.ajax laroute.route('beatmapsets.update', beatmapset: @props.beatmapset.id),
      method: 'PATCH',
      data:
        description: value

    .done (data) =>
      @setState
        isEditing: false
        description: data.description

    .fail osu.ajaxError

    .always =>
      @setState isBusy: false


  withEdit: =>
     @props.beatmapset.description.bbcode?


  renderChart: ->
    return if !@props.beatmapset.is_scoreable || @props.beatmap.playcount < 1

    unless @_failurePointsChart?
      options =
        scales:
          x: d3.scaleLinear()
          y: d3.scaleLinear()
        modifiers: ['beatmap-success-rate']

      @_failurePointsChart = new StackedBarChart @refs.chartArea, options
      $(window).on 'throttled-resize.beatmapsetPageInfo', @_failurePointsChart.resize

    @_failurePointsChart.loadData @props.beatmap.failtimes


  renderEditButton: =>
    div className: 'beatmapset-info__edit-description',
      button
        type: 'button'
        className: 'btn-circle'
        onClick: @editStart
        span className: 'btn-circle__content',
          i className: 'fas fa-pencil-alt'


  render: ->
    tags = _(@props.beatmapset.tags)
      .split(' ')
      .filter((t) -> t? && t != '')
      .slice(0, 21)
      .value()

    if tags.length == 21
      tags.pop()
      tagsOverload = true

    div className: 'beatmapset-info',
      if @state.isEditing
        div className: 'beatmapset-description-editor',
          div
            className: 'beatmapset-description-editor__overlay'
            onClick: @dismissEditor
            onMouseDown: @handleClickStart
            onMouseUp: @handleClickEnd
            ref: @overlay

            div className: 'beatmapset-description-editor__container osu-page',
              el BBCodeEditor,
                modifiers: ['beatmapset-description-editor']
                disabled: @state.isBusy
                onChange: @onEditorChange
                onSelectionUpdate: @onSelectionUpdate
                rawValue: @state.description?.bbcode ? @props.beatmapset.description.bbcode
                selection: @state.selection

      div className: 'beatmapset-info__box beatmapset-info__box--description',
        @renderEditButton() if @withEdit()

        h3
          className: 'beatmapset-info__header'
          osu.trans 'beatmapsets.show.info.description'

        div className: 'beatmapset-info__description-container u-fancy-scrollbar',
          div
            className: 'beatmapset-info__description'
            dangerouslySetInnerHTML:
              __html: @state.description?.description ? @props.beatmapset.description.description

      div className: 'beatmapset-info__box beatmapset-info__box--meta',
        if @props.beatmapset.source
          div null,
            h3
              className: 'beatmapset-info__header'
              osu.trans 'beatmapsets.show.info.source'

            a
              href: laroute.route('beatmapsets.index', q: @props.beatmapset.source)
              @props.beatmapset.source

        div className: 'beatmapset-info__half-box',
          div className: 'beatmapset-info__half-entry',
            h3 className: 'beatmapset-info__header',
              osu.trans 'beatmapsets.show.info.genre'
            a
              href: laroute.route('beatmapsets.index', g: @props.beatmapset.genre.id)
              @props.beatmapset.genre.name

          div className: 'beatmapset-info__half-entry',
            h3 className: 'beatmapset-info__header',
              osu.trans 'beatmapsets.show.info.language'
            a
              href: laroute.route('beatmapsets.index', l: @props.beatmapset.language.id)
              @props.beatmapset.language.name

        if tags.length > 0
          div null,
            h3
              className: 'beatmapset-info__header'
              osu.trans 'beatmapsets.show.info.tags'

            div null,
              for tag in tags
                [
                  a
                    key: tag
                    href: laroute.route('beatmapsets.index', q: tag)
                    tag
                  span key: "#{tag}-space", ' '
                ]
              '...' if tagsOverload

      div className: 'beatmapset-info__box beatmapset-info__box--success-rate',
        if !@props.beatmapset.is_scoreable
          div className: 'beatmap-success-rate',
            div
              className: 'beatmap-success-rate__empty'
              osu.trans 'beatmapsets.show.info.unranked'
        else
          if @props.beatmap.playcount > 0
            percentage = _.round((@props.beatmap.passcount / @props.beatmap.playcount) * 100, 1)
            div className: 'beatmap-success-rate',
              h3
                className: 'beatmap-success-rate__header'
                osu.trans 'beatmapsets.show.info.success-rate'

              div className: 'bar bar--beatmap-success-rate',
                div
                  className: 'bar__fill'
                  style:
                    width: "#{percentage}%"

              div
                className: 'beatmap-success-rate__percentage'
                title: "#{osu.formatNumber(@props.beatmap.passcount)} / #{osu.formatNumber(@props.beatmap.playcount)}"
                'data-tooltip-position': 'bottom center'
                style:
                  marginLeft: "#{percentage}%"
                "#{percentage}%"

              h3
                className: 'beatmap-success-rate__header'
                osu.trans 'beatmapsets.show.info.points-of-failure'

              div
                className: 'beatmap-success-rate__chart'
                ref: 'chartArea'
          else
            div className: 'beatmap-success-rate',
              div
                className: 'beatmap-success-rate__empty'
                osu.trans 'beatmapsets.show.info.no_scores'
