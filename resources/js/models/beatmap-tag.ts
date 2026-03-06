// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { RulesetId } from 'interfaces/ruleset';
import TagJson from 'interfaces/tag-json';

export default class BeatmapTag {
  description: string;
  fullName: string;
  fullNameLowercase: string;
  group: string;
  id: number;
  name: string;

  /**
   * Specific rulesets for which this tag should be displayed.
   *
   * @remarks An empty array means that the tag is allowed for all rulesets.
   */
  rulesetIds: RulesetId[] = [];

  constructor(tag: TagJson) {
    this.description = tag.description;
    this.id = tag.id;
    this.fullName = tag.name;
    this.fullNameLowercase = tag.name.toLowerCase();

    if (tag.ruleset_id !== null) {
      this.rulesetIds.push(tag.ruleset_id);
    }

    const split = this.fullName.split('/');

    this.group = split[0];
    this.name = split[1];
  }

  matchesFullName(match: string) {
    return this.fullNameLowercase.includes(match.toLowerCase());
  }

  tagString() {
    return `tag="${this.fullName}"`;
  }
}
