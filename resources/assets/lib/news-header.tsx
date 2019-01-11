/**
 *    Copyright 2015-2018 ppy Pty. Ltd.
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

import * as React from 'react';
import HeaderTitleTrans from 'interfaces/header-title-trans';
import HeaderV3 from 'header-v3';

interface PropsInterface {
  section: string;
  titleTrans: HeaderTitleTrans;
  url?: string;
}

export default function NewsHeader(props: PropsInterface) {
  let links = [
    {
      title: osu.trans('news.index.title.info'),
      url: laroute.route('news.index'),
      active: props.section === 'index',
    }
  ];

  if (props.section === 'show' && props.url != null) {
    links.push({
      active: true,
      title: osu.trans('news.show.title.info'),
      url: props.url,
    });
  }

  return <HeaderV3
    theme='news'
    titleTrans={props.titleTrans}
    links={links}
  />;
}
