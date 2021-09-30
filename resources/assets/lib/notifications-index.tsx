// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { dispatch } from 'app-dispatcher';
import { NotificationBundleJson } from 'interfaces/notification-json';
import { Main } from 'notifications-index/main';
import { NotificationEventMoreLoaded } from 'notifications/notification-events';
import core from 'osu-core-singleton';
import * as React from 'react';
import { parseJson } from 'utils/json';

core.reactTurbolinks.register('notifications-index', (container: HTMLElement) => {
  const bundle = parseJson<NotificationBundleJson>('json-notifications');
  dispatch(new NotificationEventMoreLoaded(bundle, { isWidget: false }));

  return <Main />;
});
