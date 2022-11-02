// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import HeaderLink from 'interfaces/header-link';
import UserExtendedJson from 'interfaces/user-extended-json';
import { MultiplayerTypeGroup } from 'interfaces/user-multiplayer-history-json';
import { route } from 'laroute';

type LinkMode = 'modding' | 'show' | MultiplayerTypeGroup;

const nonBotModes: LinkMode[] = ['modding', 'playlists', 'realtime'];

const url = {
  modding: (userId: number) => route('users.modding.index', { user: userId }),
  playlists: (userId: number) => route('users.multiplayer.index', { typeGroup: 'playlists', user: userId }),
  realtime: (userId: number) => route('users.multiplayer.index', { typeGroup: 'realtime', user: userId }),
  show: (userId: number) => route('users.show', { user: userId }),
};

function link(mode: LinkMode, active: boolean, userId: number) {
  return {
    active,
    title: osu.trans(`layout.header.users.${mode}`),
    url: url[mode](userId),
  };
}

export default function headerLinks(user: UserExtendedJson, active: LinkMode) {
  const links: HeaderLink[] = [link('show', active === 'show', user.id)];

  if (!user.is_bot) {
    nonBotModes.forEach((mode) => {
      links.push(link(mode, active === mode, user.id));
    });
  }

  return links;
}
