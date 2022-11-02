// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import UserRelationJson from 'interfaces/user-relation-json';
import { route } from 'laroute';
import { action, computed, makeObservable, observable } from 'mobx';
import { observer } from 'mobx-react';
import core from 'osu-core-singleton';
import * as React from 'react';
import { onErrorWithCallback } from 'utils/ajax';
import { classWithModifiers, Modifiers } from 'utils/css';
import { Spinner } from './spinner';

const bn = 'textual-button';

interface Props {
  modifiers?: Modifiers;
  onClick?: () => void;
  userId: number;
  wrapperClass?: string;
}

@observer
export default class BlockButton extends React.Component<Props> {
  @observable private loading = false;
  private xhr?: JQuery.jqXHR<UserRelationJson[]>;

  @computed
  private get block() {
    return core.currentUser?.blocks.find((f) => f.target_id === this.props.userId);
  }

  constructor(props: Props) {
    super(props);

    makeObservable(this);
  }

  @computed
  private get isVisible() {
    // - not a guest
    // - not viewing own profile
    return core.currentUser != null &&
      Number.isFinite(this.props.userId) &&
      this.props.userId !== core.currentUser.id;
  }

  componentWillUnmount() {
    this.xhr?.abort();
  }

  render() {
    if (!this.isVisible) {
      return null;
    }

    const blockClass = classWithModifiers(bn, this.props.modifiers, 'block');
    let contentClass: string | undefined;
    let wrapperClass: string;
    if (this.props.wrapperClass == null) {
      wrapperClass = blockClass;
    } else {
      contentClass = blockClass;
      wrapperClass = this.props.wrapperClass;
    }

    return (
      <button
        className={wrapperClass}
        disabled={this.loading}
        onClick={this.clicked}
        type='button'
      >
        <span className={contentClass}>
          {this.loading ? (
            <span className={`${bn}__icon fa-fw`}><Spinner /></span>
          ) : (
            <span className={`${bn}__icon fas fa-ban fa-fw`} />
          )}
          {' '}
          {this.block == null ? (
            osu.trans('users.blocks.button.block')
          ) : (
            osu.trans('users.blocks.button.unblock')
          )}
        </span>
      </button>
    );
  }

  private readonly clicked = () => {
    if (confirm(osu.trans('common.confirmation'))) {
      this.toggleBlock();
    } else {
      this.props.onClick?.();
    }
  };

  @action
  private readonly toggleBlock = () => {
    this.loading = true;

    if (this.block == null) {
      // blocking
      this.xhr = $.ajax(route('blocks.store', { target: this.props.userId }), { type: 'POST' });
    } else {
      // un-blocking
      this.xhr = $.ajax(route('blocks.destroy', { block: this.props.userId }), { type: 'DELETE' });
    }

    this.xhr
      .done(this.updateBlocks)
      .fail(onErrorWithCallback(this.toggleBlock))
      .always(action(() => this.loading = false));
  };

  @action
  private readonly updateBlocks = (data: UserRelationJson[]) => {
    if (core.currentUser != null) {
      core.currentUser.blocks = data.filter((d) => d.relation_type === 'block');
      core.currentUser.friends = data.filter((d) => d.relation_type === 'friend');
      $.publish('user:update', core.currentUser);
    }

    this.props.onClick?.();
  };
}
