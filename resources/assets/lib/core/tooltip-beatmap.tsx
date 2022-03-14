// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { template } from 'lodash';

interface HTMLElementWithTooltip extends HTMLElement {
  _tooltip?: boolean;
}

const tmpl = template(`
<div class="tooltip-beatmap">
  <div class="tooltip-beatmap__text tooltip-beatmap__text--title"><%- beatmapTitle %></div>
  <div class="tooltip-beatmap__text" style="--diff: var(--diff-<%- difficulty %>)">
    <%- stars %> <i class="fas fa-star" aria-hidden="true"></i>
  </div>
</div>
`);

function my(at: string) {
  switch (at) {
    case 'top center':
      return 'bottom center';
    case 'left center':
      return 'right center';
    case 'bottom center':
      return 'top center';
  }

  return 'left center';
}

function onMouseOver(event: JQuery.TriggeredEvent<unknown, unknown, HTMLElementWithTooltip, unknown>) {
  const el = event.currentTarget;

  if (el.dataset.beatmapTitle == null) return;

  const content = tmpl(el.dataset);

  if (el._tooltip) {
    $(el).qtip('set', { 'content.text': content });
    return;
  }

  const at = el.dataset.tooltipPosition ?? 'top center';

  const options = {
    content,
    hide: event.type === 'touchstart' ? {
      event: 'unfocus',
      inactive: 3000,
    } : {
      event: 'click mouseleave',
    },
    overwrite: false,
    position: {
      at,
      my: my(at),
      viewport: $(window),
    },
    show: {
      event: event.type,
      ready: true,
    },
    style: {
      classes: 'qtip qtip--tooltip-beatmap',
      tip: {
        height: 9,
        width: 10,
      },
    },
  };

  $(el).qtip(options, event);

  el._tooltip = true;
}

export default class TooltipBeatmap {
  constructor() {
    $(document).on('mouseover touchstart', '.js-beatmap-tooltip', onMouseOver);
  }
}
