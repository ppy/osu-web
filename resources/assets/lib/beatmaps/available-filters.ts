// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

interface FilterOption {
  id: number|string;
  name: string;
}

export default interface AvailableFilters {
  bundled: FilterOption[];
  extras: FilterOption[];
  general: FilterOption[];
  genres: FilterOption[];
  languages: FilterOption[];
  modes: FilterOption[];
  played: FilterOption[];
  ranks: FilterOption[];
  statuses: FilterOption[];
}
