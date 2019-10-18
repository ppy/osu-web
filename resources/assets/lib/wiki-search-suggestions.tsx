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

import { route } from 'laroute';
import * as React from 'react';

export interface SuggestionJSON {
  html: string;
  clean: string;
}

interface SuggestionProps {
  highlighted: boolean;
  position: number;
  suggestion: SuggestionJSON;
}

class Suggestion extends React.PureComponent<SuggestionProps, {}> {
  onClick = (e: React.MouseEvent) => {
    this.publishEvent('select', e);
  }

  onMouseEnter = (e: React.MouseEvent) => {
    this.publishEvent('mouseenter', e);
  }

  onMouseLeave = (e: React.MouseEvent) => {
    this.publishEvent('mouseleave', e);
  }

  publishEvent(type: string, e: React.MouseEvent) {
    const el = e.target as HTMLDivElement;

    if (el.dataset.position != null) {
      $.publish(`suggestion:${type}`, Number.parseInt(el.dataset.position, 10));
    }
  }

  render() {
    return (
      <div
        className={osu.classWithModifiers('wiki-search-suggestions__suggestion', [this.props.highlighted ? 'highlighted' : ''])}
        data-position={this.props.position}
        onMouseEnter={this.onMouseEnter}
        onMouseLeave={this.onMouseLeave}
        onClick={this.onClick}
      >
        <a
          className='wiki-search-suggestions__suggestion-text'
          href={route('search', {query: this.props.suggestion.clean, mode: 'wiki_page'})}
          dangerouslySetInnerHTML={{__html: this.props.suggestion.html}}
        />
      </div>
    );
  }
}

interface SuggestionsProps {
  highlighted: number|null;
  suggestions: SuggestionJSON[];
  visible: boolean;
}

export class Suggestions extends React.Component<SuggestionsProps, {}> {
  render() {
    return (
      <div className={osu.classWithModifiers('wiki-search-suggestions', [this.props.visible ? 'visible' : ''])}>
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
