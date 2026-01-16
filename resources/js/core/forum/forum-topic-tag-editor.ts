// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import TagEditorState from './forum-topic-tag-editor-state';

type ContainerEvent = JQuery.TriggeredEvent<unknown, unknown, TagEditorHTMLElement, unknown>;

interface TagEditorHTMLElement extends HTMLElement {
  state?: TagEditorState;
}

export default class ForumTopicTagEditor {
  constructor() {
    $(document).on('click', '.js-forum-topic-tag-editor-ajax', this.onClick);
  }

  private getState(e: ContainerEvent) {
    return e.currentTarget.state ??= new TagEditorState(e.currentTarget);
  }

  private readonly onClick = (e: ContainerEvent) => {
    this.getState(e).onClick();
  };
}
