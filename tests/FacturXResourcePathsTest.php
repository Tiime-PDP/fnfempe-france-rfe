<?php

declare(strict_types=1);

namespace TiimePDP\FNFEMEPFranceRFE\Tests;

use PHPUnit\Framework\TestCase;
use TiimePDP\FNFEMEPFranceRFE\FacturXResourcePaths;

final class FacturXResourcePathsTest extends TestCase
{
    public function testFacturXBasicWlPaths(): void
    {
        self::assertSame($this->resourcesBase() . '/Factur-X/BASICWL/1xsd', FacturXResourcePaths::xsdDir('BASICWL'));
        self::assertSame(
            $this->resourcesBase() . '/Factur-X/BASICWL/schematron/FACTUR-X_BASIC-WL.sch',
            FacturXResourcePaths::baseSchematron('BASICWL')
        );
        self::assertSame(
            $this->resourcesBase() . '/Factur-X/BASICWL/schematron/BR-FR-Flux2-Schematron-CII.sch',
            FacturXResourcePaths::brFrSchematron('BASICWL')
        );
        self::assertSame(
            $this->resourcesBase() . '/Factur-X/BASICWL/2xslt/FACTUR-X_BASIC-WL.xslt',
            FacturXResourcePaths::baseXslt('BASICWL')
        );
        self::assertSame(
            $this->resourcesBase() . '/Factur-X/BASICWL/2xslt/BR-FR-Flux2-Schematron-CII.xslt',
            FacturXResourcePaths::brFrXslt('BASICWL')
        );
    }

    public function testFacturXEn16931Paths(): void
    {
        self::assertSame($this->resourcesBase() . '/Factur-X/EN16931/1xsd', FacturXResourcePaths::xsdDir('EN16931'));
        self::assertSame(
            $this->resourcesBase() . '/Factur-X/EN16931/schematron/FACTUR-X_EN16931.sch',
            FacturXResourcePaths::baseSchematron('EN16931')
        );
    }

    public function testFacturXExtendedPaths(): void
    {
        self::assertSame($this->resourcesBase() . '/Factur-X/EXTENDED/1xsd', FacturXResourcePaths::xsdDir('EXTENDED'));
        self::assertSame(
            $this->resourcesBase() . '/Factur-X/EXTENDED/schematron/FACTUR-X_EXTENDED.sch',
            FacturXResourcePaths::baseSchematron('EXTENDED')
        );
    }

    public function testFacturXBrFrXsltWithWarning(): void
    {
        self::assertSame(
            $this->resourcesBase() . '/Factur-X/BASICWL/2xslt/BR-FR-Flux2-Schematron-CII_WARNING.xslt',
            FacturXResourcePaths::brFrXslt('BASICWL', true)
        );
    }

    public function testFacturXInvalidVersionThrowsException(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage("Unsupported Factur-X version 'UNKNOWN'");

        FacturXResourcePaths::baseSchematron('UNKNOWN');
    }

    private function resourcesBase(): string
    {
        return dirname(__DIR__) . '/resources';
    }
}
