// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import UserJson from 'interfaces/user-json';
import { route } from 'laroute';

export function apiLookup(idsOrUsernames: (string | null | undefined)[]) {
  return $.ajax(route('users.lookup-users'), {
    data: { ids: idsOrUsernames },
    dataType: 'json',
    type: 'POST',
  }) as JQuery.jqXHR<{ users: UserJson[] }>;
}
