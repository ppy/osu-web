// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import ProfilePageExtraTab from 'components/profile-page-extra-tab';
import { ProfileExtraPage } from 'interfaces/user-extended-json';
import { observer } from 'mobx-react';
import * as React from 'react';
import Controller from './controller';

interface Props {
  controller: Controller;
  page: ProfileExtraPage;
}

const ExtraTab = observer((props: Props) => (
  <ProfilePageExtraTab
    currentPage={props.controller.currentPage}
    page={props.page}
  />
));

export default ExtraTab;
