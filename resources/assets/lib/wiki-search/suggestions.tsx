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

import * as React from 'react';
import { Spinner } from 'spinner';
import Suggestion from './suggestion';
import SuggestionJSON from './suggestion-json';

interface Props {
  highlighted: number|null;
  loading: boolean;
  suggestions: SuggestionJSON[];
  visible: boolean;
}

export default class Suggestions extends React.Component<Props, {}> {
  render() {
    return (
      <div className={osu.classWithModifiers('wiki-search-suggestions', [this.props.visible ? 'visible' : ''])}>

        {this.props.loading &&
          <div className='wiki-search-suggestions__spinner'>
            <Spinner/>
          </div>
        }

        {this.props.suggestions.map((s: SuggestionJSON, i: number) =>
          <Suggestion
            key={i}
            position={i}
            suggestion={s}
            highlighted={i === this.props.highlighted}
          />,
        )}

        {this.props.highlighted == null &&
          <div className='wiki-search-suggestions__prompt'>
            {osu.trans('wiki.main.search-enter-prompt')}
          </div>
        }
      </div>
    );
  }
}
