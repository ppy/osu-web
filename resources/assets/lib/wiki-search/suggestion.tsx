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
import SuggestionJSON from './suggestion-json';

interface Props {
  suggestion: SuggestionJSON;
  highlighted: boolean;
  position: number;
}

export default class Suggestion extends React.PureComponent<Props, {}> {
  onMouseEnter = (e: React.MouseEvent) => {
    this.publishEvent('mouseenter', e);
  }

  onMouseLeave = (e: React.MouseEvent) => {
    this.publishEvent('mouseleave', e);
  }

  onClick = (e: React.MouseEvent) => {
    this.publishEvent('select', e);
  }

  publishEvent(type: string, e: React.MouseEvent) {
    let el = e.target as HTMLDivElement;

    if (el.dataset.position != null) {
      $.publish(`suggestion:${type}`, el.dataset.position);
    }
  }

  render() {
    return (
      <div
        className={osu.classWithModifiers('wiki-search-suggestions__suggestion', [this.props.highlighted ? 'highlighted' : ''])}
        data-position={this.props.position}
        onMouseEnter={this.onMouseEnter}
        onMouseLeave={this.onMouseLeave}
        onClick={this.onClick}>
        <span
          className='wiki-search-suggestions__suggestion-text'
          dangerouslySetInnerHTML={{__html: this.props.suggestion.highlighted_title}}/>
        <span
          className={osu.classWithModifiers('wiki-search-suggestions__suggestion-text', ['path'])}>
          {osu.trans('wiki.search.path')} {this.props.suggestion.subtitle}
        </span>
      </div>
    );
  }
}
