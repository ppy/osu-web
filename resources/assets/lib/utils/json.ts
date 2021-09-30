// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

function isScriptElement(ele: HTMLElement | null): ele is HTMLScriptElement {
  return ele?.localName === 'script';
}

export function jsonClone<T = string|number|Record<string, unknown>>(obj: T) {
  return JSON.parse(JSON.stringify(obj)) as T;
}

export function parseJson<T = any>(id: string, remove = false) {
  const element = window.newBody?.querySelector(`#${id}`);
  if (!(element instanceof HTMLScriptElement)) return undefined;
  const json = JSON.parse(element.text) as T;

  if (remove) {
    element.remove();
  }

  return json;
}

export function storeJson(id: string, object: Record<string, unknown>) {
  const json = JSON.stringify(object);
  let element = document.getElementById(id);

  // TODO: typingggggg???
  if (element == null) {
    element = document.createElement('script');
    element.id = id;
    document.body.appendChild(element);
  }

  if (!isScriptElement(element)) {
    throw new Error();
  }

  element.id = id;
  element.type = 'application/json';
  element.text = json;
}
