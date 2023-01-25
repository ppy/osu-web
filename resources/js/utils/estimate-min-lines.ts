// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

let counterElem: HTMLElement | null = null;

function getCounterElem() {
  if (counterElem == null) {
    counterElem = document.querySelector('.js-estimate-min-lines');

    if (counterElem == null) {
      throw new Error('js-estimate-min-lines placeholder element is missing!');
    }
  }

  return counterElem;
}

/**
 * Estimate minimum number of lines of a dom.
 * The counting is done by wrapping it inside a container which width
 * is the maximum allowed site-wide based on `@container-sm`.
 *
 * Line height attribute is based on the line height of the first element.
 * Images are hidden as we're not going to wait until they finish loading and
 * it may be shorter on narrower size due to keeping aspect ratio.
 * Extra padding and margins, mixed line height, and various other factors
 * will contribute in causing incorrect result.
 *
 * Also note that this forces repaint so don't call this during initial react
 * render or otherwise scroll position will be reset to 0.
 * Mainly noticeable on browser history navigation.
 *
 * Components:
 * - lib/utils/estimate-min-lines.ts (main)
 * - less/bem/estimate-min-lines.less (styling)
 * - views/master.blade.php (placeholder)
 */
export function estimateMinLines(domString: string) {
  const counter = getCounterElem();
  counter.innerHTML = domString;

  const firstChild = counter.firstChild;
  let refLineHeight: HTMLElement = counter;

  if (firstChild instanceof HTMLElement) {
    refLineHeight = firstChild;
  }

  const lineHeight = parseFloat(window.getComputedStyle(refLineHeight).getPropertyValue('line-height') ?? '0');
  const height = counter.scrollHeight;
  const count = Math.ceil(height / lineHeight);

  return { count, height, lineHeight };
}
