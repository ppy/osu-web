// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { last } from 'lodash';
import core from 'osu-core-singleton';
import { blackoutToggle } from 'utils/blackout';
import { htmlElementOrNull } from 'utils/html';
import { isModalShowing } from 'utils/modal-helper';

const menuActiveClass = 'js-click-menu--active';
const menuButtonSelector = '.js-mobile-menu--button';
const menuElementSelector = '.js-mobile-menu';
const menuRootElementSelector = '.js-mobile-menu--root';
const navActiveClass = 'js-nav2--active';

function closestMenuId(child: Element | null | undefined) {
  return child != null
    ? $(child).parents(menuElementSelector).attr('data-mobile-menu')
    : undefined;
}

function menuElement(id: string) {
  return htmlElementOrNull(document.querySelector(`${menuElementSelector}[data-mobile-menu=${id}]`));
}

export default class MobileMenu {
  private current?: string | null = null;
  private documentMouseEventTarget: unknown;

  constructor() {
    window.addEventListener('resize', this.handleResize);
    $(document).on('click', '.js-click-menu--close', this.handleCloseClick);
    $(document).on('click', menuButtonSelector, this.handleMenuButtonClick);
    $(document).on('mousedown', this.handleDocumentMousedown);
    $(document).on('mouseup', this.handleDocumentMouseup);
    document.addEventListener('turbo:load', this.restoreSaved);
    document.addEventListener('turbo:before-cache', this.saveCurrent);
  }

  toggle(target?: string | null) {
    const actualTarget = (target != null ? menuElement(target)?.dataset.mobileMenuDefault : null) ?? target;
    const rootOfCurrent = this.current != null && target != null ? last(this.tree(this.current)) : null;

    const tree = new Set(this.tree(actualTarget));
    // root level always switches or toggles.
    if ((tree.size === 1 && this.current === actualTarget) || rootOfCurrent === target) {
      tree.clear();
    } else if (tree.size > 1 && this.current === actualTarget) {
      if (rootOfCurrent != null) {
        // Activate the default submenu of the root level. Current logic assumes there aren't more than 2 levels.
        const next = menuElement(rootOfCurrent)?.dataset.mobileMenuDefault;
        if (next != null && this.current !== next) {
          this.toggle(next);
          return;
        }
      }
    }

    const allMenuButtons = document.querySelectorAll<HTMLElement>(menuButtonSelector);
    for (const element of allMenuButtons) {
      if (element.dataset.mobileMenu == null) continue;
      element.classList.toggle(menuActiveClass, tree.has(element.dataset.mobileMenu));
    }

    const allMenus = document.querySelectorAll<HTMLElement>(menuElementSelector);
    for (const element of allMenus) {
      if (element.dataset.mobileMenu == null) continue;
      element.classList.toggle(menuActiveClass, tree.has(element.dataset.mobileMenu));
    }

    this.current = tree.size > 0 ? actualTarget : null;

    if (this.current == null) {
      blackoutToggle(this, false);
      $(menuRootElementSelector).finish().slideUp(150, () => {
        // use actual state instead of always removing the class in case
        // the menu is shown again right after it's closed
        document.body.classList.toggle(navActiveClass, this.current != null);
      });
    } else {
      blackoutToggle(this, true);
      document.body.classList.toggle(navActiveClass, true);
      window.setTimeout(() => {
        $(menuRootElementSelector).finish().slideDown(150);
      });
    }
  }

  tree(menuId?: string | null) {
    if (menuId == null) return [];

    const tree = [menuId];
    let traverseId: string | undefined = menuId;
    for (;;) {
      traverseId = closestMenuId(menuElement(traverseId));
      if (traverseId == null) {
        break;
      } else {
        tree.push(traverseId);
      }
    }

    return tree;
  }

  private readonly handleCloseClick = () => {
    this.toggle();
  };

  private readonly handleDocumentMousedown = (e: JQuery.MouseDownEvent<Document, unknown, Document, HTMLElement | Document>) => {
    this.documentMouseEventTarget = e.button === 0 ? e.target : null;
  };

  private readonly handleDocumentMouseup = (e: JQuery.MouseUpEvent<Document, unknown, Document, HTMLElement | Document>) => {
    if (this.documentMouseEventTarget !== e.target) return;
    if (e.button !== 0) return;
    if (isModalShowing()) return;
    if (this.current == null) return;
    if ($(e.target).closest([menuElementSelector, menuButtonSelector].join(',')).length > 0) return;

    this.toggle();
  };

  private readonly handleMenuButtonClick = (e: JQuery.ClickEvent<Document, unknown, HTMLElement, HTMLElement>) => {
    e.preventDefault();
    this.toggle(e.currentTarget.dataset.mobileMenu);
  };

  private readonly handleResize = () => {
    // just force close the menu to keep it simple.
    if (this.current == null || core.windowSize.isMobile) return;
    this.toggle();
  };

  private readonly restoreSaved = () => {
    const saved = document.body.dataset.mobileMenuCurrent;
    if (core.windowSize.isDesktop) {
      // clear any weird state caused by resizing windows.
      if (saved != null) {
        delete document.body.dataset.mobileMenuCurrent;
        blackoutToggle(this, false);
      }
      return;
    }
    this.toggle(saved);
  };

  private readonly saveCurrent = () => {
    if (this.current == null) {
      delete document.body.dataset.mobileMenuCurrent;
    } else {
      document.body.dataset.mobileMenuCurrent = this.current;
    }
  };
}
