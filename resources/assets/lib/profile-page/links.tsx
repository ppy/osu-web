// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import ClickToCopy from 'click-to-copy';
import UserJson from 'interfaces/user-json';
import UserJsonExtended from 'interfaces/user-json-extended';
import { route } from 'laroute';
import { compact } from 'lodash';
import * as moment from 'moment';
import * as React from 'react';

interface Props {
  user: UserJsonExtended;
}

const bn = 'profile-links';

const linkMapping = {
  twitter: (val: string) => ({
    icon: 'fab fa-twitter',
    url: `https://twitter.com/${val}`,
    text: `@${val}`,
  }),
  discord: (val: string) => ({
    icon: 'fab fa-discord',
    text: <ClickToCopy showIcon value={val} />,
  }),
  interests: () => ({
    icon: 'far fa-heart',
  }),
  location: () => ({
    icon: 'fas fa-map-marker-alt',
  }),
  occupation: () => ({
    icon: 'fas fa-suitcase',
  }),
  website: (val: string) => ({

    icon: 'fas fa-link',
    url: val,
    text: val.replace(/^https?:\/\//, ''),
  }),
};

const textMapping = {
  comments_count: (val: string, user: UserJson) => {
    const count = osu.transChoice('users.show.comments_count.count', val)
    const url = route('comments.index', { user_id: user.id })

    return {
      html: osu.trans('users.show.comments_count._'),
      link: rowValue(count, { href: url }),
    }
  },
  join_date: (val: string) => {
    const joinDate = moment(val)
    const joinDateTitle = joinDate.toISOString()

    if (joinDate.isBefore(moment.utc([2008]))) {
      return {
        extraClasses: 'js-tooltip-time',
        html: osu.trans('users.show.first_members'),
        title: joinDateTitle,
      };
    }

    return {
      html: osu.trans('users.show.joined_at', {
        date: rowValue(
          joinDate.format(osu.trans('common.datetime.year_month.moment')),
          { className: 'js-tooltip-time', title: joinDateTitle }
        ),
      }),
    };
  },
  last_visit: (val: string, user: UserJson) => {
    if (user.is_online) {
      return { html: osu.trans('users.show.lastvisit_online') };
    }

    return {
      date: rowValue(osu.timeago(val)),
      html: osu.trans('users.show.lastvisit'),
    };
  },
  playstyle: (val: string[]) => {
    const playsWith = val.map((s) => osu.trans(`common.device.${s}`)).join(', ');

    return {
      devices: rowValue(playsWith),
      html: osu.trans('users.show.plays_with'),
    };
  },
  post_count: (val: string, user: UserJson) => {
    const count = osu.transChoice('users.show.post_count.count', val);
    const url = route('users.posts', { user: user.id });

    return {
      html: osu.trans('users.show.post_count._'),
      link: rowValue(count, { href: url }),
    }
  },
}

function rowValue(value: any, attributes: Record<string, any> = {}, modifiers: string[] = []) {
  let tagName: string;
  if (attributes.href != null) {
    tagName = 'a';
    modifiers.push('link');
  } else {
    tagName = 'span';
  }

  const elem = document.createElement(tagName);
  for (const [k, v] of Object.entries(attributes)) {
    elem[k] = v;
  }

  elem.innerHTML = value;

  return elem.outerHTML;
}

export default class Links extends React.PureComponent<Props> {
  render() {
    const rows = [
      ['join_date', 'last_visit', 'playstyle', 'post_count', 'comments_count'].map(this.renderText),
      ['location', 'interests', 'occupation'].map(this.renderLink),
      ['twitter', 'discord', 'website'].map(this.renderLink),
    ].map((row) => compact(row)).filter((x) => x.length > 0);

    return (
      <div className={bn}>
        {rows.map((row, index) => (
          <div key={index} className={`${bn}__row ${bn}__row--${index}`}>{row}</div>
        ))}
        {this.props.user.id === currentUser.id && (
          <div className={`${bn}__edit`}>
            <a className='profile-page-toggle' href={route('account.edit')} title={osu.trans('users.show.page.button')}>
              <span className='fas fa-pencil-alt' />
            </a>
          </div>
        )}
      </div>
    );
  }

  renderLink = (key: string) => {
    const value = this.props.user[key];
    if (value == null) return null;

    const { url, icon, text, title } = linkMapping[key](value);

    return (
      <div key={key} className={`${bn}__item`}>
        <span className={`${bn}__icon`} title={title ?? osu.trans(`users.show.info.${key}`)}>
          <span className={`fa-fw ${icon}`} />
        </span>
        {url != null ? (
          <a className={`${bn}__value`} href={url}>
            {text ?? value}
          </a>
        ) : (
          <span className={`${bn}__value`}>
            {text ?? value}
          </span>
        )}
      </div>
    );
  };

  renderText = (key: string) => {
    const value = this.props.user[key]
    if (value == null) return null;

    const { extraClasses, html, title } = textMapping[key](value, this.props.user);
    const className = `${bn}__item ${extraClasses ?? ''}`;

    return (
      <div
        key={key}
        className={className}
        dangerouslySetInnerHTML={{ __html: html }}
        title={title}
      />
    );
  };
}
