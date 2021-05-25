// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

export default class TurbolinksReload {
  private loaded = new Set<string>();
  private loading = new Map<string, JQuery.jqXHR<void>>();

  constructor() {
    $(document).on('turbolinks:before-cache', this.abortLoading);
  }

  abortLoading = () => {
    for (const xhr of this.loading.values()) {
      xhr.abort();
    }
  };

  forget = (src: string) => {
    this.loaded.delete(src);
    this.loading.get(src)?.abort();
  };

  load(src: string) {
    if (this.loaded.has(src) || this.loading.has(src)) return;

    const xhr = $.ajax(src, { cache: true, dataType: 'script' }) as JQuery.jqXHR<void>;

    this.loading.set(src, xhr);

    void xhr
      .done(() => this.loaded.add(src))
      .always(() => this.loading.delete(src));

    return xhr;
  }
}
