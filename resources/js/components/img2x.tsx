// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import * as React from 'react';
import { make2x } from 'utils/html';

type ImgProps = React.ImgHTMLAttributes<HTMLImageElement>;

// explicit className typing otherwise eslint complains.
type Props = ImgProps & Pick<ImgProps, 'className'> & { src2x?: string };

export default function Img2x(props: Props) {
  const { className = '', src2x, ...otherProps } = props;

  if (otherProps.src == null) {
    return <img {...otherProps} className={`${className} u-hidden`} />;
  }

  return <img className={className} srcSet={`${otherProps.src} 1x, ${src2x ?? make2x(otherProps.src)} 2x`} {...otherProps} />;
}
