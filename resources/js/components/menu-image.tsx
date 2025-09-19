// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import MenuImageJson from 'interfaces/menu-image-json';
import * as React from 'react';

const bn = 'menu-image';

interface Props {
  image: MenuImageJson;
  index?: number;
}

export default function MenuImage({ image, index }: Props) {
  return (
    <div
      className={bn}
      style={{ '--index': index } as React.CSSProperties}
    >
      <a className='u-contents' href={image.url}>
        <img className={`${bn}__image`} src={image.image_url} />
      </a>
    </div>
  );
}
