// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import * as React from 'react';
import { classWithModifiers, Modifiers } from 'utils/css';

const bn = 'avatar';

interface UserForAvatarJson {
  avatar_url?: string | null;
}

interface Props {
  modifiers?: Modifiers;
  user: UserForAvatarJson;
}

export default function UserAvatar(props: Props) {
  return (
    <div
      className={`${classWithModifiers(bn, props.modifiers)} ${bn}--guest`}
      style={{
        backgroundImage: osu.urlPresence(props.user.avatar_url),
      }}
    />
  );
}
