// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

document.addEventListener('turbo:load', () => {
  for (const container of document.querySelectorAll<HTMLElement>('[data-popular-beatmaps]')) {
    container.addEventListener('click', (event) => {
      const button = (event.target as Element).closest<HTMLButtonElement>('[data-popular-mode]');
      if (button == null) {
        return;
      }

      const mode = button.dataset.popularMode;

      for (const otherButton of container.querySelectorAll<HTMLButtonElement>('[data-popular-mode]')) {
        otherButton.classList.toggle('game-mode-link--active', otherButton.dataset.popularMode === mode);
      }

      for (const panel of container.querySelectorAll<HTMLElement>('[data-popular-panel]')) {
        panel.classList.toggle('u-hidden', panel.dataset.popularPanel !== mode);
      }
    });
  }
});
