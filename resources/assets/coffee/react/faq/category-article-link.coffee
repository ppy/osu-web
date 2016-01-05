
{div} = React.DOM
el = React.createElement

class Faq.CategoryArticleLink extends React.Component
  constructor: (props) ->
    super props

    @state =
      title: props.article.title
      id: props.article.id
  render: =>
    el 'li', className: 'faq-category__item',
      el 'a', href: "/help/faq/view/#{@state.id}", @state.title
