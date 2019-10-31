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

import { route } from 'laroute';
import { Dictionary } from 'lodash';
import * as React from 'react';
import { ReportForm } from 'report-form';

interface Props {
  baseKey?: string;
  icon: boolean;
  onFormClose: () => void;
  reportableId: string;
  reportableType: string;
  user: User;
}

interface ReportData {
  comments: string;
  reason?: string;
}

interface State {
  completed: boolean;
  disabled: boolean;
  showingForm: boolean;
}

const availableOptions: Dictionary<string[]> = {
  beatmapset_discussion_post: ['Insults', 'Spam', 'UnwantedContent', 'Nonsense', 'Other'],
  comment: ['Insults', 'Spam', 'UnwantedContent', 'Nonsense', 'Other'],
  scores: ['Cheating', 'Other'],
};

export class ReportReportable extends React.PureComponent<Props & React.DetailedHTMLProps<React.ButtonHTMLAttributes<HTMLButtonElement>, HTMLButtonElement>, State> {
  static defaultProps = {
    icon: false,
    onFormClose: () => { /** nothing */ },
  };

  private timeout?: number;

  constructor(props: Props & React.DetailedHTMLProps<React.ButtonHTMLAttributes<HTMLButtonElement>, HTMLButtonElement>) {
    super(props);

    this.state = {
      completed: false,
      disabled: false,
      showingForm: false,
    };
  }

  onFormClose = () => {
    this.setState({ disabled: false, showingForm: false }, this.props.onFormClose);
  }

  onSubmit = (report: ReportData) => {
    this.setState({ disabled: true });

    const data = {
      comments: report.comments,
      reason: report.reason,
      reportable_id: this.props.reportableId,
      reportable_type: this.props.reportableType,
    };

    const params = {
      data,
      dataType: 'json',
      type: 'POST',
      url: route('reports.store'),
    };

    $.ajax(params).done(() => {
      this.timeout = Timeout.set(1000, this.onFormClose);
      this.setState({ completed: true });
    }).fail((xhr) => {
      osu.ajaxError(xhr);
      this.setState({ disabled : false });
    });
  }

  render(): React.ReactNode {
    const { baseKey, icon, onFormClose, reportableId, reportableType, user, ...attribs } = this.props;
    const groupKey = baseKey || this.props.reportableType;

    return (
      <>
        <button key='button' onClick={this.showForm} {...attribs}>
          {
            icon ? (
              <span className='textual-button textual-button--inline'>
                <i className='textual-button__icon fas fa-exclamation-triangle' />
                {' '}
                {osu.trans(`report.${groupKey}.button`)}
              </span>
            ) : osu.trans(`report.${groupKey}.button`)
          }
        </button>
        <ReportForm
          completed={this.state.completed}
          disabled={this.state.disabled}
          onClose={this.onFormClose}
          onSubmit={this.onSubmit}
          title={osu.trans(`report.${groupKey}.title`, { username: `<strong>${user.username}</strong>` })}
          visible={this.state.showingForm}
          visibleOptions={availableOptions[groupKey]}
        />
      </>
    );
  }

  showForm = (e: React.MouseEvent<HTMLElement>) => {
    if (e.button !== 0) { return; }
    e.preventDefault();

    Timeout.clear(this.timeout);
    this.setState({ disabled: false, showingForm: true });
  }
}
