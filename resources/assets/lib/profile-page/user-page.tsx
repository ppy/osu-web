// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { route } from 'laroute';
import core from 'osu-core-singleton';
import ExtraHeader from 'profile-page/extra-header';
import UserPageEditor from 'profile-page/user-page-editor';
import * as React from 'react';
import StringWithComponent from 'string-with-component';
import ExtraPageProps from './extra-page-props';

export interface UserPageData {
  editing: boolean;
  html: string;
  initialRaw: string;
  raw: string;
}

interface Props extends ExtraPageProps {
  userPage: UserPageData;
}

export default class UserPage extends React.Component<Props> {
  private get canEdit() {
    return this.props.withEdit || (core.currentUser != null && (core.currentUser.is_moderator || core.currentUser.is_admin));
  }

  render() {
    const isBlank = !osu.present(this.props.userPage.initialRaw);
    const canEdit = this.canEdit;

    return (
      <div className='page-extra page-extra--userpage'>
        <ExtraHeader name={this.props.name} withEdit={this.props.withEdit} />

        {!this.props.userPage.editing && canEdit && !isBlank && (
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

        {this.props.userPage.editing ? (
          <UserPageEditor user={this.props.user} userPage={this.props.userPage} />
        ) : (
          <div className='page-extra__content-overflow-wrapper-outer u-fancy-scrollbar'>
            {this.props.withEdit && isBlank ? (
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

  private readonly editStart = () => {
    $.publish('user:page:update', { editing: true });
  };

  private renderPageNew() {
    return (
      <div className='profile-extra-user-page profile-extra-user-page--new'>
        <p className='profile-extra-user-page__new-content'>
          <button
            className='btn-osu-big btn-osu-big--user-page-edit'
            disabled={!this.props.user.has_supported}
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

        {!this.props.user.has_supported && (
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
        dangerouslySetInnerHTML={{ __html: this.props.userPage.html }}
      />
    );
  }
}
