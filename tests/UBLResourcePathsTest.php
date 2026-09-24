<?php

declare(strict_types=1);

namespace TiimePDP\FNFEMEPFranceRFE\Tests;

use PHPUnit\Framework\TestCase;
use TiimePDP\FNFEMEPFranceRFE\UBLResourcePaths;

/**
 * @internal
 *
 * @coversNothing
 */
final class UBLResourcePathsTest extends TestCase
{
    public function testUblPaths(): void
    {
        self::assertSame($this->resourcesBase().'/UBL/1xsd_UBL2.1', UBLResourcePaths::xsdDir());
        self::assertSame($this->resourcesBase().'/UBL/EN16931/schematron', UBLResourcePaths::schematronDir('EN16931'));
        self::assertSame(
            $this->resourcesBase().'/UBL/EN16931/schematron/EN16931-UBL-validation-preprocessed.sch',
            UBLResourcePaths::baseSchematron('EN16931')
        );
        self::assertSame(
            $this->resourcesBase().'/UBL/EN16931/schematron/BR-FR-Flux2-Schematron-UBL.sch',
            UBLResourcePaths::brFrSchematron('EN16931')
        );
        self::assertSame(
            $this->resourcesBase().'/UBL/EN16931/2xslt/EN16931-UBL-validation.xslt',
            UBLResourcePaths::baseXslt('EN16931')
        );
        self::assertSame(
            $this->resourcesBase().'/UBL/EN16931/2xslt/BR-FR-Flux2-Schematron-UBL.xslt',
            UBLResourcePaths::brFrXslt('EN16931')
        );
    }

    public function testUblExtendedCtcFrPaths(): void
    {
        self::assertSame($this->resourcesBase().'/UBL/EXTENDED-CTC-FR/schematron', UBLResourcePaths::schematronDir('EXTENDED-CTC-FR'));
        self::assertSame(
            $this->resourcesBase().'/UBL/EXTENDED-CTC-FR/schematron/EXTENDED-CTC-FR-UBL.sch',
            UBLResourcePaths::baseSchematron('EXTENDED-CTC-FR')
        );
        self::assertSame(
            $this->resourcesBase().'/UBL/EXTENDED-CTC-FR/2xslt/EXTENDED-CTC-FR-UBL.xslt',
            UBLResourcePaths::baseXslt('EXTENDED-CTC-FR')
        );
    }

    public function testUblRootXsdByDocumentType(): void
    {
        self::assertSame(
            $this->resourcesBase().'/UBL/1xsd_UBL2.1/maindoc/UBL-Invoice-2.1.xsd',
            UBLResourcePaths::rootXsd('Invoice')
        );
        self::assertSame(
            $this->resourcesBase().'/UBL/1xsd_UBL2.1/maindoc/UBL-CreditNote-2.1.xsd',
            UBLResourcePaths::rootXsd('CreditNote')
        );
    }

    public function testUblBrFrXsltWithWarning(): void
    {
        self::assertSame(
            $this->resourcesBase().'/UBL/EXTENDED-CTC-FR/2xslt/BR-FR-Flux2-Schematron-UBL_WARNING.xslt',
            UBLResourcePaths::brFrXslt('EXTENDED-CTC-FR', true)
        );
    }

    public function testUblInvalidProfileThrowsException(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage("Unsupported UBL profile 'UNKNOWN'");

        UBLResourcePaths::baseSchematron('UNKNOWN');
    }

    private function resourcesBase(): string
    {
        return dirname(__DIR__).'/resources';
    }
}
