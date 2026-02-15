// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import PopupMenu from 'components/popup-menu';
import { observer } from 'mobx-react';
import React, { useCallback } from 'react';
import { trans } from 'utils/lang';
import UserTagPicker from './user-tag-picker';

const UserTagPickerButton = observer(() => {
  const renderButton = useCallback((children: React.ReactNode, ref: React.RefObject<HTMLDivElement>, toggle: (event: React.MouseEvent<HTMLElement>) => void) => (
    <>
      <div
        ref={ref}
        className='beatmapsets-search__icon beatmapsets-search__icon--tags'
        onClick={toggle}
        title={trans('beatmaps.listing.search.tag_picker.tooltip')}
      >
        <i className='fas fa-tag' />
      </div>
      {children}
    </>
  ), []);

  return (
    <PopupMenu customRender={renderButton} direction='left'>
      {(_) => <UserTagPicker />}
    </PopupMenu>
  );
});

export default UserTagPickerButton;
