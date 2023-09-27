// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { createContext } from 'react';
import DiscussionsState from './discussions-state';

// TODO: combine with DiscussionsContext, BeatmapsetContext, etc into a store with properties.
const DiscussionsStateContext = createContext(new DiscussionsState());

export default DiscussionsStateContext;
