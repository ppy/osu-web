# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import { Observer } from 'mobx-react'
import core from 'osu-core-singleton'
import * as React from 'react'
import { button, div } from 'react-dom-factories'

el = React.createElement

uiState = core.dataStore.uiState

export class CommentsSort extends React.PureComponent
  render: =>
    div className: osu.classWithModifiers('sort', @props.modifiers),
      div className: 'sort__items',
        div className: 'sort__item sort__item--title', osu.trans('sort._')
        @renderButton('new')
        @renderButton('old')
        @renderButton('top')


  renderButton: (sort) =>
    el Observer, null, () =>
      className = 'sort__item sort__item--button'
      className += ' sort__item--active' if sort == (uiState.comments.loadingSort ? uiState.comments.currentSort)

      button
        className: className
        'data-sort': sort
        onClick: @setSort
        osu.trans("sort.#{sort}")


  setSort: (e) =>
    $.publish 'comments:sort', sort: e.target.dataset.sort
