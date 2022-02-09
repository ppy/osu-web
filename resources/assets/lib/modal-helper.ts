// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { Modal } from 'components/modal';

export function isModalShowing() {
  return Modal.isOpen() || $('#overlay').is(':visible') || document.body.classList.contains('modal-open');
}
