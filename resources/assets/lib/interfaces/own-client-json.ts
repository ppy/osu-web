// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { ClientJSON } from 'interfaces/client-json';

export interface OwnClientJSON extends ClientJSON {
  redirect: string;
  secret: string;
}
