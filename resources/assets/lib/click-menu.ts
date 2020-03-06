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
    $(document).on('click', '.js-click-menu--close', this.close);
    $(document).on('click', '.js-click-menu[data-click-menu-target]', this.toggle);
    $(document).on('click', this.hide);
    document.addEventListener('turbolinks:load', this.restoreSaved);
    document.addEventListener('turbolinks:before-cache', this.saveCurrent);
  }

  close = () => {
    this.show();
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

  menu(id: string | null | undefined) {
    return document.querySelector(`.js-click-menu[data-click-menu-id${id == null ? '' : `='${id}'`}]`);
  }

  menuLink(id: string | null | undefined) {
    return document.querySelector(`.js-click-menu[data-click-menu-target${id == null ? '' : `='${id}'`}]`);
  }

  restoreSaved = () => {
    this.show(document.body.dataset.clickMenuCurrent);
  }

  saveCurrent = () => {
    if (this.current == null) {
      delete document.body.dataset.clickMenuCurrent;
    } else {
      document.body.dataset.clickMenuCurrent = this.current;
    }
  }

  show = (target?: string | null | undefined) => {
    const previousTree = this.tree();

    this.current = target;

    const tree = this.tree();
    const menus = document.querySelectorAll('.js-click-menu[data-click-menu-id]');
    let shownMenu: HTMLElement | null = null;
    let validCurrent = false;

    for (const menu of menus) {
      if (!(menu instanceof HTMLElement)) {
        continue;
      }

      const menuId = menu.dataset.clickMenuId;

      if (menuId == null || tree.indexOf(menuId) === -1) {
        Fade.out(menu);
        menu.classList.remove('js-click-menu--active');
        this.menuLink(menuId)?.classList.remove('js-click-menu--active');
      } else {
        Fade.in(menu);
        menu.classList.add('js-click-menu--active');
        this.menuLink(menuId)?.classList.add('js-click-menu--active');
        validCurrent = true;

        if (menuId === this.current) {
          shownMenu = menu;
        }
      }
    }

    if (!validCurrent) {
      this.current = null;
    }

    $.publish('click-menu:current', { previousTree, target: this.current, tree });

    const toFocus = shownMenu?.querySelector('.js-click-menu--autofocus');

    if (toFocus instanceof HTMLElement) {
      toFocus.focus();
    }
  }

  toggle = (e: JQuery.ClickEvent) => {
    const menu = e.currentTarget;
    const tree = this.tree();

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
