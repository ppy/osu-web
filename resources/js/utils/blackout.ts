// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { fadeToggle } from './fade';

const elements = new Set<unknown>();

export function blackoutToggle(element: unknown, state: boolean) {
  if (state) {
    elements.add(element);
  } else {
    elements.delete(element);
  }

  fadeToggle(
    window.newBody?.querySelector('.js-blackout'),
    blackoutVisible(),
  );
}

export function blackoutVisible() {
  return elements.size > 0;
}
