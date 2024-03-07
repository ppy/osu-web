// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

export function mapBy<T, K extends keyof T>(array: T[], key: K) {
  const map = new Map<T[K], T>();

  for (const value of array) {
    map.set(value[key], value);
  }

  return map;
}

export function mapByWithNulls<T, K extends keyof T>(array: T[], key: K) {
  const map = new Map<T[K] | null | undefined, T>();

  for (const value of array) {
    map.set(value[key], value);
  }

  return map;
}
