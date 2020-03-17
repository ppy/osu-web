# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

# Prefilter to disable parsing of cross-domain scripts loaded via jQuery.
# jQuery's autodection means responses with text/javascript get eval'ed if
# fetched without an explicit data type.
# ref: https://github.com/jquery/jquery/blob/b078a62013782c7424a4a61a240c23c4c0b42614/src/ajax/script.js#L8-L12
$.ajaxPrefilter (options) ->
  options.contents.script = false if options.crossDomain
