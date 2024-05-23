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
