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

import { route } from 'laroute';
import { observer } from 'mobx-react';
import { Modal } from 'modal';
import QuickSearch from 'quick-search/main';
import Worker from 'quick-search/worker';
import * as React from 'react';

interface Props {
  worker: Worker;
}

interface State {
  open: boolean;
}

@observer export default class QuickSearchButton extends React.Component<Props, State> {
  formRef = React.createRef<QuickSearch>();
  searchPath = route('search', null, false);
  state: State = { open: false };

  private get isSearchPage() {
    return document.location.pathname === this.searchPath;
  }

  componentDidUpdate(prevProps: Props, prevState: State) {
    if (!prevState.open && this.state.open) {
      this.formRef.current?.focus();
    }
  }

  render() {
    let className = 'nav2__menu-link-main nav2__menu-link-main--search js-login-required--click';

    if (this.state.open || document.location.pathname === route('search', null, false)) {
      className += ' u-section--bg-normal';
    }

    return (
      <>
        <a
          className={className}
          href={route('search')}
          onClick={this.toggle}
        >
          <span className='fas fa-search' />
        </a>
        {this.renderModal()}
      </>
    );
  }

  private renderModal() {
    if (!this.state.open || this.isSearchPage) {
      return null;
    }

    return (
      <Modal visible={true} onClose={this.toggle}>
        <QuickSearch worker={this.props.worker} onClose={this.toggle} ref={this.formRef} />
      </Modal>
    );
  }

  private toggle = (event?: React.SyntheticEvent<HTMLElement>) => {
    if (event != null) {
      event.preventDefault();
    }

    if (currentUser.id == null) {
      return;
    }

    if (this.isSearchPage) {
      $('.js-search--input').focus();

      return;
    }

    this.setState({ open: !this.state.open });
  }
}
