# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

export Img2x = (props) ->
  allProps = _.extend osu.src2x(props.src), props

  ReactDOMFactories.img allProps, props.children
