// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import * as React from 'react';
import { nextVal } from 'utils/seq';

interface Props {
  pswp: any;
}

export default class GalleryContestVoteButton extends React.PureComponent<Props, any> {
  private eventId = `gallery-contest-${nextVal()}`;
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

    // FIXME: possibly string | undefined
    const id: string = this.props.pswp.currItem.element.dataset.buttonId;

    return document.querySelector(`.js-contest-vote-button[data-button-id='${id}']`) as HTMLElement;
  }

  private buttonState = () => {
    const button = this.button();

    if (button != null && button.dataset.contestVoteMeta != null) {
      return JSON.parse(button.dataset.contestVoteMeta);
    }

    return {};
  };

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

  };

  private iconClass() {
    if (this.state.isLoading) {
      return 'fas fa-sync fa-spin';
    } else {
      return 'fas fa-star';
    }
  }

  private isDisabled = () => this.state.isLoading ||
      this.state.button.votingOver ||
      (!this.state.button.isSelected && !this.state.button.hasVote);

  private loadingEnd = () => {
    this.setState({ isLoading: false });
    this.syncState();
  };

  private loadingStart = () => {
    this.setState({ isLoading: true });
  };

  private mainClass = () => {
    let ret = 'pswp__button pswp__button--contest-vote js-gallery-extra';

    if (this.state.button.isSelected) {
      ret += ' pswp__button--contest-vote-active';
    }

    if (this.isDisabled()) {
      ret += ' pswp__button--disabled';
    }

    return ret;
  };

  private resetTooltip = () => {
    const main = this.mainRef.current;

    if (main != null) {
      tooltipDefault.remove(main);
    }
  };

  private syncState = () => {
    this.setState({ button: this.buttonState() });
  };

  private vote = () => {
    if (this.isDisabled()) {
      return;
    }

    const button = this.button();

    if (button != null) {
      button.click();
    }
  };
}
