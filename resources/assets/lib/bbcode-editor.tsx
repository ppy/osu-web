// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { snakeCase } from 'lodash';
import * as React from 'react';
import { classWithModifiers, Modifiers } from 'utils/css';

interface OnChangeProps {
  event?: React.SyntheticEvent;
  hasChanged: boolean;
  type: 'cancel' | 'save';
  value: string | undefined;
}

interface Props {
  disabled: boolean;
  modifiers: Modifiers;
  onChange: (props: OnChangeProps) => void;
  placeholder: string;
  rawValue: string;
}

export default class BbcodeEditor extends React.Component<Props> {
  private readonly bodyRef = React.createRef<HTMLTextAreaElement>();
  private readonly sizeSelectRef = React.createRef<HTMLSelectElement>();

  componentDidMount() {
    if (this.sizeSelectRef.current != null) {
      this.sizeSelectRef.current.value = '';
    }

    if (this.bodyRef.current != null) {
      this.bodyRef.current.selectionEnd = 0;
      this.bodyRef.current.focus();
    }
  }

  render() {
    let blockClass = classWithModifiers('bbcode-editor', this.props.modifiers);
    blockClass += ' js-bbcode-preview--form';

    return (
      <form
        className={blockClass}
        data-state='write'
      >
        <div className='bbcode-editor__content'>
          <textarea
            ref={this.bodyRef}
            className='bbcode-editor__body js-bbcode-preview--body'
            defaultValue={this.props.rawValue}
            disabled={this.props.disabled}
            name='body'
            onKeyDown={this.onKeyDown}
            placeholder={this.props.placeholder}
          />

          <div className='bbcode-editor__preview'>
            <div className='forum-post-content js-bbcode-preview--preview' />
          </div>

          <div className='bbcode-editor__buttons-bar'>
            <div className='bbcode-editor__buttons bbcode-editor__buttons--toolbar'>
              {this.renderToolbar()}
            </div>

            <div className='bbcode-editor__buttons bbcode-editor__buttons--actions'>
              <div className='bbcode-editor__button bbcode-editor__button--cancel'>
                {this.actionButton(this.cancel, osu.trans('common.buttons.cancel'))}
              </div>
              <div className='bbcode-editor__button bbcode-editor__button--hide-on-write'>
                {this.renderPreviewHideButton()}
              </div>
              <div className='bbcode-editor__button bbcode-editor__button--hide-on-preview'>
                {this.renderPreviewShowButton()}
              </div>
              <div className='bbcode-editor__button'>
                {this.actionButton(this.save, osu.trans('common.buttons.save'), 'forum-primary')}
              </div>
            </div>
          </div>
        </div>
      </form>
    );
  }

  private actionButton(onClick: (event: React.MouseEvent<HTMLButtonElement>) => void, title: string, modifiers: Modifiers = 'forum-secondary') {
    return (
      <button
        className={classWithModifiers('btn-osu-big', modifiers)}
        disabled={this.props.disabled}
        onClick={onClick}
        type='button'
      >
        {title}
      </button>
    );
  }

  private cancel = (event?: React.SyntheticEvent) => {
    if (this.bodyRef.current?.value !== this.props.rawValue && !confirm(osu.trans('common.confirmation_unsaved'))) {
      return;
    }

    if (this.bodyRef.current != null) {
      this.bodyRef.current.value = this.props.rawValue;
    }
    this.sendOnChange({ event, type: 'cancel' });
  };

  private onKeyDown = (e: React.KeyboardEvent<HTMLTextAreaElement>) => {
    if (e.keyCode === 27) {
      this.cancel();
    }
  };

  private renderPreviewHideButton() {
    return (
      <button
        className='js-bbcode-preview--hide btn-osu-big btn-osu-big--forum-secondary'
        disabled={this.props.disabled}
        type='button'
      >
        {osu.trans('forum.topic.create.preview_hide')}
      </button>
    );
  }

  private renderPreviewShowButton() {
    return (
      <button
        className='js-bbcode-preview--show btn-osu-big btn-osu-big--forum-secondary'
        disabled={this.props.disabled}
        type='button'
      >
        {osu.trans('forum.topic.create.preview')}
      </button>
    );
  }

  private renderToolbar() {
    return (
      <div className='post-box-toolbar'>
        {this.toolbarButton('bold', <i className='fas fa-bold' />)}
        {this.toolbarButton('italic', <i className='fas fa-italic' />)}
        {this.toolbarButton('strikethrough', <i className='fas fa-strikethrough' />)}
        {this.toolbarButton('heading', <i className='fas fa-heading' />)}
        {this.toolbarButton('link', <i className='fas fa-link' />)}
        {this.toolbarButton('spoilerbox', <i className='fas fa-barcode' />)}
        {this.toolbarButton('list-numbered', <i className='fas fa-list-ol' />)}
        {this.toolbarButton('list', <i className='fas fa-list' />)}
        {this.toolbarButton('image', <i className='fas fa-image' />)}

        <label
          className='bbcode-size-select'
          title={osu.trans('bbcode.size._')}
        >
          <span className='bbcode-size-select__label'>
            {osu.trans('bbcode.size._')}
          </span>

          <i className='fas fa-chevron-down' />

          <select
            ref={this.sizeSelectRef}
            className='bbcode-size-select__select js-bbcode-btn--size'
            disabled={this.props.disabled}
          >
            <option value='50'>{osu.trans('bbcode.size.tiny')}</option>
            <option value='85'>{osu.trans('bbcode.size.small')}</option>
            <option value='100'>{osu.trans('bbcode.size.normal')}</option>
            <option value='150'>{osu.trans('bbcode.size.large')}</option>
          </select>
        </label>
      </div>
    );
  }

  private save = (event?: React.SyntheticEvent) => {
    this.sendOnChange({ event, type: 'save' });
  };

  private sendOnChange({event, type}: { event?: React.SyntheticEvent; type: 'cancel' | 'save' }) {
    this.props.onChange?.({
      event,
      hasChanged: this.bodyRef.current?.value !== this.props.rawValue,
      type,
      value: this.bodyRef.current?.value,
    });
  }

  private toolbarButton(name: string, content: JSX.Element) {
    return (
      <button
        className={`btn-circle btn-circle--bbcode js-bbcode-btn--${name}`}
        disabled={this.props.disabled}
        title={osu.trans(`bbcode.${snakeCase(name)}`)}
        type='button'
      >
        <span className='btn-circle__content'>{content}</span>
      </button>
    );
  }
}
