// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import ClickToCopy from 'click-to-copy';
import UserJson from 'interfaces/user-json';
import UserJsonExtended from 'interfaces/user-json-extended';
import { route } from 'laroute';
import { compact } from 'lodash';
import * as moment from 'moment';
import * as React from 'react';
import { Props as StringWithComponentProps, StringWithComponent } from 'string-with-component';
import TimeWithTooltip from 'time-with-tooltip';
import { classWithModifiers } from 'utils/css';

const linkNames = ['discord', 'interests', 'location', 'occupation', 'twitter', 'website'] as const;
type LinkName = (typeof linkNames)[number];

const textNames = ['comments_count', 'join_date', 'last_visit', 'playstyle', 'post_count'] as const;
type TextName = (typeof textNames)[number];

interface LinkProps {
  icon: string;
  text: string | React.ReactNode;
  title?: string;
  url?: string;
}

interface Props {
  user: UserJsonExtended;
}

const linkMapping: Record<LinkName, (val: string) => LinkProps> = {
  discord: (val: string) => ({
    icon: 'fab fa-discord',
    text: <ClickToCopy showIcon value={val} />,
  }),
  interests: (val: string) => ({
    icon: 'far fa-heart',
    text: val,
  }),
  location: (val: string) => ({
    icon: 'fas fa-map-marker-alt',
    text: val,
  }),
  occupation: (val: string) => ({
    icon: 'fas fa-suitcase',
    text: val,
  }),
  twitter: (val: string) => ({
    icon: 'fab fa-twitter',
    text: `@${val}`,
    url: `https://twitter.com/${val}`,
  }),
  website: (val: string) => ({
    icon: 'fas fa-link',
    text: val.replace(/^https?:\/\//, ''),
    url: val,
  }),
};

const textMapping: Record<TextName, (val: string | string[] | number, user: UserJson) => StringWithComponentProps> = {
  comments_count: (val: number, user: UserJson) => {
    const count = osu.transChoice('users.show.comments_count.count', val);
    const url = route('comments.index', { user_id: user.id });

    return {
      mappings: { ':link': <a key='link' className={classWithModifiers('profile-links__value', ['link'])} href={url}>{count}</a> },
      pattern: osu.trans('users.show.comments_count._'),
    };
  },
  join_date: (val: string) => {
    const joinDate = moment(val);
    const joinDateTitle = joinDate.toISOString();
    let className = 'js-tooltip-time';
    let pattern: string;
    let text: string;

    if (joinDate.isBefore(moment.utc([2008]))) {
      pattern = ':date';
      text = osu.trans('users.show.first_members');
    } else {
      className += ' profile-links__value';
      pattern = osu.trans('users.show.joined_at');
      text = joinDate.format(osu.trans('common.datetime.year_month.moment'));
    }

    const mappings = {
      ':date': (
        <span
          key='date'
          className={className}
          title={joinDateTitle}
        >
          {text}
        </span>
      ),
    };

    return { mappings, pattern };
  },
  last_visit: (val: string, user: UserJson) => {
    if (user.is_online) {
      return {
        mappings: {},
        pattern: osu.trans('users.show.lastvisit_online'),
      };
    }

    return {
      mappings: { ':date': <TimeWithTooltip key='date' dateTime={val} /> },
      pattern: osu.trans('users.show.lastvisit'),
    };
  },
  playstyle: (val: string[]) => {
    const playsWith = val.map((s) => osu.trans(`common.device.${s}`)).join(', ');

    return {
      mappings: { ':devices': <span key='devices' className='profile-links__value'>{playsWith}</span> },
      pattern: osu.trans('users.show.plays_with'),
    };
  },
  post_count: (val: number, user: UserJson) => {
    const count = osu.transChoice('users.show.post_count.count', val);
    const url = route('users.posts', { user: user.id });

    return {
      mappings: { ':link': <a key='link' className={classWithModifiers('profile-links__value', ['link'])} href={url}>{count}</a> },
      pattern: osu.trans('users.show.post_count._'),
    };
  },
};

function Link(props: LinkProps) {
  return (
    <div className='profile-links__item'>
      <span className='profile-links__icon' title={props.title}>
        <span className={`fa-fw ${props.icon}`} />
      </span>
      {props.url != null ? (
        <a className='profile-links__value profile-links__value--link' href={props.url}>
          {props.text}
        </a>
      ) : (
        <span className='profile-links__value'>
          {props.text}
        </span>
      )}
    </div>
  );
}

export default class Links extends React.PureComponent<Props> {
  render() {
    const rows = [
      ['join_date', 'last_visit', 'playstyle', 'post_count', 'comments_count'].map(this.renderText),
      ['location', 'interests', 'occupation'].map(this.renderLink),
      ['twitter', 'discord', 'website'].map(this.renderLink),
    ].map((row) => compact(row)).filter((x) => x.length > 0);

    return (
      <div className='profile-links'>
        {rows.map((row, index) => (
          <div key={index} className={`profile-links__row profile-links__row--${index}`}>{row}</div>
        ))}
        {this.props.user.id === currentUser.id && (
          <div className='profile-links__edit'>
            <a className='profile-page-toggle' href={route('account.edit')} title={osu.trans('users.show.page.button')}>
              <span className='fas fa-pencil-alt' />
            </a>
          </div>
        )}
      </div>
    );
  }

  renderLink = (key: LinkName) => {
    const value = this.props.user[key];
    if (typeof value !== 'string') return null;

    const props = linkMapping[key](value);
    props.title ??= osu.trans(`users.show.info.${key}`);

    return <Link key={key} {...props} />;
  };

  renderText = (key: TextName) => {
    const value = this.props.user[key];
    if (value == null) return null;

    const { mappings, pattern } = textMapping[key](value, this.props.user);

    return (
      <div key={key} className='profile-links__item'>
        <StringWithComponent mappings={mappings} pattern={pattern} />
      </div>
    );
  };
}
