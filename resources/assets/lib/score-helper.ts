# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

# TODO: move to application state repository thingy later
export class ScoreHelper
  @hasMenu: (score) ->
    score.replay || (currentUser.id? && score.user_id != currentUser.id)
