# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

o = $({})

$.subscribe = o.on.bind o
$.unsubscribe = o.off.bind o
$.publish = o.trigger.bind o
