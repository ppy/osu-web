// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

export default class LazyLoadImages {
  private readonly imageObserver = new IntersectionObserver((entries) => {
    for (const entry of entries) {
      if (!entry.isIntersecting) continue;

      const element = entry.target;
      if (element instanceof HTMLImageElement) {
        if (element.dataset.normal != null) {
          element.src = element.dataset.normal;
          delete element.dataset.normal;
        }
      }

      this.imageObserver.unobserve(element);
    }
  });

  private readonly mutationObserver = new MutationObserver((mutations) => {
    for (const mutation of mutations) {
      for (const node of mutation.addedNodes) {
        if (!(node instanceof HTMLElement)) continue;

        if (node instanceof HTMLImageElement && node.dataset.normal != null) {
          this.imageObserver.observe(node);
        }

        const images = node.querySelectorAll<HTMLImageElement>('img[data-normal]');
        images.forEach((image) => this.imageObserver.observe(image));
      }
    }
  });

  constructor() {
    this.mutationObserver.observe(document, { childList: true, subtree: true });
  }
}
