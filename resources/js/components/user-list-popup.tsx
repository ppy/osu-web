// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import UserAvatar from 'components/user-avatar';
import UserLink from 'components/user-link';
import UserJson from 'interfaces/user-json';
import { autorun } from 'mobx';
import * as React from 'react';
import { renderToStaticMarkup } from 'react-dom/server';
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

export function createTooltip(targetFn: () => HTMLElement | null, propsFn: () => Props, positionAt: PositionAt) {
  $(targetFn() ?? []).qtip({
    content: {
      text: '[placeholder]',
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

  return autorun(() => {
    const content = renderToStaticMarkup(<UserListPopup {...propsFn()} />);
    $(targetFn() ?? []).qtip('set', { 'content.text': content });
  });
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
              tooltipPosition='top right'
              user={user}
            >
              <UserAvatar modifiers='full' user={user} />
            </UserLink>
          ))}
        </div>
      }
      {props.count > props.users.length && props.users.length > 0 &&
        <div className='user-list-popup__remainder-count'>
          {transChoice('common.count.plus_others', props.count - props.users.length)}
        </div>
      }
    </div>
  );
}
