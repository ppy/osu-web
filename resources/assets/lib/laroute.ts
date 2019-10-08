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

import { forEach } from 'lodash';
import { Ziggy } from 'ziggy';
import ziggyRoute from 'ziggy-route';

interface Attributes {
  [key: string]: string | number | null | undefined;
}

export function route(name: string, params?: Attributes | null, absolute?: boolean) {
  if (params == null) {
    params = {};
  }

  return ziggyRoute(name, params, absolute, Ziggy).toString();
}

export function link_to_route(name: string, text: string, params?: Attributes | null, attrs?: Attributes | null) {
  const url = route(name, params);

  const link = document.createElement('a');
  link.textContent = text;
  link.href = url;

  if (attrs != null) {
    forEach(attrs, (value, key) => {
      if (value != null) {
        link.setAttribute(key, value.toString());
      }
    });
  }

  return link.outerHTML;
}
