// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

interface Navigation {
  newer?: NewsPostJson;
  older?: NewsPostJson;
}

interface HasFirstImage {
  first_image: string;
  'first_image@2x': string;
}

interface HasNoFirstImage {
  first_image: null;
  'first_image@2x': null;
}

type NewsPostJson = {
  author: string;
  content?: string;
  edit_url: string;
  id: number;
  navigation?: Navigation;
  preview?: string;
  published_at: string;
  slug: string;
  title: string;
} & (HasFirstImage | HasNoFirstImage);

export default NewsPostJson;
