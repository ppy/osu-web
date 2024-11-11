// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { route } from 'laroute';
import { trans, transChoice } from 'utils/lang';
import { popup } from 'utils/popup';
import { reloadPage } from 'utils/turbolinks';

const checkboxSelector = '.js-user-cover-preset-batch-enable--checkbox';

export default class UserCoverPresetBatchActivate {
  private lastSelected: HTMLInputElement | null = null;
  private xhr: JQuery.jqXHR<void> | null = null;

  constructor() {
    $(document)
      .on('click', '.js-user-cover-preset-batch-enable', this.handleEvent)
      .on('turbo:before-cache', this.cleanup);
  }

  private applySelected(active: boolean) {
    const ids = [...this.checkboxes()]
      .filter((el) => el.checked)
      .map((el) => el.dataset.id);
    const count = ids.length;

    if (count === 0) {
      popup('no covers selected');
      return;
    }

    if (!confirm(trans('user_cover_presets.index.batch_confirm._', {
      action: trans(`user_cover_presets.index.batch_confirm.${active ? 'enable' : 'disable'}`),
      items: transChoice('user_cover_presets.index.batch_confirm.items', count),
    }))) {
      return;
    }

    this.xhr = $.post(route('user-cover-presets.batch-activate'), { active, ids });
    this.xhr
      .done(() => {
        reloadPage();
      })
      .fail((xhr, status) => {
        if (status !== 'abort') {
          popup('Update failed', 'danger');
        }
      });
  }

  private checkboxes() {
    return document.querySelectorAll<HTMLInputElement>(checkboxSelector);
  }

  private readonly cleanup = () => {
    this.lastSelected = null;
    this.xhr?.abort();
    this.xhr = null;
  };

  private readonly handleEvent = (e: JQuery.ClickEvent<Document, unknown, HTMLElement, HTMLElement>) => {
    const target = e.currentTarget;

    switch (target.dataset.action) {
      case 'disable-selected': return this.applySelected(false);
      case 'enable-selected': return this.applySelected(true);
      case 'select': return this.select(target, e);
      case 'select-all': return this.toggleAll(target as HTMLInputElement);
    }
  };

  private readonly select = (target: HTMLElement, e: JQuery.ClickEvent) => {
    const checkbox = target.querySelector(checkboxSelector);
    if (checkbox instanceof HTMLInputElement) {
      if ((e.originalEvent?.shiftKey ?? false) && this.lastSelected != null) {
        const checked = this.lastSelected.checked;
        let started = false;
        for (const el of this.checkboxes()) {
          if (el === checkbox) {
            el.checked = checked;
          }
          if (el === this.lastSelected || el === checkbox) {
            if (started) {
              break;
            } else {
              started = true;
            }
            continue;
          }
          if (started) {
            el.checked = checked;
          }
        }
      }
      this.lastSelected = checkbox;
    }
    this.syncToggleState();
  };

  private selectAllCheckbox() {
    const ret = document.querySelector('.js-user-cover-preset-batch-enable--select-all');
    if (!(ret instanceof HTMLInputElement)) {
      throw new Error('select all checkbox element is not HTMLInputElement');
    }

    return ret;
  }

  private syncToggleState() {
    const selectAllCheckbox = this.selectAllCheckbox();
    let state: boolean | null = null;
    for (const el of this.checkboxes()) {
      if (state == null) {
        selectAllCheckbox.checked = state = el.checked;
        selectAllCheckbox.dataset.indeterminate = 'false';
      } else {
        if (state !== el.checked) {
          selectAllCheckbox.dataset.indeterminate = 'true';
          break;
        }
      }
    }
  }

  private readonly toggleAll = (target: HTMLInputElement) => {
    const checked = target.checked;
    for (const el of this.checkboxes()) {
      el.checked = checked;
    }
    target.dataset.indeterminate = 'false';
  };
}
