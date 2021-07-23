// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { find } from 'lodash';

const osuCommon = {
  bottomPage: () => osuCommon.bottomPageDistance() === 0,
  bottomPageDistance: () => {
    const body = document.documentElement ?? document.body.parentElement ?? document.body;
    return (body.scrollHeight - body.scrollTop) - body.clientHeight;
  },
  classWithModifiers: (className: string, modifiers?: string[]) => {
    let ret = className;

    if (modifiers != null) {
      modifiers.forEach((modifier) => {
        ret += ` ${className}--${modifier}`;
      });
    }

    return ret;
  },
  currentUserIsFriendsWith: (userId: number) => find(currentUser.friends, { target_id: userId }),
  isIos: /iPad|iPhone|iPod/.test(navigator.platform),
  urlRegex: /(https?:\/\/((?:(?:[a-z0-9]\.|[a-z0-9][a-z0-9-]*[a-z0-9]\.)*[a-z][a-z0-9-]*[a-z0-9](?::\d+)?)(?:(?:(?:\/+(?:[a-z0-9$_\.\+!\*',;:@&=-]|%[0-9a-f]{2})*)*(?:\?(?:[a-z0-9$_\.\+!\*',;:@&=-]|%[0-9a-f]{2})*)?)?(?:#(?:[a-z0-9$_\.\+!\*',;:@&=/?-]|%[0-9a-f]{2})*)?)?(?:[^\.,:\s])))/ig,
};
