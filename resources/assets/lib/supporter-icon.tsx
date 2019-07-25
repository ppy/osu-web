/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */

import { times } from 'lodash';
import * as React from 'react';

interface Props {
  level?: number;
  modifiers?: string[];
}

export const SupporterIcon = (props: Props) => {
  const className = osu.classWithModifiers('supporter-icon', props.modifiers);

  return (
    <span className={className} title={osu.trans('users.show.is_supporter')}>
      {
        times(props.level || 1, (n) => <span key={n} className='fas fa-heart' />)
      }
    </span>
  );
};
