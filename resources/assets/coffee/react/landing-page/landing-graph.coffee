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

# svg = d3.select('.js-landing-graph').append('svg').attr('width', 250).attr('height', 250)
# xScale = d3.scale.linear().range([
#   0
#   250
# ])
# yScale = d3.scale.linear().range([
#   0
#   250
# ])

# render = (data) ->
#   xScale.domain d3.extent(data, (d) ->
#     d.banchostats_id
#   )
#   yScale.domain d3.extent(data, (d) ->
#     d.users_irc
#   )
#   circles = svg.selectAll('circle').data(data)
#   circles.enter().append('circle').attr 'r', 10
#   circles.attr('cx', (d) ->
#     xScale d.banchostats_id
#   ).attr 'cy', (d) ->
#     yScale d.users_irc
#   circles.exit().remove()
#   return

# type = (d) ->
#   d.banchostats_id = +d.banchostats_id
#   d.users_irc = +d.users_irc
#   d

# d3.csv '/landing-csv.csv', type, render
