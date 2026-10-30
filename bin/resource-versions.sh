#!/usr/bin/env bash

set -euo pipefail

ROOT_DIR="$(cd -- "$(dirname -- "${BASH_SOURCE[0]}")/.." && pwd)"
CSV=false

case "${1:-}" in
  -h|--help)
    echo "Usage: $0 [--csv]"
    echo "List bundled XSD/SCH versions (tab-separated: type, format, profile, version, source, file, validator)."
    echo "  --csv  Output comma-separated values instead."
    exit 0
    ;;
  --csv)
    CSV=true
    shift
    ;;
esac
if [[ $# -ne 0 ]]; then
  echo "Error: unexpected argument '$1'." >&2
  exit 1
fi

print_row() {
  if [[ "${CSV}" == true ]]; then
    local field separator=""
    for field in "$@"; do
      field="${field//\"/\"\"}"
      printf '%s"%s"' "${separator}" "${field}"
      separator=","
    done
    printf '\n'
  else
    local field separator=""
    for field in "$@"; do
      printf '%s%s' "${separator}" "${field}"
      separator=$'\t'
    done
    printf '\n'
  fi
}

cd -- "${ROOT_DIR}"
print_row TYPE FORMAT PROFILE VERSION SOURCE FILE VALIDATOR
while IFS= read -r -d '' file; do
  version="$(awk -v path="${file}" '
    function report(value, source) {
      printf "%s\t%s", value, source
      found = 1
      exit
    }
    function extract(value, pattern) {
      match(value, pattern)
      return substr(value, RSTART, RLENGTH)
    }
    {
      # Examiner uniquement les metadonnees avant la premiere declaration ou regle.
      if ($0 ~ /<([[:alnum:]_]+:)?(element|simpleType|complexType|pattern|rule)([[:space:]>])/) exit

      if (path ~ /\.sch$/) {
        if ($0 ~ /<!--[[:space:]]*(Schematron|FLUX10).*[_Vv][0-9]+\.[0-9]+/) {
          value = extract($0, "[_Vv][0-9]+(\\.[0-9]+)+")
          sub(/^[_Vv]/, "", value)
          report(value, "comment")
        }
        if ($0 ~ /<!--[[:space:]]*Schematron version [0-9]/)
          report(extract($0, "[0-9]+(\\.[0-9]+)+"), "comment")
        if ($0 ~ /^[[:space:]]*Version:[[:space:]]*[0-9]/)
          report(extract($0, "[0-9]+(\\.[0-9]+)+"), "metadata")
      } else {
        if ($0 ~ /^[[:space:]]*VersionID:[[:space:]]*[0-9]/)
          report(extract($0, "[0-9]+(\\.[0-9]+)+"), "metadata")
        if ($0 ~ /<([[:alnum:]_]+:)?schema([[:space:]>])/) in_schema = 1
        if (in_schema) {
          schema = schema " " $0
          if ($0 ~ />/) {
            if (schema ~ /[[:space:]]version[[:space:]]*=/) {
              value = schema
              sub(/^.*[[:space:]]version[[:space:]]*=[[:space:]]*["\047]/, "", value)
              sub(/["\047].*$/, "", value)
              report(value, "schema/@version")
            }
            if (schema ~ /targetNamespace=["\047]http:\/\/uri\.etsi\.org\/01903\/v[0-9.]+#/) {
              value = extract(schema, "http://uri\\.etsi\\.org/01903/v[0-9.]+")
              sub(/^.*\/v/, "", value)
              report(value, "schema/@targetNamespace")
            }
            in_schema = 0
          }
        }
        if (path ~ /\/Factur-X\// && (path " " $0) ~ /Factur-X_[0-9]+\.[0-9]+/) {
          value = extract(path " " $0, "Factur-X_[0-9]+(\\.[0-9]+)+")
          sub(/^Factur-X_/, "", value)
          report(value, "filename/import")
        }
      }
    }
    END {
      if (!found) printf "unknown\tnot declared"
    }
  ' "${file}")"
  type="${file##*.}"
  resource_path="${file#resources/}"
  format="${resource_path%%/*}"
  profile_path="${resource_path#*/}"
  profile="${profile_path%%/*}"
  case "${format}/${profile}" in
    CII/1xsd*|UBL/1xsd*) profile="all" ;;
    CDAR/*|Flux10/*) profile="n/a" ;;
  esac
  print_row "${type^^}" "${format}" "${profile}" "${version%%$'\t'*}" \
    "${version#*$'\t'}" "${file}" "${file##*/}"
done < <(find resources -type f \( -name '*.xsd' -o -name '*.sch' \) -print0 | LC_ALL=C sort -z)
