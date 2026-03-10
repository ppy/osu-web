// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import Rank from 'interfaces/rank';
import React from 'react';
import { classWithModifiers } from 'utils/css';

interface Props {
  rank: Rank;
}

export default function LegacyRank({ rank }: Props) {
  return <div className={classWithModifiers('legacy-rank', rank)} />;
}
