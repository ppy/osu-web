// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import GroupJson from 'interfaces/group-json';

const guestGroup: Readonly<GroupJson> = Object.freeze({
  colour: 'hsl(var(--hsl-l1))',
  id: -1,
  identifier: 'guest',
  is_probationary: false,
  name: 'Difficulty Guest',
  short_name: 'GUEST',
});

export default guestGroup;
