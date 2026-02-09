// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

const atToMy = {
  'bottom center': 'top center',
  'bottom left': 'top left',
  'left center': 'right center',
  'right center': 'left center',
  'top center': 'bottom center',
  'top left': 'bottom left',
  'top right': 'bottom left',
} as const;
export type PositionAt = keyof typeof atToMy;

export function qtipPosition(at: PositionAt) {
  return {
    at,
    my: atToMy[at] ?? 'left center',
    viewport: $(window),
  };
}
