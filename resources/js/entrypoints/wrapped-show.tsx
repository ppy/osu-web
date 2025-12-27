// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import core from 'osu-core-singleton';
import React from 'react';
import { parseJson } from 'utils/json';
import WrappedShow from 'wrapped-show';
import sampleData from 'wrapped-show/sums/summary-8447637.json';

const userId = 8447637;

core.reactTurbolinks.register('wrapped-show', () => (
  // <WrappedShow {...parseJson('json-wrapped-show')} />
  <WrappedShow user_id={userId} {...sampleData} />
));
