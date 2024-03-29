// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { ContestEntryJsonForResults } from 'interfaces/contest-entry-json';
import { ContestJsonForResults } from 'interfaces/contest-json';
import * as React from 'react';
import Header from './header';
import Vote from './vote';

interface Props {
  contest: ContestJsonForResults;
  entries: ContestEntryJsonForResults[];
  entry: ContestEntryJsonForResults;
}

export default function Main(props: Props) {
  return (
    <>
      <Header
        contest={props.contest}
        entries={props.entries}
        entry={props.entry}
      />

      <div className='contest-judge-results'>
        {props.entry.judge_votes.map((vote) => (
          <Vote
            key={vote.id}
            contest={props.contest}
            vote={vote}
          />
        ))}
      </div>
    </>
  );
}
