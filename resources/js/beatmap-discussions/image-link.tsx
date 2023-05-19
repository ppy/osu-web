// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { Spinner } from 'components/spinner';
import { route } from 'laroute';
import { action, makeObservable, observable } from 'mobx';
import { observer } from 'mobx-react';
import React from 'react';
import { ReactMarkdownProps } from 'react-markdown/lib/complex-types';
import { LinkContext } from './renderers';

type Props = ReactMarkdownProps & JSX.IntrinsicElements['img'];

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

    return (
      // declaring the context at the class level causes the component to be undefined when used by ReactMarkdown.
      // TODO: render something else on fail?
      <LinkContext.Consumer>
        {({ inLink }) => (
          inLink ? (
            <span className='beatmapset-discussion-image-link'>
              {content}
            </span>
          ) : (
            <a className='beatmapset-discussion-image-link' href={src} rel='nofollow noreferrer' target='_blank'>
              {content}
            </a>
          )
        )}
      </LinkContext.Consumer>
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
