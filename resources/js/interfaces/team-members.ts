// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import TeamMemberJson from './team-member-json';

export default interface TeamMembers {
  items: TeamMemberJson[];
  total: number;
}
