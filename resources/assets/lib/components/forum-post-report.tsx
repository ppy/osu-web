// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import * as React from 'react';
import { ReportReportable } from './report-reportable';

interface State {
  postId: string;
  username: string;
}

export default class ForumPostReport extends React.Component<Record<string, never>, State> {
  state = {
    postId: '',
    username: '',
  };

  private reportRef = React.createRef<ReportReportable>();

  componentDidMount() {
    $(document).on('click', '.js-forum-post-report', this.onClickReportButton);
  }

  componentWillUnmount() {
    $(document).off('click', '.js-forum-post-report', this.onClickReportButton);
  }

  render() {
    return (
      <ReportReportable
        // Manually set key to create new form when reporting for
        // different post.
        key={this.state.postId}
        ref={this.reportRef}
        reportableId={this.state.postId}
        reportableType='forum_post'
        user={{ username: this.state.username }}
      />
    );
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

    this.setState({ postId, username }, () => {
      if (this.reportRef.current != null) {
        this.reportRef.current.showForm();
      }
    });
  };
}
