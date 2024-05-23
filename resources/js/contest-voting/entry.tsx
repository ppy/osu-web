// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import TrackPreview from 'components/track-preview';
import { route } from 'laroute';
import { includes, round } from 'lodash';
import * as React from 'react';
import { transChoice } from 'utils/lang';
import UserLink from '../components/user-link';
import ContestEntryJson from '../interfaces/contest-entry-json';
import { ContestJsonForEntries } from '../interfaces/contest-json';
// I'll fix this later
// eslint-disable-next-line @typescript-eslint/ban-ts-comment
// @ts-ignore
import { Voter } from './voter';

interface Props {
  contest: ContestJsonForEntries;
  entry: ContestEntryJson;
  hideIfNotVoted: boolean;
  options: {
    showLink: boolean;
    showPreview: boolean;
  };
  rank: number;
  selected: number[];
  waitingForResponse: boolean;
  winnerVotes: number;
}

export const Entry = (props: Props) => {
  const selected = includes(props.selected, props.entry.id);

  if (props.hideIfNotVoted && !selected) {
    return;
  }

  const linkIcon =
    props.contest.type === 'external' ? 'fa-external-link-alt' : 'fa-download';

  const relativeVotePercentage = props.entry.results
    ? round((props.entry.results.votes / props.winnerVotes) * 100, 2)
    : 0;

  const usersVotedPercentage = props.entry.results
    ? round(
      (props.entry.results.votes / props.contest.users_voted_count) * 100,
      2,
    )
    : 0;

  const renderUserLink = () => {
    if (!props.entry.user) {
      return <></>;
    }

    return (
      <UserLink
        className="contest-voting-list__entrant"
        user={props.entry.user}
      />
    );
  };

  const renderTitle = () => {
    if (props.contest.type === 'external') {
      return (
        <>
          <a className="contest-voting-list__title-link u-ellipsis-overflow u-relative">
            {props.entry.title}
          </a>
          {renderUserLink()}
        </>
      );
    }

    if (
      props.options.showLink &&
      props.entry.preview !== null &&
      props.contest.submitted_beatmaps
    ) {
      return (
        <>
          <a
            className="contest-voting-list__title-link u-ellipsis-overflow u-relative"
            href={route('beatmapsets.show', {
              beatmapset: props.entry.preview,
            })}
          >
            {props.entry.title}
          </a>
          {renderUserLink()}
        </>
      );
    }

    return (
      <>
        <div className="u-relative u-ellipsis-overflow">
          {props.entry.title}
        </div>
        {renderUserLink()}
      </>
    );
  };

  return (
    <div
      className={`contest-voting-list__row${
        selected && !props.contest.show_votes
          ? ' contest-voting-list__row--selected'
          : ''
      }`}
    >
      {props.contest.show_votes && (
        <div className="contest-voting-list__rank">
          {props.rank < 4 ? (
            <span
              className={`contest-voting-list__trophy contest-voting-list__trophy--${props.rank}`}
            >
              <i className="fas fa-fw fa-trophy" />
            </span>
          ) : (
            `#${props.rank}`
          )}
        </div>
      )}
      {props.entry.preview !== undefined ? (
        props.contest.submitted_beatmaps ? (
          <div className="contest-voting-list__preview">
            {props.entry.preview !== undefined && (
              <TrackPreview
                track={{
                  coverUrl: `https://b.ppy.sh/thumb/${props.entry.preview}.jpg`,
                  preview: props.entry.preview,
                }}
              />
            )}
          </div>
        ) : (
          <div className="contest-voting-list__icon contest-voting-list__icon--bg">
            <a
              className="contest-voting-list__link"
              href={props.entry.preview}
              rel="nofollow noreferrer"
              target="_blank"
            >
              <i className={`fas fa-fw fa-lg ${linkIcon}`} />
            </a>
          </div>
        )
      ) : (
        <></>
      )}
      {props.contest.show_votes ? (
        <div className="contest-voting-list__title contest-voting-list__title--show-votes">
          <div
            className="contest-voting-list__votes-bar"
            style={{ width: `${relativeVotePercentage}%` }}
          />
          {renderTitle()}
        </div>
      ) : (
        <div className="contest-voting-list__title">{renderTitle()}</div>
      )}
      {!props.contest.judged && (
        <div
          className={`contest__voting-star${
            props.contest.show_votes ? ' contest__voting-star--dark-bg' : ''
          }`}
        >
          <Voter
            key={props.entry.id}
            contest={props.contest}
            entry={props.entry}
            selected={props.selected}
            waitingForResponse={props.waitingForResponse}
          />
        </div>
      )}
      {props.contest.show_votes ? (
        props.contest.best_of || props.contest.judged ? (
          <div className="contest__vote-count contest__vote-count--no-percentages">
            {props.entry.results &&
              transChoice('contest.vote.points', props.entry.results.votes)}
          </div>
        ) : (
          <div className="contest__vote-count">
            {props.entry.results &&
              transChoice('contest.vote.count', props.entry.results.votes)}
            {Number.isFinite(usersVotedPercentage)}
          </div>
        )
      ) : (
        <></>
      )}
      {props.contest.judged && (
        <div className="contest-voting-list__icon contest-voting-list__icon--bg">
          <a
            className="contest-voting-list__link"
            href={route('contest-entries.judge-results', props.entry.id)}
            rel="noreferrer"
            target="_blank"
          >
            <i className="fas fa-fw fa-lg fa-external-link-alt" />
          </a>
        </div>
      )}
    </div>
  );
};
