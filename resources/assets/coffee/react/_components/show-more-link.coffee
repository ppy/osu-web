###
#    Copyright 2015-2018 ppy Pty. Ltd.
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

class @ShowMoreLink extends React.PureComponent
  render: =>
    return null unless @props.hasMore || @props.loading

    button
      type: 'button'
      onClick: @props.callback ? @showMore
      disabled: @props.loading
      className: osu.classWithModifiers(bn, @props.modifiers)
      span className: "#{bn}__spinner",
        el Spinner
      span className: "#{bn}__label",
        osu.trans('common.buttons.show_more')


  showMore: =>
    $.publish @props.event, @props.data
