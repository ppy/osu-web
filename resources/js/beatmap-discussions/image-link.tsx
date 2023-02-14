// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { observer } from 'mobx-react';
import React from 'react';
import { ReactMarkdownProps } from 'react-markdown/lib/complex-types';
import DiscussionsStateContext from './discussions-state-context';

type Props = ReactMarkdownProps & React.DetailedHTMLProps<React.ImgHTMLAttributes<HTMLImageElement>, HTMLImageElement>;

const placeholder = 'data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==';

@observer
export default class ImageLink extends React.Component<Props> {
  static contextType = DiscussionsStateContext;
  declare context: React.ContextType<typeof DiscussionsStateContext>;

  componentDidMount(): void {
    if (this.props.src != null) {
      this.context.mediaUrlsPending.add(this.props.src);
    }
  }

  render() {
    const url = this.props.src != null ? this.context.mediaUrls.get(this.props.src) : null;
    // render node mutation when url changes to trigger Layzr
    if (url == null) {
      return (
        <img {...this.props.node.properties} src={placeholder} />
      );
    }

    return (
      <a href={url} rel='nofollow noreferrer' target='_blank'>
        <img {...this.props.node.properties} data-normal={url} src={placeholder} />
      </a>
    );
  }
}
