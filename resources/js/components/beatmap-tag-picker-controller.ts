// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { RulesetId } from 'interfaces/ruleset';
import BeatmapTag from 'models/beatmap-tag';

export default interface BeatmapTagPickerController {
  disableTag: (tag: BeatmapTag) => void;
  enableTag: (tag: BeatmapTag) => void;
  isTagEnabled: (tag: BeatmapTag) => boolean;
  query: string;
  rulesetId: RulesetId|undefined;
}
