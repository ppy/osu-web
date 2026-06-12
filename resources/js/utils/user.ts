// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { type RulesetId } from 'interfaces/ruleset';
import UserJson from 'interfaces/user-json';
import { route } from 'laroute';

interface LookupUserParams {
  exclude_bots?: boolean;
  ids: (string | null | undefined)[];
  ruleset_id?: RulesetId;
}

export function apiLookupUsers(idsOrUsernames: (string | null | undefined)[], excludeBots?: boolean, rulesetId?: RulesetId) {
  const data: LookupUserParams = { exclude_bots: excludeBots, ids: idsOrUsernames };
  if (rulesetId != null) {
    data.ruleset_id = rulesetId;
  }

  return $.ajax(route('users.lookup'), {
    data,
    dataType: 'json',
  }) as JQuery.jqXHR<{ users: UserJson[] }>;
}
