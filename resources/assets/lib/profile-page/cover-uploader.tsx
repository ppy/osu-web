// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import UserCoverJson from 'interfaces/user-cover-json';
import UserExtendedJson from 'interfaces/user-extended-json';
import { route } from 'laroute';
import * as React from 'react';
import StringWithComponent from 'string-with-component';
import { fileuploadFailCallback } from 'utils/ajax';
import { classWithModifiers } from 'utils/css';
import CoverSelection from './cover-selection';

interface Props {
  canUpload: boolean;
  cover: UserCoverJson;
  dropzoneRef: React.RefObject<HTMLDivElement>;
}

export default class CoverUploader extends React.PureComponent<Props> {
  private readonly uploadButtonContainer = React.createRef<HTMLLabelElement>();

  private get $uploadButton() {
    return $(this.uploadButtonContainer.current ?? {}).find('.js-profile-cover-upload');
  }

  destroy() {
    this.$uploadButton.fileupload('destroy').remove();
  }

  render() {
    return (
      <div className='profile-cover-uploader'>
        <CoverSelection
          isSelected={this.props.cover.id == null}
          modifiers='custom'
          name='-1'
          thumbUrl={this.props.cover.custom_url}
          url={this.props.cover.custom_url}
        />

        <div className='profile-cover-uploader__button'>
          <label
            ref={this.uploadButtonContainer}
            className={classWithModifiers(
              'btn-osu-big',
              ['fileupload', 'full', 'rounded'],
              { disabled: !this.props.canUpload },
            )}
          >
            {osu.trans('users.show.edit.cover.upload.button')}
          </label>
        </div>

        <div className='profile-cover-uploader__info'>
          <p className='profile-cover-uploader__info-entry'>
            <strong>
              <StringWithComponent
                mappings={{
                  link: (
                    <a
                      href={route('store.products.show', { product: 'supporter-tag' })}
                      rel="noreferrer"
                      target='_blank'
                    >
                      {osu.trans('users.show.edit.cover.upload.restriction_info.link')}
                    </a>
                  ),
                }}
                pattern={osu.trans('users.show.edit.cover.upload.restriction_info._')}
              />
            </strong>
          </p>

          <p className='profile-cover-uploader__info-entry'>
            {osu.trans('users.show.edit.cover.upload.dropzone_info')}
          </p>

          <p className='profile-cover-uploader__info-entry'>
            {osu.trans('users.show.edit.cover.upload.size_info')}
          </p>
        </div>
      </div>
    );
  }

  setup() {
    if (this.uploadButtonContainer.current == null) {
      throw new Error("can't setup before mounting");
    }

    const $uploadButton = $('<input>', {
      class: 'js-profile-cover-upload fileupload',
      disabled: !this.props.canUpload,
      name: 'cover_file',
      type: 'file',
    });

    this.uploadButtonContainer.current.appendChild($uploadButton[0]);

    $uploadButton.fileupload({
      always: () => {
        $.publish('user:cover:upload:state', false);
      },
      dataType: 'json',
      done: (e: unknown, data: { result: UserExtendedJson }) => {
        $.publish('user:update', data.result);
      },
      dropZone: this.props.dropzoneRef.current ?? undefined,
      fail: fileuploadFailCallback,
      submit: () => {
        $.publish('user:cover:upload:state', true);
        $.publish('dragendGlobal');
      },
      url: route('account.cover'),
    });
  }
}
