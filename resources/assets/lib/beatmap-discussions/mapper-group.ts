// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import GroupJson from 'interfaces/group-json';

const mapperGroup: Readonly<GroupJson> = Object.freeze({
  colour: 'hsl(var(--hsl-l1))',
  id: -1,
  identifier: 'owner',
  is_probationary: false,
  name: 'Beatmap Mapper',
  short_name: 'MAPPER',
});

export default mapperGroup;
