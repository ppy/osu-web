// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import * as React from 'react';
import { classWithModifiers, Modifiers, urlPresence } from 'utils/css';

interface UserForAvatarJson {
  // TODO: make non-optional; existing coffeescript passes {} for guest user.
  avatar_url?: string | null;
  has_alpha?: boolean;
}

interface Props {
  modifiers?: Modifiers;
  user?: UserForAvatarJson;
}

export default function UserAvatar(props: Props) {
  return (
    <span
      className={classWithModifiers('avatar', { guest: true, 'no-border': props.user?.has_alpha }, props.modifiers)}
      style={{ backgroundImage: urlPresence(props.user?.avatar_url) }}
    />
  );
}
