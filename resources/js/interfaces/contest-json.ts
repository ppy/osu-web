// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import ContestEntryJson, { ContestEntryJsonForResults } from './contest-entry-json';
import ContestScoringCategoryJson from './contest-scoring-category-json';

interface ContestJsonAvailableIncludes {
  current_user_attributes: {
    can_judge: boolean;
  };
  entries: ContestEntryJson[];
  max_judging_score: number;
  max_total_score: number;
  scoring_categories: ContestScoringCategoryJson[];
}

interface ContestJsonDefaultAttributes {
  id: number;
  name: string;
  show_votes: boolean;
}

type ContestJson = ContestJsonDefaultAttributes & Partial<ContestJsonAvailableIncludes>;
export default ContestJson;

export type ContestJsonForResults = ContestJsonDefaultAttributes
& Required<Pick<ContestJsonAvailableIncludes, 'max_judging_score' | 'max_total_score' | 'scoring_categories'>>
& {
  entires: ContestEntryJsonForResults;
};

export type ContestJsonForStore = ContestJsonDefaultAttributes
& Required<Pick<ContestJsonAvailableIncludes, 'current_user_attributes' | 'entries' | 'scoring_categories'>>;
