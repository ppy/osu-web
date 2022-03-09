// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { action, observable, makeObservable } from 'mobx';
import { observer } from 'mobx-react';
import { isModalShowing } from 'modal-helper';
import CoverSelector from 'profile-page/cover-selector';
import * as React from 'react';
import { nextVal } from 'utils/seq';
import Controller from './controller';

interface Props {
  controller: Controller;
}

@observer
export default class CoverEditor extends React.Component<Props> {
  private readonly coverSelector = React.createRef<HTMLDivElement>();
  private readonly eventId = `users-show-header-${nextVal()}`;
  @observable private selectingCover = false;

  get user() {
    return this.props.controller.state.user;
  }

  constructor(props: Props) {
    super(props);

    makeObservable(this);
  }

  componentDidMount() {
    $.subscribe(`key:esc.${this.eventId}`, this.tryCloseCoverSelector);
    $(document).on(`click.${this.eventId}`, this.onDocumentClick);
  }

  componentWillUnmount() {
    $.unsubscribe(`.${this.eventId}`);
    $(document).off(`.${this.eventId}`);

    this.closeCoverSelector();
  }

  render() {
    if (!this.props.controller.withEdit) return null;

    return (
      <div ref={this.coverSelector} className='profile-page-cover-editor-button'>
        <button
          className='btn-circle btn-circle--page-toggle'
          onClick={this.onClickCoverSelectorToggle}
          title={osu.trans('users.show.edit.cover.button')}
        >
          <span className='fas fa-pencil-alt' />
        </button>

        {this.selectingCover &&
          <CoverSelector controller={this.props.controller} />
        }
      </div>
    );
  }

  @action
  private readonly closeCoverSelector = () => {
    this.selectingCover = false;
    this.props.controller.setDisplayCoverUrl(null);
  };

  private readonly onClickCoverSelectorToggle = () => {
    if (this.selectingCover) {
      this.closeCoverSelector();
    } else {
      this.openCoverSelector();
    }
  };

  private readonly onDocumentClick = (e: JQuery.ClickEvent) => {
    if (!this.selectingCover) return;

    if (e.button !== 0) return;

    if ('target' in e && this.coverSelector.current != null && $(e.target).closest(this.coverSelector.current).length) {
      return;
    }

    this.tryCloseCoverSelector();
  };

  @action
  private readonly openCoverSelector = () => {
    this.selectingCover = true;
  };

  private readonly tryCloseCoverSelector = () => {
    if (isModalShowing()) return;

    this.closeCoverSelector();
  };
}
