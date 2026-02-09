// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { route } from 'laroute';
import { debounce } from 'lodash';
import { onError } from 'utils/ajax';

type Event = JQuery.TriggeredEvent<unknown, unknown, HTMLInputElement, unknown>;

export default class ForumTopicTagEditor {
  private readonly debouncedUpdate;

  private xhr?: JQuery.jqXHR;

  constructor() {
    this.debouncedUpdate = debounce(this.update, 1000);

    $(document).on('change', '.js-forum-topic-tag-editor-checkbox', this.onChange);
  }

  private getEnabledTags(container: HTMLElement) {
    return [...container.querySelectorAll<HTMLInputElement>('.js-forum-topic-tag-editor-checkbox')]
      .filter((input) => input.checked)
      .map((el) => el.name);
  }

  private readonly onChange = (e: Event) => {
    const target = e.currentTarget;
    const container = target.closest<HTMLElement>('.js-forum-topic-tag-editor');

    if (container == null) {
      throw new Error('missing container');
    }

    this.xhr?.abort();

    // set the checkbox state on both desktop and mobile copies of the editor element
    $(`.js-forum-topic-tag-editor-checkbox[name="${target.name}"]`)
      .prop('checked', target.checked);

    this.setLoading();
    this.debouncedUpdate(container);
  };

  private readonly setComplete = () => {
    $('.js-forum-topic-tag-editor-button').html('<i class="fa fa-tag"></i>');
  };

  private readonly setLoading = () => {
    $('.js-forum-topic-tag-editor-button').html('<div class="la-ball-clip-rotate"></div>');
  };

  private readonly update = (editor: HTMLElement) => {
    if (!('topicId' in editor.dataset)) {
      throw new Error('missing dataset-topic-id property on editor');
    }

    this.xhr = $.post(route('forum.topics.issue-tag', {
      tags: this.getEnabledTags(editor),
      topic: editor.dataset.topicId,
    }));

    this.xhr.done(this.setComplete)
      .fail(onError);
  };
}
