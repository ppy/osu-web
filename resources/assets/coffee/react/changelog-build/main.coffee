###
#    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
#    See the LICENCE file in the repository root for full licence text.
###

import { Build } from 'build'
import { ChangelogHeaderStreams } from 'changelog-header-streams'
import { Comments } from 'comments'
import { CommentsManager } from 'comments-manager'
import * as React from 'react'
import { a, div, h1, h2, i, li, ol, p, span } from 'react-dom-factories'
el = React.createElement

export class Main extends React.PureComponent
  componentDidMount: =>
    changelogChartLoader.initialize()


  render: =>
    div null,
      div className: 'header-v3 header-v3--changelog',
        div className: 'header-v3__bg'
        div className: 'header-v3__overlay'
        div className: 'osu-page osu-page--header-v3',
          @renderHeaderTitle()
          @renderHeaderTabs()

      div className: 'osu-page osu-page--changelog',
        el ChangelogHeaderStreams, updateStreams: @props.updateStreams, currentStreamId: @props.build.update_stream.id

        div className: 'js-changelog-chart', style: height: '100px'

        div className: 'builds',
          div
            className: 'builds__group',
            div
              className: 'builds__item'
              el Build, build: @props.build, showDate: true, modifiers: ['build']

            div className: 'page-nav',
              div className: 'page-nav__item page-nav__item--left',
                if @props.build.versions.previous?
                  a
                    className: 'page-nav__link'
                    href: Url.changelogBuild @props.build.versions.previous
                    i className: 'fas fa-chevron-left'
                    span className: 'page-nav__label',
                      @props.build.versions.previous.display_version

              div className: 'page-nav__item page-nav__item--right',
                if @props.build.versions.next?
                  a
                    className: 'page-nav__link'
                    href: Url.changelogBuild @props.build.versions.next
                    @props.build.versions.next.display_version
                    span className: 'page-nav__label',
                      i className: 'fas fa-chevron-right'

          if !(currentUser.id? && currentUser.is_supporter)
            div className: 'builds__group', @renderSupporterPromo()

          div
            className: 'builds__group builds__group--discussions'
            el CommentsManager,
              component: Comments
              commentableType: 'build'
              commentableId: @props.build.id
              componentProps:
                modifiers: ['changelog']


  renderHeaderTabs: =>
    ol className: 'page-mode-v2 page-mode-v2--breadcrumbs page-mode-v2--changelog',
      li
        className: 'page-mode-v2__item'
        a
          href: laroute.route('changelog.index')
          className: 'page-mode-v2__link'
          osu.trans 'changelog.index.title.info'
      li
        className: 'page-mode-v2__item'
        span
          className: 'page-mode-v2__link page-mode-v2__link--active'
          @props.build.update_stream.display_name
          ' '
          @props.build.display_version


  renderHeaderTitle: =>
    div className: 'osu-page-header-v3 osu-page-header-v3--changelog',
      div className: 'osu-page-header-v3__title',
        div className: 'osu-page-header-v3__title-icon',
          div className: 'osu-page-header-v3__icon'
        h1
          className: 'osu-page-header-v3__title-text'
          dangerouslySetInnerHTML:
            __html: osu.trans 'changelog.index.title._',
              info: "<span class='osu-page-header-v3__title-highlight'>#{@props.build.update_stream.display_name}</span>"


  renderSupporterPromo: =>
    div className: 'supporter-promo',
      div className: 'supporter-promo__pippi',
        div className: 'supporter-promo__heart'

      div className: 'supporter-promo__text-box',
        h2 className: 'supporter-promo__heading',
          osu.trans('changelog.support.heading')

        div null,
          p
            className: 'supporter-promo__text'
            dangerouslySetInnerHTML: __html:
              osu.trans 'changelog.support.text_1',
                link: "<a href='#{laroute.route('support-the-game')}' class='supporter-promo__link'>#{osu.trans('changelog.support.text_1_link')}</a>"
          p className: 'supporter-promo__text supporter-promo__text--small',
            osu.trans('changelog.support.text_2')
