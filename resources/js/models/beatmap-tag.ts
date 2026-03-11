// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { RulesetId } from 'interfaces/ruleset';
import TagJson from 'interfaces/tag-json';

export default class BeatmapTag {
  categoryName: string;
  description: string;
  id: number;
  name: string;
  nameLowercase: string;

  /**
   * Specific rulesets for which this tag should be displayed.
   *
   * @remarks An empty array means that the tag is allowed for all rulesets.
   */
  rulesetIds: RulesetId[] = [];

  tagName: string;

  constructor(tag: TagJson) {
    this.description = tag.description;
    this.id = tag.id;
    this.name = tag.name;
    this.nameLowercase = tag.name.toLowerCase();

    if (tag.ruleset_id !== null) {
      this.rulesetIds.push(tag.ruleset_id);
    }

    const split = this.name.split('/');

    this.categoryName = split[0];
    this.tagName = split[1];
  }

  matchesName(match: string) {
    return this.nameLowercase.includes(match.toLowerCase());
  }

  toQuery() {
    return `tag="${this.name}"`;
  }
}
