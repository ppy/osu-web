// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { fail } from 'utils/fail';
import { htmlElementOrNull } from 'utils/html';

function expand(e: JQuery.ClickEvent) {
  e.stopPropagation();
  e.preventDefault();

  const container = htmlElementOrNull(e.target)?.closest('.js-spoilerbox')
    ?? fail('spoiler container is missing');
  const body = htmlElementOrNull(container.querySelector(':scope > .js-spoilerbox__body'))
    ?? fail('spoiler body is missing');

  const toggle = container.classList.toggle('js-spoilerbox--open')
    ? 'slideDown'
    : 'slideUp';

  $(body).stop()[toggle]({
    complete(this: void) {
      $.publish('sync-height:force');
      body.style.height = '';
    },
  });
}

export default class Spoilerbox {
  constructor() {
    $(document).on('click', '.js-spoilerbox__link', expand);
  }
}
