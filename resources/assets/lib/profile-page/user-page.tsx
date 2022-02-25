// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import StringWithComponent from 'components/string-with-component';
import { route } from 'laroute';
import { action, computed, makeObservable } from 'mobx';
import { observer } from 'mobx-react';
import core from 'osu-core-singleton';
import * as React from 'react';
import ExtraHeader from './extra-header';
import ExtraPageProps from './extra-page-props';
import UserPageEditor from './user-page-editor';

@observer
export default class UserPage extends React.Component<ExtraPageProps> {
  @computed
  private get canEdit() {
    return this.props.controller.withEdit || (core.currentUser != null && (core.currentUser.is_moderator || core.currentUser.is_admin));
  }

  constructor(props: ExtraPageProps) {
    super(props);

    makeObservable(this);
  }

  render() {
    const isBlank = !osu.present(this.props.controller.state.user.page.raw);
    const canEdit = this.canEdit;

    return (
      <div className='page-extra page-extra--userpage'>
        <ExtraHeader name={this.props.name} withEdit={this.props.controller.withEdit} />

        {!this.props.controller.state.editingUserPage && canEdit && !isBlank && (
          <div className='page-extra__actions'>
            <button
              className='btn-circle btn-circle--page-toggle'
              onClick={this.editStart}
              title={osu.trans('users.show.page.button')}
              type='button'
            >
              <span className='fas fa-pencil-alt' />
            </button>
          </div>
        )}

        {this.props.controller.state.editingUserPage ? (
          <UserPageEditor controller={this.props.controller} />
        ) : (
          <div className='page-extra__content-overflow-wrapper-outer u-fancy-scrollbar'>
            {this.props.controller.withEdit && isBlank ? (
              this.renderPageNew()
            ) : (
              <div className='page-extra__content-overflow-wrapper-inner'>
                {this.renderPageShow()}
              </div>
            )}
          </div>
        )}
      </div>
    );
  }

  @action
  private readonly editStart = () => {
    this.props.controller.state.editingUserPage = true;
  };

  private renderPageNew() {
    return (
      <div className='profile-extra-user-page profile-extra-user-page--new'>
        <p className='profile-extra-user-page__new-content'>
          <button
            className='btn-osu-big btn-osu-big--user-page-edit'
            disabled={!this.props.controller.state.user.has_supported}
            onClick={this.editStart}
            type='button'
          >
            {osu.trans('users.show.page.edit_big')}
          </button>
        </p>

        <p className='profile-extra-user-page__new-content profile-extra-user-page__new-content--icon'>
          <span className='fas fa-edit' />
        </p>

        <p
          className='profile-extra-user-page__new-content'
          dangerouslySetInnerHTML={{ __html: osu.trans('users.show.page.description') }}
        />

        {!this.props.controller.state.user.has_supported && (
          <p className='profile-extra-user-page__new-content'>
            <StringWithComponent
              mappings={{
                link: (
                  <a
                    href={route('store.products.show', { product: 'supporter-tag' })}
                    rel="noreferrer"
                    target='_blank'
                  >
                    {osu.trans('users.show.page.restriction_info.link')}
                  </a>
                ),
              }}
              pattern={osu.trans('users.show.page.restriction_info._')}
            />
          </p>
        )}
      </div>
    );
  }

  private renderPageShow() {
    return (
      <div
        className='js-audio--group'
        dangerouslySetInnerHTML={{ __html: this.props.controller.state.user.page.html }}
      />
    );
  }
}
