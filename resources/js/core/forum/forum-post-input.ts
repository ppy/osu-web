// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { currentUrl } from 'utils/turbolinks';

export function getInputFromElement(element: unknown) {
  if (!(element instanceof HTMLElement)) return;

  const post = element.closest('.js-forum-post') ?? element.closest('form');

  if (!(post instanceof HTMLElement)) return;

  const input = post.querySelector('[name=body]');

  if (input instanceof HTMLTextAreaElement) {
    return input;
  }
}

export default class ForumPostInput {
  constructor() {
    $(document)
      .on('input change', '.js-forum-post-input', this.onInput)
      .on('turbolinks:load', this.handlePageLoad)
      .on('ajax:success', '.js-forum-post-input--form', this.handlePostSaved);
    $.subscribe('forum-post-input:restore', this.handleRestore);
    $.subscribe('forum-post-input:clear', this.handleClear);
  }

  private clearInput(input: HTMLTextAreaElement | undefined) {
    if (input == null) return;

    const key = this.getKeyFromInput(input);
    if (key == null) return;

    localStorage.removeItem(key);
  }

  private getKeyFromInput(input: HTMLTextAreaElement) {
    return this.prefixKey(input.dataset.forumPostInputId);
  }

  private handleClear = (e: unknown, element: unknown) => {
    this.clearInput(getInputFromElement(element));
  };

  private handlePageLoad = () => {
    for (const element of document.querySelectorAll('.js-forum-post-input')) {
      this.handleRestore(null, element);
    }
  };

  private handlePostSaved = (e: JQuery.TriggeredEvent) => {
    this.clearInput(getInputFromElement(e.target));
  };

  private handleRestore = (e: unknown, element: unknown) => {
    const input = getInputFromElement(element);
    if (input == null) return;

    const key = this.getKeyFromInput(input);
    if (key == null) return;

    const fromStorage = localStorage.getItem(key);
    if (fromStorage != null) {
      input.value = fromStorage;
    }

    // try migrating from old storage system for reply boxes
    if (key.startsWith('forum-post-input:topic:')) {
      const legacyKey = `forum-topic-reply--${currentUrl().pathname}--text`;

      const fromLegacyStorage = localStorage.getItem(legacyKey);

      if (fromLegacyStorage != null) {
        localStorage.removeItem(legacyKey);
        localStorage.setItem(key, fromLegacyStorage);
        input.value = fromLegacyStorage;
      }
    }
  };

  private onInput = (e: JQuery.ChangeEvent) => {
    const input: unknown = e.currentTarget;
    if (!(input instanceof HTMLTextAreaElement)) return;

    const key = this.getKeyFromInput(input);
    if (key == null) return;

    const value = input.value;

    if (value === '') {
      localStorage.removeItem(key);
    } else {
      localStorage.setItem(key, input.value);
    }
  };

  private prefixKey(inputId: string | undefined) {
    if (inputId != null && inputId !== '') {
      return `forum-post-input:${inputId}`;
    }
  }
}
