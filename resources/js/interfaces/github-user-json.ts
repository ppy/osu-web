// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

interface CommonProps {
  display_name: string;
}

interface GithubProps {
  github_url: string;
  github_username: string;
  id: number;
}

interface OsuProps {
  osu_username: string;
  user_id: number;
  user_url: string;
}

type GithubUserJson = CommonProps & GithubProps & (OsuProps | { [P in keyof OsuProps]: null });
type GithubUserJsonLegacy = CommonProps & { [P in keyof GithubProps]: null } & OsuProps;

export default GithubUserJson;
export type GithubUserJsonForChangelog = GithubUserJson | GithubUserJsonLegacy;
