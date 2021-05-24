// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import UserGroupJson from 'interfaces/user-group-json';

const mapperGroup: Readonly<UserGroupJson> = Object.freeze({
  colour: 'hsl(var(--hsl-l1))',
  description: '',
  has_listing: false,
  has_playmodes: false,
  id: -1,
  identifier: 'owner',
  is_probationary: false,
  name: 'Beatmap Mapper',
  short_name: 'MAPPER',
});

export default mapperGroup;
