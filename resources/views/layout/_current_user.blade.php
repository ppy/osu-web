{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
<script class="js-current-user">
    var currentUser = {!! Auth::check() ? json_encode(Auth::user()->defaultJson()) : '{}' !!};
    // self-destruct to avoid rerun by turbolinks
    $('.js-current-user').remove();
</script>
