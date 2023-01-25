// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import Highlight from 'docs/highlight';
import Search from 'docs/search';
import SetLanguage from 'docs/set-language';
import SidebarToggle from 'docs/sidebar-toggle';
import Tocify from 'docs/tocify';

declare global {
  interface Window {
    docs: Docs;
  }
}

class Docs {
  highlight = new Highlight();
  search;
  setLanguage = new SetLanguage();
  sidebarToggle = new SidebarToggle();
  tocify = new Tocify();

  constructor() {
    // depends on Tocify to be initialised
    this.search = new Search();
  }
}

document.addEventListener('DOMContentLoaded', () => {
  window.docs = new Docs();
});
