// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { hideLoadingOverlay } from 'utils/loading-overlay';

export default class ForumTopicTagEditor {
  constructor() {
    $(document).on('ajax:send', '.js-forum-tag-editor-ajax', this.onSend);
    $(document).on('ajax:error', '.js-forum-tag-editor-ajax', this.onError);
    $(document).on('ajax:success', '.js-forum-tag-editor-ajax', this.onSuccess);
  }

  private onError(this: void, e: Event) {
    const target = e.target as HTMLButtonElement;

    target.classList.remove('js-forum-topic-ajax-tag-editor--loading');
    target.disabled = false;
  }

  private onSend(this: void, e: Event){
    const target = e.target as HTMLButtonElement;

    hideLoadingOverlay();

    target.classList.add('js-forum-topic-tag-editor-ajax--loading');
    target.disabled = true;
  }

  private onSuccess(this: void, e: Event) {
    const target = e.target as HTMLButtonElement;

    target.classList.remove('js-forum-topic-tag-editor-ajax--loading');
    target.disabled = false;

    const checkbox = target.querySelector('input[type="checkbox"]') as HTMLInputElement;
    checkbox.checked = !checkbox.checked;
  }
}
