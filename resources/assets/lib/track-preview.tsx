// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import * as React from 'react';

interface Props {
  track: {
    cover_url?: string | null;
    preview: string;
  };
}

export default function TrackPreview({ track }: Props) {
  return (
    <button
      className='track-cover-preview js-audio--play js-audio--player'
      data-audio-url={track.preview}
      style={{
        backgroundImage: osu.urlPresence(track.cover_url),
      }}
      type='button'
    >
      <span className='play-button' />
    </button>
  );
}
