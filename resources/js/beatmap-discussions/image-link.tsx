// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { route } from 'laroute';
import { action, makeObservable, observable } from 'mobx';
import { observer } from 'mobx-react';
import React from 'react';
import { ReactMarkdownProps } from 'react-markdown/lib/complex-types';

type Props = ReactMarkdownProps & React.DetailedHTMLProps<React.ImgHTMLAttributes<HTMLImageElement>, HTMLImageElement>;

async function getProxiedUrl(url: string) {
  const xhr = $.post(route('beatmapsets.discussions.media-urls'), {
    urls: [url],
  }) as JQuery.jqXHR<Record<string, string>>;

  const urls = await xhr;

  return urls[url];
}

@observer
export default class ImageLink extends React.Component<Props> {
  @observable private url?: string;

  constructor(props: Props) {
    super(props);

    makeObservable(this);

    if (props.src != null) {
      getProxiedUrl(props.src).then(action((url) => this.url = url));
    }
  }

  render() {
    return (
      <a href={this.url} rel='nofollow noreferrer' target='_blank'>
        <img {...this.props.node.properties} src={this.url} />
      </a>
    );
  }
}
