/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */

import { dispatch } from 'app-dispatcher';
import { NotificationBundleJson } from 'interfaces/notification-json';
import { Main } from 'notifications-index/main';
import { NotificationEventMoreLoaded } from 'notifications/notification-events';

reactTurbolinks.registerPersistent('notifications-index', Main, true, (container: HTMLElement) => {
  const bundle = osu.parseJson('json-notifications') as NotificationBundleJson;
  dispatch(new NotificationEventMoreLoaded(bundle, { isWidget: false }));

  return {};
});
