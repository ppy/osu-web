
{div} = React.DOM
el = React.createElement

class Faq.CategoryArticleLink extends React.Component
  constructor: (props) ->
    super props

    @state =
      title: props.article.title
      id: props.article.id
  render: =>
    el 'li', className: 'faq__list--item faq__list--link',
      el 'a', href: "/help/faq/view/#{@state.id}", @state.title
