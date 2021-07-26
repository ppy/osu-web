// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { route } from 'laroute';
import { Dictionary } from 'lodash';
import * as osu from 'osu-common';
import * as React from 'react';
import { ReportForm } from 'report-form';

type ReactButton = React.DetailedHTMLProps<React.ButtonHTMLAttributes<HTMLButtonElement>, HTMLButtonElement>;
type ReactButtonWithoutRef = Pick<ReactButton, Exclude<keyof ReactButton, 'ref'>>;

interface Props extends ReactButtonWithoutRef {
  baseKey?: string;
  icon: boolean;
  onFormClose: () => void;
  reportableId: string;
  reportableType: string;
  user: { username: string };
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
  forum_post: ['Insults', 'Spam', 'UnwantedContent', 'Nonsense', 'Other'],
  scores: ['Cheating', 'MultipleAccounts', 'Other'],
};

export class ReportReportable extends React.PureComponent<Props, State> {
  static defaultProps = {
    icon: false,
    onFormClose: () => { /** nothing */ },
  };

  private timeout?: number;

  constructor(props: Props) {
    super(props);

    this.state = {
      completed: false,
      disabled: false,
      showingForm: false,
    };
  }

  onFormClose = () => {
    this.setState({ disabled: false, showingForm: false }, this.props.onFormClose);
  };

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
      this.timeout = window.setTimeout(this.onFormClose, 1000);
      this.setState({ completed: true });
    }).fail((xhr) => {
      osu.ajaxError(xhr);
      this.setState({ disabled: false });
    });
  };

  render(): React.ReactNode {
    const { baseKey, icon, onFormClose, reportableId, reportableType, user, ...attribs } = this.props;
    const groupKey = baseKey || this.props.reportableType;

    return (
      <>
        <button key='button' onClick={this.onShowFormButtonClick} {...attribs}>
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
        {this.state.showingForm && (
          <ReportForm
            completed={this.state.completed}
            disabled={this.state.disabled}
            onClose={this.onFormClose}
            onSubmit={this.onSubmit}
            title={osu.trans(`report.${groupKey}.title`, { username: `<strong>${user.username}</strong>` })}
            visible
            visibleOptions={availableOptions[groupKey]}
          />
        )}
      </>
    );
  }

  showForm = () => {
    window.clearTimeout(this.timeout);
    this.setState({ disabled: false, showingForm: true });
  };

  private onShowFormButtonClick = (e: React.MouseEvent<HTMLElement>) => {
    if (e.button !== 0) return;
    e.preventDefault();

    this.showForm();
  };
}
