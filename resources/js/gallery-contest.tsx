// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import GalleryContestVoteButton from 'components/gallery-contest-vote-button';
import GalleryContestVoteProgress from 'components/gallery-contest-vote-progress';
import * as React from 'react';
import { render, unmountComponentAtNode } from 'react-dom';
import { nextVal } from 'utils/seq';

export default class GalleryContest {
  private eventId: string;
  private root: HTMLElement;

  constructor(container: HTMLElement, pswp: any) {
    this.root = container.querySelector('.js-pswp-buttons') as HTMLElement;

    render(
      (
        <>
          <GalleryContestVoteButton pswp={pswp} />
          <GalleryContestVoteProgress />
        </>
      ),
      this.root,
    );

    this.eventId = `gallery-contest-${nextVal()}`;

    $(document).on(`turbolinks:before-cache.${this.eventId}`, this.destroy);
    pswp.listen('destroy', this.destroy);
  }

  destroy = () => {
    unmountComponentAtNode(this.root);
    $(document).off(`.${this.eventId}`);
  };
}
