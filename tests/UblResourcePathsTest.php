<?php

declare(strict_types=1);

namespace TiimePDP\FNFEMEPFranceRFE\Tests;

use PHPUnit\Framework\TestCase;
use TiimePDP\FNFEMEPFranceRFE\UblResourcePaths;

final class UblResourcePathsTest extends TestCase
{
    public function testUblPaths(): void
    {
        self::assertSame($this->resourcesBase() . '/UBL/1xsd_UBL2.1', UblResourcePaths::xsdDir());
        self::assertSame($this->resourcesBase() . '/UBL/EN16931/schematron', UblResourcePaths::schematronDir('EN16931'));
        self::assertSame(
            $this->resourcesBase() . '/UBL/EN16931/schematron/EN16931-UBL-validation-preprocessed.sch',
            UblResourcePaths::baseSchematron('EN16931')
        );
        self::assertSame(
            $this->resourcesBase() . '/UBL/EN16931/schematron/BR-FR-Flux2-Schematron-UBL.sch',
            UblResourcePaths::brFrSchematron('EN16931')
        );
        self::assertSame(
            $this->resourcesBase() . '/UBL/EN16931/2xslt/EN16931-UBL-validation.xslt',
            UblResourcePaths::baseXslt('EN16931')
        );
        self::assertSame(
            $this->resourcesBase() . '/UBL/EN16931/2xslt/BR-FR-Flux2-Schematron-UBL.xslt',
            UblResourcePaths::brFrXslt('EN16931')
        );
    }

    public function testUblExtendedCtcFrPaths(): void
    {
        self::assertSame($this->resourcesBase() . '/UBL/EXTENDED-CTC-FR/schematron', UblResourcePaths::schematronDir('EXTENDED-CTC-FR'));
        self::assertSame(
            $this->resourcesBase() . '/UBL/EXTENDED-CTC-FR/schematron/EXTENDED-CTC-FR-UBL.sch',
            UblResourcePaths::baseSchematron('EXTENDED-CTC-FR')
        );
        self::assertSame(
            $this->resourcesBase() . '/UBL/EXTENDED-CTC-FR/2xslt/EXTENDED-CTC-FR-UBL.xslt',
            UblResourcePaths::baseXslt('EXTENDED-CTC-FR')
        );
    }

    public function testUblBrFrXsltWithWarning(): void
    {
        self::assertSame(
            $this->resourcesBase() . '/UBL/EXTENDED-CTC-FR/2xslt/BR-FR-Flux2-Schematron-UBL_WARNING.xslt',
            UblResourcePaths::brFrXslt('EXTENDED-CTC-FR', true)
        );
    }

    public function testUblInvalidVersionThrowsException(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage("Unsupported UBL version 'UNKNOWN'");

        UblResourcePaths::baseSchematron('UNKNOWN');
    }

    private function resourcesBase(): string
    {
        return dirname(__DIR__) . '/resources';
    }
}
