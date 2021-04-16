// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { Img2x } from 'img2x';
import ProfileBannerJson from 'interfaces/profile-banner';
import { route } from 'laroute';
import * as React from 'react';

interface Props {
  banner?: ProfileBannerJson | null;
}

export default function ProfileTournamentBanner({ banner }: Props) {
  if (banner?.id == null) return null;

  return (
    <a
      className='profile-tournament-banner'
      href={route('tournaments.show', { tournament: banner.tournament_id })}
    >
      <Img2x className='profile-tournament-banner__image' src={banner.image} />
    </a>
  );
}
