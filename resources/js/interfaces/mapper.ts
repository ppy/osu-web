// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import UserJson from './user-json';

type Mapper = Pick<UserJson, 'avatar_url' | 'id' | 'username'>;

export default Mapper;
