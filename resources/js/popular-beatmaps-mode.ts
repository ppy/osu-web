// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

document.addEventListener('turbo:load', () => {
  for (const container of document.querySelectorAll<HTMLElement>('.js-popular-beatmaps')) {
    container.addEventListener('click', (event) => {
      const selectedButton = (event.target as Element).closest<HTMLButtonElement>('.js-popular-beatmaps-mode');
      if (selectedButton == null) {
        return;
      }

      const mode = selectedButton.dataset.popularMode;

      for (const button of container.querySelectorAll<HTMLButtonElement>('.js-popular-beatmaps-mode')) {
        button.classList.toggle('game-mode-link--active', button.dataset.popularMode === mode);
      }

      for (const panel of container.querySelectorAll<HTMLElement>('.js-popular-beatmaps-panel')) {
        panel.classList.toggle('u-hidden', panel.dataset.popularPanel !== mode);
      }
    });
  }
});
