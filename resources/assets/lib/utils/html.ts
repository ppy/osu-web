// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

export function createClickCallback(htmlTarget: unknown, reloadDefault = false) {
  const target = htmlTarget instanceof HTMLElement ? htmlTarget : undefined;

  if (target != null || reloadDefault) {
    return () => osu.executeAction(target);
  }
}
