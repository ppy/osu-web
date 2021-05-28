// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { ClientJson } from 'interfaces/client-json';

export interface OwnClientJson extends ClientJson {
  redirect: string;
  secret: string;
}
