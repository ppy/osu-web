// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { fail } from 'utils/fail';
import { htmlElementOrNull } from 'utils/html';

const activeClass = 'js-is-active';

export default class PopularBeatmapsetsRuleset {
  constructor() {
    $(document).on('click', '.js-popular-beatmapsets-ruleset', this.onClick);
  }

  private readonly onClick = (event: JQuery.ClickEvent) => {
    const selectedButton = htmlElementOrNull(event.currentTarget)
      ?? fail('popular beatmapsets ruleset button is missing');

    const container = selectedButton.closest('.js-popular-beatmapsets')
      ?? fail('popular beatmapsets container is missing');

    const ruleset = selectedButton.dataset.popularRuleset;

    for (const button of container.querySelectorAll<HTMLButtonElement>('.js-popular-beatmapsets-ruleset')) {
      button.classList.toggle(activeClass, button.dataset.popularRuleset === ruleset);
    }

    for (const panel of container.querySelectorAll<HTMLElement>('.js-popular-beatmapsets-panel')) {
      panel.classList.toggle('u-hidden', panel.dataset.popularRuleset !== ruleset);
    }
  };
}
