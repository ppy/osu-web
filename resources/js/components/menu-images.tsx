// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import MenuImageJson from 'interfaces/menu-image-json';
import { range, shuffle } from 'lodash';
import { action, computed, makeObservable, observable } from 'mobx';
import { observer } from 'mobx-react';
import * as React from 'react';
import { classWithModifiers, urlPresence } from 'utils/css';
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
  @observable private transition = true;

  private get length() {
    return this.images.length;
  }

  private get maxIndex() {
    return Math.max(this.length - 1, this.index);
  }

  private get minIndex() {
    return Math.min(0, this.index);
  }

  @computed
  private get images() {
    return shuffle(this.props.images);
  }

  constructor(props: Props) {
    super(props);

    makeObservable(this);
  }

  componentDidMount() {
    this.setAutoRotateTimer();
    document.addEventListener('visibilitychange', this.handlePageVisibilityChange);
  }

  componentWillUnmount() {
    this.clearAutoRotateTimer();
    document.removeEventListener('visibilitychange', this.handlePageVisibilityChange);
  }

  render() {
    if (this.length === 0) {
      return null;
    }

    if (this.length === 1) {
      return (
        <div className={bn}>
          <div
            className={`${bn}__blur`}
            style={{
              '--url': urlPresence(this.images[0].image_url),
            } as React.CSSProperties}
          />
          <div className={`${bn}__images`}>
            <div className={`${bn}__container`}>
              <MenuImage image={this.images[0]} />
            </div>
          </div>
        </div>
      );
    }

    const currentIndex = modulo(this.index, this.length);

    return (
      <div
        className={bn}
        onMouseEnter={this.clearAutoRotateTimer}
        onMouseLeave={this.setAutoRotateTimer}
      >
        {this.images.map((imageJson, i) => (
          <div
            key={imageJson.image_url}
            className={`${bn}__blur`}
            style={{
              '--url': urlPresence(imageJson.image_url),
              opacity: i === currentIndex ? 1 : 0,
            } as React.CSSProperties}
          />
        ))}
        <div className={`${bn}__images`}>
          <div
            className={classWithModifiers(`${bn}__container`, { transition: this.transition })}
            onTransitionEnd={this.handleTransitionEnd}
            style={{ '--index': this.index } as React.CSSProperties}
          >
            {/*
              Render the images. If minIndex or maxIndex have been adjusted, this
              will render duplicate images in a cycling pattern to help create
              the illusion of an infinitely scrolling container
            */}
            {range(this.minIndex, this.maxIndex + 1).map((index) => (
              <MenuImage
                key={index}
                image={this.images[modulo(index, this.length)]}
                index={index}
              />
            ))}
          </div>
          {this.renderArrows()}
        </div>
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

  private readonly handlePageVisibilityChange = () => {
    if (document.hidden) {
      this.clearAutoRotateTimer();
    } else {
      this.setAutoRotateTimer();
    }
  };

  @action
  private readonly handleTransitionEnd = (event: React.TransitionEvent<HTMLDivElement>) => {
    if (event.propertyName !== 'transform' || event.currentTarget !== event.target) {
      return;
    }

    // Reset the index to be within normal bounds, if it went outside. Don't
    // show the transition so that nothing changes visually
    this.setIndex(modulo(this.index, this.length), false);
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
        {this.images.map((_, index) => (
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
    this.transition = transition;
  }
}
