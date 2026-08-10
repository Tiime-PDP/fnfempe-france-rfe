#!/usr/bin/env bash

set -euo pipefail

UPSTREAM_REPO_URL="${UPSTREAM_REPO_URL:-https://github.com/fnfempe/France_RFE.git}"
UPSTREAM_SOURCE_DIR="${UPSTREAM_SOURCE_DIR:-FNFE_RFE_INVOICE}"
VENDOR_DATA_DIR="${VENDOR_DATA_DIR:-resources}"

usage() {
  echo "Usage:"
  echo "  $0 --tag <tag>"
  echo "  $0 --latest"
}

sync_tag() {
  local tag="$1"

  git fetch --no-tags "${UPSTREAM_REPO_URL}" "refs/tags/${tag}:refs/tags/${tag}"
  rm -rf "${VENDOR_DATA_DIR}"
  git checkout "refs/tags/${tag}" -- "${UPSTREAM_SOURCE_DIR}"
  mkdir -p "$(dirname "${VENDOR_DATA_DIR}")"
  mv "${UPSTREAM_SOURCE_DIR}" "${VENDOR_DATA_DIR}"
}

main() {
  if [[ $# -eq 0 ]]; then
    usage
    exit 1
  fi

  case "${1}" in
    --tag)
      if [[ $# -ne 2 || -z "${2}" ]]; then
        echo "Error: --tag requires a value."
        usage
        exit 1
      fi
      sync_tag "${2}"
      ;;
    --latest)
      if [[ $# -ne 1 ]]; then
        echo "Error: --latest takes no additional arguments."
        usage
        exit 1
      fi
      latest_tag="$(gh api repos/fnfempe/France_RFE/releases/latest --jq '.tag_name')"
      sync_tag "${latest_tag}"
      ;;
    *)
      echo "Error: unknown argument '${1}'."
      usage
      exit 1
      ;;
  esac
}

main "$@"
