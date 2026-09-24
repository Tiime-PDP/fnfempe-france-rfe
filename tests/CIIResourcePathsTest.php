<?php

declare(strict_types=1);

namespace TiimePDP\FNFEMEPFranceRFE\Tests;

use PHPUnit\Framework\TestCase;
use TiimePDP\FNFEMEPFranceRFE\CIIResourcePaths;

/**
 * @internal
 *
 * @coversNothing
 */
final class CIIResourcePathsTest extends TestCase
{
    public function testCiiPaths(): void
    {
        self::assertSame($this->resourcesBase().'/CII/1xsd-CII_D22B_uncoupled', CIIResourcePaths::xsdDir());
        self::assertSame(
            $this->resourcesBase().'/CII/EN16931/schematron/EN16931-CII-validation-preprocessed.sch',
            CIIResourcePaths::baseSchematron('EN16931')
        );
        self::assertSame(
            $this->resourcesBase().'/CII/EN16931/schematron/BR-FR-Flux2-Schematron-CII_WARNING.sch',
            CIIResourcePaths::brFrSchematron('EN16931', true)
        );
        self::assertSame(
            $this->resourcesBase().'/CII/EN16931/2xslt/EN16931-CII-validation.xslt',
            CIIResourcePaths::baseXslt('EN16931')
        );
        self::assertSame(
            $this->resourcesBase().'/CII/EN16931/2xslt/BR-FR-Flux2-Schematron-CII.xslt',
            CIIResourcePaths::brFrXslt('EN16931')
        );
    }

    public function testCiiExtendedCtcFrPaths(): void
    {
        self::assertSame(
            $this->resourcesBase().'/CII/EXTENDED-CTC-FR/schematron/EXTENDED-CTC-FR-CII.sch',
            CIIResourcePaths::baseSchematron('EXTENDED-CTC-FR')
        );
        self::assertSame(
            $this->resourcesBase().'/CII/EXTENDED-CTC-FR/2xslt/EXTENDED-CTC-FR-CII.xslt',
            CIIResourcePaths::baseXslt('EXTENDED-CTC-FR')
        );
    }

    public function testCiiRootXsd(): void
    {
        self::assertSame(
            $this->resourcesBase().'/CII/1xsd-CII_D22B_uncoupled/CrossIndustryInvoice_100pD22B.xsd',
            CIIResourcePaths::rootXsd()
        );
    }

    public function testCiiInvalidProfileThrowsException(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage("Unsupported CII profile 'UNKNOWN'");

        CIIResourcePaths::baseSchematron('UNKNOWN');
    }

    private function resourcesBase(): string
    {
        return dirname(__DIR__).'/resources';
    }
}
