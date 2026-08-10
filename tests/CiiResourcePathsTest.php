<?php

declare(strict_types=1);

namespace TiimePDP\FNFEMEPFranceRFE\Tests;

use PHPUnit\Framework\TestCase;
use TiimePDP\FNFEMEPFranceRFE\CiiResourcePaths;

final class CiiResourcePathsTest extends TestCase
{
    public function testCiiPaths(): void
    {
        self::assertSame($this->resourcesBase() . '/CII/1xsd-CII_D22B_uncoupled', CiiResourcePaths::xsdDir());
        self::assertSame(
            $this->resourcesBase() . '/CII/EN16931/schematron/EN16931-CII-validation-preprocessed.sch',
            CiiResourcePaths::baseSchematron('EN16931')
        );
        self::assertSame(
            $this->resourcesBase() . '/CII/EN16931/schematron/BR-FR-Flux2-Schematron-CII_WARNING.sch',
            CiiResourcePaths::brFrSchematron('EN16931', true)
        );
        self::assertSame(
            $this->resourcesBase() . '/CII/EN16931/2xslt/EN16931-CII-validation.xslt',
            CiiResourcePaths::baseXslt('EN16931')
        );
        self::assertSame(
            $this->resourcesBase() . '/CII/EN16931/2xslt/BR-FR-Flux2-Schematron-CII.xslt',
            CiiResourcePaths::brFrXslt('EN16931')
        );
    }

    public function testCiiExtendedCtcFrPaths(): void
    {
        self::assertSame(
            $this->resourcesBase() . '/CII/EXTENDED-CTC-FR/schematron/EXTENDED-CTC-FR-CII.sch',
            CiiResourcePaths::baseSchematron('EXTENDED-CTC-FR')
        );
        self::assertSame(
            $this->resourcesBase() . '/CII/EXTENDED-CTC-FR/2xslt/EXTENDED-CTC-FR-CII.xslt',
            CiiResourcePaths::baseXslt('EXTENDED-CTC-FR')
        );
    }

    public function testCiiInvalidVersionThrowsException(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage("Unsupported CII version 'UNKNOWN'");

        CiiResourcePaths::baseSchematron('UNKNOWN');
    }

    private function resourcesBase(): string
    {
        return dirname(__DIR__) . '/resources';
    }
}
