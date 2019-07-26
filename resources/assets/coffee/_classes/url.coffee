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

class @Url
  internal = [
    'admin'
    'api/v2'
    'beatmaps'
    'beatmapsets'
    'comments'
    'community'
    'help'
    'home'
    'legal'
    'oauth'
    'rankings'
    'session'
    'store'
    'users'
  ].join('|')


  @beatmapDownloadDirect: (id) -> "osu://dl/#{id}"

  @changelogBuild: (build) ->
    laroute.route 'changelog.build', stream: build.update_stream.name, build: build.version

  # external link
  @openBeatmapEditor: (timestampWithRange) => "osu://edit/#{timestampWithRange}"

  # location is Turbolinks.Location
  @isHTML: (location) ->
    location.isHTML() ||
      # Some changelog builds have `.` in their version, failing turbolinks' check.
      _.startsWith(location.getPath(), '/home/changelog/')


  @isInternal: (location) ->
    RegExp("^/(?:#{internal})(?:$|/|#)").test location.getPath()
