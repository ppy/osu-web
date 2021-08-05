// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

export default class ReferenceLinkTooltip {
  constructor() {
    $(document).on('mouseover', '.js-reference-link', this.showTitle);
  }

  createTooltip = (element: HTMLElement, content: HTMLElement) => {
    $(element).qtip({
      content: {
        text: content,
      },
      hide: {
        delay: 200,
        effect: $(content).fadeTo(110, 0),
        fixed: true,
      },
      position: {
        at: 'top center',
        my: 'bottom center',
        viewport: $(window),
      },
      show: {
        delay: 200,
        effect: $(content).fadeTo(110, 1),
        ready: true,
      },
      style: {
        classes: 'tooltip-default tooltip-default--interactable',
      },
    });
  };

  showTitle = (event: JQueryEventObject) => {
    if (!(event.currentTarget instanceof HTMLAnchorElement)) return;

    const el = event.currentTarget;
    const target = el.dataset.target;

    if (target == null) return;

    const elTarget = document.querySelector(target.replace(':', '\\:')); // querySelector not working if ID contains colon

    if (!(elTarget?.firstElementChild instanceof HTMLDivElement)) return;

    const tooltipContent = $(elTarget.firstElementChild).clone()[0];
    const backRefLink = tooltipContent.querySelector('[data-backref="true"]');

    if (backRefLink instanceof HTMLAnchorElement) {
      tooltipContent.removeChild(backRefLink);
    }

    this.createTooltip(el, tooltipContent);
  };
}
