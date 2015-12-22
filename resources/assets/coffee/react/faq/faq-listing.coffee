
{div} = React.DOM
el = React.createElement

class Faq.Listing extends React.Component
  constructor: (props) ->
    super props

    @state = {
      showOthers: true,
      categories: props.categories
    }
  componentWillMount: =>
    $.subscribe "faq:search:typed", @removeEverythingButMain
    $.subscribe "faq:search:emptied", @restoreOthers
  removeEverythingButMain: =>
    console.log "hiding"
    if @state.showOthers then @setState showOthers: false
  restoreOthers: =>
    console.log "restoring"
    if not @state.showOther then @setState showOthers: true
  render: =>
    el 'div', className: "osu-layout__section osu-layout__section--full",
      el Faq.SearchHeader
      el 'div', className: "osu-layout__row osu-layout__row--with-gutter faq-listing",
        el Faq.Category,
          isMain: true,
          title: "The most common questions",
          articles: []
        if (@state.showOthers == true)
          @state.categories.map (category) -> el Faq.Category,
            title: category.title,
            id: category.id,
            articles: category.articles