// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import 'micromark-util-types';

declare module 'micromark-util-types' {
  interface TokenTypeMap {
    legacyLink: 'legacyLink';
    legacyLinkClose: 'legacyLinkClose';
    legacyLinkSpace: 'legacyLinkSpace';
    legacyLinkTitle: 'legacyLinkTitle';
    legacyLinkUrl: 'legacyLinkUrl';
  }
}
