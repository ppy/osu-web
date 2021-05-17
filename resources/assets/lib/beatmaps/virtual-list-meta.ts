// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { computed, observable } from 'mobx';

export default class VirtualListMeta {
  @computed
  get itemHeight() {
    return this.itemHeightByColumns.get(this.numberOfColumns) ?? 0;
  }

  @computed
  get numberOfColumns() {
    return this.isDesktop ? 2 : 1;
  }

  private eventId = `virtual-list-meta-osu.${osu.uuid()}`;
  @observable private isDesktop = true;
  private itemHeightByColumns = new Map<number, number>([
    [1, 125],
    [2, 110],
  ]);

  constructor() {
    this.checkIsDesktop();
    $(window).on(`resize.${this.eventId}`, this.checkIsDesktop);
  }

  destroy() {
    $(window).off(`.${this.eventId}`);
  }

  private checkIsDesktop = () => {
    this.isDesktop = osu.isDesktop();
  };
}
