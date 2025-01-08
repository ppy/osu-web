#!/bin/sh
# Source: https://github.com/AJGranowski/docker-user-mirror
# License: MIT
set -eC;

VERSION='0.0.20-7d4d3c6';
exec 3>/dev/null;
exec 4>/dev/null;

check_gosu() {
    command -v gosu && \
    gosu --version && \
    gosu nobody true;
}

check_setpriv() {
    command -v setpriv && \
    setpriv --version && \
    setpriv --reuid="$(id -u nobody)" --regid="$(id -g nobody)" --clear-groups true;
}

# Download a release file.
# Args: release filename, output filename, release tag (defaults to latest release it not provided)
download_file() {
    if [ $# -eq 3 ]; then
        curl --fail -Ls -o "$2" "https://github.com/AJGranowski/docker-user-mirror/releases/download/$3/$1";
    elif [ $# -eq 2 ]; then
        curl --fail -Ls -o "$2" "https://github.com/AJGranowski/docker-user-mirror/releases/latest/download/$1";
    else
        echo 'Expected at least two arguments.' >&2;
        return 1;
    fi
}

# Query GitHub for the latest release tag.
get_latest_release_tag() {
    response="$(curl -Ls -w '%{http_code}' 'https://api.github.com/repos/AJGranowski/docker-user-mirror/releases/latest')";
    case "$(echo "$response" | tail -1)" in
        2*)
            echo "$response" | \
            grep -E '^\s*"tag_name":' | \
            sed -E 's/.*"tag_name": "([^"]+)".*/\1/g'
        ;;
        *) false;;
    esac
}

# Get the version ID of a release.
# Args: release tag (defaults to latest release it not provided)
get_release_version() {
    if [ $# -eq 0 ]; then
        response="$(curl -Ls -w '\n%{http_code}' 'https://github.com/AJGranowski/docker-user-mirror/releases/latest/download/version')";
    else
        response="$(curl -Ls -w '\n%{http_code}' "https://github.com/AJGranowski/docker-user-mirror/releases/download/$1/version")";
    fi

    case "$(echo "$response" | tail -1)" in
        2*)
            echo "$response" | head -1
            ;;
        *) false;;
    esac
}

print_user() {
    grep -e "^$1:" /etc/passwd;
}

# Query GitHub to check if a release tag exists.
release_tag_exists() {
    case "$(curl -Ls -o /dev/null -w '%{http_code}' "https://api.github.com/repos/AJGranowski/docker-user-mirror/releases/tags/$1")" in
        2*) true;;
        *) false;;
    esac
}

# Check for updates, and download the latest version.
update() {
    if ! latest_version="$(get_release_version)"; then
        echo 'Unable to fetch the latest version. Try again in a few minutes.' >&2;
        return 1;
    fi

    if [ "$VERSION" = "$latest_version" ]; then
        echo 'Up to date.';
    else
        if ! release_tag_exists "$(version_to_release_tag)"; then
            echo 'Critical update required!';
            echo '    This version has been deleted, signaling either a critical bug or vulnerability. Update immediately.'
        else
            echo 'New update available.'
        fi
    fi

    echo "    Current version: $VERSION";
    echo "    Latest version:  $latest_version";

    if [ "$VERSION" = "$latest_version" ]; then
        return 0;
    fi

    if [ "$o_yes" != true ]; then
        echo '\nInstall the update? (y/n)';
        read yn;
        case $yn in
            y*) ;;
            n*) return 0;;
        esac
    fi

    echo 'Installing update...';
    download_file 'entrypoint' "${0}.tmp";
    mv "${0}.tmp" "$0" && echo "${latest_version} installed!"; exit 0;
}

