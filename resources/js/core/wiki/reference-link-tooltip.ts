// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { qtipPosition } from 'utils/qtip-helper';

export default class ReferenceLinkTooltip {
  constructor() {
    $(document).on('mouseover', '.js-reference-link', this.showTooltip);
  }

  private readonly createTooltip = (element: HTMLElement, content: HTMLElement) => {
    $(element).qtip({
      content: {
        text: content,
      },
      hide: {
        delay: 200,
        effect() {
          $(this).fadeTo(110, 0);
        },
        fixed: true,
      },
      position: qtipPosition('top center'),
      show: {
        delay: 200,
        effect() {
          $(this).fadeTo(110, 1);
        },
        ready: true,
      },
      style: {
        classes: 'tooltip-default tooltip-default--interactable',
      },
    });
  };

  private readonly showTooltip = (e: JQuery.MouseOverEvent) => {
    if (!(e.currentTarget instanceof HTMLAnchorElement)) return;

    const el = e.currentTarget;
    const targetId = el.getAttribute('href');

    if (targetId == null) return;

    const tooltipContent = document.querySelector(targetId)?.firstElementChild?.cloneNode(true);

    if (!(tooltipContent instanceof HTMLParagraphElement)) return;

    tooltipContent.querySelectorAll('*').forEach((node) => {
      if (node.getAttribute('role') === 'doc-backlink') {
        node.remove();
      } else {
        node.removeAttribute('class');
      }
    });
    // Remove extra non-breaking spaces between backlink elements
    for (let i = tooltipContent.childNodes.length - 1; i >= 0; i--) {
      const node = tooltipContent.childNodes[i];
      if (node.textContent === ' ') {
        node.remove();
      } else {
        break;
      }
    }

    this.createTooltip(el, tooltipContent);
  };
}
