<?php

/**
 *    Copyright 2015 ppy Pty. Ltd.
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
class ModdingQueue
{
    public function rank($job, $data)
    {
        $this->set($job, $data, 'rank', function ($job, $data, $set) {
            if ($set->rankable()) {
                $set->processRank();
                $job->delete();
            } else {
                if (!$job->attempts() > 5) {
                    sentry_log("[rank] Failed to rank $id too many times; moving to pending", 'queue', Raven_Client::FATAL);
                    $set->processUnrank();
                    $job->delete();
                } else {
                    // retry bi-hourly
                    $job->release(1800);
                }
            }
        });
    }

    public function kick($job, $data)
    {
        // fire an unrank event for a beatmap to process it async

        $this->set($job, $data, 'kick', function ($job, $data, $set) {
            $set->processUnrank();
            $job->delete();
        });
    }

    public function unrank($job, $data)
    {
        // force-unrank a map. reserved for dire circumstances

        $this->set($job, $data, 'force-unrank', function ($job, $data, $set) {
            $sender = @$data['user'];
            $id = @$data['id'];
            $user = User::find($sender);

            if (!$user) {
                $log = "[force-unrank] Missing user when trying to unrank $id (user: $sender)";
            } else {
                if ($user->isDev()) {
                    $log = "[force-unrank] {$user->username} force unranked $id";
                    $set->forceUnrank();
                } else {
                    $log = "[force-unrank] {$user->username} tried to force unranked $id";
                }
            }

            sentry_log($log, 'queue', Raven_Client::FATAL);
            $job->delete();
        });
    }

    public function graveyard($job, $data)
    {
        $this->set($job, $data, 'graveyard', function ($job, $data, $set) {
            $set->processUnrank();
            $job->delete();
        });
    }

    public function delete($job, $data)
    {
        $this->set($job, $data, 'delete', function ($job, $data, $set) {
            if ($set->ranked() or $set->qualified()) {
                return;
            }

            $set->remove();
            $job->delete();
        });
    }

    protected function set($job, $data, $ident, $callback)
    {
        $id = @$data['id'];
        $set = Beatmapset::find($id);

        if (!$set) {
            sentry_log("[$ident] Set not found while trying to $ident: $id", 'queue', Raven_Client::FATAL);
            $job->delete();

            return;
        }

        $callback($job, $data, $set);
    }
}
