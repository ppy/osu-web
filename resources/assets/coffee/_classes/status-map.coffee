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

class @StatusMap
  constructor: (element) ->
    @circleSize = 8
    offset = 40

    # whatever input data is scaled to
    width = 1350
    height = 597

    @svg = d3.select(element)
            .append('svg')
            .attr('width', '100%')
            .attr('height', '100%')
            .attr('viewBox',"0 0 #{width} #{height + offset}")
            .attr('preserveAspectRatio','xMinYMin')

    @svg.append('svg:image')
      .attr('xlink:href', '/images/backgrounds/world_map.svg')
      .attr('width', width)
      .attr('height', height)
      .attr('x', 0)
      .attr('y', offset / 2)

  update: (servers) =>
    @svg.selectAll('circle').remove()
    @svg.selectAll('text').remove()

    # inserts each circle + name and player number
    for server in servers
      @svg.append('circle')
         .attr('r', @circleSize)
         .attr('cx', server.x)
         .attr('cy', server.y)
         .classed("status-map__circle status-map__circle--#{server.state}", true)

      # the "O" that grows
      grower = @svg.append('circle')
                  .attr('r', @circleSize)
                  .attr('cx', server.x)
                  .attr('cy', server.y)
                  .classed("status-map__circle status-map__circle--#{server.state}", true)

      grower.on 'mouseover', =>
        target = d3.select(d3.event.target)

        target
          .transition()
          .duration(1000)
          .attr('r', @circleSize + 20)
          .style('opacity', 0)
          .on 'end', =>
            target
              .attr('r', @circleSize)
              .style('opacity', 1)

      @svg.append('text')
         .text(server.name)
         .attr('x', server.x)
         .attr('y', server.y - 40)
         .classed("status-map__text", true)

      @svg.append('text')
         .text("#{server.players} players #{(if server.state == 'down' then 'offline' else 'online')}")
         .attr('x', server.x)
         .attr('y', server.y - 20)
         .classed("status-map__text", true)
