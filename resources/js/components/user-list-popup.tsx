// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import UserAvatar from 'components/user-avatar';
import { UserLink } from 'components/user-link';
import UserJson from 'interfaces/user-json';
import * as React from 'react';
import { transChoice } from 'utils/lang';

interface Props {
  count: number;
  title?: string;
  users: Partial<Pick<UserJson, 'avatar_url' | 'id' | 'username'>>[];
}

type PositionAt = `${'right' | 'top'} center`;
const atToMy = {
  'right center': 'left center',
  'top center': 'bottom center',
};

export function createTooltip(target: HTMLElement, positionAt: PositionAt, content: string | (() => string)) {
  if (target._tooltip === '1') return;

  target._tooltip = '1';

  return $(target).qtip({
    content: {
      text: content,
    },
    hide: {
      delay: 500,
      effect(this: HTMLElement) {
        $(this).fadeTo(250, 0);
      },
      fixed: true,
    },
    position: {
      at: positionAt,
      my: atToMy[positionAt],
      viewport: $(window),
    },
    show: {
      delay: 100,
      effect(this: HTMLElement) {
        $(this).fadeTo(110, 1);
      },
      ready: true,
    },
    style: {
      classes: 'qtip qtip--user-list',
      def: false,
      tip: false,
    },
  }) as JQuery;
}

export default function UserListPopup(props: Props) {
  return (
    <div className='user-list-popup'>
      {props.title}
      {props.users.length > 0 &&
        <div className='user-list-popup__users'>
          {props.users.map((user) => (
            <UserLink
              key={user.id}
              className='user-list-popup__user'
              user={user}
            >
              <UserAvatar modifiers='full' user={user} />
            </UserLink>
          ))}
        </div>
      }
      {props.count > props.users.length &&
        <div className='user-list-popup__remainder-count'>
          {transChoice('common.count.plus_others', props.count - props.users.length)}
        </div>
      }
    </div>
  );
}
