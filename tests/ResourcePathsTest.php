<?php

declare(strict_types=1);

namespace TiimePDP\FNFEMEPFranceRFE\Tests;

use PHPUnit\Framework\TestCase;
use TiimePDP\FNFEMEPFranceRFE\ResourcePaths;

final class ResourcePathsTest extends TestCase
{
    public function testBasePath(): void
    {
        $base = ResourcePaths::base();
        self::assertSame($this->resourcesBase(), $base);
        self::assertDirectoryExists($base);
    }

    public function testFilePath(): void
    {
        $path = ResourcePaths::file('/CII/1xsd-CII_D22B_uncoupled/CrossIndustryInvoice_100pD22B.xsd');
        self::assertSame(
            $this->resourcesBase() . '/CII/1xsd-CII_D22B_uncoupled/CrossIndustryInvoice_100pD22B.xsd',
            $path
        );
        self::assertFileExists($path);
    }

    public function testCdarPathsWithAndWithoutWarning(): void
    {
        $cdarSchematron = ResourcePaths::cdarSchematron();
        $cdarSchematronWarning = ResourcePaths::cdarSchematron(true);
        $cdarXslt = ResourcePaths::cdarXslt();
        $cdarXsltWarning = ResourcePaths::cdarXslt(true);

        self::assertSame(
            $this->resourcesBase() . '/CDAR/schematron/BR-FR-CDV-Schematron-CDAR.sch',
            $cdarSchematron
        );
        self::assertSame(
            $this->resourcesBase() . '/CDAR/schematron/BR-FR-CDV-Schematron-CDAR_WARNING.sch',
            $cdarSchematronWarning
        );
        self::assertSame(
            $this->resourcesBase() . '/CDAR/2xslt/BR-FR-CDV-Schematron-CDAR.xslt',
            $cdarXslt
        );
        self::assertSame(
            $this->resourcesBase() . '/CDAR/2xslt/BR-FR-CDV-Schematron-CDAR_WARNING.xslt',
            $cdarXsltWarning
        );
        self::assertFileExists($cdarSchematron);
        self::assertFileExists($cdarSchematronWarning);
        self::assertFileExists($cdarXslt);
        self::assertFileExists($cdarXsltWarning);
    }

    public function testFacturXPathForVersionAndWarningVariants(): void
    {
        $facturXSchematron = ResourcePaths::facturXSchematron('EN16931');
        $facturXSchematronWarning = ResourcePaths::facturXSchematron('EN16931', true);
        $facturXXslt = ResourcePaths::facturXXslt('BASICWL');
        $facturXXsltWarning = ResourcePaths::facturXXslt('EXTENDED', true);

        self::assertSame(
            $this->resourcesBase() . '/Factur-X/EN16931/schematron/BR-FR-Flux2-Schematron-CII.sch',
            $facturXSchematron
        );
        self::assertSame(
            $this->resourcesBase() . '/Factur-X/EN16931/schematron/BR-FR-Flux2-Schematron-CII_WARNING.sch',
            $facturXSchematronWarning
        );
        self::assertSame(
            $this->resourcesBase() . '/Factur-X/BASICWL/2xslt/BR-FR-Flux2-Schematron-CII.xslt',
            $facturXXslt
        );
        self::assertSame(
            $this->resourcesBase() . '/Factur-X/EXTENDED/2xslt/BR-FR-Flux2-Schematron-CII_WARNING.xslt',
            $facturXXsltWarning
        );
        self::assertFileExists($facturXSchematron);
        self::assertFileExists($facturXSchematronWarning);
        self::assertFileExists($facturXXslt);
        self::assertFileExists($facturXXsltWarning);
    }

    public function testFacturXVersionNormalization(): void
    {
        self::assertSame(
            $this->resourcesBase() . '/Factur-X/EN16931/schematron/BR-FR-Flux2-Schematron-CII.sch',
            ResourcePaths::facturXSchematron(' en16931 ')
        );
    }

    public function testFacturXInvalidVersionThrowsException(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage("Unsupported Factur-X version 'UNKNOWN'");

        ResourcePaths::facturXSchematron('UNKNOWN');
    }

    private function resourcesBase(): string
    {
        return dirname(__DIR__) . '/resources';
    }
}
