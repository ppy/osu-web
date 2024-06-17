// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import remarkWikiLink, { RemarkWikiLinkPlugin } from 'remark-wiki-link';
import { wikiUrlWithoutLocale } from 'utils/url';

const wikiLink: RemarkWikiLinkPlugin = [remarkWikiLink, {
  hrefTemplate: wikiUrlWithoutLocale,
  pageResolver: (name: string) => [name],
}];

export default wikiLink;
