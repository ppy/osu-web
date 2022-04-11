// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import UserJson from 'interfaces/user-json';
import core from 'osu-core-singleton';

export function isBlocked(user: UserJson) {
  return core.currentUser?.blocks.find((u) => u.target_id === user.id) != null;
}
