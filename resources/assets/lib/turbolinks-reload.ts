// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

export default class TurbolinksReload {
  private loaded = new Set<string>();

  forget = (src: string) => {
    this.loaded.delete(src);
  };

  load(src: string) {
    if (this.loaded.has(src)) return;

    this.loaded.add(src);

    return $.ajax(src, { dataType: 'script' }) as JQuery.jqXHR<void>;
  }
}
