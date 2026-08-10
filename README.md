# France_RFE PHP Wrapper

PHP library wrapper around the source project https://github.com/fnfempe/France_RFE.

## Installation

Install it with Composer:

```bash
composer require tiimepdp/fnfempe-france-rfe
```

## PHP helpers for resource paths

```php
<?php

use TiimePDP\FNFEMEPFranceRFE\CiiResourcePaths;
use TiimePDP\FNFEMEPFranceRFE\UblResourcePaths;
use TiimePDP\FNFEMEPFranceRFE\FacturXResourcePaths;
use TiimePDP\FNFEMEPFranceRFE\CDARResourcePaths;

$cii = CiiResourcePaths::create('EN16931');
$ciiXsdDir = $cii->xsdDir();
$ciiBaseSchematron = $cii->baseSchematron();
$ciiBrFrSchematronWarning = $cii->brFrSchematron(true);
$ciiBaseXslt = $cii->baseXslt();
$ciiBrFrXslt = $cii->brFrXslt();

$ubl = UblResourcePaths::create('EXTENDED-CTC-FR');
$ublXsdDir = $ubl->xsdDir();
$ublSchematronDir = $ubl->schematronDir();
$ublBaseSchematron = $ubl->baseSchematron();
$ublBrFrSchematron = $ubl->brFrSchematron();
$ublBaseXslt = $ubl->baseXslt();
$ublBrFrXsltWarning = $ubl->brFrXslt(true);

$facturX = FacturXResourcePaths::create('BASICWL');
$facturXXsdDir = $facturX->xsdDir();
$facturXBaseSchematron = $facturX->baseSchematron();
$facturXBrFrSchematronWarning = $facturX->brFrSchematron(true);
$facturXBaseXslt = $facturX->baseXslt();
$facturXBrFrXslt = $facturX->brFrXslt();

$cdar = CDARResourcePaths::create();
$cdarXsdDir = $cdar->xsdDir();
$cdarBrFrSchematron = $cdar->brFrSchematron();
$cdarBrFrSchematronWarning = $cdar->brFrSchematron(true);
$cdarBrFrXslt = $cdar->brFrXslt();
$cdarBrFrXsltWarning = $cdar->brFrXslt(true);
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
