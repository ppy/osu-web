// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import HeaderLink from 'interfaces/header-link';
import UserJsonExtended from 'interfaces/user-json-extended';
import { route } from 'laroute';
import osu from 'osu-common';

type LinkMode = 'modding' | 'multiplayer' | 'show';

const nonBotModes: LinkMode[] = ['modding', 'multiplayer'];

export default function headerLinks(user: UserJsonExtended, active: LinkMode) {
  const links: HeaderLink[] = [{
    active: active === 'show',
    title: osu.trans('layout.header.users.show'),
    url: route('users.show', { user: user.id }),
  }];

  if (!user.is_bot) {
    nonBotModes.forEach((mode) => {
      links.push({
        active: active === mode,
        title: osu.trans(`layout.header.users.${mode}`),
        url: route(`users.${mode}.index`, { user: user.id }),
      });
    });
  }

  return links;
}
