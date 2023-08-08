// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

export default interface NewsAnnouncementJson {
  content: {
    html: string;
    markdown: string;
  } | null;
  ended_at: string | null;
  id: number;
  image_url: string;
  order: number;
  started_at: string;
  url: string;
}
