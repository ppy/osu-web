// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import HeaderLink from 'interfaces/header-link';
import UserJsonExtended from 'interfaces/user-json-extended';
import { route } from 'laroute';

export default function headerLinks(user: UserJsonExtended, active: 'modding' | 'show') {
  const links: HeaderLink[] = [{
    active: active === 'show',
    title: osu.trans('layout.header.users.show'),
    url: route('users.show', { user: user.id }),
  }];

  if (!user.is_bot) {
    links.push({
      active: active === 'modding',
      title: osu.trans('layout.header.users.modding'),
      url: route('users.modding.index', { user: user.id }),
    });
  }

  return links;
}
