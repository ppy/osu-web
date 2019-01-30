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

# Prefilter to disable parsing of cross-domain scripts loaded via jQuery.
# jQuery's autodection means responses with text/javascript get eval'ed if
# fetched without an explicit data type.
# ref: https://github.com/jquery/jquery/blob/b078a62013782c7424a4a61a240c23c4c0b42614/src/ajax/script.js#L8-L12
$.ajaxPrefilter (options) ->
  options.contents.script = false if options.crossDomain

