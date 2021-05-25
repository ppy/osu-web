// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { computed, observable } from 'mobx';
import core from 'osu-core-singleton';

export default class VirtualListMeta {
  get cardHeight() {
    if (this.isDesktop) {
      return core.userPreferences.get('beatmapset_card_size') === 'normal' ? 100 : 140;
    }

    return 120;
  }

  @computed
  get itemHeight() {
    // 10px margin
    return this.cardHeight + 10;
  }

  @computed
  get numberOfColumns() {
    return this.isDesktop ? 2 : 1;
  }

  @observable private isDesktop = true;

  constructor() {
    this.checkIsDesktop();
    $(window).on('resize', this.checkIsDesktop);
  }

  destroy() {
    $(window).off('resize', this.checkIsDesktop);
  }

  private checkIsDesktop = () => {
    this.isDesktop = osu.isDesktop();
  };
}
