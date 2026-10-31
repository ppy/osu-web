// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import ShowMoreLink from 'components/show-more-link';
import StringWithComponent from 'components/string-with-component';
import { route } from 'laroute';
import { action, computed, makeObservable, observable } from 'mobx';
import { observer } from 'mobx-react';
import core from 'osu-core-singleton';
import * as React from 'react';
import { trans } from 'utils/lang';
import { present } from 'utils/string';
import ExtraHeader from './extra-header';
import ExtraPageProps from './extra-page-props';
import UserPageEditor from './user-page-editor';

@observer
export default class UserPage extends React.Component<ExtraPageProps> {
  private readonly contentRef = React.createRef<HTMLDivElement>();
  @observable private expanded = false;
  private frame?: number;
  private readonly innerRef = React.createRef<HTMLDivElement>();
  @observable private overflowing = false;
  private resizeObserver?: ResizeObserver;

  @computed
  private get canEdit() {
    return this.props.controller.withEdit || (core.currentUser != null && (core.currentUser.is_moderator || core.currentUser.is_admin));
  }

  constructor(props: ExtraPageProps) {
    super(props);

    makeObservable(this);
  }

  componentDidMount() {
    this.resizeObserver = new ResizeObserver(this.measure);
    this.observeContent();
    this.measure();
  }

  componentDidUpdate() {
    this.observeContent();
    this.measure();
  }

  componentWillUnmount() {
    this.resizeObserver?.disconnect();

    if (this.frame != null) {
      cancelAnimationFrame(this.frame);
    }
  }

  render() {
    const isBlank = !present(this.props.controller.state.user.page.raw);
    const canEdit = this.canEdit;

    return (
      <div className='page-extra page-extra--userpage'>
        <ExtraHeader name={this.props.name} withEdit={this.props.controller.withEdit} />

        {!this.props.controller.state.editingUserPage && canEdit && !isBlank && (
          <div className='page-extra__actions'>
            <button
              className='btn-circle btn-circle--page-toggle'
              onClick={this.editStart}
              title={trans('users.show.page.edit_big')}
              type='button'
            >
              <span className='fas fa-pencil-alt' />
            </button>
          </div>
        )}

        {this.props.controller.state.editingUserPage ? (
          <UserPageEditor controller={this.props.controller} />
        ) : (
          <>
            <div
              className='page-extra__content-overflow-wrapper-outer u-fancy-scrollbar'
              style={this.expanded ? { maxHeight: 'none' } : undefined}
            >
              {this.props.controller.withEdit && isBlank ? (
                this.renderPageNew()
              ) : (
                <div
                  ref={this.innerRef}
                  className='page-extra__content-overflow-wrapper-inner'
                  style={this.expanded ? { maxHeight: 'none' } : undefined}
                >
                  {this.renderPageShow()}
                </div>
              )}
            </div>

            {!isBlank && (this.expanded || this.overflowing) && (
              <ShowMoreLink
                callback={this.toggleExpanded}
                direction={this.expanded ? 'up' : 'down'}
                hasMore
                label={this.expanded ? trans('common.buttons.show_less') : undefined}
                modifiers='profile-page'
              />
            )}
          </>
        )}
      </div>
    );
  }

  @action
  private readonly editStart = () => {
    this.props.controller.state.editingUserPage = true;
  };

  @action
  private readonly measure = () => {
    if (this.frame != null) {
      cancelAnimationFrame(this.frame);
    }

    this.frame = requestAnimationFrame(action(() => {
      this.frame = undefined;

      if (this.expanded) return;

      const el = this.innerRef.current;
      this.overflowing = el != null && el.scrollHeight > el.clientHeight + 1;
    }));
  };

  private observeContent() {
    this.resizeObserver?.disconnect();

    [this.contentRef.current, this.innerRef.current].forEach((el) => {
      if (el != null) {
        this.resizeObserver?.observe(el);
      }
    });
  }

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
            {trans('users.show.page.edit_big')}
          </button>
        </p>

        <p className='profile-extra-user-page__new-content profile-extra-user-page__new-content--icon'>
          <span className='fas fa-edit' />
        </p>

        <p
          dangerouslySetInnerHTML={{ __html: trans('users.show.page.description') }}
          className='profile-extra-user-page__new-content'
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
                    {trans('users.show.page.restriction_info.link')}
                  </a>
                ),
              }}
              pattern={trans('users.show.page.restriction_info._')}
            />
          </p>
        )}
      </div>
    );
  }

  private renderPageShow() {
    return (
      <div
        dangerouslySetInnerHTML={{ __html: this.props.controller.state.user.page.html }}
        className='js-audio--group'
      />
    );
  }

  @action
  private readonly toggleExpanded = () => {
    this.expanded = !this.expanded;
  };
}
