UPSTREAM_REPO_URL ?= https://github.com/fnfempe/France_RFE.git
UPSTREAM_SOURCE_DIR ?= FNFE_RFE_INVOICE
VENDOR_DATA_DIR ?= resources
TAG ?=

.PHONY: sync-upstream sync-upstream-latest

sync-upstream:
	@test -n "$(TAG)" || (echo "TAG is required (example: make sync-upstream TAG=v1.4.0.03)" && exit 1)
	git fetch --no-tags $(UPSTREAM_REPO_URL) "refs/tags/$(TAG):refs/tags/$(TAG)"
	rm -rf $(VENDOR_DATA_DIR)
	git checkout "refs/tags/$(TAG)" -- $(UPSTREAM_SOURCE_DIR)
	mkdir -p $(dir $(VENDOR_DATA_DIR))
	mv $(UPSTREAM_SOURCE_DIR) $(VENDOR_DATA_DIR)

sync-upstream-latest:
	@LATEST_TAG="$$(gh api repos/fnfempe/France_RFE/releases/latest --jq '.tag_name')"; \
	$(MAKE) sync-upstream TAG="$$LATEST_TAG"
