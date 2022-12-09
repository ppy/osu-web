// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

export default interface GithubUserJson {
  github_url: string;
  github_username: string;
  id: number;
  osu_username: string | null;
  user_id: number | null;
  user_url: string | null;
}
