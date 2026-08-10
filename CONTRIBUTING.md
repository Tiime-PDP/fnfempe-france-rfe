# Contributing

## Prerequisites

- PHP 8.2+ (CI runs 8.2, 8.4, 8.5)
- Composer v2
- `gh` CLI (required for `--latest` sync mode)

## Setup

```bash
composer update
composer test
```

## Repository structure

- `resources/`: upstream FNFE/FEMEP artifacts (XSD/XSLT/Schematron, etc.)
- `src/`: PHP wrapper code
- `tests/`: PHPUnit tests
- `bin/sync-upstream.sh`: upstream synchronization script

## Sync upstream artifacts

Use the sync script from repository root:

```bash
# Sync a specific upstream release tag
bin/sync-upstream.sh --tag v1.4.0.03

# Sync latest upstream release
bin/sync-upstream.sh --latest
```

Optional environment overrides:

- `UPSTREAM_REPO_URL` (default: `https://github.com/fnfempe/France_RFE.git`)
- `UPSTREAM_SOURCE_DIR` (default: `FNFE_RFE_INVOICE`)
- `VENDOR_DATA_DIR` (default: `resources`)

Example:

```bash
UPSTREAM_SOURCE_DIR=FNFE_RFE_INVOICE VENDOR_DATA_DIR=resources bin/sync-upstream.sh --latest
```

## Tests and CI

- Run locally: `composer test`
- Workflow: `.github/workflows/tests.yml`
  - triggers on `push` to `main` and on `pull_request`
  - runs dependency update, Composer validation, and PHPUnit

## Monthly automated upstream check

Workflow: `.github/workflows/upstream-version-check.yml`

- runs monthly and on manual dispatch
- checks latest upstream release
- syncs `resources` when a new tag is detected
- updates `.github/upstream-france-rfe-version.txt`
- opens an automated pull request

## Contribution flow

1. Create a branch from `main`
2. Implement your change
3. Run `composer test`
4. Open a pull request with a clear description
