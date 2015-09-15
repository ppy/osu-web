el = React.createElement


class @UserCard extends React.Component
  constructor: (props) ->
    super props

    @state = user: window.currentUser


  componentDidMount: =>
    $(document).on 'user.update', @_userUpdate


  componentWillUnmount: =>
    $(document).off 'user.update', @_userUpdate


  _userUpdate: (_e, user) =>
    return if user.id != @state.user.id

    @setState user: user


  render: =>
    user = @state.user
    stats = user.defaultStats.data

    el 'div',
      className: 'modal-content modal-content--authenticated'
      el 'div',
        className: 'modal-header modal-header--authenticated'
        style:
          backgroundImage: "url('#{user.cover.url}')"

        el 'div', className: 'modal-header__dimmer'

        el 'div', className: 'modal-header__badges',
          el 'span',
            className: 'badges__badge badges__badge--small badges__badge--level'
            stats.level.current
          el 'span',
            className: 'badges__badge badges__badge--small badges__badge--achievements'
            user.achievements.current

        el 'div', className: 'modal-header__userinfo userinfo-small',
          el 'h1', className: 'userinfo-small__username', user.username

          el 'span',
            className: 'userinfo-small__country'
            style:
              backgroundImage: "url('/images/flags/#{user.country.code}.png')"

          # not implemented yet
          if false
            el 'span',
              className: 'userinfo-small__team'
              style:
                backgroundImage: "url('/team-flag-url.png')"

        if stats.rank.isRanked
          el 'div', className: 'modal-header__ranking rankinginfo-small',
            el 'span', className: 'rankinginfo-small__gamemode',
              el 'i', className: "fa osu fa-#{user.playmode}-o"
              " ##{stats.rank.global.toLocaleString()}"

            el 'span', className: 'rankinginfo-small__country',
              "#{user.country.name} ##{stats.rank.country.toLocaleString()}"

      el 'div',
        className: 'modal-body modal-body--user-dropdown modal-body--compartimentalized'
        el 'div',
          className: 'modal-body__compartment modal-body__compartment--left quick-info'
          el 'span', className: 'quick-info__level',
            Lang.get 'users.show.stats.level', level: stats.level.current
          el 'ul', className: 'quick-info__roles user-roles',
            if user.isSupporter
              el 'li', className: 'user-roles__role user-roles__role--supporter',
                Lang.get 'users.show.is_supporter'

            if false
              el 'li', className: 'user-roles__role user-roles__role--developer',
                Lang.get 'users.show.is_developer'

          el 'ul', className: 'quick-info__statistics',
            el 'li', className: 'quick-info-statistics__statistic',
              el 'span', null, Lang.get('users.show.stats.ranked_score')
              el 'span', className: 'text-right', stats.rankedScore.toLocaleString()
            el 'li', className: 'quick-info-statistics__statistic',
              el 'span', null, Lang.get('users.show.stats.hit_accuracy')
              el 'span', className: 'text-right', "#{stats.hitAccuracy.toFixed(2)}%"
            el 'li', className: 'quick-info-statistics__statistic',
              el 'span', null, Lang.get('users.show.stats.play_count')
              el 'span', className: 'text-right', stats.playCount.toLocaleString()

        el 'div',
          className: 'modal-body__compartment modal-body__compartment--right'
          el 'ul', className: 'user-dropdown-modal-menu',
            el 'li', className: 'user-dropdown-modal-menu__item',
              el 'a', href: '#', title: Lang.get('layout.menu.user.messages'),
                Lang.get 'layout.menu.user.messages'
                el 'i', className: 'fa fa-envelope'
            el 'li', className: 'user-dropdown-modal-menu__item',
              el 'a', href: '#', title: Lang.get('layout.menu.user.settings'),
                Lang.get 'layout.menu.user.settings'
                el 'i', className: 'fa fa-cog'
            el 'li', className: 'user-dropdown-modal-menu__item',
              el 'a',
                href: '#'
                title: Lang.get('layout.menu.user.logout')
                className: 'js-logout-link'
                'data-method': 'delete'
                'data-confirm': Lang.get 'users.logout_confirm'
                'data-remote': 1
                Lang.get 'layout.menu.user.logout'
                el 'i', className: 'fa fa-sign-out'
            el 'li', className: 'user-dropdown-modal-menu__item',
              el 'a', href: '#', title: Lang.get('layout.menu.user.help'),
                Lang.get 'layout.menu.user.help'
                el 'i', className: 'fa fa-question-circle'
