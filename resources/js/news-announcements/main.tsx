// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import Img2x from 'components/img2x';
import NewsAnnouncementJson from 'interfaces/news-announcement-json';
import { action, autorun, IReactionDisposer, makeObservable, observable } from 'mobx';
import { observer } from 'mobx-react';
import * as React from 'react';
import { classWithModifiers } from 'utils/css';

const bn = 'news-announcements';
const itemBn = 'news-announcement';

interface Props {
  announcements: NewsAnnouncementJson[];
}

@observer
export default class Main extends React.Component<Props> {
  @observable private announcementWidth = 0;
  @observable private readonly containerRef = React.createRef<HTMLDivElement>();
  @observable private index = 0;
  private registerResizeObserverDisposer?: IReactionDisposer;
  private resizeObserver?: ResizeObserver;
  private rotateAnnouncementTimer?: NodeJS.Timer;
  @observable private readonly topRef = React.createRef<HTMLDivElement>();

  private get length() {
    return this.props.announcements.length;
  }

  constructor(props: Props) {
    super(props);

    makeObservable(this);
  }

  componentDidMount() {
    this.setRotateAnnouncementTimer();

    this.registerResizeObserverDisposer = autorun(() => {
      if (this.topRef.current != null) {
        this.resizeObserver?.disconnect();
        this.resizeObserver?.observe(this.topRef.current);
      }
    });
    this.resizeObserver = new ResizeObserver(action((entries) => {
      if (entries.length > 0) {
        this.announcementWidth = entries[0].contentRect.width;

        setImmediate(() => {
          if (this.containerRef.current != null) {
            this.containerRef.current.scrollLeft = this.announcementWidth * this.index;
          }
        });
      }
    }));
  }

  componentWillUnmount() {
    this.clearRotateAnnouncementTimer();
    this.registerResizeObserverDisposer?.();
    this.resizeObserver?.disconnect();
  }

  render() {
    if (this.length === 0) {
      return null;
    }

    return (
      <>
        <div
          ref={this.topRef}
          className={bn}
          onMouseEnter={this.clearRotateAnnouncementTimer}
          onMouseLeave={this.setRotateAnnouncementTimer}
        >
          <div
            ref={this.containerRef}
            className={`${bn}__announcements-container`}
          >
            {this.props.announcements.map((announcement) => (
              <div
                key={announcement.id}
                className={itemBn}
                style={{ width: this.announcementWidth }}
              >
                <a className={`${itemBn}__link`} href={announcement.url}>
                  <Img2x className={`${itemBn}__image`} src={announcement.image_url} />
                </a>
                {announcement.content.html != null && (
                  <div
                    className={`${itemBn}__content`}
                    dangerouslySetInnerHTML={{ __html: announcement.content.html }}
                  />
                )}
              </div>
            ))}
          </div>
          {this.renderButtons()}
        </div>
        {this.renderIndicators()}
      </>
    );
  }

  private clearRotateAnnouncementTimer = () => {
    if (this.rotateAnnouncementTimer != null) {
      clearInterval(this.rotateAnnouncementTimer);

      this.rotateAnnouncementTimer = undefined;
    }
  };

  private handleButtonClick = (event: React.MouseEvent<HTMLButtonElement>) => {
    this.setIndex(parseInt(event.currentTarget.dataset.index ?? '', 10));
  };

  private renderButtons() {
    if (this.length > 1) {
      return (
        <>
          <button
            className={`${bn}__button ${bn}__button--left`}
            data-index={this.index - 1}
            onClick={this.handleButtonClick}
          />
          <button
            className={`${bn}__button ${bn}__button--right`}
            data-index={this.index + 1}
            onClick={this.handleButtonClick}
          />
        </>
      );
    }
  }

  private renderIndicators() {
    if (this.length > 1) {
      return (
        <div className={`${bn}__indicators`}>
          {this.props.announcements.map((_, index) => (
            <div
              key={index}
              className={classWithModifiers(
                `${bn}__indicator`,
                { active: index === this.index },
              )}
            />
          ))}
        </div>
      );
    }
  }

  @action
  private setIndex(index: number) {
    this.index = (index + this.length) % this.length;
    this.containerRef.current?.scrollTo({
      axis: 'x',
      behavior: 'smooth',
      left: this.announcementWidth * this.index,
    });
  }

  private setRotateAnnouncementTimer = () => {
    this.clearRotateAnnouncementTimer();

    if (this.length > 1) {
      this.rotateAnnouncementTimer = setInterval(() => {
        this.setIndex(this.index + 1);
      }, 6000);
    }
  };
}
