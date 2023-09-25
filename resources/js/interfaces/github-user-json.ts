// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

interface CommonProps {
  display_name: string;
}

interface GithubProps {
  github_url: string;
  github_username: string;
}

interface IdProps {
  id: number;
}

interface OsuProps {
  osu_username: string;
  user_id: number;
  user_url: string;
}

type Null<T> = Record<keyof T, null>;

type GithubUserJson = CommonProps & GithubProps       & IdProps       & (OsuProps | Null<OsuProps>);
type Legacy         = CommonProps & Null<GithubProps> & Null<IdProps> & OsuProps;
type Placeholder    = CommonProps & GithubProps       & Null<IdProps> & Null<OsuProps>;

export default GithubUserJson;
export type GithubUserJsonForChangelog = GithubUserJson | Legacy | Placeholder;
