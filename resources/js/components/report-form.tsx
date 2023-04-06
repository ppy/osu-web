// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import SelectOptions from 'components/select-options';
import { route } from 'laroute';
import { action, computed, makeObservable, observable } from 'mobx';
import { observer } from 'mobx-react';
import * as React from 'react';
import { render, unmountComponentAtNode } from 'react-dom';
import { onError } from 'utils/ajax';
import { trans } from 'utils/lang';
import Modal from './modal';
import StringWithComponent from './string-with-component';

const bn = 'report-form';
const maxLength = 2000;

export function showReportForm(params: { reportableId: string; reportableType: ReportableType; username: string }) {
  const root = document.createElement('div');

  render(<ReportForm
    reportableId={params.reportableId}
    reportableType={params.reportableType}
    root={root}
    username={params.username}
  />, root);
}

export const reportableTypeToGroupKey = {
  beatmapset: 'beatmapset',
  beatmapset_discussion_post: 'beatmapset_discussion_post',
  comment: 'comment',
  forum_post: 'forum_post',
  score_best_fruits: 'scores',
  score_best_mania: 'scores',
  score_best_osu: 'scores',
  score_best_taiko: 'scores',
  solo_score: 'scores',
  user: 'user',
} as const;
export type ReportableType = keyof typeof reportableTypeToGroupKey;
type GroupKey = typeof reportableTypeToGroupKey[ReportableType];

// intended to be in display order, not alphabetical order.
/* eslint-disable sort-keys */
const availableOptions = {
  Cheating: trans('users.report.options.cheating'),
  MultipleAccounts: trans('users.report.options.multiple_accounts'),
  Insults: trans('users.report.options.insults'),
  Spam: trans('users.report.options.spam'),
  UnwantedContent: trans('users.report.options.unwanted_content'),
  Nonsense: trans('users.report.options.nonsense'),
  Other: trans('users.report.options.other'),
} as const;
/* eslint-enable sort-keys */

const availableOptionsByGroupKey: Partial<Record<GroupKey, (keyof typeof availableOptions)[]>> = {
  beatmapset: ['UnwantedContent', 'Other'],
  beatmapset_discussion_post: ['Insults', 'Spam', 'UnwantedContent', 'Nonsense', 'Other'],
  comment: ['Insults', 'Spam', 'UnwantedContent', 'Nonsense', 'Other'],
  forum_post: ['Insults', 'Spam', 'UnwantedContent', 'Nonsense', 'Other'],
  scores: ['Cheating', 'MultipleAccounts', 'Other'],
};

interface Props {
  reportableId: string;
  reportableType: ReportableType;
  root: HTMLElement;
  username: string;
}

interface ReportOption {
  id: string;
  text: string;
}

@observer
export default class ReportForm extends React.Component<Props> {
  @observable private comments = '';
  @observable private completed = false;
  @observable private disabled = false;
  @observable private selectedReason = this.options[0];
  private timeout: number | undefined;

  private get canSubmit() {
    return !this.disabled && this.comments.length > 0;
  }

  private get groupKey() {
    return reportableTypeToGroupKey[this.props.reportableType];
  }

  @computed
  private get options() {
    const options = availableOptionsByGroupKey[this.groupKey]
      ?? Object.keys(availableOptions) as (keyof typeof availableOptions)[];

    return options.map((option) => ({
      id: option as string, text: availableOptions[option],
    }));
  }

  constructor(props: Props) {
    super(props);

    makeObservable(this);
  }

  componentDidMount() {
    $(document).on('turbolinks:before-cache', this.handleClose);
  }

  componentWillUnmount() {
    $(document).off('turbolinks:before-cache', this.handleClose);
    window.clearTimeout(this.timeout);
  }

  render() {
    return (
      <Modal onClose={this.handleClose}>
        <div className={bn}>
          <div className={`${bn}__header`}>
            <div className={`${bn}__row ${bn}__row--exclamation`}>
              <i className='fas fa-exclamation-triangle' />
            </div>

            <div className={`${bn}__row ${bn}__row--title`}>
              <span>
                {this.renderTitle()}
              </span>
            </div>
          </div>

          {!this.completed && this.renderFormContent()}
        </div>
      </Modal>
    );
  }

  private readonly handleClose = () => {
    unmountComponentAtNode(this.props.root);
  };

  @action
  private readonly handleCommentsChange = (e: React.ChangeEvent<HTMLTextAreaElement>) => {
    this.comments = e.target.value;
  };

  @action
  private readonly handleReasonChange = (option: ReportOption) => {
    this.selectedReason = option;
  };

  @action
  private readonly handleSubmit = () => {
    this.disabled = true;

    const data = {
      comments: this.comments,
      reason: this.selectedReason.id,
      reportable_id: this.props.reportableId,
      reportable_type: this.props.reportableType,
    };

    const params = {
      data,
      dataType: 'json',
      type: 'POST',
      url: route('reports.store'),
    };

    $.ajax(params).done(action(() => {
      this.timeout = window.setTimeout(this.handleClose, 1000);
      this.completed = true;
    })).fail(action((xhr: JQuery.jqXHR) => {
      onError(xhr);
      this.disabled = false;
    }));
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
                modifiers='report'
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
            disabled={!this.canSubmit}
            onClick={this.handleSubmit}
            type='button'
          >
            {trans('users.report.actions.send')}
          </button>
          <button
            className={`${bn}__button`}
            disabled={this.disabled}
            onClick={this.handleClose}
            type='button'
          >
            {trans('users.report.actions.cancel')}
          </button>
        </div>
      </div>
    );
  }

  private renderTitle() {
    if (this.completed) {
      return trans('users.report.thanks');
    }

    return (
      <StringWithComponent
        mappings={{ username: <strong>{this.props.username}</strong> }}
        pattern={trans(`report.${this.groupKey}.title`)}
      />
    );
  }
}
