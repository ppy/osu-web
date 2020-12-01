// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { Name } from 'models/notification-type';
import { createContext } from 'react';

export interface NotificationContextData {
  excludes: Name[];
  isWidget: boolean;
}

export const NotificationContext = createContext<NotificationContextData>({ excludes: [], isWidget: false });
