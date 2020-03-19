// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import TurbolinksReload from 'turbolinks-reload';

const src = '//platform.enchant.com';

interface WindowWithEnchant extends Window {
  enchant?: any;
}

export default class Enchant {
  constructor(private window: WindowWithEnchant, private turbolinksReload: TurbolinksReload) {
    $(document).on('turbolinks:load', this.load);
    $(document).on('turbolinks:before-cache', this.unload);
    $(document).on('click', '.js-enchant--show', this.showMessageWindow);
  }

  load = () => {
    const enchantIdElement = document.querySelector('.enchant-help-center');

    if (enchantIdElement == null) {
      return;
    }

    this.window.enchant = [];
    this.turbolinksReload.load(src);
  }

  showMessageWindow = (e: JQuery.ClickEvent) => {
    e.preventDefault();

    if (this.window.enchant != null && this.window.enchant.messenger != null && typeof this.window.enchant.messenger.open === 'function') {
      this.window.enchant.messenger.open();
    }
  }

  unload = () => {
    this.turbolinksReload.forget(src);
    $('#enchant-messenger-main, #enchant-messenger-launcher, iframe[src^="https://enchantwidgets-"]').remove();

    document.querySelectorAll('style').forEach((el) => {
      const text = el.textContent;

      if (text != null && text.match(/#enchant-/)) {
        $(el).remove();
      }
    });
  }
}
