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

import * as React from 'react';
import { ReportForm } from 'report-form';

interface ReportCommentProps {
  comment: Comment;
  user: User;
}

interface ReportCommentState {
  completed: boolean;
  disabled: boolean;
  showingForm: boolean;
}

export class ReportComment extends React.PureComponent<ReportCommentProps, ReportCommentState> {
  private timeout?: number;

  constructor(props: ReportCommentProps) {
    super(props);

    this.state = {
      completed: false,
      disabled: false,
      showingForm: false,
    };
  }

  render(): React.ReactNode {
    const { user, comment, ...attribs } = this.props;
    return (
      <React.Fragment>
        <button key='button' onClick={this.showForm} {...attribs}>
          { osu.trans('report.comment.button') }
        </button>
        <ReportForm
          allowOptions={false}
          completed={this.state.completed}
          disabled={this.state.disabled}
          key='form'
          onClose={this.onFormClose}
          onSubmit={this.onSubmit}
          title={osu.trans('report.comment.title', { username: `<strong>${user.username}</strong>` })}
          visible={this.state.showingForm}
        >
        </ReportForm>
      </React.Fragment>
    );
  }

  onFormClose = () => {
    this.setState({ disabled: false, showingForm: false });
  }

  onSubmit = ({comments}: {comments: string}) => {
    this.setState({ disabled: true });
    const params = {
      data: { comments },
      dataType: 'json',
      type: 'POST',
      url: laroute.route('comments.report', { comment: this.props.comment.id }),
    };

    $.ajax(params).done(() => {
      this.timeout = Timeout.set(1000, this.onFormClose);
      this.setState({ completed: true });
    }).fail((xhr) => {
      osu.ajaxError(xhr);
      this.setState({ disabled : false });
    });
  }

  showForm = (e: React.MouseEvent<HTMLElement>) => {
    if (e.button !== 0) { return; }
    e.preventDefault();

    Timeout.clear(this.timeout);
    this.setState({ disabled: false, showingForm: true });
  }
}
