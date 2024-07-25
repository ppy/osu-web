// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import ContestEntryJson, { ContestEntryJsonForResults } from './contest-entry-json';
import ContestScoringCategoryJson from './contest-scoring-category-json';

interface ContestJsonAvailableIncludes {
  entries: ContestEntryJson[];
  max_judging_score: number;
  max_total_score: number;
  scoring_categories: ContestScoringCategoryJson[];
}

interface ContestJsonEntry {
  best_of: boolean;
  judged: boolean;
  link_icon: string;
  show_votes: boolean;
  submitted_beatmaps: boolean;
  type: string;
  users_voted_count: number;
}

interface ContestJsonDefaultAttributes {
  id: number;
  name: string;
}

type ContestJson = ContestJsonDefaultAttributes & Partial<ContestJsonAvailableIncludes>;
export default ContestJson;

export type ContestJsonForResults = ContestJsonDefaultAttributes
& Required<Pick<ContestJsonAvailableIncludes, 'max_judging_score' | 'max_total_score' | 'scoring_categories'>>
& {
  entires: ContestEntryJsonForResults;
};

export type ContestJsonForEntries = ContestJsonDefaultAttributes
& Required<Pick<ContestJsonAvailableIncludes, 'entries'>>
& Required<ContestJsonEntry>;

export type ContestJsonForStore = ContestJsonDefaultAttributes
& Required<Pick<ContestJsonAvailableIncludes, 'entries' | 'scoring_categories'>>;
