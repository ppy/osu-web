// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import UserGroupJson from 'interfaces/user-group-json';

const guestGroup: Readonly<UserGroupJson> = Object.freeze({
  colour: 'hsl(var(--hsl-l1))',
  description: '',
  has_listing: false,
  has_playmodes: false,
  id: -1,
  identifier: 'guest',
  is_probationary: false,
  name: 'Difficulty Guest',
  short_name: 'GUEST',
});

export default guestGroup;
