// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BeatmapJsonExtended from 'interfaces/beatmap-json-extended';
import * as React from 'react';

const defaultValue: Partial<Record<number, BeatmapJsonExtended>> = {};

export const BeatmapsContext = React.createContext(defaultValue);
