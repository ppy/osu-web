// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import GroupJson from 'interfaces/group-json';
import { find } from 'lodash';
import * as React from 'react';
import { currentUrl as getCurrentUrl } from 'utils/turbolinks';

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
  diffColour: (difficultyRating?: string | null) => ({ '--diff': `var(--diff-${difficultyRating ?? 'default'})` } as React.CSSProperties),
  groupColour: (group?: GroupJson) => ({ '--group-colour': group?.colour ?? 'initial' } as React.CSSProperties),
  isIos: /iPad|iPhone|iPod/.test(navigator.platform),
  setHash: (newHash: string) => {
    const currentUrl = getCurrentUrl().href;
    let newUrl = currentUrl.replace(/#.*/, '');
    newUrl += newHash;

    if (newUrl === currentUrl) {
      return;
    }

    history.replaceState(history.state, '', newUrl);
  },
  urlRegex: /(https?:\/\/((?:(?:[a-z0-9]\.|[a-z0-9][a-z0-9-]*[a-z0-9]\.)*[a-z][a-z0-9-]*[a-z0-9](?::\d+)?)(?:(?:(?:\/+(?:[a-z0-9$_\.\+!\*',;:@&=-]|%[0-9a-f]{2})*)*(?:\?(?:[a-z0-9$_\.\+!\*',;:@&=-]|%[0-9a-f]{2})*)?)?(?:#(?:[a-z0-9$_\.\+!\*',;:@&=/?-]|%[0-9a-f]{2})*)?)?(?:[^\.,:\s])))/ig,
};
