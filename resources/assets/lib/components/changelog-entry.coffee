# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import * as React from 'react'
import { div, span, a } from 'react-dom-factories'
el = React.createElement

icon =
  add: 'fas fa-plus'
  fix: 'fas fa-check'
  misc: 'far fa-circle'

export ChangelogEntry = ({entry}) =>
  titleHtml = _.escape(entry.title).replace(/(`+)([^`]+)\1/g, '<code>$2</code>')

  div
    className: 'changelog-entry'
    key: entry.id

    div className: 'changelog-entry__row',
      div className: "changelog-entry__title #{if entry.major then 'changelog-entry__title--major' else ''}",
        span className: 'changelog-entry__title-icon',
          span className: "changelog-entry__icon #{icon[entry.type]}"

        if entry.url?
          a
            href: entry.url
            className: 'changelog-entry__link'
            dangerouslySetInnerHTML:
              __html: titleHtml
        else
          span
            dangerouslySetInnerHTML:
              __html: titleHtml
        if entry.github_url?
          span null,
            ' ('
            a
              className: 'changelog-entry__link'
              href: entry.github_url
              "#{entry.repository.replace /^.*\//, ''}##{entry.github_pull_request_id}"
            ')'
        do =>
          user = _.escape(entry.github_user.display_name)
          url = entry.github_user.github_url ? entry.github_user.user_url

          link =
            if url?
              "<a
                data-user-id='#{entry.github_user.user_id ? ''}'
                class='changelog-entry__user-link js-usercard'
                href='#{_.escape(url)}'
              >#{user}</a>"
            else
              user

          span
            className: 'changelog-entry__user'
            dangerouslySetInnerHTML:
              __html: osu.trans('changelog.entry.by', user: link)

    if entry.message_html?
      div
        className: 'changelog-entry__row changelog-entry__row--message'
        dangerouslySetInnerHTML: __html: entry.message_html
