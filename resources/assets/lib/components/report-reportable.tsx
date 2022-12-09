// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import * as React from 'react';
import { trans } from 'utils/lang';
import { ReportableType, reportableTypeToGroupKey, showReportForm } from './report-form';

type ReactButton = React.DetailedHTMLProps<React.ButtonHTMLAttributes<HTMLButtonElement>, HTMLButtonElement>;
type ReactButtonWithoutRef = Pick<ReactButton, Exclude<keyof ReactButton, 'ref'>>;

interface Props extends ReactButtonWithoutRef {
  icon: boolean;
  onFormOpen: () => void;
  reportableId: string;
  reportableType: ReportableType;
  user: { username: string };
}

export class ReportReportable extends React.PureComponent<Props> {
  static defaultProps = {
    icon: false,
    onFormOpen: () => { /** nothing */ },
  };

  render() {
    const { icon, onFormOpen, reportableId, reportableType, user, ...attribs } = this.props;
    const groupKey = reportableTypeToGroupKey[this.props.reportableType];
    const buttonText = trans(`report.${groupKey}.button`);

    return (
      <button onClick={this.onShowFormButtonClick} type='button' {...attribs}>
        {
          icon ? (
            <span className='textual-button textual-button--inline'>
              <i className='textual-button__icon fas fa-exclamation-triangle' />
              {' '}
              {buttonText}
            </span>
          ) : buttonText
        }
      </button>
    );
  }

  private onShowFormButtonClick = (e: React.MouseEvent<HTMLElement>) => {
    if (e.button !== 0) return;

    this.props.onFormOpen();
    showReportForm({
      reportableId: this.props.reportableId,
      reportableType: this.props.reportableType,
      username: this.props.user.username,
    });
  };
}
