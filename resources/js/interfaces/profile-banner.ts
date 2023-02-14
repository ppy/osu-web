// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

interface ProfileBannerJsonBase {
  id: number;
  tournament_id: number;
}

type ProfileBannerJson = ProfileBannerJsonBase & (
  {
    image: string;
    'image@2x': string;
  } | {
    image: null;
    'image@2x': null;
  }
);

export default ProfileBannerJson;
