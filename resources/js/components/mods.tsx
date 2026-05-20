// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import ScoreModJson from 'interfaces/score-mod-json';
import { autorun, makeObservable } from 'mobx';
import { observer } from 'mobx-react';
import * as React from 'react';
import { renderToStaticMarkup } from 'react-dom/server';
import { classWithModifiers, Modifiers } from 'utils/css';
import { qtipPosition } from 'utils/qtip-helper';
import { modDetails } from 'utils/score-helper';
import Mod, { getExtendedContent } from './mod';

interface Props {
  maxIcons?: number;
  modifiers?: Modifiers;
  mods: ScoreModJson[];
}

@observer
export default class Mods extends React.Component<Props> {
  private overflowMods: Props['mods'] = [];
  private tooltipDisposer?: () => void;

  constructor(props: Props) {
    super(props);
    makeObservable(this);
  }

  componentWillUnmount() {
    this.tooltipDisposer?.();
  }

  render() {
    const maxLength = (this.props.maxIcons ?? 5) - 1;
    let modsLength = 0;
    const content: React.ReactNode[] = [];
    this.overflowMods = [];
    for (let i = 0; i < this.props.mods.length; i++) {
      const mod = this.props.mods[i];
      const extendedContent = getExtendedContent(mod);
      modsLength += extendedContent === '' ? 1 : 2;
      if (modsLength <= maxLength || (modsLength === maxLength + 1 && this.props.mods[i + 1] == null)) {
        content.push(
          <Mod
            key={mod.acronym}
            extendedContent={extendedContent}
            mod={mod}
          />,
        );
      } else {
        this.overflowMods = this.props.mods.slice(i);
        break;
      }
    }

    return (
      <div className={classWithModifiers('mods', this.props.modifiers)}>
        {content}
        {this.overflowMods.length > 0 && (
          <div
            className='mods__over'
            onMouseOver={this.handleHoverShowMore}
            onTouchStart={this.handleHoverShowMore}
          >
            {`+${this.overflowMods.length}`}
          </div>
        )}
      </div>
    );
  }

  private readonly handleHoverShowMore = (event: React.MouseEvent<HTMLDivElement> | React.TouchEvent<HTMLDivElement>) => {
    if (this.tooltipDisposer != null) {
      return;
    }

    const componentFn = () => (
      <div className='mods-overflow-tooltip'>
        <div className='mods-overflow-tooltip__content'>
          {this.overflowMods.map((mod) => {
            const modJson = modDetails(mod);
            return (
              <div
                key={mod.acronym}
                className='mods-overflow-tooltip__item'
              >
                <Mod hideNameInTitle mod={mod} />
                {modJson.name}
              </div>
            );
          })}
        </div>
      </div>
    );

    const target = event.currentTarget;
    $(target).qtip({
      content: {
        text: '[placeholder]',
      },
      hide: {
        delay: 500,
        effect(this: HTMLElement) {
          $(this).fadeTo(250, 0);
        },
        fixed: true,
      },
      position: qtipPosition('top center'),
      show: {
        delay: 100,
        ready: true,
      },
      style: {
        classes: 'qtip qtip--user-list',
        def: false,
        tip: false,
      },
    });

    this.tooltipDisposer = autorun(() => {
      const content = renderToStaticMarkup(componentFn());
      $(target).qtip('set', { 'content.text': content });
    });
  };
}
