// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import EventJson from 'interfaces/event-json';
import KudosuHistoryJson from 'interfaces/kudosu-history-json';
import { OffsetPaginationJson } from 'utils/offset-paginator';

export default interface ExtrasJson {
  recentActivity: EventJson[];
  recentlyReceivedKudosu: KudosuHistoryJson[];
}

export interface PageSection<T> extends PageSectionWithoutCount<T> {
  count: number;
}

// TODO: basically OffsetPaginatorJson now
export interface PageSectionWithoutCount<T> {
  items: T[];
  pagination: OffsetPaginationJson;
}
