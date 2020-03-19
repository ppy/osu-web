# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

class @StatusChart
  constructor: (element, name) ->
    @ratio = 2 * Math.PI
    width = $(element).width()
    height = $(element).height()

    outerRadius = Math.min(width, height) / 2
    innerRadius = outerRadius / 4.7 * 4

    @defaultArc = d3.arc()
            .innerRadius(innerRadius)
            .outerRadius(outerRadius)
            .startAngle(0)

    @svg = d3.select(element)
            .append('svg')
            .attr('width', '100%')
            .attr('height', '100%')
            .attr('viewBox', "0 0 #{Math.min(width, height)} #{Math.min(width, height)}")
            .attr('preserveAspectRatio', 'xMinYMin')
            .append('g')
            .attr('transform', "translate(#{Math.min(width, height) / 2}, #{Math.min(width, height) / 2})")

    @text = @svg.append('text')
              .text(name)
              .attr('dy', -8)
              .classed('status-chart__text', true)

    @percentage = @svg.append('text')
                    .attr('dy', 20)
                    .classed('status-chart__text status-chart__text--percentage', true)

    @background = @svg.append('path')
                    .datum(endAngle: @ratio)
                    .classed('status-chart__background', true)
                    .attr('d', @defaultArc)

    @upArc = @svg.append('path')
                         .datum(endAngle: 0)
                         .classed('status-chart__up-arc', true)
                         .attr('d', @defaultArc)

    @downArc = @svg.append('path')
                       .datum(endAngle: 0)
                       .classed('status-chart__down-arc', true)
                       .attr('d', @defaultArc)

  parse: (n) ->
    @ratio * n / 100

  set: (data) =>
    arcTween = (transition, newAngle) =>
      transition.attrTween 'd', (d) =>
        interpolate = d3.interpolate(d.endAngle, newAngle)
        (t) =>
          d.endAngle = interpolate(t)
          @percentage.text Math.round((d.endAngle / @ratio) * 100) + '%'
          @defaultArc d

    @downArc.transition().duration(750).call(arcTween, -@parse(data.down))
    @upArc.transition().duration(750).call(arcTween, @parse(data.up))
