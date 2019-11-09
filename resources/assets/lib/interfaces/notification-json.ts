/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

export default interface NotificationJson {
  created_at?: string;
  details: any;
  id: number;
  is_read: boolean;
  name: string;
  object_id: number;
  object_type: string;
  source_user_id?: number;
}
