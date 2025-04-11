{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@php
    use App\Libraries\Search\TeamSearchParams;

    $query = Request::query();
    unset($query['page']);
    $searchParams = $search->getParams();
@endphp
<div class="sort sort--default-padding">
    <div class="sort__items">
        <span class="sort__item sort__item--title">
            {{ osu_trans('sort._') }}
        </span>
        @foreach (TeamSearchParams::VALID_SORT_FIELDS as $field)
            @php
                $active = $field === $searchParams->sortField;
                if ($active) {
                    $currentOrder = $searchParams->sortOrder;
                    $order = $currentOrder === 'asc' ? 'desc' : 'asc';
                    $arrowOrder = $currentOrder;
                } else {
                    $order = TeamSearchParams::defaultSortOrder($field);
                    $arrowOrder = $order;
                }
                $sort = "{$field}_{$order}";
                $arrowClass = $arrowOrder === 'asc' ? 'fas fa-caret-up' : 'fas fa-caret-down';
            @endphp
            <a
                class="{{ class_with_modifiers('sort__item', ['active' => $active, 'button' => true]) }}"
                href="{{ route('search', [...$query, 'sort' => $sort]) }}"
            >
                {{ osu_trans("sort.teams.{$field}") }}

                <span class="sort__item-arrow">
                    <i class="{{ $arrowClass }}"></i>
                </span>
            </a>
        @endforeach
    </div>
</div>
