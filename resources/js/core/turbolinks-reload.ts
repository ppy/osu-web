// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

export default class TurbolinksReload {
  private readonly loaded = new Set<string>();
  private readonly loading = new Map<string, [Promise<unknown>, () => void]>();

  constructor() {
    $(document).on('turbo:before-cache', this.abortLoading);
  }

  abortLoading = () => {
    for (const [, cleanupCallback] of this.loading.values()) {
      cleanupCallback();
    }
  };

  forget = (src: string) => {
    this.loaded.delete(src);
    this.loading.get(src)?.[1]?.();
  };

  load(src: string) {
    if (this.loaded.has(src) || this.loading.has(src)) {
      return this.loading.get(src)?.[0];
    }

    const script = document.createElement('script');
    const promise = new Promise((resolve, reject) => {
      script.addEventListener('load', resolve);
      script.addEventListener('error', reject);
      script.src = src;
      document.head.append(script);
    });

    const cleanupCallback = () => {
      script.remove();
    };
    this.loading.set(src, [promise, cleanupCallback]);

    promise
      .then(() => {
        this.loaded.add(src);
      })
      .finally(() => {
        this.loading.delete(src);
        cleanupCallback();
      });

    return promise;
  }
}
