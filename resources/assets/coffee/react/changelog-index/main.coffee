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

{a, div, h1, p, span} = ReactDOMFactories
el = React.createElement

class ChangelogIndex.Main extends React.PureComponent
  componentDidMount: =>
    changelogChartLoader.initialize()


  render: =>
    div null,
      div className: 'header-bg header-bg--changelog',
        div className: 'header-bg__overlay'

      div className: 'osu-page osu-page--changelog',
        div className: 'osu-page__header',
          @renderHeaderTitle()
          @renderHeaderTabs()

        el ChangelogHeaderBuilds, latestBuilds: @props.latestBuilds

        div className: 'js-changelog-chart'

        div className: 'builds',
          for own date, builds of _.groupBy(@props.builds, (b) -> moment(b.created_at).format('LL'))
            div
              key: date
              className: 'builds__group',
              div className: 'builds__date', date

              for build in builds
                div
                  key: build.id
                  className: 'builds__item'
                  el Build, build: build


  renderHeaderTabs: =>
    div className: 'page-mode-v2 page-mode-v2--changelog',
      span
        className: 'page-mode-v2__link page-mode-v2__link--active'
        osu.trans 'changelog.index.title.info'


  renderHeaderTitle: =>
    div className: 'osu-page-header-v3 osu-page-header-v3--changelog',
      div className: 'osu-page-header-v3__title js-nav2--header-title',
        div className: 'osu-page-header-v3__title-icon',
          div className: 'osu-page-header-v3__icon'
        h1
          className: 'osu-page-header-v3__title-text'
          dangerouslySetInnerHTML:
            __html: osu.trans 'changelog.index.title._',
              info: "<span class='osu-page-header-v3__title-highlight'>#{osu.trans('changelog.index.title.info')}</span>"
