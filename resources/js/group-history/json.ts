// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import GroupJson from 'interfaces/group-json';
import UserGroupEventJson from 'interfaces/user-group-event-json';

export default interface GroupHistoryJson {
  cursor_string: string | null;
  events: UserGroupEventJson[];
  groups: GroupJson[];
  params: {
    group_id?: number | null;
    max_date?: string | null;
    min_date?: string | null;
    sort: string;
    user?: string | null;
  };
}
