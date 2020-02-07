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

import { Build } from 'build'
import { ChangelogHeaderStreams } from 'changelog-header-streams'
import { Comments } from 'comments'
import { CommentsManager } from 'comments-manager'
import HeaderV4 from 'header-v4'
import * as React from 'react'
import { a, div, h1, h2, i, li, ol, p, span } from 'react-dom-factories'
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
        section: osu.trans 'layout.header.changelog._'
        subSection: @props.build.update_stream.display_name

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
                    href: _exported.OsuUrlHelper.changelogBuild @props.build.versions.previous
                    i className: 'fas fa-chevron-left'
                    span className: 'page-nav__label',
                      @props.build.versions.previous.display_version

              div className: 'page-nav__item page-nav__item--right',
                if @props.build.versions.next?
                  a
                    className: 'page-nav__link'
                    href: _exported.OsuUrlHelper.changelogBuild @props.build.versions.next
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
        url: _exported.OsuUrlHelper.changelogBuild @props.build
        title: "#{@props.build.update_stream.display_name} #{@props.build.display_version}"
      }
    ]
