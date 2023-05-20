// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

// Note: `github_url`, `github_username`, and `id` are null when this model is
//       created for use in legacy changelog entries. Typings don't reflect this
//       because changelogs are only CoffeeScript for now.
export default interface GithubUserJson {
  display_name: string;
  github_url: string;
  github_username: string;
  id: number;
  osu_username: string | null;
  user_id: number | null;
  user_url: string | null;
}
