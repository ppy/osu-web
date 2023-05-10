// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import FormErrorJson from 'interfaces/form-error-json';
import { action, makeObservable, observable } from 'mobx';
import { flattenFormErrorJson } from 'utils/json';

export class FormErrors {
  @observable private errors = new Map<string, string[]>();

  constructor() {
    makeObservable(this);
  }

  @action
  clear() {
    this.errors.clear();
  }

  /**
   * Returns a list of errors with errors for specific input fields filtered out.
   * This works fine for its current use-case and the way validation error keys
   * are currently returned.
   *
   * @param names field names to filter out.
   * @returns List of error messages.
   */
  except(names: readonly string[]): string[] {
    const keys = [...this.errors.keys()].filter((key) => names.every((name) => key !== name));

    const messages: string[] = [];
    for (const key of keys) {
      const strings = this.errors.get(key);
      if (strings != null) {
        strings.forEach((value) => messages.push(value));
      }
    }

    return messages;
  }

  get(name: string) {
    return this.errors.get(name);
  }

  @action
  handleResponse = (xhr: JQuery.jqXHR<unknown>) => {
    // TODO: extra checks
    const errors = xhr.responseJSON?.form_error as FormErrorJson | undefined;

    // only handle responses with form_error
    if (errors == null) return;

    this.errors = flattenFormErrorJson(errors);
  };
}
