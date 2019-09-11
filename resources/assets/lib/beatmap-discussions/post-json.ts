export default interface BeatmapDiscussionPostJSON {
  beatmap_discussion_id: number;
  created_at: string;
  deleted_at: string;
  deleted_by_id: number;
  id: number;
  last_editor_id: number;
  message: string;
  system: boolean;
  updated_at: string;
  user_id: number;
}
