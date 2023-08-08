// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import Img2x from 'components/img2x';
import NewsAnnouncementJson from 'interfaces/news-announcement-json';
import { action, makeObservable, observable } from 'mobx';
import { observer } from 'mobx-react';
import * as React from 'react';
import { classWithModifiers } from 'utils/css';

const autoRotateIntervalMs = 6000;
const bn = 'news-announcements';
const itemBn = 'news-announcement';

interface Props {
  announcements: NewsAnnouncementJson[];
}

@observer
export default class Main extends React.Component<Props> {
  private autoRotateTimerId?: number;
  @observable private index = 0;

  private get length() {
    return this.props.announcements.length;
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

    return (
      <>
        <div
          className={bn}
          onMouseEnter={this.clearAutoRotateTimer}
          onMouseLeave={this.setAutoRotateTimer}
        >
          <div
            className={`${bn}__container`}
            style={{ '--index': this.index } as React.CSSProperties}
          >
            {this.props.announcements.map(this.renderAnnouncement)}
          </div>
          {this.length > 1 && this.renderButtons()}
        </div>
        {this.length > 1 && this.renderIndicators()}
      </>
    );
  }

  private clearAutoRotateTimer = () => {
    if (this.autoRotateTimerId != null) {
      window.clearInterval(this.autoRotateTimerId);

      this.autoRotateTimerId = undefined;
    }
  };

  private handleButtonClick = (event: React.MouseEvent<HTMLButtonElement>) => {
    this.setIndex(this.index + parseInt(event.currentTarget.dataset.increment ?? '', 10));
  };

  private renderAnnouncement = (announcement: NewsAnnouncementJson) => (
    <div
      key={announcement.id}
      className={itemBn}
    >
      <a className={`${itemBn}__link`} href={announcement.url}>
        <Img2x className={`${itemBn}__image`} src={announcement.image_url} />
      </a>
      {announcement.content != null && (
        <div
          className={`${itemBn}__content`}
          dangerouslySetInnerHTML={{ __html: announcement.content.html }}
        />
      )}
    </div>
  );

  private renderButtons() {
    return (
      <>
        <button
          className={`${bn}__button ${bn}__button--left`}
          data-increment={-1}
          onClick={this.handleButtonClick}
        />
        <button
          className={`${bn}__button ${bn}__button--right`}
          data-increment={1}
          onClick={this.handleButtonClick}
        />
      </>
    );
  }

  private renderIndicators() {
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

  private setAutoRotateTimer = () => {
    this.clearAutoRotateTimer();

    this.autoRotateTimerId = window.setInterval(
      () => this.setIndex(this.index + 1),
      autoRotateIntervalMs,
    );
  };

  @action
  private setIndex(index: number) {
    this.index = (index + this.length) % this.length;
  }
}
