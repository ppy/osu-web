// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import MenuImageJson from 'interfaces/menu-image-json';
import { range } from 'lodash';
import { action, makeObservable, observable } from 'mobx';
import { observer } from 'mobx-react';
import * as React from 'react';
import { classWithModifiers } from 'utils/css';
import MenuImage from './menu-image';

function modulo(dividend: number, divisor: number): number {
  return ((dividend % divisor) + divisor) % divisor;
}

const autoRotateIntervalMs = 6000;
const bn = 'menu-images';

interface Props {
  images: MenuImageJson[];
}

@observer
export default class MenuImages extends React.Component<Props> {
  private autoRotateTimerId?: number;
  @observable private index = 0;
  @observable private maxIndex = this.length - 1;
  @observable private minIndex = 0;
  @observable private transition = true;

  private get length() {
    return this.props.images.length;
  }

  constructor(props: Props) {
    super(props);

    makeObservable(this);
  }

  componentDidMount() {
    this.setAutoRotateTimer();
  }

  componentWillUnmount() {
    this.clearAutoRotateTimer();
  }

  render() {
    if (this.length === 0) {
      return null;
    }

    if (this.length === 1) {
      return (
        <div className={bn}>
          <div className={`${bn}__container`}>
            <MenuImage image={this.props.images[0]} />
          </div>
        </div>
      );
    }

    return (
      <div
        className={bn}
        onMouseEnter={this.clearAutoRotateTimer}
        onMouseLeave={this.setAutoRotateTimer}
      >
        <div
          className={classWithModifiers(`${bn}__container`, { transition: this.transition })}
          onTransitionEnd={this.handleTransitionEnd}
          style={{ '--index': this.index } as React.CSSProperties}
        >
          {/*
            Render the images, including clones before and after to help create
            the illusion of an infinitely scrolling container
          */}
          {range(this.minIndex, this.maxIndex + 1).map((index) => (
            <MenuImage
              key={index}
              image={this.props.images[modulo(index, this.length)]}
              index={index}
            />
          ))}
        </div>
        {this.renderArrows()}
        {this.renderIndicators()}
      </div>
    );
  }

  private readonly clearAutoRotateTimer = () => {
    window.clearInterval(this.autoRotateTimerId);
  };

  private readonly handleArrowClick = (event: React.MouseEvent<HTMLButtonElement>) => {
    this.setIndex(this.index + parseInt(event.currentTarget.dataset.increment ?? '', 10));
  };

  private readonly handleIndicatorClick = (event: React.MouseEvent<HTMLButtonElement>) => {
    // Increment the index by the visible difference between the selected and
    // active indicator
    this.setIndex(
      this.index
        + parseInt(event.currentTarget.dataset.index ?? '', 10)
        - modulo(this.index, this.length),
    );
  };

  @action
  private readonly handleTransitionEnd = (event: React.TransitionEvent<HTMLDivElement>) => {
    if (event.propertyName !== 'transform' || event.currentTarget !== event.target) {
      return;
    }

    // Reset the index to be within normal bounds, if it went outside. Don't
    // show the transition so that nothing changes visually
    this.setIndex(modulo(this.index, this.length), false);

    // Reset the max and min indices to delete all of the cloned images
    this.maxIndex = this.length - 1;
    this.minIndex = 0;
  };

  private renderArrows() {
    return (
      <>
        <button
          className={`${bn}__arrow ${bn}__arrow--left`}
          data-increment={-1}
          onClick={this.handleArrowClick}
        />
        <button
          className={`${bn}__arrow ${bn}__arrow--right`}
          data-increment={1}
          onClick={this.handleArrowClick}
        />
      </>
    );
  }

  private renderIndicators() {
    return (
      <div className={`${bn}__indicators`}>
        {this.props.images.map((_, index) => (
          <button
            key={index}
            className={classWithModifiers(
              `${bn}__indicator`,
              { active: index === modulo(this.index, this.length) },
            )}
            data-index={index}
            onClick={this.handleIndicatorClick}
          />
        ))}
      </div>
    );
  }

  private readonly setAutoRotateTimer = () => {
    this.clearAutoRotateTimer();

    this.autoRotateTimerId = window.setInterval(
      () => this.setIndex(this.index + 1),
      autoRotateIntervalMs,
    );
  };

  @action
  private setIndex(index: number, transition = true) {
    if (this.index === index) {
      return;
    }

    this.index = index;
    this.maxIndex = Math.max(this.maxIndex, index);
    this.minIndex = Math.min(this.minIndex, index);
    this.transition = transition;
  }
}
