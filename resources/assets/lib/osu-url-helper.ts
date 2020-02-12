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

import * as laroute from 'laroute';
import * as _ from 'lodash';

export default class OsuUrlHelper {
  private static internalUrls = [
    'admin',
    'api/v2',
    'beatmaps',
    'beatmapsets',
    'client-verifications',
    'comments',
    'community',
    'help',
    'home',
    'legal',
    'oauth',
    'rankings',
    'session',
    'store',
    'users',
  ].join('|');

  static beatmapDownloadDirect(id: string | number): string {
    return `osu://b/${id}`;
  }

  static changelogBuild(build: ChangelogBuild): string {
    return laroute.route('changelog.build', {stream: build.update_stream.name, build: build.version});
  }

  static isHTML(location: TurbolinksLocation): boolean {
    // Some changelog builds have `.` in their version, failing turbolinks' check.
    return location.isHTML() || _.startsWith(location.getPath(), '/home/changelog/');
  }

  static isInternal(location: TurbolinksLocation): boolean {
    return RegExp(`^/(?:${this.internalUrls})(?:$|/|#)`).test(location.getPath());
  }

  // external link
  static openBeatmapEditor(timestampWithRange: string): string {
    return `osu://edit/${timestampWithRange}`;
  }
}
