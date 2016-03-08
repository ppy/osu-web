
{div} = React.DOM
el = React.createElement

class Faq.SearchHeader extends React.Component
  constructor: (props) ->
    super props
    @searchDelay = null
    @state = {
      searchQuery: ""
    }

  changeSearch: (e) =>
    val = $(e.target).val()
    @setState searchQuery: val
    console.log val
    if val is ""
      $.publish "faq:search:emptied"
      clearTimeout @searchDelay
    else
      $.publish "faq:search:typed",  val
      if @searchDelay != null
        clearTimeout @searchDelay
      searchCallback = ->
        $.get "/help/faq/search",
          {
            query: val
          }
        .done (data) ->
          $.publish "faq:search:done",
            {
              title: "Results for " + val + ": ", searchResults: data
            }
      @searchDelay = setTimeout searchCallback, 300



  render: ->
    el 'div', className: "osu-layout__row osu-layout__row--with-gutter faq-header-search",
      el 'div', className: 'osu-layout__row--page header-row faq-header-search__background',
        el 'div', className: 'col-sm-12 faq-header-search__container',
          el 'div', className: 'faq-search',
            el 'input', className: 'faq-search__input', placeholder: 'what is your issue?', onChange:@changeSearch
            el 'div', className: 'fa fa-search faq-search__search-icon'