# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import MetadataEditor from 'beatmapsets-show/metadata-editor'
import BbcodeEditor from 'components/bbcode-editor'
import { Modal } from 'components/modal'
import { route } from 'laroute'
import { sum, zip } from 'lodash'
import core from 'osu-core-singleton'
import * as React from 'react'
import { a, button, div, h3, span, textarea } from 'react-dom-factories'
import { formatNumber } from 'utils/html'

el = React.createElement

export class Info extends React.Component
  constructor: (props) ->
    super props

    @state =
      isBusy: false
      isEditingDescription: false
      isEditingMetadata: false


  toggleEditingDescription: =>
    @setState isEditingDescription: !@state.isEditingDescription


  onEditorChange: (action) =>
    switch action.type
      when 'save'
        if action.hasChanged
          @saveDescription(action)
        else
          @setState isEditingDescription: false

      when 'cancel'
        @setState isEditingDescription: false


  saveDescription: ({ event, value }) =>
    target = event.target

    @setState isBusy: true
    $.ajax route('beatmapsets.update', beatmapset: @props.beatmapset.id),
      method: 'PATCH',
      data:
        description: value

    .done (data) =>
      @setState
        isEditingDescription: false
        description: data.description

    .fail osu.emitAjaxError(target)

    .always =>
      @setState isBusy: false


  toggleEditingMetadata: =>
    @setState isEditingMetadata: !@state.isEditingMetadata


  withEditDescription: =>
     @props.beatmapset.description.bbcode?


  withEditMetadata: =>
     @props.beatmapset.current_user_attributes?.can_edit_metadata ? false


  renderEditMetadataButton: =>
    div className: 'beatmapset-info__edit-button',
      button
        type: 'button'
        className: 'btn-circle'
        onClick: @toggleEditingMetadata
        span className: 'btn-circle__content',
          span className: 'fas fa-pencil-alt'


  renderEditDescriptionButton: =>
    div className: 'beatmapset-info__edit-button',
      button
        type: 'button'
        className: 'btn-circle'
        onClick: @toggleEditingDescription
        span className: 'btn-circle__content',
          span className: 'fas fa-pencil-alt'


  render: ->
    tags = _(@props.beatmapset.tags)
      .split(' ')
      .filter((t) -> t? && t != '')
      .value()

    div className: 'beatmapset-info',
      if @state.isEditingDescription
        el Modal, visible: true, onClose: @toggleEditingDescription,
          div className: 'osu-page',
            el BbcodeEditor,
              modifiers: ['beatmapset-description-editor']
              disabled: @state.isBusy
              onChange: @onEditorChange
              rawValue: @state.description?.bbcode ? @props.beatmapset.description.bbcode

      if @state.isEditingMetadata
        el Modal, visible: true, onClose: @toggleEditingMetadata,
          el MetadataEditor, onClose: @toggleEditingMetadata, beatmapset: @props.beatmapset

      div className: 'beatmapset-info__box beatmapset-info__box--description',
        @renderEditDescriptionButton() if @withEditDescription()

        h3
          className: 'beatmapset-info__header'
          osu.trans 'beatmapsets.show.info.description'

        div className: 'beatmapset-info__description-container u-fancy-scrollbar',
          div
            className: 'beatmapset-info__description'
            dangerouslySetInnerHTML:
              __html: @state.description?.description ? @props.beatmapset.description.description

      div className: 'beatmapset-info__box beatmapset-info__box--meta',
        @renderEditMetadataButton() if @withEditMetadata()

        if @props.beatmapset.source
          div null,
            h3
              className: 'beatmapset-info__header'
              osu.trans 'beatmapsets.show.info.source'

            a
              className: 'beatmapset-info__link'
              href: route('beatmapsets.index', q: @props.beatmapset.source)
              @props.beatmapset.source

        div className: 'beatmapset-info__half-box',
          div className: 'beatmapset-info__half-entry',
            h3 className: 'beatmapset-info__header',
              osu.trans 'beatmapsets.show.info.genre'
            a
              className: 'beatmapset-info__link'
              href: route('beatmapsets.index', g: @props.beatmapset.genre.id)
              @props.beatmapset.genre.name

          div className: 'beatmapset-info__half-entry',
            h3 className: 'beatmapset-info__header',
              osu.trans 'beatmapsets.show.info.language'
            a
              className: 'beatmapset-info__link'
              href: route('beatmapsets.index', l: @props.beatmapset.language.id)
              @props.beatmapset.language.name

        if tags.length > 0
          div className: 'beatmapset-info__box beatmapset-info__box--tags u-fancy-scrollbar',
            h3
              className: 'beatmapset-info__header'
              osu.trans 'beatmapsets.show.info.tags'

            div className='beatmapset-info__tags',
              for tag in tags
                [
                  a
                    key: tag
                    className: 'beatmapset-info__link'
                    href: route('beatmapsets.index', q: tag)
                    tag
                  span key: "#{tag}-space", ' '
                ]

      div className: 'beatmapset-info__box beatmapset-info__box--success-rate',
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
              title: "#{formatNumber(@props.beatmap.passcount)} / #{formatNumber(@props.beatmap.playcount)}"
              'data-tooltip-position': 'bottom center'
              style:
                marginLeft: "#{percentage}%"
              "#{percentage}%"

            h3
              className: 'beatmap-success-rate__header'
              osu.trans 'beatmapsets.show.info.points-of-failure'

            div
              className: 'beatmap-success-rate__chart'
              @renderFailChart()
        else
          div className: 'beatmap-success-rate',
            div
              className: 'beatmap-success-rate__empty'
              osu.trans 'beatmapsets.show.info.no_scores'


  renderFailChart: =>
    fails = zip(@props.beatmap.failtimes.exit, @props.beatmap.failtimes.fail)
    maxValue = Math.max 1, Math.max(fails.map(sum)...)

    div className: 'stacked-bar-chart stacked-bar-chart--beatmap-fail-rate',
      for f, i in fails
        div key: i, className: 'stacked-bar-chart__col',
          for value, j in f
            div
              className: "stacked-bar-chart__entry stacked-bar-chart__entry--#{j}"
              key: j
              style:
                height: "#{100 * value / maxValue}%"
