// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

export type GithubUserJsonForAccountEdit = GithubUserJson & {
  github_url: string;
  github_username: string;
};

export default interface GithubUserJson {
  display_name: string;
  github_url: string | null;
  github_username: string | null;
  id: number;
  osu_username: string | null;
  user_id: number | null;
  user_url: string | null;
}
