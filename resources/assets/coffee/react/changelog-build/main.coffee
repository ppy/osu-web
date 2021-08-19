# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import { Build } from 'build'
import { ChangelogHeaderStreams } from 'changelog-header-streams'
import { Comments } from 'comments'
import { CommentsManager } from 'comments-manager'
import HeaderV4 from 'header-v4'
import * as React from 'react'
import { a, div, h1, h2, i, li, ol, p, span } from 'react-dom-factories'
import { changelogBuild } from 'utils/url'
el = React.createElement

export class Main extends React.PureComponent
  componentDidMount: =>
    changelogChartLoader.initialize()


  render: =>
    el React.Fragment, null,
      el HeaderV4,
        theme: 'changelog'
        links: @headerLinks()
        linksBreadcrumb: true

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
                if @props.build.versions?.previous?
                  a
                    href: changelogBuild @props.build.versions.previous
                    i className: 'fas fa-chevron-left'
                    span className: 'page-nav__label',
                      @props.build.versions.previous.display_version

              div className: 'page-nav__item page-nav__item--right',
                if @props.build.versions?.next?
                  a
                    href: changelogBuild @props.build.versions.next
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


  headerLinks: =>
    [
      {
        url: laroute.route('changelog.index')
        title: osu.trans 'layout.header.changelog.index'
      }
      {
        url: changelogBuild @props.build
        title: "#{@props.build.update_stream.display_name} #{@props.build.display_version}"
      }
    ]
