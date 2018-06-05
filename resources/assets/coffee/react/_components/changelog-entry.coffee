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

{div, span, a} = ReactDOMFactories
el = React.createElement

@ChangelogEntry = ({entry}) =>
  div
    className: 'changelog-entry'
    key: entry.id
    div className: 'changelog-entry__col changelog-entry__col--user',
      if entry.github_user.github_url?
        a
          href: entry.github_user.github_url
          className: 'changelog-entry__user-link js-usercard'
          'data-user-id': entry.github_user.user_id
          entry.github_user.display_name
      else if entry.github_user.user_url?
        a
          href: entry.github_user.user_url
          className: 'changelog-entry__user-link js-usercard'
          'data-user-id': entry.github_user.user_id
          entry.github_user.display_name
      else
        entry.github_user.display_name

    div className: 'changelog-entry__col',
      div className: "changelog-entry__title #{if entry.major then 'changelog-entry__title--major' else ''}",
        if entry.url?
          a
            href: entry.url
            className: 'changelog-entry__link'
            entry.title
        else
          entry.title
        if entry.github_url?
          span null,
            ' ('
            a
              className: 'changelog-entry__link'
              href: entry.github_url
              "#{entry.repository.replace /^.*\//, ''}##{entry.github_pull_request_id}"
            ')'
      if entry.message_html?
        div
          className: 'changelog-entry__message'
          dangerouslySetInnerHTML: __html: entry.message_html
