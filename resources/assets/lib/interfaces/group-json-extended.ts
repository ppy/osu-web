// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import GroupJson from './group-json';

export default interface GroupJsonExtended extends GroupJson {
  description: {
    html: string;
    markdown: string;
  } | null;
}
