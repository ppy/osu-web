// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

document.addEventListener('turbo:load', () => {
  for (const container of document.querySelectorAll<HTMLElement>('.js-popular-beatmaps')) {
    container.addEventListener('click', (event) => {
      const button = (event.target as Element).closest<HTMLButtonElement>('.js-popular-beatmaps-mode');
      if (button == null) {
        return;
      }

      const mode = button.dataset.popularMode;

      for (const otherButton of container.querySelectorAll<HTMLButtonElement>('.js-popular-beatmaps-mode')) {
        otherButton.classList.toggle('game-mode-link--active', otherButton.dataset.popularMode === mode);
      }

      for (const panel of container.querySelectorAll<HTMLElement>('.js-popular-beatmaps-panel')) {
        panel.classList.toggle('u-hidden', panel.dataset.popularPanel !== mode);
      }
    });
  }
});
