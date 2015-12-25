

{div} = React.DOM
el = React.createElement

class Faq.Category extends React.Component
  constructor: (props) ->
    super props

    @state =
      id: props.id,
      title: props.title,
      articles: props.articles,
      searchResults: [],
      editing: false,
      isSearching: false
  defaultProps: {
    isMain: false
  }
  componentDidMount: =>
    if @props.isMain
      $.subscribe "faq:search:done", @fillSearch
      $.subscribe "faq:search:typed", @changeToSearch
      $.subscribe "faq:search:emptied", @changeToCommon
  fillSearch: (e, data) =>
    @setState title: data.title
    @setState searchResults: data.searchResults
  changeEditing: (e) =>
    return if @props.isMain
    @setState editing: true
  cancelEditing: (e) =>
    @setState editing: false
  saveEditing: (e) =>
    if e.keyCode == 13
      console.log $(e.target).val()
      @setState title: $(e.target).val()
      @setState editing: false
      $.post "/help/faq/update-category/#{@state.id}",
        {
          title: $(e.target).val()
        }
      .done (data) ->

  changeToSearch: (e, content) =>
    @setState title: "Searching..."
    @setState isSearching: true
    @setState searchResults: []
  changeToCommon: =>
    @setState title: "Most Popular Topics"
    @setState isSearching: false
    @setState searchResults: []
  render: =>
    headingClass = if @props.isMain then "-heading" else ""
    el 'div', className: 'wide col-sm-' + (if @props.isMain then '12' else '6'),
      el 'div', className: 'faq__row--page osu-layout__row--page',
        el 'ul', className: "faq__list#{headingClass}",
          el 'li', className: "faq__list#{headingClass}--header faq__list#{headingClass}--item",
            if @state.editing
              el 'i', className: "fa fa-pencil"
              el 'input',
                className: "faq__list--header-editing",
                onKeyUp: @saveEditing,
                onBlur: @cancelEditing,
                autoFocus: "autoFocus",
                defaultValue: @state.title
            else
              el 'h2',
                onClick: @changeEditing,
                @state.title
          if not @state.isSearching
            @state.articles.map (article) -> el Faq.CategoryArticleLink,
              article: article,
              key: article.id
          else
            @state.searchResults.map (article) -> el Faq.CategoryArticleLink,
              article: article,
              key: article.id
        if !@props.isMain then el 'a', href: '/help/faq/category/' + @state.id, className: "faq__list--more", "more"
        if !@props.isMain
          el 'div', className: 'forum-post__actions',
            el 'div', className: 'forum-post-actions',
              el 'a', className: 'forum-post-actions__action', href: "/help/faq/create/#{@props.id}",
                el 'i', className: 'fa fa-plus'