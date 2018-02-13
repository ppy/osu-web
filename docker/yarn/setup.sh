#!/bin/bash

# there's a group with same id as default
# macos groupid (20), hence the -o param
groupadd -o -g $_gid osuweb
useradd -m -u $_uid -g $_gid osuweb
