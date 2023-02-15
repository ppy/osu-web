// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { Spinner } from 'components/spinner';
import { action, makeObservable, observable } from 'mobx';
import { observer } from 'mobx-react';
import React from 'react';
import { ReactMarkdownProps } from 'react-markdown/lib/complex-types';
import DiscussionsStateContext from './discussions-state-context';

type Props = ReactMarkdownProps & React.DetailedHTMLProps<React.ImgHTMLAttributes<HTMLImageElement>, HTMLImageElement>;

@observer
export default class ImageLink extends React.Component<Props> {
  static contextType = DiscussionsStateContext;
  declare context: React.ContextType<typeof DiscussionsStateContext>;
  @observable private loaded = false;

  constructor(props: Props) {
    super(props);

    makeObservable(this);
  }

  @action
  componentDidMount(): void {
    if (this.props.src != null) {
      this.context.addUrl(this.props.src);
    }
  }

  render() {
    const url = this.props.src != null ? this.context.mediaUrls.get(this.props.src) : null;

    if (url == null) {
      return (
        <span className='beatmapset-discussion-image-link'>
          {this.renderSpinner()}
        </span>
      );
    }

    // TODO: render something else on fail?
    return (
      <a className='beatmapset-discussion-image-link' href={url} rel='nofollow noreferrer' target='_blank'>
        {!this.loaded && this.renderSpinner()}
        <img {...this.props.node.properties} onLoad={this.handleOnLoad} src={url} />
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
