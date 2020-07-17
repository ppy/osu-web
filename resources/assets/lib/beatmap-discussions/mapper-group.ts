// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import GroupJSON from 'interfaces/group-json';

const mapperGroup: Readonly<GroupJSON> = Object.freeze({
  colour: 'hsl(200, 60%, 50%)',
  id: -1,
  identifier: 'mapper',
  name: 'Beatmap Mapper',
  short_name: 'MAP',
});

export default mapperGroup;
