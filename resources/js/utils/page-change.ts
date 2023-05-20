// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

export function pageChange() {
  return window.setTimeout(pageChangeImmediate, 0);
}

export function pageChangeImmediate() {
  $.publish('osu:page:change');
}
