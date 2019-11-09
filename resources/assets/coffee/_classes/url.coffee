###
#    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
#    See the LICENCE file in the repository root for full licence text.
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
