// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

const className = 'js-link-main-host';
const searchQuery = `.${className}`;

export default class LinkMainHost {
  constructor() {
    $(document).on('click', searchQuery, this.handleClick);
  }

  private readonly handleClick = (e: JQuery.Event) => {
    e.preventDefault();
    window.location.host = 'osu.ppy.sh';
  };
}
