// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BigButton from 'components/big-button';
import StringWithComponent from 'components/string-with-component';
import TimeWithTooltip from 'components/time-with-tooltip';
import { UserLink } from 'components/user-link';
import LovedPollJson, { LovedPollOption } from 'interfaces/loved-poll-json';
import { route } from 'laroute';
import { action, computed, makeObservable, observable } from 'mobx';
import { observer } from 'mobx-react';
import * as moment from 'moment';
import * as React from 'react';
import { onErrorWithCallback } from 'utils/ajax';
import { classWithModifiers } from 'utils/css';
import { formatNumber } from 'utils/html';
import { wikiUrl } from 'utils/url';
import Controller from './controller';

const bn = 'beatmapset-loved-poll';
const transPrefix = 'beatmapsets.show.loved_poll.';

interface Props {
  controller: Controller;
}

@observer
export default class LovedPoll extends React.PureComponent<Props> {
  @observable private changingVoteTo?: LovedPollOption;
  private xhr?: JQuery.jqXHR<LovedPollJson>;

  @computed
  private get beatmapsAreLoved() {
    return this.props.controller.currentBeatmaps.some(
      (beatmap) => !beatmap.convert && beatmap.status === 'loved',
    );
  }

  @computed
  private get excludedBeatmaps() {
    return this.props.controller.currentBeatmaps.filter(
      (beatmap) => this.poll.excluded_beatmap_ids.includes(beatmap.id),
    );
  }

  @computed
  private get passed() {
    return (
      this.poll.results != null &&
      this.poll.total_vote_count > 0 &&
      this.poll.results.yes / this.poll.total_vote_count >= this.poll.pass_threshold
    );
  }

  @computed
  private get poll() {
    // eslint-disable-next-line @typescript-eslint/no-non-null-assertion
    return this.props.controller.beatmapset.loved_polls.find(
      (poll) => poll.ruleset === this.props.controller.currentBeatmap.mode,
    )!;
  }

  @computed
  private get show() {
    return this.poll != null && (
      this.poll.results == null ||
      this.passed ||
      moment(this.poll.ended_at).add(7, 'days').isAfter()
    );
  }

  constructor(props: Props) {
    super(props);
    makeObservable(this);
  }

  componentWillUnmount() {
    this.xhr?.abort();
  }

  render() {
    if (!this.show) {
      return null;
    }

    const completed = this.poll.results != null;
    const thresholdFormatted = formatNumber(this.poll.pass_threshold, 0, { style: 'percent' });

    return (
      <div className='page-extra page-extra--compact'>
        <div className={bn}>
          <div className={`${bn}__box`}>
            <h2 className={`${bn}__header`}>
              {osu.trans(`${transPrefix}header`)}
            </h2>
            <p>
              <StringWithComponent
                mappings={{
                  loved_category: <a href={route('beatmapsets.index', { s: 'loved' })}>{osu.trans(`${transPrefix}info.loved_category`)}</a>,
                  percent: <strong>{thresholdFormatted}</strong>,
                  project_loved: <a href={wikiUrl('Project_Loved')}>{osu.trans(`${transPrefix}info.project_loved`)}</a>,
                }}
                pattern={osu.trans(`${transPrefix}info.${completed ? (this.passed ? (this.beatmapsAreLoved ? 'passed_and_loved' : 'passed') : 'failed') : 'in_progress'}`)}
              />
            </p>
            {!completed && this.excludedBeatmaps.length > 0 && (
              <>
                <p>{osu.trans(`${transPrefix}info.excluded_beatmaps`)}</p>
                <ul>
                  {this.excludedBeatmaps.map((beatmap) => (
                    <li key={beatmap.id}>
                      {beatmap.version}
                    </li>
                  ))}
                </ul>
              </>
            )}
            <h3 className={`${bn}__header ${bn}__header--small`}>
              {this.poll.description_author == null
                ? osu.trans(`${transPrefix}description_header_no_author`)
                : (
                  <StringWithComponent
                    mappings={{ author: <UserLink mode={this.poll.ruleset} user={this.poll.description_author} /> }}
                    pattern={osu.trans(`${transPrefix}description_header`)}
                  />
                )
              }
            </h3>
            <div dangerouslySetInnerHTML={{ __html: this.poll.description.html }} />
          </div>
          <div className={`${bn}__box ${bn}__box--poll`}>
            <h3 className={`${bn}__header ${bn}__header--small`}>
              {osu.trans(`${transPrefix}poll.${completed ? 'header' : 'header_question'}`)}
            </h3>
            <div>
              {completed && (
                <div>
                  {osu.trans(`${transPrefix}poll.threshold`, { percent: thresholdFormatted })}
                </div>
              )}
              <div>
                {osu.trans('forum.topics.show.poll.detail.total', {
                  count: formatNumber(this.poll.total_vote_count),
                })}
              </div>
              <div>
                <StringWithComponent
                  mappings={{ time: <TimeWithTooltip dateTime={this.poll.ended_at} format='LLL' /> }}
                  pattern={osu.trans(`forum.topics.show.poll.detail.${completed ? 'ended' : 'end_time'}`)}
                />
              </div>
            </div>
            <div className={`${bn}__buttons`}>
              {completed ? (
                <>
                  {this.renderResult('yes')}
                  {this.renderResult('no')}
                </>
              ) : (
                <>
                  {this.renderVoteButton('yes')}
                  {this.renderVoteButton('no')}
                </>
              )}
              <div className={`${bn}__view-topic-button`}>
                <BigButton
                  href={route('forum.topics.show', { topic: this.poll.topic_id })}
                  icon='fas fa-external-link-alt'
                  modifiers='full'
                  text={osu.trans(`${transPrefix}poll.view_topic`)}
                />
              </div>
            </div>
          </div>
        </div>
      </div>
    );
  }

