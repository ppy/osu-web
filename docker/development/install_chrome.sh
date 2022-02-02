#!/bin/sh

set -e

ARCH=`uname -m`

if [ "${ARCH}" = "x86_64" ]; then
  echo "Installing Chrome..."

  curl -LO https://dl.google.com/linux/direct/google-chrome-stable_current_amd64.deb && \
  DEBIAN_FRONTEND=noninteractive apt-get install -y ./google-chrome-stable_current_amd64.deb && \
  rm google-chrome-stable_current_amd64.deb
else
  echo "Unsupported architecture, not installing Chrome. Tests using ChromeDriver will not work!"
fi

