<?php

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

namespace App\Models;

/**
 * @property string $country_acronym
 * @property int $group_id
 * @property int $osu_featurevotes
 * @property int $osu_kudosavailable
 * @property int $osu_kudosdenied
 * @property int $osu_kudostotal
 * @property float $osu_mapperrank
 * @property int $osu_playmode
 * @property int $osu_playstyle
 * @property bool $osu_subscriber
 * @property \Carbon\Carbon|null $osu_subscriptionexpiry
 * @property int $osu_testversion
 * @property string|null $remember_token
 * @property string $user_actkey
 * @property int $user_allow_massemail
 * @property bool $user_allow_pm
 * @property int $user_allow_viewemail
 * @property bool $user_allow_viewonline
 * @property string $user_avatar
 * @property int $user_avatar_height
 * @property int $user_avatar_type
 * @property int $user_avatar_width
 * @property string $user_birthday
 * @property string $user_colour
 * @property string $user_dateformat
 * @property int $user_dst
 * @property string|null $user_email
 * @property int $user_emailtime
 * @property string $user_from
 * @property int $user_full_folder
 * @property int $user_id
 * @property int $user_inactive_reason
 * @property int $user_inactive_time
 * @property string|null $user_interests
 * @property string $user_ip
 * @property string $user_jabber
 * @property string $user_lang
 * @property string $user_last_confirm_key
 * @property int $user_last_privmsg
 * @property int $user_last_search
 * @property int $user_last_warning
 * @property string $user_lastfm
 * @property string $user_lastfm_session
 * @property int $user_lastmark
 * @property string $user_lastpage
 * @property int $user_lastpost_time
 * @property int $user_lastvisit
 * @property int $user_login_attempts
 * @property int $user_message_rules
 * @property string $user_msnm
 * @property int $user_new_privmsg
 * @property string $user_newpasswd
 * @property bool $user_notify
 * @property int $user_notify_pm
 * @property int $user_notify_type
 * @property string|null $user_occ
 * @property int $user_options
 * @property int $user_passchg
 * @property string $user_password
 * @property int|null $user_perm_from
 * @property mixed|null $user_permissions
 * @property int $user_post_show_days
 * @property string $user_post_sortby_dir
 * @property string $user_post_sortby_type
 * @property int $user_posts
 * @property int $user_rank
 * @property int $user_regdate
 * @property mixed $user_sig
 * @property string $user_sig_bbcode_bitfield
 * @property string $user_sig_bbcode_uid
 * @property int $user_style
 * @property float $user_timezone
 * @property int $user_topic_show_days
 * @property string $user_topic_sortby_dir
 * @property string $user_topic_sortby_type
 * @property string $user_twitter
 * @property int $user_type
 * @property int $user_unread_privmsg
 * @property int $user_warnings
 * @property string $user_website
 * @property string $username
 * @property string $username_clean
 * @property string|null $username_previous
 * @property int|null $userpage_post_id
 */
class DeletedUser extends User
{
    public $user_avatar = null;
    public $username = '[deleted user]';
}
