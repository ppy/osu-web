// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import Img2x from 'components/img2x';
import UserProfileJson from 'interfaces/user-profile-json';
import { route } from 'laroute';
import * as React from 'react';

interface Props {
  user: UserProfileJson;
}

export default function ProfileHeaderBanners({ user }: Props) {
  const {
    active_tournament_banner: tournamentBanner,
    voted_in_project_loved: votedInProjectLoved,
  } = user;

  return (
    <div className='profile-header-banners'>
      {tournamentBanner != null && (
        <a
          className='profile-header-banner profile-header-banner--tournament'
          href={route('tournaments.show', { tournament: tournamentBanner.tournament_id })}
        >
          <Img2x className='profile-header-banner__image' src={tournamentBanner.image} />
        </a>
      )}
      {votedInProjectLoved && (
        <a
          className='profile-header-banner profile-header-banner--loved-voted-sticker'
          href={route('forum.forums.show', { forum: 120 })}
          title={osu.trans('users.show.loved_voted_sticker.title', { username: user.username })}
        >
          <Img2x className='profile-header-banner__image' src='/images/layout/loved-voted-sticker.png' />
          <span>{osu.trans('users.show.loved_voted_sticker.content')}</span>
        </a>
      )}
    </div>
  );
}
