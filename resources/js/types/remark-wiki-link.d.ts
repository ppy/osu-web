// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare module 'remark-wiki-link' {
  import { Plugin } from 'unified';

  interface WikiLinkOptions {
    hrefTemplate(url: string): string;
  }

  const remarkWikiLink: Plugin<[WikiLinkOptions?]>;

  export type RemarkWikiLinkPlugin = [typeof remarkWikiLink, WikiLinkOptions];

  export default remarkWikiLink;
}