# Convert "$VERSION" to "release-**" format.
version_to_release_tag() {
    if [ $# -eq 0 ]; then
        echo "$VERSION" | sed -E 's/([^-]*).*/release-\1/g'
    else
        echo "$1" | sed -E 's/([^-]*).*/release-\1/g'
    fi
}

# Parse options.
while [ $# -gt 0 ]; do
    case $1 in
        --setup)
            o_setup=true;
            ;;
        --update)
            o_update=true;
            ;;
        --verbose)
            exec 3>&1;
            exec 4>&2;
            ;;
        --version)
            echo "Version: ${VERSION}";
            exit 0;
            ;;
        -y|--yes)
            o_yes=true;
            ;;
        --)
            shift;
            break;
            ;;
        *)
            break;
            ;;
    esac
    shift;
done

if [ "$o_update" = true ]; then
    if update; then
        exit 0;
    else
        exit 1;
    fi
fi

if [ "$o_setup" = true ]; then
    set -euxC;

    if ! check_setpriv >/dev/null 2>&1; then
        echo 'setpriv is not installed or is out of date. Attempting to install setpriv...';

        # Attempt to install setpriv with apk.
        if (apk update && apk -s add setpriv) >/dev/null 2>&1; then
            apk add --no-cache "setpriv>=$SETPRIV_VERSION";
            hash -r;
            check_setpriv;
            echo 'setpriv installed!';

        # Attempt to install setpriv from util-linux with apt-get.
        elif (apt-get update && apt-get install --dry-run util-linux) >/dev/null 2>&1; then
            apt-get satisfy --no-install-recommends -y "util-linux (>=$UTIL_LINUX_VERSION)";
            hash -r;
            check_setpriv;
            echo 'setpriv installed!';

        # Attempt to install gosu as a fallback.
        elif ! check_gosu >/dev/null 2>&1; then
            echo 'gosu is not installed or is out of date. Attempting to install gosu...';

            unameArch="$(uname -m)";
            case "$unameArch" in
                aarch64) dpkgArch='arm64' ;;
                armv[67]*) dpkgArch='armhf' ;;
                i[3456]86) dpkgArch='i386' ;;
                ppc64le) dpkgArch='ppc64el' ;;
                riscv64 | s390x) dpkgArch="$unameArch" ;;
                x86_64) dpkgArch='amd64' ;;
                *) echo >&2 "error: unknown/unsupported architecture '$unameArch'"; exit 1 ;;
            esac

            mkdir -p /usr/local/bin/;
            wget -O /usr/local/bin/gosu "https://github.com/tianon/gosu/releases/download/$GOSU_VERSION/gosu-$dpkgArch";
            wget -O /usr/local/bin/gosu.asc "https://github.com/tianon/gosu/releases/download/$GOSU_VERSION/gosu-$dpkgArch.asc";

            GNUPGHOME="$(mktemp -d)";
            if command -v gpg >/dev/null; then
                gpg --batch --keyserver hkps://keys.openpgp.org --recv-keys B42F6819007F00F88E364FD4036A9C25BF357DD4;
                gpg --batch --verify /usr/local/bin/gosu.asc /usr/local/bin/gosu;
                gpgconf --kill all;
            fi
            rm -rf "$GNUPGHOME" /usr/local/bin/gosu.asc;
            chmod +x /usr/local/bin/gosu;
            check_gosu;
        fi
    fi
