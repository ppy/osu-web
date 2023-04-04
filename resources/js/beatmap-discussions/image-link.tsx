// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { Spinner } from 'components/spinner';
import { route } from 'laroute';
import { action, makeObservable, observable } from 'mobx';
import { observer } from 'mobx-react';
import React from 'react';
import { ReactMarkdownProps } from 'react-markdown/lib/complex-types';

type Props = ReactMarkdownProps & React.DetailedHTMLProps<React.ImgHTMLAttributes<HTMLImageElement>, HTMLImageElement> & {
  noLink?: boolean;
};

@observer
export default class ImageLink extends React.Component<Props> {
  @observable private loaded = false;

  constructor(props: Props) {
    super(props);

    makeObservable(this);
  }

  render() {
    if (this.props.src == null) return null;

    const src = route('beatmapsets.discussions.media-url', { url: this.props.src });
    const content = (
      <>
        {!this.loaded && this.renderSpinner()}
        <img {...this.props.node.properties} loading='lazy' onLoad={this.handleOnLoad} src={src} />
      </>
    );

    if (this.props.noLink) {
      return (
        <span className='beatmapset-discussion-image-link'>
          {content}
        </span>
      );
    }

    // TODO: render something else on fail?
    return (
      <a className='beatmapset-discussion-image-link' href={src} rel='nofollow noreferrer' target='_blank'>
        {content}
      </a>
    );
  }

  @action
  private handleOnLoad = () => {
    this.loaded = true;
  };

  private renderSpinner() {
    return <span className='beatmapset-discussion-image-link__spinner'><Spinner /></span>;
  }
}
