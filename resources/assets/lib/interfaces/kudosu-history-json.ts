// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

export default interface KudosuHistoryJson {
  action: string;
  amount: number;
  created_at: string;
  giver: {
    url: string;
    username: string;
  } | null;
  id: number;
  model: string;
  post: {
    title: string;
    url: string | null;
  };
}
