// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import Ruleset from './ruleset';
import UserStatisticsJson from './user-statistics-json';

type UserStatisticsRulesetsJson = Partial<Record<Ruleset, UserStatisticsJson | null>>;

export default UserStatisticsRulesetsJson;
