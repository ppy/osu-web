// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { route } from 'laroute';
import { trans } from 'utils/lang';

export default function homeLinks(active: string) {
  return [
    {
      active: active === 'home',
      title: trans('home.user.title'),
      url: route('home'),
    },
    {
      active: active === 'friends.index',
      title: trans('friends.title_compact'),
      url: route('friends.index'),
    },
    {
      active: active === 'follows.index',
      title: trans('follows.index.title_compact'),
      url: route('follows.index', { subtype: 'forum_topic' }),
    },
    {
      active: active === 'account.edit',
      title: trans('accounts.edit.title_compact'),
      url: route('account.edit'),
    },
  ];
}
