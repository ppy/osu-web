// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

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
    let className = 'nav2__menu-link-main nav2__menu-link-main--search';

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
      <Modal onClose={this.toggle} visible>
        <QuickSearch ref={this.formRef} onClose={this.toggle} worker={this.props.worker} />
      </Modal>
    );
  }

  private toggle = (event?: React.SyntheticEvent<HTMLElement>) => {
    if (currentUser.id == null) {
      return;
    }

    if (event != null) {
      event.preventDefault();
    }

    if (this.isSearchPage) {
      $('.js-search--input').focus();

      return;
    }

    this.setState({ open: !this.state.open });
  };
}
