<?php

/**
 *    Copyright 2015 ppy Pty. Ltd.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License as published by
 *    the Free Software Foundation, version 3 of the License.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */
namespace App\Traits;

trait ModdingAPI
{
    protected $types = ['suggestion', 'praise', 'problem'];

    /**
     * POST /api/$version/mod-reply/$id.
     *
     * @api
     *
     * @return json
     */
    public function postModReply($id)
    {
        $user = $this->user();

        if ($user) {
            try {
                $parent = Mod::findOrFail(Input::get('parent'));
            } catch (Exception $e) {
                return $this->error('missing', 'beatmaps.modding');
            }

            if ($parent->beatmapset_id != $id) {
                // someone is trying to be a twat
                return $this->error('access-denied', 'beatmaps.modding');
            }

            if (Input::has('comment')) {
                try {
                    $mod = new Mod([
                        'user_id' => $user->user_id,
                        'parent_item_id' => $parent->item_id,
                        'text' => Input::get('comment'),
                        'beatmapset_id' => $parent->beatmapset_id,
                    ]);
                    $mod->save();

                    if (Input::get('reply-type') == 'fix') {
                        // we need to resolve the parent comment
                        if (Auth::user()->canEditMod($parent)) {
                            $parent->resolve();
                        } else {
                            return $this->error('access-denied', 'beatmaps.modding');
                        }
                    }
                } catch (Exception $e) {
                    // this error will be sent to sentry.
                    return Config::get('app.debug') ? Response::json(['error' => $e->getMessage()]) : $this->error('unknown', 'beatmaps.modding');
                }
            } else {
                return $this->error('no-comment', 'beatmaps.modding');
            }

            return Response::json(['success' => Lang::get('beatmaps.modding.success.reply')]);
        } else {
            return $this->error('access-denied', 'beatmaps.modding');
        }
    }

    /**
     * Fetch a mod in JSON format from its ID.
     *
     * @api
     *
     * @return json
     */
    public function getMod($id)
    {
        try {
            $mod = Mod::find($id);

            return Response::json($mod->toArray());
        } catch (Exception $e) {
            return Response::json(['error' => $e->getMessage()]);
        }
    }

    /**
     * POST /api/$version/mod-edit/$id.
     *
     * @api
     *
     * @return json
     */
    public function postModEdit($id)
    {
        $user = $this->user();

        if ($user) {
            $comment = Input::get('comment', false);
            if ($comment) {
                try {
                    $mod = Mod::findOrFail($id);
                } catch (Exception $e) {
                    return $this->error('missing', 'beatmaps.modding');
                }

                if ($user->canEditMod($mod)) {
                    // you can edit
                    $mod->comment = $comment;
                    $mod->edit_count += 1;
                    $mod->save();

                    return Response::json(['success' => $mod->toArray()]);
                }
            } else {
                return $this->error('comment', 'beatmaps.modding');
            }
        }

        return $this->error('access-denied', 'beatmaps.modding');
    }

    /**
     * POST /api/$version/mod-comment/$id.
     *
     * @api
     *
     * @return json
     */
    public function postModComment($id)
    {
        $user = $this->user();

        if (!$user) {
            return $this->error('access-denied', 'beatmaps.modding');
        }

        $type = strtolower(Input::get('type'));

        if ($type and in_array($type, $this->types)) {

            // restrict nominations
            if ($type == 'nomination' and !$user->canNominate()) {
                return $this->error('access-denied', 'beatmaps.modding');
            }

            // dont let silenced users post mods
            if ($user->isSilenced()) {
                return $this->error('silenced', 'beatmaps.modding');
            }

            // let the insertion method deal with validation
            return Mod::insert($id, $type);
        } else {
            return $this->error('type', 'beatmaps.modding');
        }
    }

    /**
     * GET /api/$version/mod-comments/$id.
     *
     * @api
     *
     * @param int $id
     *
     * @return json
     */
    public function anyModComments($id = null)
    {
        if (!$id) {
            return $this->error('missing', 'beatmaps.modding');
        }
        try {
            $set = BeatmapSet::findOrFail($id);
        } catch (Exception $e) {
            return $this->error('missing', 'beatmaps.modding');
        }

        if ($set) {
            $updates = $this->getModChanges($id);
            $user = $this->user();
            $updated = false;

            foreach ($updates as $k => $v) {
                foreach ($v as $type => $value) {
                    if ($value) {
                        $updated = true;
                    }
                }
            }

            $updates['updated'] = $updated;
            $updates['set'] = $set->beatmapset_id;
            $updates['csrf'] = csrf_token();
            $updates['authed'] = $user ?: 0;
            $updates['bat'] = $user and $user->isBAT();
            $updates['time'] = time();

            return Response::json($updates);
        }

        return $this->error('missing', 'beatmaps.modding');
    }

    protected function getModChanges($id)
    {
        $set = BeatmapSet::find($id);

        $new = [
            'replies' => [
                'keys' => explode(',', Input::get('replies')),
                'values' => $set->replies(Input::get('time')),
            ],
            'comments' => [
                'keys' => explode(',', Input::get('comments')),
                'values' => $set->comments(Input::get('time')),
            ],
        ];

        $changes = [
            'replies' => [
                'creates' => [],
                'updates' => [],
                'deletes' => [],
            ],
            'comments' => [
                'creates' => [],
                'updates' => [],
                'deletes' => [],
            ],
        ];

        foreach (['comments', 'replies'] as $type) {
            $values = $new[$type]['values'];
            foreach ($new[$type]['keys'] as $key) {
                if (isset($values[$key])) {

                    // things are soft-deleted using deleted_at
                    if (isset($values[$key]['deleted_at']) and $values[$key]['deleted_at']) {
                        array_push($changes[$type]['deletes'], $key);
                        unset($values[$key]);
                        continue;
                    }

                    array_push($changes[$type]['updates'], $values[$key]);
                    unset($values[$key]);
                    continue;
                }
            }

            foreach ($values as $key => $mod) {
                $changes[$type]['creates'][$key] = $mod;
            }
        }

        return $changes;
    }

    public function postModBss($id)
    {
        $set = BeatmapSet::find($id);
        $user = $this->user();
        $username = Input::get('username');
        $password = Input::get('password');

        if (!$set) {
            return $this->error('beatmaps.bss', 'missing');
        }

        if ($user and $user->ownsSet($id)) {
            if ($set->graveyarded()) {
                return $this->error('beatmaps.bss', 'graveyard');
            }

            if ($set->ranked()) {
                return $this->error('beatmaps.bss', 'ranked');
            }

            $type = Input::get('complete') ? BeatmapSet::PENDING : BeatmapSet::WIP;
            $message = Input::get('message');
            $filesize = Input::get('filesize');
            $marathon = Input::get('marathon') ? true : false;
        } else {
            return $this->error('beatmaps.bss', 'access-denied');
        }
    }
}
