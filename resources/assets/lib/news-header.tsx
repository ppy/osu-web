/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

import HeaderV3 from 'header-v3';
import HeaderTitleTrans from 'interfaces/header-title-trans';
import NewsPostJson from 'interfaces/news-post-json';
import { route } from 'laroute';
import * as React from 'react';

interface Props {
  post?: NewsPostJson;
  section: string;
  titleTrans: HeaderTitleTrans;
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
    <HeaderV3
      theme='news'
      titleTrans={props.titleTrans}
      links={links}
    />
  );
}
