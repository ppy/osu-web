// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BeatmapExtendedJson from 'interfaces/beatmap-extended-json';
import * as React from 'react';
import { renderToStaticMarkup } from 'react-dom/server';
import { getDiffColour } from 'utils/beatmap-helper';
import { classWithModifiers, Modifiers } from 'utils/css';
import { nextVal } from 'utils/seq';
import DifficultyBadge from './difficulty-badge';

interface Props {
  beatmap: BeatmapExtendedJson;
  modifiers?: Modifiers;
  showConvertMode: boolean;
  withTooltip: boolean;
}

export class BeatmapIcon extends React.Component<Props> {
  static readonly defaultProps = {
    showConvertMode: false,
    withTooltip: false,
  };

  private tooltipId = '';

  render() {
    this.tooltipId = `beatmap-icon-${this.props.beatmap.id}-${nextVal()}`;
    const mode = this.props.beatmap.convert && !this.props.showConvertMode ? 'osu' : this.props.beatmap.mode;

    const className = classWithModifiers('beatmap-icon', this.props.modifiers, {
      'with-hover': this.props.withTooltip,
    });

    const style = {
      '--diff': getDiffColour(this.props.beatmap.difficulty_rating),
    } as React.CSSProperties;

    return (
      <div
        className={className}
        onMouseOver={this.handleMouseOver}
        onTouchStart={this.handleMouseOver}
        style={style}
      >
        <i className={`fal fa-extra-mode-${mode}`} />
      </div>
    );
  }

  private readonly handleMouseOver = (event: React.SyntheticEvent<HTMLElement>) => {
    if (!this.props.withTooltip) return;

    const el = event.currentTarget;

    // on touch devices, touchstart and then mouseover will trigger.
    // the following mouseover should be ignored in that case.
    if (el._tooltip === this.tooltipId) return;

    const $content = $(renderToStaticMarkup(
      <div className='tooltip-beatmap'>
        <div className='tooltip-beatmap__content'>
          <div>{this.props.beatmap.version}</div>
          <DifficultyBadge rating={this.props.beatmap.difficulty_rating} />
        </div>
      </div>,
    ));

    if (el._tooltip != null) {
      el._tooltip = this.tooltipId;
      $(el).qtip('set', { 'content.text': $content });
      return;
    }

    el._tooltip = this.tooltipId;

    const options = {
      content: $content,
      hide: event.type === 'touchstart' ? {
        event: 'touchstart unfocus',
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
  };
}
