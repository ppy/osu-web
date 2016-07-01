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
{div, h2, span} = React.DOM
el = React.createElement

ProfilePage.Extra = React.createClass
  mixins: [StickyTabsMixin]

  getInitialState: ->
    tabsSticky: false
    profileOrder: @props.user.profileOrder


  componentDidMount: ->
    @_removeListeners()
    $.subscribe 'stickyHeader.profileContentsExtra', @_tabsStick
    osu.pageChange()

    $(@refs.pages).sortable
      cursor: 'move'
      handle: '.js-profile-page-extra--sortable-handle'
      revert: 150
      scrollSpeed: 10
      update: @updateOrder

    for tabType in ['tabs', 'fixedTabs']
      $(@refs[tabType]).sortable
        items: '[data-page-id]'
        tolerance: 'pointer'
        cursor: 'move'
        disabled: !@props.withEdit
        revert: 150
        scrollSpeed: 0
        update: @updateOrder


  componentWillUnmount: ->
    @_removeListeners()

    for sortable in ['pages', 'tabs', 'fixedTabs']
      $(@refs[sortable]).sortable 'destroy'


  componentWillReceiveProps: (newProps) ->
    @setState profileOrder: newProps.user.profileOrder
    osu.pageChange()


  _removeListeners: ->
    $.unsubscribe '.profileContentsExtra'
    $(window).off '.profileContentsExtra'


  updateOrder: (event) ->
    $elems = $(event.target)

    newOrder = $elems.sortable('toArray', attribute: 'data-page-id')

    LoadingOverlay.show()

    $elems.sortable('cancel')

    @setState profileOrder: newOrder, =>
      $.ajax laroute.route('account.update-profile'),
        method: 'POST'
        dataType: 'JSON'
        data:
          order: @state.profileOrder

      .done (userData) =>
        $.publish 'user:update', userData.data

      .fail (xhr) =>
        osu.ajaxError xhr

        @setState profileOrder: @props.user.profileOrder

      .always LoadingOverlay.hide


  render: ->
    withMePage = @props.userPage.html != '' || @props.withEdit

    tabs = div
      className: 'hidden-xs page-extra-tabs__container'
      div className: 'osu-layout__row',
        div
          className: 'page-extra-tabs__items'
          @state.profileOrder.map (m) =>
            return if m == 'me' && !withMePage

            el ProfilePage.ExtraTab, key: m, page: m, currentPage: @props.currentPage, currentMode: @props.currentMode

    div className: 'osu-layout__section osu-layout__section--extra',
      div
        className: 'page-extra-tabs js-sticky-header js-switchable-mode-page--scrollspy-offset'
        'data-sticky-header-target': 'page-extra-tabs'
        ref: 'tabs'
        tabs

      div
        className: 'page-extra-tabs page-extra-tabs--fixed'
        'data-visibility': if @state.tabsSticky then '' else 'hidden'
        ref: 'fixedTabs'
        tabs

      div className: 'osu-layout__row', ref: 'pages',
        @state.profileOrder.map (m) =>
          topClassName = 'js-switchable-mode-page--scrollspy js-switchable-mode-page--page'

          elem =
            switch m
              when 'me'
                topClassName += ' hidden' unless withMePage
                props = userPage: @props.userPage, withEdit: @props.withEdit, user: @props.user
                ProfilePage.UserPage

              when 'recent_activities'
                props = recentActivities: @props.recentActivities
                ProfilePage.RecentActivities

              when 'kudosu'
                props = user: @props.user, recentlyReceivedKudosu: @props.recentlyReceivedKudosu
                ProfilePage.Kudosu

              when 'top_ranks'
                props = user: @props.user, scoresBest: @props.scoresBest, scoresFirst: @props.scoresFirst
                ProfilePage.TopRanks

              when 'beatmaps'
                props =
                  favouriteBeatmapsets: @props.favouriteBeatmapsets
                  rankedAndApprovedBeatmapsets: @props.rankedAndApprovedBeatmapsets
                ProfilePage.Beatmaps

              when 'medals'
                props =
                  achievements: @props.achievements
                  userAchievements: @props.userAchievements
                  currentMode: @props.currentMode
                ProfilePage.Medals

              when 'historical'
                props =
                  scores: @props.scores
                  user: @props.user
                  currentMode: @props.currentMode
                ProfilePage.Historical

              when 'performance'
                props = rankHistories: @props.rankHistories
                ProfilePage.Performance

          props.withEdit = @props.withEdit
          props.name = m

          div
            key: m
            'data-page-id': m
            className: topClassName
            el elem, props
