// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

function fixLink(e: MouseEvent) {
  if (!(e.target instanceof Element)) {
    return;
  }
  const link = e.target.closest('a');
  if (!(link instanceof HTMLAnchorElement)) {
    return;
  }

  if (link.getAttribute('href')?.startsWith('./')) {
    link.setAttribute('href', link.href);
  }
}

export default class FixRelativeLink {
  constructor() {
    document.addEventListener('click', fixLink);
  }
}
