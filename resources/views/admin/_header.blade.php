{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@php
    $links = [[
        'url' => route('admin.root'),
        'title' => osu_trans('layout.header.admin.root'),
    ]];

    if (isset($title)) {
        $links[] = compact('title');
    } else {
        $title = osu_trans('layout.header.admin.root');
    }
@endphp
@include('layout._page_header_v4', ['params' => [
    'links' => $links,
    'linksBreadcrumb' => true,
]])
