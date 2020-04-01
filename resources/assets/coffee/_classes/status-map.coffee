# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

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
