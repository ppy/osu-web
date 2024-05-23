// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import ContestEntryJson from 'interfaces/contest-entry-json';
import { ContestJsonForEntries } from 'interfaces/contest-json';
import * as React from 'react';

interface Props {
  buttonId?: string;
  contest: ContestJsonForEntries;
  entry: ContestEntryJson;
  selected: number[];
  theme?: string;
  waitingForResponse: boolean;
}

export class Voter extends React.Component<Props> {}
