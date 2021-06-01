// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { BeatmapsetJson } from 'beatmapsets/beatmapset-json';
import BeatmapJson from 'interfaces/beatmap-json';
import * as React from 'react';

interface ContextProps {
  beatmaps: Partial<Record<number, BeatmapJson>>;
  beatmapsets: Partial<Record<number, BeatmapsetJson>>;
  cursor: {
    ends_at: string;
    id: number;
  } | null;
}

const defaultValue: ContextProps = {
  beatmaps: {},
  beatmapsets: {},
  cursor: null,
};

// TODO: store?
export const RoomsContext = React.createContext(defaultValue);
