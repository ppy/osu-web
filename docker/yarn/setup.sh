#!/bin/bash

# workaround for macos default groupid (20)
groupmod -g 24 dialout

groupadd -g $_gid osuweb
useradd -m -u $_uid -g $_gid osuweb
