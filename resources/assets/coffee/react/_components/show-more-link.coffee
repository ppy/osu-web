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
{button, span} = ReactDOMFactories
el = React.createElement
bn = 'show-more-link'

@ShowMoreLink = React.forwardRef (props, ref) =>
  return null unless props.hasMore || props.loading

  onClick = props.callback
  onClick ?= -> $.publish props.event, props.data

  button
    ref: ref
    type: 'button'
    onClick: onClick
    disabled: props.loading
    className: osu.classWithModifiers(bn, props.modifiers)
    span className: "#{bn}__spinner",
      el Spinner
    span className: "#{bn}__label",
      span className: "#{bn}__label-icon",
        span className: 'fas fa-angle-down'
      span className: "#{bn}__label-text",
        osu.trans('common.buttons.show_more')

        if props.remaining?
          " (#{props.remaining})"
      span className: "#{bn}__label-icon",
        span className: 'fas fa-angle-down'
