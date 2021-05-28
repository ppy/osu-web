// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { computed } from 'mobx';
import core from 'osu-core-singleton';

export default class VirtualListMeta {
  get cardHeight() {
    if (core.windowSize.isDesktop) {
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
    return core.windowSize.isDesktop ? 2 : 1;
  }
}
