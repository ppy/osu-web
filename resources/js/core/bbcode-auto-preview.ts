// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { route } from 'laroute';
import { debounce } from 'lodash';
import { fail } from 'utils/fail';
import { htmlElementOrNull } from 'utils/html';

export default class BbcodeAutoPreview {
  private readonly debouncedLoadPreview;
  private readonly xhr = new Map<HTMLElement, JQuery.jqXHR<string>>();

  constructor() {
    this.debouncedLoadPreview = debounce(this.loadPreview, 500);
    document.addEventListener('input', this.onInput);
  }

  private readonly loadPreview = (target: HTMLTextAreaElement) => {
    const form = target.closest('form') ?? fail('form element is missing');
    const body = target.value;
    const preview = htmlElementOrNull(form.querySelector('.js-post-preview--preview'));
    const previewBox = form.querySelector('.js-post-preview--box');

    if (preview == null) {
      return;
    }

    this.xhr.get(preview)?.abort();

    if (body === '') {
      preview.dataset.raw = '';
      preview.innerHTML = '';
      previewBox?.classList.add('hidden');
      return;
    }

    if (preview.dataset.raw === body) {
      previewBox?.classList.remove('hidden');
      return;
    }

    const xhr = $.post(route('bbcode-preview'), { text: body }) as JQuery.jqXHR<string>;
    xhr.done((data) => {
      preview.dataset.raw = body;
      preview.innerHTML = data;
      previewBox?.classList.remove('hidden');
    }).always(() => {
      this.xhr.delete(preview);
    });
  };

  private readonly onInput = (e: InputEvent) => {
    const target = htmlElementOrNull(e.target)?.closest('.js-post-preview--auto');

    if (target instanceof HTMLTextAreaElement) {
      this.debouncedLoadPreview(target);
    }
  };
}
