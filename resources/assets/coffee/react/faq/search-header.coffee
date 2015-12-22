
{div} = React.DOM
el = React.createElement

class Faq.SearchHeader extends React.Component
  constructor: (props) ->
    super props

    @state = {
      searchQuery: ""
    }

  changeSearch: (e) =>
    val = $(e.target).val()
    @setState searchQuery: val
    if val is ""
      $.publish "faq:search:emptied"
    else
      $.publish "faq:search:typed"
  render: ->
    el 'div', className: "osu-layout__row osu-layout__row--with-gutter faq-header",
      el 'div', className: 'osu-layout__row--page header-row faq-header--background',
        el 'div', className: 'wide col-sm-12 faq-input-wrapper',
          el 'div', className: 'input-search-container faq-input-container',
            el 'input', placeholder: 'what is your issue?', onChange:@changeSearch
            el 'div', className: 'fa fa-search'