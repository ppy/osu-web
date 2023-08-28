## ChannelType

Type        | Permission Check for Joining/Messaging
----------- | -----------------------------------------------------
PUBLIC      | |
PRIVATE     | is player in the allowed groups? (channel.allowed_groups)
MULTIPLAYER | is player currently in the mp game?
SPECTATOR   | |
TEMPORARY   | _deprecated_
PM          | see below (user_channels)
GROUP       | is player in channel? (user_channels)
ANNOUNCE    | is user in the `announce` group? |

For PMs, two factors are taken into account:

- Is either user blocking the other? If so, deny.
- Does the target only accept PMs from friends? Is the current user a friend? If not, deny.

<aside class="notice">
Public channels, group chats and private DMs are all considered "channels".
</aside>
