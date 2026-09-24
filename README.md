# FNFE France RFE PHP Wrapper

PHP library wrapper around the source project https://github.com/fnfempe/France_RFE.

## Installation

Install it with Composer:

```bash
composer require tiimepdp/fnfempe-france-rfe
```

## PHP helpers for resource paths

The resource path helpers are static and expose filesystem paths to the bundled standards.

```php
<?php

use TiimePDP\FNFEMEPFranceRFE\CIIResourcePaths;
use TiimePDP\FNFEMEPFranceRFE\UBLResourcePaths;
use TiimePDP\FNFEMEPFranceRFE\FacturXResourcePaths;
use TiimePDP\FNFEMEPFranceRFE\CDARResourcePaths;

$ciiXsdDir = CIIResourcePaths::xsdDir();
$ciiRootXsd = CIIResourcePaths::rootXsd();
$ciiBaseSchematron = CIIResourcePaths::baseSchematron('EN16931');
$ciiBrFrSchematronWarning = CIIResourcePaths::brFrSchematron('EN16931', true);
$ciiBaseXslt = CIIResourcePaths::baseXslt('EN16931');
$ciiBrFrXslt = CIIResourcePaths::brFrXslt('EN16931');

$ublXsdDir = UBLResourcePaths::xsdDir();
$ublRootXsd = UBLResourcePaths::rootXsd('Invoice');
$ublSchematronDir = UBLResourcePaths::schematronDir('EXTENDED-CTC-FR');
$ublBaseSchematron = UBLResourcePaths::baseSchematron('EXTENDED-CTC-FR');
$ublBrFrSchematron = UBLResourcePaths::brFrSchematron('EXTENDED-CTC-FR');
$ublBaseXslt = UBLResourcePaths::baseXslt('EXTENDED-CTC-FR');
$ublBrFrXsltWarning = UBLResourcePaths::brFrXslt('EXTENDED-CTC-FR', true);

$facturXXsdDir = FacturXResourcePaths::xsdDir('BASICWL');
$facturXRootXsd = FacturXResourcePaths::rootXsd('BASICWL');
$facturXBaseSchematron = FacturXResourcePaths::baseSchematron('BASICWL');
$facturXBrFrSchematronWarning = FacturXResourcePaths::brFrSchematron('BASICWL', true);
$facturXBaseXslt = FacturXResourcePaths::baseXslt('BASICWL');
$facturXBrFrXslt = FacturXResourcePaths::brFrXslt('BASICWL');

$cdarXsdDir = CDARResourcePaths::xsdDir();
$cdarRootXsd = CDARResourcePaths::rootXsd();
$cdarBrFrSchematron = CDARResourcePaths::brFrSchematron();
$cdarBrFrSchematronWarning = CDARResourcePaths::brFrSchematron(true);
$cdarBrFrXslt = CDARResourcePaths::brFrXslt();
$cdarBrFrXsltWarning = CDARResourcePaths::brFrXslt(true);
```

## Sync upstream artifacts

```bash
# Sync a specific upstream release
bin/sync-upstream.sh --tag v1.4.0.03

# Sync latest upstream release
bin/sync-upstream.sh --latest
```

The sync places upstream entries starting with `Z` into `docs/` and all other entries into `resources/`.