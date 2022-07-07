// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

export interface FilterOption {
  id: boolean | number | string | null;
  name: string;
}

export default interface AvailableFilters {
  extras: FilterOption[];
  general: FilterOption[];
  genres: FilterOption[];
  languages: FilterOption[];
  modes: FilterOption[];
  nsfw: FilterOption[];
  played: FilterOption[];
  ranks: FilterOption[];
  statuses: FilterOption[];
}
