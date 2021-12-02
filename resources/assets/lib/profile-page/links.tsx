// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import ClickToCopy from 'click-to-copy';
import UserExtendedJson from 'interfaces/user-extended-json';
import { route } from 'laroute';
import { compact } from 'lodash';
import * as moment from 'moment';
import core from 'osu-core-singleton';
import * as React from 'react';
import StringWithComponent, { Props as StringWithComponentProps } from 'string-with-component';
import TimeWithTooltip from 'time-with-tooltip';
import { classWithModifiers } from 'utils/css';

// these are ordered in the order they appear in.
const textKeys = ['join_date', 'last_visit', 'playstyle', 'post_count', 'comments_count'] as const;
type TextKey = (typeof textKeys)[number];

const bioKeys = ['location', 'interests', 'occupation'] as const;
type BioKey = (typeof bioKeys)[number];

const mediaKeys = ['twitter', 'discord', 'website'] as const;
type MediaKey = (typeof mediaKeys)[number];

type LinkKey = BioKey | MediaKey;

interface LinkProps {
  icon: string;
  text: string | React.ReactNode;
  title?: string;
  url?: string | null;
}

interface Props {
  user: UserExtendedJson;
}

const linkMapping: Record<LinkKey, (user: UserExtendedJson) => LinkProps> = {
  discord: (user: UserExtendedJson) => ({
    icon: 'fab fa-discord',
    text: <ClickToCopy showIcon value={user.discord ?? ''} />,
  }),
  interests: (user: UserExtendedJson) => ({
    icon: 'far fa-heart',
    text: user.interests,
  }),
  location: (user: UserExtendedJson) => ({
    icon: 'fas fa-map-marker-alt',
    text: user.location,
  }),
  occupation: (user: UserExtendedJson) => ({
    icon: 'fas fa-suitcase',
    text: user.occupation,
  }),
  twitter: (user: UserExtendedJson) => ({
    icon: 'fab fa-twitter',
    text: `@${user.twitter}`,
    url: `https://twitter.com/${user.twitter}`,
  }),
  website: (user: UserExtendedJson) => ({
    icon: 'fas fa-link',
    text: (user.website ?? '').replace(/^https?:\/\//, ''),
    url: user.website,
  }),
};

const textMapping: Record<TextKey, (user: UserExtendedJson) => StringWithComponentProps> = {
  comments_count: (user: UserExtendedJson) => {
    const count = osu.transChoice('users.show.comments_count.count', user.comments_count ?? 0);
    const url = route('comments.index', { user_id: user.id });

    return {
      mappings: { link: <a className={classWithModifiers('profile-links__value', 'link')} href={url}>{count}</a> },
      pattern: osu.trans('users.show.comments_count._'),
    };
  },
  join_date: (user: UserExtendedJson) => {
    const joinDate = moment(user.join_date);
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
      date: (
        <span className={className} title={joinDateTitle}>
          {text}
        </span>
      ),
    };

    return { mappings, pattern };
  },
  last_visit: (user: UserExtendedJson) => {
    if (user.is_online) {
      return {
        mappings: {},
        pattern: osu.trans('users.show.lastvisit_online'),
      };
    }

    return {
      mappings: { date: (
        <span className='profile-links__value'>
          <TimeWithTooltip dateTime={user.last_visit ?? ''} relative />
        </span>
      ) },
      pattern: osu.trans('users.show.lastvisit'),
    };
  },
  playstyle: (user: UserExtendedJson) => {
    const playsWith = user.playstyle.map((s) => osu.trans(`common.device.${s}`)).join(', ');

    return {
      mappings: { devices: <span className='profile-links__value'>{playsWith}</span> },
      pattern: osu.trans('users.show.plays_with'),
    };
  },
  post_count: (user: UserExtendedJson) => {
    const count = osu.transChoice('users.show.post_count.count', user.post_count);
    const url = route('users.posts', { user: user.id });

    return {
      mappings: { link: <a className={classWithModifiers('profile-links__value', 'link')} href={url}>{count}</a> },
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
      textKeys.map(this.renderText),
      bioKeys.map(this.renderLink),
      mediaKeys.map(this.renderLink),
    ].map((row) => compact(row)).filter((x) => x.length > 0);

    return (
      <div className='profile-links'>
        {rows.map((row, index) => (
          <div key={index} className={`profile-links__row profile-links__row--${index}`}>{row}</div>
        ))}
        {this.props.user.id === core.currentUser?.id && (
          <div className='profile-links__edit'>
            <a className='btn-circle btn-circle--page-toggle' href={route('account.edit')} title={osu.trans('users.show.page.button')}>
              <span className='fas fa-pencil-alt' />
            </a>
          </div>
        )}
      </div>
    );
  }

  private renderLink = (key: LinkKey) => {
    if (this.props.user[key] == null) return null;

    const props = linkMapping[key](this.props.user);
    props.title ??= osu.trans(`users.show.info.${key}`);

    return <Link key={key} {...props} />;
  };

  private renderText = (key: TextKey) => {
    if (this.props.user[key] == null) return null;

    const props = textMapping[key](this.props.user);

    return (
      <div key={key} className='profile-links__item'>
        <StringWithComponent {...props} />
      </div>
    );
  };
}
