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
$ublRootXsd = UBLResourcePaths::rootXsd('EN16931', 'Invoice');
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

---

Forum National de la Facture - Réforme Facture Electronique en France - 
Socle minimum - XP Z12-012, Z12-014

## Validation Artefact for France CTC e-invoicing mandate

Standard XP_Z12-012 can be found on this link : https://www.boutique.afnor.org/fr-fr/norme/xp-z12012/formats-et-profils-des-messages-factures-et-statuts-de-cycle-de-vie-constit/fa301169/601641

Standard XP_Z12-014 (Use case for France CTC e-invoicing mandate reform in France) can be found on this link : https://www.boutique.afnor.org/fr-fr/norme/xp-z12014/-cas-dusage-b2b-applicables-dans-le-cadre-la-reforme-facture-electronique-e/fa301171/601640

Standard XP_Z12-013 (standard API for last mile to connect Plateformes Agrées), on this link : https://www.boutique.afnor.org/fr-fr/norme/xp-z12013/api-pour-interfacer-les-systemes-dinformations-des-entreprises-avec-les-pla/fa301170/601639
