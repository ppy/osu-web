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

import { createElement } from 'react';
import { render, unmountComponentAtNode } from 'react-dom';
import GalleryContestVoteButton from './gallery-contest-vote-button';

export default class GalleryContest {
  private eventId: string;
  private root: HTMLElement;

  constructor(container: HTMLElement, pswp: any) {
    this.root = container.querySelector('.js-pswp-buttons') as HTMLElement;
    render(createElement(GalleryContestVoteButton, {pswp}), this.root);
    this.eventId = `gallery-contest-${osu.uuid()}`;

    $(document).on(`turbolinks:before-cache.${this.eventId}`, this.destroy);
    pswp.listen('destroy', this.destroy);
  }

  destroy = () => {
    unmountComponentAtNode(this.root);
    $(document).off(`.${this.eventId}`);
  }
}
