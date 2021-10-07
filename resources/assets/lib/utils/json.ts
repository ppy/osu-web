// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

/**
 * Performs a deep clone of a json object.
 * TODO: stop supporting null/undefined?
 *
 * @param obj object to clone.
 */
export function jsonClone<T>(obj: T) {
  return obj != null ? JSON.parse(JSON.stringify(obj)) as T : obj;
}

/**
 * Parses the contents of a HTMLScriptElement into json.
 * Simliar to parseJsonNullable but does not allow null values.
 *
 * @param id id of the HTMLScriptElement.
 */
export function parseJson<T>(id: string): T {
  const json = parseJsonNullable<T>(id);
  if (json == null) {
    throw new Error(`script element ${id} is missing or contains nullish value.`);
  }

  return json;
}

/**
 * Parses the contents of a HTMLScriptElement into json.
 * The result is undefined if the element does not exist.
 *
 * @param id id of the HTMLScriptElement.
 * @param remove true to remove the element after parsing; false, otherwise.
 */
export function parseJsonNullable<T>(id: string, remove = false): T | undefined {
  const element = window.newBody?.querySelector(`#${id}`);
  if (!(element instanceof HTMLScriptElement)) return undefined;
  const json = JSON.parse(element.text) as T;

  if (remove) {
    element.remove();
  }

  return json;
}

/**
 * Used to store simple React or mobx state objects into a HTMLScriptElement.
 *
 * @param id id of the element to store to. Contents of an existing HTMLScriptElement will be overriden.
 * @param object state to store.
 */
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
