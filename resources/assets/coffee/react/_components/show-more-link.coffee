###
#    Copyright 2015-2017 ppy Pty. Ltd.
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
{button, div} = ReactDOMFactories
el = React.createElement

class @ShowMoreLink extends React.PureComponent
  render: =>
    blockClass = osu.classWithModifiers('show-more-link', @props.modifiers)

    if @props.loading
      div className: blockClass, el Spinner

    else
      return null unless @props.hasMore

      button
        type: 'button'
        onClick: @props.callback ? @showMore
        className: "#{blockClass} show-more-link--link"
        osu.trans('common.buttons.show_more')


  showMore: =>
    $.publish @props.event,
      name: @props.name
      perPage: @props.perPage ? 20
      url: @props.url
      extras: @props.extras
