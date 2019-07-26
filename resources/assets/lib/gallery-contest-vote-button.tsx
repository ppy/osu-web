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

interface Props {
  pswp: any;
}

export default class GalleryContestVoteButton extends React.PureComponent<Props, any> {
  private eventId = `gallery-contest-${osu.uuid()}`;
  private mainRef = React.createRef<HTMLButtonElement>();

  constructor(props: Props) {
    super(props);

    this.state = {
      button: this.buttonState(),
      isLoading: false,
    };
  }

  componentDidMount() {
    $.subscribe(`contest:vote:click.${this.eventId}`, this.loadingStart);
    $.subscribe(`contest:vote:end.${this.eventId}`, this.loadingEnd);
    this.props.pswp.listen('afterChange', this.syncState);
  }

  componentDidUpdate() {
    this.resetTooltip();
  }

  componentWillUnmount() {
    $.unsubscribe(`.${this.eventId}`);
  }

  render() {
    return (
      <button ref={this.mainRef} className={this.mainClass()} onClick={this.vote} title={this.buttonTitle()}>
        <span className={this.iconClass()} />
      </button>
    );
  }

  private button() {
    if (this.props.pswp.currItem == null) {
      return;
    }

    const id = this.props.pswp.currItem.element.dataset.buttonId;

    return document.querySelector(`.js-contest-vote-button[data-button-id='${id}']`) as HTMLElement;
  }

  private buttonState = () => {
    const button = this.button();

    if (button != null && button.dataset.contestVoteMeta != null) {
      return JSON.parse(button.dataset.contestVoteMeta);
    }

    return {};
  }

  private buttonTitle = () => {
    if (this.state.isLoading || this.state.button.votingOver) {
      return;
    }

    if (this.state.button.isSelected) {
      return osu.trans('contest.voting.button.remove');
    }

    if (!this.state.button.hasVote) {
      return osu.trans('contest.voting.button.used_up');
    }

    return osu.trans('contest.voting.button.add');

  }

  private iconClass() {
    if (this.state.isLoading) {
      return 'fas fa-sync fa-spin';
    } else {
      return 'fas fa-star';
    }
  }

  private isDisabled = () => {
    return this.state.isLoading ||
      this.state.button.votingOver ||
      (!this.state.button.isSelected && !this.state.button.hasVote);
  }

  private loadingEnd = () => {
    this.setState({ isLoading: false });
    this.syncState();
  }

  private loadingStart = () => {
    this.setState({ isLoading: true });
  }

  private mainClass = () => {
    let ret = 'pswp__button pswp__button--contest-vote js-gallery-extra';

    if (this.state.button.isSelected) {
      ret += ' pswp__button--contest-vote-active';
    }

    if (this.isDisabled()) {
      ret += ' pswp__button--disabled';
    }

    return ret;
  }

  private resetTooltip = () => {
    const main = this.mainRef.current;

    if (main != null) {
      tooltipDefault.remove(main);
    }
  }

  private syncState = () => {
    this.setState({ button: this.buttonState() });
  }

  private vote = () => {
    if (this.isDisabled()) {
      return;
    }

    const button = this.button();

    if (button != null) {
      button.click();
    }
  }
}
