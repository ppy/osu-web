<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Controllers;

use App\Exceptions\InvariantException;
use App\Models\Contest;
use App\Models\ContestEntry;
use App\Models\ContestJudgeScore;
use App\Models\ContestJudgeVote;
use App\Models\UserContestEntry;
use Auth;
use Illuminate\Support\Facades\DB;
use Request;

class ContestEntriesController extends Controller
{
    public function judgeResults($id)
    {
        $entry = ContestEntry::with('contest')
            ->with('contest.entries')
            ->with('contest.scoringCategories')
            ->with('judgeVotes')
            ->with('judgeVotes.scores')
            ->with('judgeVotes.user')
            ->with('judgeVotes.scores.category')
            ->with('user')
            ->withSum('scores', 'value')
            ->findOrFail($id);

        abort_if(!$entry->contest->isJudged() || !$entry->contest->show_votes, 404);

        $contestJson = json_item(
            $entry->contest->loadSum('scoringCategories', 'max_value'),
            'Contest',
            ['max_judging_score']
        );

        $entryJson = json_item($entry, 'ContestEntry', [
            'judge_votes.user',
            'judge_votes.total_score',
            'judge_votes.scores.category',
            'results',
            'user',
        ]);

        $entriesJson = json_collection($entry->contest->entries, 'ContestEntry');

        return ext_view('contest_entries.judge-results', [
            'contestJson' => $contestJson,
            'entryJson' => $entryJson,
            'entriesJson' => $entriesJson,
        ]);
    }

    public function judgeVote($id)
    {
        $entry = ContestEntry::with('contest')
            ->with('contest.judges')
            ->with('contest.scoringCategories')
            ->with('judgeVotes')
            ->findOrFail($id);

        priv_check('ContestJudge', $entry->contest)->ensureCan();

        // so that admin can't submit vote if not judge
        abort_if(!$entry->contest->isJudge(auth()->user()), 403);

        $params = get_params(request()->all(), null, [
            'scores:array',
            'comment',
        ]);

        $scores = collect($params['scores']);
        $comment = $params['comment'];

        DB::transaction(function () use ($scores, $comment, $entry) {
            $vote = $entry->judgeVotes->where('user_id', auth()->user()->getKey())->first();

            if ($vote !== null) {
                if ($comment !== $vote->comment) {
                    $vote->update(['comment' => $comment]);
                }
            } else {
                $vote = ContestJudgeVote::create([
                    'comment' => $comment,
                    'contest_entry_id' => $entry->getKey(),
                    'user_id' => auth()->user()->getKey(),
                ]);
            }

            foreach ($entry->contest->scoringCategories as $category) {
                $score = $scores
                    ->where('contest_scoring_category_id', $category->getKey())
                    ->first();

                if ($score === null) {
                    throw new InvariantException(osu_trans('contest.judge.validation.missing_score'));
                }

                $currentScore = ContestJudgeScore::where('contest_judge_vote_id', $vote->getKey())
                    ->where('contest_scoring_category_id', $category->getKey())
                    ->first();

                $value = clamp($score['value'], 0, $category->max_value);

                if ($currentScore !== null) {
                    $currentValue = $currentScore->value;

                    if ($currentValue !== $value) {
                        $currentScore->update(['value' => $value]);
                    }
                } else {
                    ContestJudgeScore::create([
                        'contest_scoring_category_id' => $category->getKey(),
                        'contest_judge_vote_id' => $vote->getKey(),
                        'value' => $value,
                    ]);
                }
            }
        });

        $updatedEntry = ContestEntry::with('judgeVotes')
            ->with('judgeVotes.scores')
            ->findOrFail($id);

        $updatedEntryJson = json_item($updatedEntry, 'ContestEntry', ['current_user_judge_vote.scores']);

        return $updatedEntryJson;
    }

    public function vote($id)
    {
        $user = Auth::user();
        $entry = ContestEntry::findOrFail($id);
        $contest = Contest::with('entries')->with('entries.contest')->findOrFail($entry->contest_id);

        if ($contest->isJudged()) {
            throw new InvariantException(osu_trans('contest.judge.validation.contest_vote_judged'));
        }

        priv_check('ContestVote', $contest)->ensureCan();

        $contest->vote($user, $entry);

        return $contest->defaultJson($user);
    }

    public function store()
    {
        if (Request::hasFile('entry') !== true) {
            abort(422, 'No file uploaded');
        }

        $user = Auth::user();
        $contest = Contest::findOrFail(Request::input('contest_id'));
        $file = Request::file('entry');

        priv_check('ContestEntryStore', $contest)->ensureCan();

        $allowedExtensions = [];
        $maxFilesize = 0;
        switch ($contest->type) {
            case 'art':
                $allowedExtensions[] = 'jpg';
                $allowedExtensions[] = 'jpeg';
                $allowedExtensions[] = 'png';
                $maxFilesize = 8 * 1024 * 1024;
                break;
            case 'beatmap':
                $allowedExtensions[] = 'osu';
                $allowedExtensions[] = 'osz';
                $maxFilesize = 32 * 1024 * 1024;
                break;
            case 'music':
                $allowedExtensions[] = 'mp3';
                $maxFilesize = 16 * 1024 * 1024;
                break;
        }

        if (!in_array(strtolower($file->getClientOriginalExtension()), $allowedExtensions, true)) {
            abort(
                422,
                'Files for this contest must have one of the following extensions: '.implode(', ', $allowedExtensions)
            );
        }

        if ($file->getSize() > $maxFilesize) {
            abort(413, 'File exceeds max size');
        }

        if ($contest->type === 'art' && !is_null($contest->getForcedWidth()) && !is_null($contest->getForcedHeight())) {
            if (empty($file->getContent())) {
                abort(422, 'File must not be empty');
            }

            [$width, $height] = read_image_properties_from_string($file->getContent()) ?? [null, null];

            if ($contest->getForcedWidth() !== $width || $contest->getForcedHeight() !== $height) {
                abort(
                    422,
                    "Images for this contest must be {$contest->getForcedWidth()}x{$contest->getForcedHeight()}"
                );
            }
        }

        UserContestEntry::upload($file, $user, $contest);

        return $contest->userEntries($user);
    }

    public function destroy($id)
    {
        $user = Auth::user();
        $entry = UserContestEntry::where(['user_id' => $user->user_id])->findOrFail($id);
        $contest = Contest::findOrFail($entry->contest_id);

        priv_check('ContestEntryDestroy', $entry)->ensureCan();

        $entry->deleteWithFile();

        return $contest->userEntries($user);
    }
}
