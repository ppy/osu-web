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

import { action, observable } from 'mobx';

export class FormErrors {
  @observable private errors = new Map<string, string[]>();

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
  except(names: string[]): string[] {
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
  handleResponse = (xhr: JQueryXHR) => {
    const errors = xhr.responseJSON.form_error;
    // only handle responses with form_error
    if (errors == null) { return; }

    this.errors.clear();
    for (const key of Object.keys(errors)) {
      this.errors.set(key, errors[key]);
    }
  }
}
