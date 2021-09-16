// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BeatmapExtendedJson from 'interfaces/beatmap-extended-json';
import * as React from 'react';

const defaultValue: Partial<Record<number, BeatmapExtendedJson>> = {};

export const BeatmapsContext = React.createContext(defaultValue);
