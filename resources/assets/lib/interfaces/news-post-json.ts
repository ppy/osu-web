// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

interface Navigation {
  newer?: NewsPostJson;
  older?: NewsPostJson;
}

export default interface NewsPostJson {
  author: string;
  content?: string;
  edit_url: string;
  first_image?: string;
  id: number;
  navigation?: Navigation;
  preview?: string;
  published_at: string;
  slug: string;
  title: string;
}
