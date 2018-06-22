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

{a, div, p} = ReactDOMFactories
el = React.createElement

class @ChangelogHeaderBuilds extends React.PureComponent
  render: =>
    div className: osu.classWithModifiers('changelog-builds-v2', ['with-active' if @props.currentStreamId?]),
      div className: 'changelog-builds-v2__container',
        for build in @props.latestBuilds
          @renderHeaderBuild build: build


  renderHeaderBuild: ({build}) =>
    streamNameClass = _.kebabCase(build.update_stream.display_name)
    mainClass = osu.classWithModifiers 'changelog-builds-v2__item', [
      streamNameClass
      'featured' if build.is_featured
      'active' if @props.currentStreamId == build.update_stream.id
    ]
    mainClass += " t-changelog-stream--#{streamNameClass}"

    a
      href: Url.changelogBuild build
      key: build.id
      className: mainClass
      div className: 'changelog-builds-v2__bar u-changelog-stream--bg'
      p className: 'changelog-builds-v2__row changelog-builds-v2__row--name', build.update_stream.display_name
      p className: 'changelog-builds-v2__row changelog-builds-v2__row--version', build.display_version
      if build.users > 0
        p
          className: 'changelog-builds-v2__row changelog-builds-v2__row--users'
          osu.transChoice 'changelog.builds.users_online', build.users
