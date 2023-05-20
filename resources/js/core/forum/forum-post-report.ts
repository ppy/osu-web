// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { showReportForm } from 'components/report-form';

export default class ForumPostReport {
  constructor() {
    $(document).on('click', '.js-forum-post-report', this.onClickReportButton);
  }

  private onClickReportButton = (e: JQuery.ClickEvent<Document>) => {
    if (e.button !== 0) return;

    const post = e.currentTarget.closest('.js-forum-post');

    if (post == null) return;

    const postId = post.dataset.postId;
    const username = post.dataset.postUsername;

    if (postId == null || username == null) {
      return;
    }

    showReportForm({
      reportableId: postId,
      reportableType: 'forum_post',
      username,
    });
  };
}
