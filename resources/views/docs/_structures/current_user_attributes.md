## CurrentUserAttributes

An object listing various related permissions and states for the current user, related to the object it is attached to.

### BeatmapsetDiscussionPermissions

TODO: needs a better name.

Name                | Description
------------------- | -----------
can_destroy         | Can delete the discussion.
can_reopen          | Can reopen the discussion.
can_moderate_kudosu | Can allow or deny kudosu.
can_resolve         | Can resolve the discussion.
vote_score          | Current vote given to the discussion.


### ChatChannelUserAttributes

Name         | Type    | Description
------------ | ------- | --------------
can_message  | boolean | Can send messages to this channel.
last_read_id | number  | `message_id` of last message read.
