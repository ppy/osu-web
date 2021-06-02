// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import * as React from 'react';
import { make2x } from 'utils/html';

export default function Img2x(props: React.DetailedHTMLProps<React.ImgHTMLAttributes<HTMLImageElement>, HTMLImageElement>) {
  return <img srcSet={`${props.src} 1x, ${make2x(props.src)} 2x`} {...props} />;
}
