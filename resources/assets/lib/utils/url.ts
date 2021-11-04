// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { route } from 'laroute';
import { startsWith } from 'lodash';
import { TurbolinksLocation } from 'turbolinks';
import { currentUrl } from 'utils/turbolinks';

const internalUrls = [
  'admin',
  'api/v2',
  'beatmaps',
  'beatmapsets',
  'client-verifications',
  'comments',
  'community',
  'help',
  'home',
  'groups',
  'legal',
  'multiplayer',
  'notifications',
  'oauth',
  'rankings',
  'scores',
  'session',
  'store',
  'users',
  'wiki',
].join('|');

const internalUrlRegExp = RegExp(`^/(?:${internalUrls})(?:$|/|#)`);

export function beatmapDownloadDirect(id: string | number): string {
  return `osu://b/${id}`;
}

export function beatmapsetDownloadDirect(id: string | number): string {
  return `osu://s/${id}`;
}

export function changelogBuild(build: ChangelogBuild): string {
  return route('changelog.build', { build: build.version, stream: build.update_stream.name });
}

export function isHTML(location: TurbolinksLocation): boolean {
  // Some changelog builds have `.` in their version, failing turbolinks' check.
  return location.isHTML() || startsWith(location.getPath(), '/home/changelog/');
}

export function isInternal(location: TurbolinksLocation): boolean {
  return internalUrlRegExp.test(location.getPath());
}

// external link
export function openBeatmapEditor(timestampWithRange: string): string {
  return `osu://edit/${timestampWithRange}`;
}

export function updateQueryString(url: string | null, params: Record<string, string | null | undefined>) {
  const docUrl = currentUrl();
  const urlObj = new URL(url ?? docUrl.href, docUrl.origin);

  for (const [key, value] of Object.entries(params)) {
    if (value != null) {
      urlObj.searchParams.set(key, value);
    } else {
      urlObj.searchParams.delete(key);
    }
  }

  return urlObj.href;
}

export function wikiUrl(path: string, locale?: string | null | undefined) {
  return route('wiki.show', { locale: locale ?? currentLocale, path: 'WIKI_PATH' })
    .replace('WIKI_PATH', encodeURI(path));
}
