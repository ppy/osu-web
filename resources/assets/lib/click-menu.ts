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

import Fade from 'fade';

export default class ClickMenu {
  private current: string | null | undefined = null;

  constructor() {
    $(document).on('click', '.js-click-menu', this.toggle);
    $(document).on('click', this.hide);
    document.addEventListener('turbolinks:load', this.restoreSaved);
    document.addEventListener('turbolinks:before-cache', this.saveCurrent);
  }

  closestMenuId(child: Element | null | undefined) {
    if (child != null) {
      return $(child).parents('[data-click-menu-id]').attr('data-click-menu-id');
    }
  }

  hide = (e: JQuery.ClickEvent) => {
    if (e.button !== 0) return;
    if (osu.popupShowing()) return;
    if (this.current == null) return;
    if ($(e.target).closest('.js-click-menu').length > 0) return;

    this.show();
  }

  menuLink(id: string | null | undefined) {
    return document.querySelector(`.js-click-menu[data-click-menu-target${id == null ? '' : `='${id}'`}]`);
  }

  restoreSaved = () => {
    this.show(document.body.dataset.clickMenuCurrent);
  }

  saveCurrent = () => {
    document.body.dataset.clickMenuCurrent = this.current ?? undefined;
  }

  show = (target?: string | null | undefined) => {
    this.current = target;

    const tree = this.tree();
    const menus = Array.from(document.querySelectorAll('.js-click-menu[data-click-menu-id]'));
    let validCurrent = false;

    for (const menu of menus) {
      if (!(menu instanceof HTMLElement)) {
        continue;
      }

      const menuId = menu.dataset.clickMenuId;

      if (menuId == null || tree.indexOf(menuId) === -1) {
        Fade.out(menu);
        this.menuLink(menuId)?.classList.remove('js-click-menu--active');
        menu.classList.remove('js-click-menu--active');
      } else {
        Fade.in(menu);
        this.menuLink(menuId)?.classList.add('js-click-menu--active');
        menu.classList.add('js-click-menu--active');
        validCurrent = true;
      }
    }

    $.publish('click-menu:current', { target: this.current });

    if (!validCurrent) {
      this.current = null;
    }
  }

  toggle = (e: JQuery.ClickEvent) => {
    const menu = e.currentTarget;
    const tree = this.tree();

    // Events bubble up, and when clicking stuff inside menu that's not a menu,
    // this function will be called. When currentTarget is finally the closest
    // menu from the clicked item, this function should not do anything.
    if (this.current != null && tree.indexOf(menu.dataset.clickMenuId) !== -1) return;

    e.preventDefault();
    e.stopPropagation();

    const target = menu.dataset.clickMenuTarget;
    let next = target;

    if (target != null) {
      const index = tree.indexOf(target);

      if (index !== -1) {
        // toggling part of the menu tree, show parent of toggled menu
        next = tree[index + 1];
      }
    }

    this.show(next);
  }

  tree = (): string[] => {
    if (this.current == null) return [];

    let traverseId: string | null | undefined = this.current;
    const tree = [traverseId];

    while (true) {
      traverseId = this.closestMenuId(this.menuLink(traverseId));

      if (traverseId == null) {
        break;
      } else {
        tree.push(traverseId);
      }
    }

    return tree;
  }
}
