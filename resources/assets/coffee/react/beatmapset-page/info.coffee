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

{a, button, div, h3, span, textarea} = ReactDOMFactories
el = React.createElement

class BeatmapsetPage.Info extends React.Component
  constructor: (props) ->
    super props

    @state =
      isBusy: false
      isEditing: false


  componentDidMount: ->
    @renderChart()


  componentDidUpdate: ->
    @renderChart()


  componentWillUnmount: =>
    $(window).off '.beatmapsetPageInfo'


  dismissEditor: (e) =>
    @setState isEditing: false if e.target == @overlay


  editStart: =>
    @setState isEditing: true


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
    return if !@props.beatmapset.has_scores

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
          el Icon, name: 'edit'


  render: ->
    percentage = _.round (@props.beatmap.passcount / (@props.beatmap.playcount + @props.beatmap.passcount)) * 100

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
            ref: (element) => @overlay = element

            div className: 'beatmapset-description-editor__container osu-page',
              el BBCodeEditor,
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

        div className: 'beatmapset-info__description-container',
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

            div null, @props.beatmapset.source

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
        if @props.beatmapset.has_scores
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
              style:
                paddingLeft: "#{percentage}%"
              div null, "#{percentage}%"

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
