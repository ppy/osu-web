// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import Fade from 'fade';
import osu from 'osu-common';

export default class ClickMenu {
  private current: string | null | undefined = null;
  private documentMouseEventTarget: unknown;

  constructor() {
    $(document).on('click', '.js-click-menu--close', this.close);
    $(document).on('click', '.js-click-menu[data-click-menu-target]', this.toggle);
    $(document).on('mousedown', this.onDocumentMousedown);
    $(document).on('mouseup', this.onDocumentMouseup);
    document.addEventListener('turbolinks:load', this.restoreSaved);
    document.addEventListener('turbolinks:before-cache', this.saveCurrent);
  }

  close = () => {
    this.show();
  };

  closestMenuId(child: Element | null | undefined) {
    if (child != null) {
      return $(child).parents('[data-click-menu-id]').attr('data-click-menu-id');
    }
  }

  menu(id: string | null | undefined) {
    return document.querySelector(`.js-click-menu[data-click-menu-id${id == null ? '' : `='${id}'`}]`);
  }

  menuLink(id: string | null | undefined) {
    return document.querySelector(`.js-click-menu[data-click-menu-target${id == null ? '' : `='${id}'`}]`);
  }

  restoreSaved = () => {
    this.show(document.body.dataset.clickMenuCurrent);
  };

  saveCurrent = () => {
    if (this.current == null) {
      delete document.body.dataset.clickMenuCurrent;
    } else {
      document.body.dataset.clickMenuCurrent = this.current;
    }
  };

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
  };

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
  };

  tree = (): string[] => {
    if (this.current == null) return [];

    let traverseId: string | null | undefined = this.current;
    const tree = [traverseId];

    for (; ;) {
      traverseId = this.closestMenuId(this.menuLink(traverseId));

      if (traverseId == null) {
        break;
      } else {
        tree.push(traverseId);
      }
    }

    return tree;
  };

  private onDocumentMousedown = (e: JQuery.MouseDownEvent) => {
    this.documentMouseEventTarget = e.button === 0 ? e.target : null;
  };

  private onDocumentMouseup = (e: JQuery.MouseUpEvent) => {
    if (this.documentMouseEventTarget !== e.target) return;
    if (e.button !== 0) return;
    if (osu.popupShowing()) return;
    if (this.current == null) return;
    if ($(e.target).closest('.js-click-menu').length > 0) return;

    this.show();
  };
}
