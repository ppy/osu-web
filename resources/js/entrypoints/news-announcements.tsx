// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import NewsAnnouncements from 'components/news-announcements';
import core from 'osu-core-singleton';
import * as React from 'react';
import { parseJson } from 'utils/json';

core.reactTurbolinks.register('news-announcements', () => (
  <NewsAnnouncements announcements={parseJson('json-news-announcements')} />
));
