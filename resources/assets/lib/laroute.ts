// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { forEach } from 'lodash';
import { Ziggy } from 'ziggy';
import ziggyRoute from 'ziggy-route';

interface Attributes {
  [key: string]: string | number | null | undefined;
}

// ensure correct url
Ziggy.baseUrl = `${document.location.origin}/`;
Ziggy.baseProtocol = document.location.protocol.slice(0, -1);
Ziggy.baseDomain = document.location.hostname;
Ziggy.basePort = +document.location.port || false; // either port number of false if empty (converted to 0)

export function route(name: string, params?: Attributes | null, absolute?: boolean) {
  if (params == null) {
    params = {};
  }

  return decodeURIComponent(ziggyRoute(name, params, absolute, Ziggy).toString());
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
