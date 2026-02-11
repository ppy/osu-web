// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { observable } from 'mobx';
import Ruleset, { rulesetIdToName } from '../interfaces/ruleset';
import TagJson from '../interfaces/tag-json';

export default class BeatmapTag {
  @observable description: string;
  @observable fullName: string;
  @observable group: string;
  @observable id: number;
  @observable name: string;
  @observable ruleset: Ruleset|null;

  constructor(tag: TagJson) {
    this.description = tag.description;
    this.id = tag.id;
    this.fullName = tag.name;
    this.ruleset = tag.ruleset_id !== null ? rulesetIdToName[tag.ruleset_id] : null;

    const split = this.fullName.split('/');

    this.group = split[0];
    this.name = split[1];
  }
}
