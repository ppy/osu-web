// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { debounce, isEmpty } from 'lodash';
import { route } from '../../laroute';
import { onError } from '../../utils/ajax';

type Event = JQuery.TriggeredEvent<unknown, unknown, HTMLElement, unknown>;

export default class ForumTopicTagEditor {
  private readonly debouncedUpdate;

  private xhr?: JQuery.jqXHR;

  constructor() {
    this.debouncedUpdate = debounce(this.update, 1000);

    $(document).on('click', '.js-forum-topic-tag-editor-tag', this.onClick);
  }

  private readonly getChangedTags = (container: HTMLElement): { [key: string]: boolean } => {
    const data: { [key: string]: boolean } = {};
    const elements = container.querySelectorAll<HTMLElement>('.js-forum-topic-tag-editor-tag[data-changed="true"]');

    for (const element of elements) {
      const checkbox: HTMLInputElement | null = element.querySelector('input[type="checkbox"]');
      const issueTag = element.dataset.issueTag;

      if (issueTag === null || issueTag === undefined) {
        continue;
      }

      if (!checkbox) {
        continue;
      }

      data[issueTag] = checkbox.checked;
    }

    return data;
  };

  private readonly onClick = (e: Event) => {
    this.xhr?.abort();

    const target = e.currentTarget;
    const editor: HTMLElement | null = target.closest('.js-forum-topic-tag-editor');

    if (editor == null) {
      throw new Error('could not find editor element');
    }

    this.setLoading();

    const tagToApply = target.dataset.issueTag;

    if (tagToApply === null || tagToApply === undefined) {
      return;
    }

    const checkbox = target.querySelector('input[type="checkbox"]') as HTMLInputElement;

    // set the checkbox state on both desktop and mobile copies of the editor element
    $(`.js-forum-topic-tag-editor-tag[data-issue-tag="${tagToApply}"] input[type="checkbox"]`)
      .prop('checked', !checkbox.checked);

    // mark tag as changed in order not to send all unchanged tags with every request
    target.dataset.changed = 'true';

    this.debouncedUpdate(editor);
  };

  private readonly setComplete = () => {
    $('.js-forum-topic-tag-editor-button').html('<i class="fa fa-tag"></i>');
    $('.js-forum-topic-tag-editor-tag').removeProp('data-changed');
  };

  private readonly setLoading = () => {
    $('.js-forum-topic-tag-editor-button').html('<div class="la-ball-clip-rotate"></div>');
  };

  private readonly update = (editor: HTMLElement) => {
    const changedTags = this.getChangedTags(editor);

    if (isEmpty(changedTags)) {
      this.setComplete();
      return;
    }

    if (!('topicId' in editor.dataset)) {
      throw new Error('missing dataset-topic-id property on editor');
    }

    this.xhr = $.post(route('forum.topics.issue-tag', {
      tags: changedTags,
      topic: editor.dataset.topicId,
    }));

    this.xhr.catch(onError)
      .done(this.setComplete);
  };
}
