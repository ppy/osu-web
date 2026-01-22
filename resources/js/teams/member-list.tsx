// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import React, { useCallback, useEffect, useMemo, useRef, useState } from 'react';
import ShowMoreLink from '../components/show-more-link';
import { UserCard } from '../components/user-card';
import Members from '../interfaces/team-members';
import { route } from '../laroute';
import { onError } from '../utils/ajax';
import { formatNumber } from '../utils/html';
import { trans } from '../utils/lang';

interface Props {
  teamId: number;
}

const defaultPerPage = 50;

export default function TeamMemberList({ teamId }: Props) {
  const [members, setMembers] = useState<Members>({
    items: [],
    total: 0,
  });
  const [loading, setLoading] = useState(false);

  const listRef = useRef<HTMLDivElement|null>(null);

  // determine amount of items per page based on the grid column count
  // this avoids having an empty space at the end of the list on wide media queries
  const perPage = useCallback((): number => {
    if (listRef.current === null) {
      return defaultPerPage;
    }

    const columns = window.getComputedStyle(listRef.current)
      .getPropertyValue('grid-template-columns').split(' ').length;

    return columns % 3 === 0 ? defaultPerPage + 1 : defaultPerPage;
  }, [listRef]);

  const commonQuery = useMemo(() => ({
    team: teamId,
    withLeader: false,
  }), [teamId]);

  const onShowMore = useCallback(() => {
    setLoading(true);
    $.get(route('teams.members.index', { ...commonQuery, limit: perPage(), offset: members.items.length }))
      .then((json: Members) => setMembers((currentMembers) => ({
        items: [...currentMembers.items, ...json.items],
        total: json.total,
      })))
      .catch(onError)
      .always(() => setLoading(false));
  }, [perPage, members.items.length, commonQuery]);

  useEffect(() => {
    $.get(route('teams.members.index', { ...commonQuery, limit: perPage() }))
      .then((json: Members) => setMembers(json))
      .catch(onError);
  }, [commonQuery, perPage]);

  return (
    <div ref={listRef} className="team-members__type">
      <div className="team-members__meta">
        <span>{` ${trans('teams.show.members.members')} `}</span>
        <span>{` ${formatNumber(members.total)} `}</span>
      </div>
      {members.items.map((member) => (
        <UserCard key={member.user.id} user={member.user} />
      ))}
      <ShowMoreLink
        callback={onShowMore}
        hasMore={members.items.length < members.total}
        loading={loading}
        modifiers='team-members' />
    </div>
  );
}
