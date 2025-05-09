// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

export default interface ModJson {
  acronym: string;
  index: Partial<Record<number, number>>;
  name: string;
  setting_labels: Partial<Record<string, string>>;
  type: string;
}
