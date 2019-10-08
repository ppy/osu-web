/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */

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
