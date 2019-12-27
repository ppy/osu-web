/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
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

import HeaderV4 from 'header-v4';
import NewsPostJson from 'interfaces/news-post-json';
import { route } from 'laroute';
import * as React from 'react';

interface Props {
  post?: NewsPostJson;
  section: string;
  title: string;
}

export default function NewsHeader(props: Props) {
  const links = [
    {
      active: props.section === 'index',
      title: osu.trans('news.index.title.info'),
      url: route('news.index'),
    },
  ];

  if (props.section === 'show' && props.post != null) {
    links.push({
      active: true,
      title: props.post.title,
      url: route('news.show', {news: props.post.slug}),
    });
  }

  return (
    <HeaderV4
      section={osu.trans('news.index.title._', { info: '' })}
      subSection={props.title}
      theme='news'
      links={links}
      linksBreadcrumb={true}
    />
  );
}
