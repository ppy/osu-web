import GameMode from './game-mode';
import UserJson from './user-json';

export type LovedPollOption = 'yes' | 'no';

export default interface LovedPollJson {
  current_user_attributes: {
    can_vote: boolean;
    can_vote_error: string | null;
    vote: LovedPollOption | null;
  };
  description: {
    bbcode: string;
    html: string;
  };
  description_author: UserJson | null;
  ended_at: string;
  excluded_beatmap_ids: number[];
  pass_threshold: number;
  results: Record<LovedPollOption, number> | null;
  ruleset: GameMode;
  topic_id: number;
  total_vote_count: number;
}
