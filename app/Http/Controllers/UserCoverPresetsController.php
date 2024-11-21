<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Controllers;

use App\Models\UserCoverPreset;
use Symfony\Component\HttpFoundation\Response;

class UserCoverPresetsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        parent::__construct();
    }

    public function batchActivate(): Response
    {
        $params = get_params(\Request::all(), null, [
            'ids:int[]',
            'active:bool',
        ]);
        if (!isset($params['active'])) {
            abort(422, 'parameter "active" is missing');
        }
        UserCoverPreset::whereKey($params['ids'] ?? [])->update(['active' => $params['active']]);

        return response(null, 204);
    }

    public function index(): Response
    {
        priv_check('UserCoverPresetManage')->ensureCan();

        return ext_view('user_cover_presets.index', [
            'items' => UserCoverPreset::orderBy('id', 'ASC')->get(),
        ]);
    }

    public function store(): Response
    {
        priv_check('UserCoverPresetManage')->ensureCan();

        try {
            $files = \Request::file('files') ?? [];
            foreach ($files as $file) {
                $item = \DB::transaction(function () use ($file) {
                    $item = UserCoverPreset::create();
                    $item->file()->store($file->getRealPath());
                    $item->saveOrExplode();

                    return $item;
                });
                $hash ??= "#cover-{$item->getKey()}";
            }
            \Session::flash('popup', osu_trans('user_cover_presets.store.ok'));
        } catch (\Throwable $e) {
            \Session::flash('popup', osu_trans('user_cover_presets.store.failed', ['error' => $e->getMessage()]));
        }

        return ujs_redirect(route('user-cover-presets.index').($hash ?? ''));
    }

    public function update(string $id): Response
    {
        priv_check('UserCoverPresetManage')->ensureCan();

        $item = UserCoverPreset::findOrFail($id);
        $params = get_params(\Request::all(), null, [
            'file:file',
            'active:bool',
        ], ['null_missing' => true]);

        if ($params['file'] !== null) {
            $item->file()->store($params['file']);
            $item->save();
        }
        if ($params['active'] !== null) {
            $item->update(['active' => $params['active']]);
        }

        return response(null, 204);
    }
}
