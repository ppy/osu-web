// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { action, observable, makeObservable } from 'mobx';
import { observer } from 'mobx-react';
import * as React from 'react';
import { trans } from 'utils/lang';
import { isModalShowing } from 'utils/modal-helper';
import { nextVal } from 'utils/seq';
import Controller from './controller';
import ProfileEditPopup from './profile-edit-popup';

interface Props {
  controller: Controller;
}

@observer
export default class ProfileEditButton extends React.Component<Props> {
  private clickStartTarget: unknown;
  private readonly container = React.createRef<HTMLDivElement>();
  private readonly eventId = `users-show-header-${nextVal()}`;
  @observable private popupOpen = false;

  get user() {
    return this.props.controller.state.user;
  }

  constructor(props: Props) {
    super(props);

    makeObservable(this);
  }

  componentDidMount() {
    $.subscribe(`key:esc.${this.eventId}`, this.tryClosePopup);
    $(document).on(`mousedown.${this.eventId}`, this.onDocumentMouseDown);
    $(document).on(`click.${this.eventId}`, this.onDocumentClick);
  }

  componentWillUnmount() {
    $.unsubscribe(`.${this.eventId}`);
    $(document).off(`.${this.eventId}`);

    this.closePopup();
  }

  render() {
    if (!this.props.controller.withEdit) return null;

    return (
      <div ref={this.container} className='profile-page-cover-editor-button'>
        <button
          className='btn-circle btn-circle--page-toggle'
          onClick={this.onClickPopupToggle}
          title={trans('users.show.edit.cover.button')}
        >
          <span className='fas fa-pencil-alt' />
        </button>

        {this.popupOpen &&
          <ProfileEditPopup controller={this.props.controller} />
        }
      </div>
    );
  }

  @action
  private readonly closePopup = () => {
    this.popupOpen = false;
  };

  private readonly onClickPopupToggle = () => {
    if (this.popupOpen) {
      this.closePopup();
    } else {
      this.openPopup();
    }
  };

  private readonly onDocumentClick = (e: JQuery.ClickEvent) => {
    if (!this.popupOpen) return;

    if (e.button !== 0) return;

    if (
      this.clickStartTarget instanceof Element &&
      this.container.current != null &&
      $(this.clickStartTarget).closest(this.container.current).length
    ) {
      return;
    }

    this.tryClosePopup();
  };

  private readonly onDocumentMouseDown = (e: JQuery.ClickEvent) => {
    this.clickStartTarget = e.target;
  };

  @action
  private readonly openPopup = () => {
    this.popupOpen = true;
  };

  private readonly tryClosePopup = () => {
    if (isModalShowing()) return;

    this.closePopup();
  };
}
