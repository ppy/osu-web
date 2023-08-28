// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BeatmapetExtendedJson from 'interfaces/beatmapset-extended-json';
import * as React from 'react';

const defaultValue: Partial<Record<number, BeatmapetExtendedJson>> = {};

export const BeatmapsetsContext = React.createContext(defaultValue);
