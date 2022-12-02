// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { SelectOptions } from 'components/select-options';
import { intersectionWith } from 'lodash';
import { action, computed, makeObservable, observable } from 'mobx';
import { observer } from 'mobx-react';
import * as React from 'react';
import { trans } from 'utils/lang';
import Modal from './modal';

const bn = 'report-form';
const maxLength = 2000;
const availableOptions = [
  { id: 'Cheating', text: trans('users.report.options.cheating') },
  { id: 'MultipleAccounts', text: trans('users.report.options.multiple_accounts') },
  { id: 'Insults', text: trans('users.report.options.insults') },
  { id: 'Spam', text: trans('users.report.options.spam') },
  { id: 'UnwantedContent', text: trans('users.report.options.unwanted_content') },
  { id: 'Nonsense', text: trans('users.report.options.nonsense') },
  { id: 'Other', text: trans('users.report.options.other') },
];

interface Props {
  completed: boolean;
  disabled: boolean;
  onClose: () => void;
  onSubmit: ({ comments }: { comments: string }) => void;
  title: React.ReactNode;
  visibleOptions?: string[];
}

interface ReportOption {
  id: string;
  text: string;
}

@observer
export class ReportForm extends React.Component<Props> {
  @observable private comments = '';
  @observable private selectedReason = this.options[0];

  @computed
  private get options() {
    if (this.props.visibleOptions == null) {
      return availableOptions;
    }

    return intersectionWith(availableOptions, this.props.visibleOptions, (left, right) => left.id === right);
  }

  constructor(props: Props) {
    super(props);

    makeObservable(this);
  }

  render() {
    const title = this.props.completed ? trans('users.report.thanks') : this.props.title;

    return (
      <Modal onClose={this.props.onClose}>
        <div className={bn}>
          <div className={`${bn}__header`}>
            <div className={`${bn}__row ${bn}__row--exclamation`}>
              <i className='fas fa-exclamation-triangle' />
            </div>

            <div className={`${bn}__row ${bn}__row--title`}>
              <span>
                {title}
              </span>
            </div>
          </div>

          {!this.props.completed && this.renderFormContent()}
        </div>
      </Modal>
    );
  }

  @action
  private readonly handleCommentsChange = (e: React.ChangeEvent<HTMLTextAreaElement>) => {
    this.comments = e.target.value;
  };

  @action
  private readonly handleReasonChange = (option: ReportOption) => {
    this.selectedReason = option;
  };

  private renderFormContent() {
    return (
      <div>
        {this.options.length !== 0 && (
          <>
            <div className={`${bn}__row`}>
              {trans('users.report.reason')}
            </div>
            <div className={`${bn}__row`}>
              <SelectOptions
                blackout={false}
                bn={`${bn}-select-options`}
                onChange={this.handleReasonChange}
                options={this.options}
                selected={this.selectedReason}
              />
            </div>
          </>
        )}
        <div className={`${bn}__row`}>
          {trans('users.report.comments')}
        </div>
        <div className={`${bn}__row`}>
          <textarea
            className={`${bn}__textarea`}
            maxLength={maxLength}
            onChange={this.handleCommentsChange}
            placeholder={trans('users.report.placeholder')}
            value={this.comments}
          />
        </div>
        <div className={`${bn}__row ${bn}__row--buttons`}>
          <button
            className={`${bn}__button ${bn}__button--report`}
            disabled={this.props.disabled || this.comments.length === 0}
            onClick={this.sendReport}
            type='button'
          >
            {trans('users.report.actions.send')}
          </button>
          <button
            className={`${bn}__button`}
            disabled={this.props.disabled}
            onClick={this.props.onClose}
            type='button'
          >
            {trans('users.report.actions.cancel')}
          </button>
        </div>
      </div>
    );
  }

  @action
  private readonly sendReport = () => {
    const data = {
      comments: this.comments,
      reason: this.selectedReason.id,
    };

    this.props.onSubmit(data);
  };
}
