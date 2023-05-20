// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import GameMode from './game-mode';
import UserStatisticsJson from './user-statistics-json';

type UserStatisticsRulesetsJson = Partial<Record<GameMode, UserStatisticsJson | null>>;

export default UserStatisticsRulesetsJson;
