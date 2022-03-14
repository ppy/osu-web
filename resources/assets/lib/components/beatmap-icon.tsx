// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BeatmapExtendedJson from 'interfaces/beatmap-extended-json';
import { round } from 'lodash';
import * as React from 'react';
import { renderToStaticMarkup } from 'react-dom/server';
import { getDiffColour, getDiffRating } from 'utils/beatmap-helper';
import { classWithModifiers } from 'utils/css';

interface HTMLElementWithTooltip extends HTMLElement {
  _tooltip?: boolean;
}

interface Props {
  beatmap: BeatmapExtendedJson;
  modifier?: string;
  showConvertMode: boolean;
  showTitle: boolean;
}

export class BeatmapIcon extends React.Component<Props> {
  static readonly defaultProps = {
    showConvertMode: false,
    showTitle: true,
  };

  render() {
    const mode = this.props.beatmap.convert && !this.props.showConvertMode ? 'osu' : this.props.beatmap.mode;

    const className = classWithModifiers('beatmap-icon', this.props.modifier, {
      'with-hover': this.props.showTitle,
    });

    const style = {
      '--diff': getDiffColour(this.props.beatmap.difficulty_rating),
    } as React.CSSProperties;

    return (
      <div
        className={className}
        onMouseOver={this.handleMouseOver}
        style={style}
      >
        <i className={`fal fa-extra-mode-${mode}`} />
      </div>
    );
  }

  private readonly handleMouseOver = (event: React.MouseEvent<HTMLElementWithTooltip>) => {
    if (!this.props.showTitle) return;

    event.persist();
    const el = event.currentTarget;
    const diffRating = getDiffRating(this.props.beatmap.difficulty_rating);
    const $content = $(renderToStaticMarkup(
      <div
        className='tooltip-beatmap'
        style={{
          '--diff': `var(--diff-${diffRating})`,
        } as React.CSSProperties}
      >
        <div className='tooltip-beatmap__text tooltip-beatmap__text--title'>{this.props.beatmap.version}</div>
        <div className='tooltip-beatmap__text'>
          {round(this.props.beatmap.difficulty_rating, 2)} <i aria-hidden='true' className='fas fa-star' />
        </div>
      </div>,
    ));

    if (el._tooltip) {
      $(el).qtip('set', { 'content.text': $content });
      return;
    }

    const options = {
      content: $content,
      hide: event.type === 'touchstart' ? {
        event: 'unfocus',
        inactive: 3000,
      } : {
        event: 'click mouseleave',
      },
      overwrite: false,
      position: {
        at: 'top center',
        my: 'bottom center',
        viewport: $(window),
      },
      show: {
        event: event.type,
        ready: true,
      },
      style: {
        classes: 'qtip qtip--tooltip-beatmap',
        tip: {
          height: 9,
          width: 10,
        },
      },
    };

    $(el).qtip(options, event);

    el._tooltip = true;
  };
}
