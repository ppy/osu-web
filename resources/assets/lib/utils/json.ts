// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

// TODO: stop supporting null/undefined?
export function jsonClone<T>(obj: T) {
  return obj != null ? JSON.parse(JSON.stringify(obj)) as T : obj;
}

export function parseJson<T>(id: string): T {
  const json = parseJsonNullable<T>(id);
  if (json == null) {
    throw new Error(`missing script element ${id}`);
  }

  return json;
}

export function parseJsonNullable<T>(id: string, remove = false): T | undefined {
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
  const maybeElement = document.getElementById(id);

  let element: HTMLScriptElement;
  if (maybeElement == null) {
    element = document.createElement('script');
    element.id = id;
    element.type = 'application/json';
    document.body.appendChild(element);
  } else if (maybeElement instanceof HTMLScriptElement) {
    element = maybeElement;
  } else {
    throw new Error(`existing ${id} is not a script element.`);
  }

  element.text = json;
}
