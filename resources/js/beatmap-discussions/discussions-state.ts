// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { makeObservable, observable } from 'mobx';
import { Mode } from './markdown-editor';

export default class DiscussionsState {
  @observable discussionCollapsed = new Map<number, boolean>();
  @observable discussionDefaultCollapsed = false;
  @observable editorMode = new Map<number, Mode>();
  @observable highlightedDiscussionId: number | null = null;
  // TODO: single discussion should have own state? Wasn't done before to make handling the collapse state simpler...
  @observable postEditing = new Set<number>();

  constructor() {
    makeObservable(this);
  }
}
