// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

type MaybeHTMLElement = HTMLElement | undefined | null;

const Fade = {
  in: (el: MaybeHTMLElement) => {
    el?.setAttribute('data-visibility', 'visible');
  },

  isVisible: (el: MaybeHTMLElement) => el?.getAttribute('data-visibility') !== 'hidden',

  out: (el: MaybeHTMLElement) => {
    el?.setAttribute('data-visibility', 'hidden');
  },

  toggle: (el: MaybeHTMLElement, makeVisible?: boolean) => {
    if (el == null) return;

    makeVisible = makeVisible ?? !Fade.isVisible(el);

    makeVisible ? Fade.in(el) : Fade.out(el);
  },
};

export default Fade;