  @action
  private readonly changeVote = (pollOption: LovedPollOption) => {
    if (this.poll.current_user_attributes.vote === pollOption) {
      return;
    }

    this.changingVoteTo = pollOption;
    this.xhr?.abort();
    this.xhr = $.ajax(
      route('loved-polls.vote', { topic: this.poll.topic_id }),
      {
        data: { poll_option: pollOption },
        dataType: 'JSON',
        method: 'POST',
      },
    );
    this.xhr
      .done(this.setPoll)
      .fail(onErrorWithCallback(() => this.changeVote(pollOption)))
      .always(action(() => this.changingVoteTo = undefined));
  };

  private renderResult(pollOption: LovedPollOption) {
    if (this.poll.results == null) {
      return null;
    }

    const highlight = pollOption === (this.passed ? 'yes' : 'no');
    const result =
      this.poll.total_vote_count &&
      (this.poll.results[pollOption] / this.poll.total_vote_count);
    const percent = formatNumber(result, 2, { style: 'percent' });
    let threshold = this.poll.pass_threshold;

    if (pollOption === 'no') {
      threshold = 1 - threshold;
    }

    return (
      <div className={classWithModifiers(`${bn}-result`, { highlight })}>
        <div className={`${bn}-result__fill`} style={{ width: `${result * 100}%` }} />
        <div className={`${bn}-result__threshold`} style={{ width: `${threshold * 100}%` }} />
        <div className={`${bn}-result__content`}>
          {osu.trans(`${transPrefix}poll.${pollOption}_result`, { percent })}
        </div>
      </div>
    );
  }

  private renderVoteButton(pollOption: LovedPollOption) {
    const text = osu.trans(`${transPrefix}poll.${pollOption}`);
    const buttonText =
      this.poll.current_user_attributes.vote === pollOption
        ? { top: <>{text}<span className={`${bn}__voted-icon fas fa-check`} /></> }
        : text;

    return (
      <BigButton
        disabled={!this.poll.current_user_attributes.can_vote || this.changingVoteTo != null}
        icon={`fas fa-thumbs-${pollOption === 'yes' ? 'up' : 'down'}`}
        isBusy={this.changingVoteTo === pollOption}
        modifiers='full'
        props={{
          onClick: () => this.changeVote(pollOption),
          title: this.poll.current_user_attributes.can_vote_error ?? undefined,
        }}
        text={buttonText}
      />
    );
  }

  @action
  private readonly setPoll = (poll: LovedPollJson) => {
    const lovedPolls = this.props.controller.beatmapset.loved_polls;

    lovedPolls.splice(lovedPolls.indexOf(this.poll), 1, poll);
  };
}