else
    set -eC;

    if [ -z "$HOST_MAPPED_GID" ]; then
        printf 'HOST_MAPPED_GID is unset\n' >&2;
        guard_failure=true;
    fi

    if [ -z "$HOST_MAPPED_GROUP" ]; then
        printf 'HOST_MAPPED_GROUP is unset\n' >&2;
        guard_failure=true;
    fi

    if [ -z "$HOST_MAPPED_UID" ]; then
        printf 'HOST_MAPPED_UID is unset\n' >&2;
        guard_failure=true;
    fi

    if [ -z "$HOST_MAPPED_USER" ]; then
        printf 'HOST_MAPPED_USER is unset\n' >&2;
        guard_failure=true;
    fi

    if [ "$guard_failure" = true ]; then
        exit 1;
    fi

    echo "CAPABILITIES=$CAPABILITIES" >&3;
    echo "HOST_MAPPED_GROUP=$HOST_MAPPED_GROUP" >&3;
    echo "HOST_MAPPED_GID=$HOST_MAPPED_GID" >&3;
    echo "HOST_MAPPED_USER=$HOST_MAPPED_USER" >&3;
    echo "HOST_MAPPED_UID=$HOST_MAPPED_UID" >&3;

    # Create/replace user if non-root.
    if [ $HOST_MAPPED_UID -ne 0 ] && [ "$HOST_MAPPED_USER" != 'root' ]; then
        if id -u "$HOST_MAPPED_USER" >/dev/null 2>&1; then
            echo "Removing user matching $HOST_MAPPED_USER: $(print_user $HOST_MAPPED_USER)" >&3;
            if command -v userdel >/dev/null; then
                userdel "$HOST_MAPPED_USER";
            else
                deluser "$HOST_MAPPED_USER" 2>/dev/null;
            fi
        fi

        uid_username="$(awk -F: "\$3 == $HOST_MAPPED_UID {print \$1}" /etc/passwd)";
        if id -u "$uid_username" >/dev/null 2>&1; then
            echo "Removing user matching UID $HOST_MAPPED_UID: $(print_user $uid_username)" >&3;
            if command -v userdel >/dev/null; then
                userdel "$uid_username";
            else
                deluser "$uid_username" 2>/dev/null;
            fi
        fi

        if command -v groupadd >/dev/null; then
            groupadd -g $HOST_MAPPED_GID "$HOST_MAPPED_GROUP" || true;
        else
            addgroup -g $HOST_MAPPED_GID "$HOST_MAPPED_GROUP" || true;
        fi
        gid_groupname="$(awk -F: "\$3 == $HOST_MAPPED_GID {print \$1}" /etc/group)";

        if command -v useradd >/dev/null; then
            useradd -g $HOST_MAPPED_GID -m -s /bin/sh -u $HOST_MAPPED_UID $HOST_MAPPED_USER 2>&3;
        else
            adduser -D -G "$gid_groupname" -s /bin/sh -u $HOST_MAPPED_UID $HOST_MAPPED_USER 2>&3;
        fi
        echo "Created user: $(print_user "$HOST_MAPPED_USER")" >&3;

        HOME_DIR="/home/$HOST_MAPPED_USER";
    else
        HOME_DIR="/root";
    fi

    # Set the ownership of a set of items to the user.
    if [ -n "$CHOWN_LIST" ]; then
        echo "$CHOWN_LIST" | xargs chown -c "$HOST_MAPPED_UID:$HOST_MAPPED_GID" >&3 2>&4 || true;
    fi

    # Execute using $HOST_MAPPED_UID.
    if check_setpriv >/dev/null 2>&1; then
        if [ -n "$CAPABILITIES" ]; then
            capabilities="-all,$CAPABILITIES";
        else
            capabilities='-all';
        fi

        echo "HOME=$HOME_DIR LOGNAME=$HOST_MAPPED_USER SHELL=/bin/sh USER=$HOST_MAPPED_USER setpriv --bounding-set \"$capabilities\" --init-groups --no-new-privs --reuid=$HOST_MAPPED_UID --regid=$HOST_MAPPED_GID ..." >&3;
        HOME="$HOME_DIR" LOGNAME="$HOST_MAPPED_USER" SHELL='/bin/sh' USER="$HOST_MAPPED_USER" setpriv --bounding-set "$capabilities" --init-groups --no-new-privs --reuid=$HOST_MAPPED_UID --regid=$HOST_MAPPED_GID "$@";
    elif command -v gosu >/dev/null; then
        echo "HOME=$HOME_DIR LOGNAME=$HOST_MAPPED_USER SHELL=/bin/sh USER=$HOST_MAPPED_USER gosu "$HOST_MAPPED_UID:$HOST_MAPPED_GID" ..." >&3;
        HOME="$HOME_DIR" LOGNAME="$HOST_MAPPED_USER" SHELL='/bin/sh' USER="$HOST_MAPPED_USER" gosu "$HOST_MAPPED_UID:$HOST_MAPPED_GID" "$@";
    else
        printf 'Unable to set user\n' >&2;
        exit 1;
    fi
fi