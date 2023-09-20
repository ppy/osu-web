// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

type MaybeHTMLElement = HTMLElement | undefined | null;

function isVisible(el: MaybeHTMLElement) {
  return el?.getAttribute('data-visibility') !== 'hidden';
}

export function fadeIn(el: MaybeHTMLElement) {
  el?.setAttribute('data-visibility', 'visible');
}

export function fadeOut(el: MaybeHTMLElement) {
  el?.setAttribute('data-visibility', 'hidden');
}

export function fadeToggle(el: MaybeHTMLElement, makeVisible?: boolean) {
  if (el == null) return;

  const fn = makeVisible ?? !isVisible(el) ? fadeIn : fadeOut;

  fn(el);
}
