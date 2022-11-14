// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { Modal } from 'components/modal';
import { SelectOptions } from 'components/select-options';
import { intersectionWith } from 'lodash';
import { action, makeObservable, observable } from 'mobx';
import { observer } from 'mobx-react';
import * as React from 'react';

const bn = 'report-form';
const maxLength = 2000;
const availableOptions = [
  { id: 'Cheating', text: osu.trans('users.report.options.cheating') },
  { id: 'MultipleAccounts', text: osu.trans('users.report.options.multiple_accounts') },
  { id: 'Insults', text: osu.trans('users.report.options.insults') },
  { id: 'Spam', text: osu.trans('users.report.options.spam') },
  { id: 'UnwantedContent', text: osu.trans('users.report.options.unwanted_content') },
  { id: 'Nonsense', text: osu.trans('users.report.options.nonsense') },
  { id: 'Other', text: osu.trans('users.report.options.other') },
];

interface Props {
  completed: boolean;
  disabled: boolean;
  onClose: () => void;
  onSubmit: ({ comments }: { comments: string }) => void;
  title: React.ReactNode;
  visible: boolean;
  visibleOptions: string[];
}

interface ReportOption {
  id: string;
  text: string;
}

@observer
export class ReportForm extends React.Component<Props> {
  static readonly defaultProps = {
    visibleOptions: availableOptions.map((option) => option.id),
  };

  @observable private comments = '';
  private readonly options = intersectionWith(availableOptions, this.props.visibleOptions, (left, right) => left.id === right);
  @observable private selectedReason = this.options[0];

  constructor(props: Props) {
    super(props);

    makeObservable(this);
  }

  render() {
    return this.props.visible ? this.renderForm() : null;
  }

  @action
  private readonly handleCommentsChange = (e: React.ChangeEvent<HTMLTextAreaElement>) => {
    this.comments = e.target.value;
  };

  @action
  private readonly handleReasonChange = (option: ReportOption) => {
    this.selectedReason = option;
  };

  private renderForm() {
    const title = this.props.completed ? osu.trans('users.report.thanks') : this.props.title;

    return (
      <Modal onClose={this.props.onClose} visible={this.props.visible}>
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

          {this.renderFormContent()}
        </div>
      </Modal>
    );
  }

  private renderFormContent() {
    return (
      <div>
        {this.options.length !== 0 && (
          <>
            <div className={`${bn}__row`}>
              {osu.trans('users.report.reason')}
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
          {osu.trans('users.report.comments')}
        </div>
        <div className={`${bn}__row`}>
          <textarea
            className={`${bn}__textarea`}
            maxLength={maxLength}
            onChange={this.handleCommentsChange}
            placeholder={osu.trans('users.report.placeholder')}
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
            {osu.trans('users.report.actions.send')}
          </button>
          <button
            className={`${bn}__button`}
            disabled={this.props.disabled}
            onClick={this.props.onClose}
            type='button'
          >
            {osu.trans('users.report.actions.cancel')}
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
