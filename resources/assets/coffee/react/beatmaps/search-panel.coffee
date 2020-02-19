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

import { SearchFilter } from './search-filter'
import { Observer } from 'mobx-react'
import core from 'osu-core-singleton'
import * as React from 'react'
import { div, a, i, input, h1, h2, li, ol, span } from 'react-dom-factories'
el = React.createElement
controller = core.beatmapsetSearchController

# props don't change anymore when selecting a new filter
export class SearchPanel extends React.Component
  constructor: (props) ->
    super props

    @inputRef = React.createRef()
    @pinnedInputRef = React.createRef()

    # containers for React to render portal into; turbolinks and React portals
    # don't play well together, otherwise. These aren't needed without turbolinks.
    @breadcrumbsPortal = document.createElement('div')
    @breadcrumbsPortal.id = 'search-panel-breadcrumbs-portal'
    @contentPortal = document.createElement('div')
    @contentPortal.id = 'search-panel-content-portal'

    @prevText = null
    @breadcrumbsElement = window.stickyHeader.breadcrumbsElement()
    @contentElement = window.stickyHeader.contentElement()


  componentDidMount: =>
    $(document).on 'sticky-header:sticking.search-panel', @setHeaderPinned
    @mountPortal @breadcrumbsPortal, @breadcrumbsElement
    @mountPortal @contentPortal, @contentElement


  componentWillUnmount: =>
    $(document).off '.search-panel'
    @unmountPortal @breadcrumbsPortal, @breadcrumbsElement
    @unmountPortal @contentPortal, @contentElement


  expand: (e) ->
    e.preventDefault()
    controller.isExpanded = true


  render: =>
    el Observer, null, =>
      div null,
        if @breadcrumbsElement?
          ReactDOM.createPortal @renderBreadcrumbs(), @breadcrumbsPortal

        if @contentElement?
          ReactDOM.createPortal @renderStickyContent(), @contentPortal

        div
          className: 'osu-page osu-page--beatmapsets-search-header'
          if currentUser.id?
            @renderUser()
          else
            @renderGuest()


  renderBreadcrumbs: =>
    return null unless currentUser.id?

    # TODO: replace with component that takes an array of {name, link}.
    ol className: 'sticky-header-breadcrumbs',
      li className: 'sticky-header-breadcrumbs__item',
        span
          className: 'sticky-header-breadcrumbs__link'
          osu.trans 'beatmapsets.index.guest_title'

      li className: 'sticky-header-breadcrumbs__item',
        span
          className: 'sticky-header-breadcrumbs__link'
          osu.trans 'home.search.title'


  renderStickyContent: =>
    return null unless currentUser.id?

    div
      className: 'beatmapsets-search beatmapsets-search--sticky'
      div
        className: 'beatmapsets-search__input-container'
        input
          className: 'beatmapsets-search__input js-beatmapsets-search-input'
          ref: @pinnedInputRef
          type: 'textbox'
          name: 'search'
          onChange: @onChange
          placeholder: osu.trans('beatmaps.listing.search.prompt')
          defaultValue: controller.filters.query
        div className: 'beatmapsets-search__icon',
          i className: 'fas fa-search'

      div
        className: 'beatmapsets-search__filters'
        @renderFilter
          name: 'status'
          options: @props.availableFilters.statuses
          showTitle: false

        @renderFilter
          name: 'mode'
          options: @props.availableFilters.modes
          showTitle: false


  onChange: (event) =>
    query = event.target.value
    @pinnedInputRef.current.value = query
    @inputRef.current.value = query

    controller.updateFilters { query }


  renderFilter: ({ multiselect = false, name, options, showTitle = true }) =>
    el SearchFilter,
      filters: controller.filters
      name: name
      title: osu.trans("beatmaps.listing.search.filters.#{name}") if showTitle
      options: options
      multiselect: multiselect
      recommendedDifficulty: controller.recommendedDifficulty
      selected: controller.filters.selectedValue(name)


  renderGuest: =>
    div
      ref: @props.innerRef
      className: 'beatmapsets-search'
      div
        className: 'beatmapsets-search__background beatmapsets-search__background--guest'
        style:
          backgroundImage: osu.urlPresence(@props.background)
      div className: 'beatmapsets-search__input-container js-user-link',
        input
          className: 'beatmapsets-search__input'
          disabled: true
          type: 'textbox'
          placeholder: osu.trans('beatmaps.listing.search.login_required')
        div className: 'beatmapsets-search__icon',
          i className: 'fas fa-search'


  renderUser: =>
    filters = @props.availableFilters
    cssClasses = 'beatmapsets-search'
    cssClasses += ' beatmapsets-search--expanded' if controller.isExpanded

    div
      ref: @props.innerRef
      className: cssClasses
      div
        className: 'beatmapsets-search__background'
        style:
          backgroundImage: osu.urlPresence(@props.background)
      div className: 'beatmapsets-search__input-container',
        input
          className: 'beatmapsets-search__input js-beatmapsets-search-input'
          ref: @inputRef
          type: 'textbox'
          name: 'search'
          onChange: @onChange
          placeholder: osu.trans('beatmaps.listing.search.prompt')
          defaultValue: controller.filters.query
        div className: 'beatmapsets-search__icon',
          i className: 'fas fa-search'

      @renderFilter
        multiselect: true
        name: 'general'
        options: filters.general

      @renderFilter
        name: 'mode'
        options: filters.modes

      @renderFilter
        name: 'status'
        options: filters.statuses

      a
        className: 'beatmapsets-search__expand-link'
        href: '#'
        onClick: @expand
        div {}, osu.trans('beatmaps.listing.search.options')
        div {}, i className: 'fas fa-angle-down'

      div className: 'beatmapsets-search__advanced',
        @renderFilter
          name: 'genre'
          options: filters.genres

        @renderFilter
          name: 'language'
          options: filters.languages

        @renderFilter
          multiselect: true
          name: 'extra'
          options: filters.extras

        @renderFilter
          multiselect: true
          name: 'rank'
          options: filters.ranks

        @renderFilter
          name: 'played'
          options: filters.played


  setHeaderPinned: (_event, pinned) =>
    if pinned && document.activeElement == @inputRef.current
      @pinnedInputRef.current.focus()
    else if !pinned && document.activeElement == @pinnedInputRef.current
      @inputRef.current.focus()


  mountPortal: (portal, root) ->
    # clean up any existing element when navigating backwards.
    existingElement = document.getElementById(portal.id)
    existingElement?.remove()

    root?.appendChild portal


  unmountPortal: (portal, root) ->
    if portal.offsetParent?
      root?.removeChild portal
