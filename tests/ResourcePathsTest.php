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
        $facturXXsdDir = ResourcePaths::facturXXsdDir('BASICWL');

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
        self::assertSame(
            $this->resourcesBase() . '/Factur-X/BASICWL/1xsd',
            $facturXXsdDir
        );
        self::assertFileExists($facturXSchematron);
        self::assertFileExists($facturXSchematronWarning);
        self::assertFileExists($facturXXslt);
        self::assertFileExists($facturXXsltWarning);
        self::assertDirectoryExists($facturXXsdDir);
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

    public function testCiiPathsWithVersionAndWarningVariants(): void
    {
        $ciiSchematron = ResourcePaths::ciiSchematron('EN16931');
        $ciiSchematronWarning = ResourcePaths::ciiSchematron('EXTENDED-CTC-FR', true);
        $ciiXslt = ResourcePaths::ciiXslt('EXTENDED-CTC-FR');
        $ciiXsltWarning = ResourcePaths::ciiXslt('EN16931', true);

        self::assertSame(
            $this->resourcesBase() . '/CII/EN16931/schematron/BR-FR-Flux2-Schematron-CII.sch',
            $ciiSchematron
        );
        self::assertSame(
            $this->resourcesBase() . '/CII/EXTENDED-CTC-FR/schematron/BR-FR-Flux2-Schematron-CII_WARNING.sch',
            $ciiSchematronWarning
        );
        self::assertSame(
            $this->resourcesBase() . '/CII/EXTENDED-CTC-FR/2xslt/BR-FR-Flux2-Schematron-CII.xslt',
            $ciiXslt
        );
        self::assertSame(
            $this->resourcesBase() . '/CII/EN16931/2xslt/BR-FR-Flux2-Schematron-CII_WARNING.xslt',
            $ciiXsltWarning
        );
        self::assertFileExists($ciiSchematron);
        self::assertFileExists($ciiSchematronWarning);
        self::assertFileExists($ciiXslt);
        self::assertFileExists($ciiXsltWarning);
    }

    public function testCiiVersionNormalization(): void
    {
        self::assertSame(
            $this->resourcesBase() . '/CII/EN16931/schematron/BR-FR-Flux2-Schematron-CII.sch',
            ResourcePaths::ciiSchematron(' en16931 ')
        );
    }

    public function testCiiInvalidVersionThrowsException(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage("Unsupported CII version 'UNKNOWN'");

        ResourcePaths::ciiSchematron('UNKNOWN');
    }

    public function testUblPathsWithVersionAndWarningVariants(): void
    {
        $ublSchematronDir = ResourcePaths::ublSchematronDir('EXTENDED-CTC-FR');
        $ublXsdDir = ResourcePaths::ublXsdDir();
        $ublSchematron = ResourcePaths::ublSchematron('EN16931');
        $ublSchematronWarning = ResourcePaths::ublSchematron('EXTENDED-CTC-FR', true);
        $ublXslt = ResourcePaths::ublXslt('EXTENDED-CTC-FR');
        $ublXsltWarning = ResourcePaths::ublXslt('EN16931', true);

        self::assertSame(
            $this->resourcesBase() . '/UBL/1xsd_UBL2.1',
            $ublXsdDir
        );
        self::assertSame(
            $this->resourcesBase() . '/UBL/EXTENDED-CTC-FR/schematron',
            $ublSchematronDir
        );
        self::assertSame(
            $this->resourcesBase() . '/UBL/EN16931/schematron/BR-FR-Flux2-Schematron-UBL.sch',
            $ublSchematron
        );
        self::assertSame(
            $this->resourcesBase() . '/UBL/EXTENDED-CTC-FR/schematron/BR-FR-Flux2-Schematron-UBL_WARNING.sch',
            $ublSchematronWarning
        );
        self::assertSame(
            $this->resourcesBase() . '/UBL/EXTENDED-CTC-FR/2xslt/BR-FR-Flux2-Schematron-UBL.xslt',
            $ublXslt
        );
        self::assertSame(
            $this->resourcesBase() . '/UBL/EN16931/2xslt/BR-FR-Flux2-Schematron-UBL_WARNING.xslt',
            $ublXsltWarning
        );
        self::assertDirectoryExists($ublXsdDir);
        self::assertDirectoryExists($ublSchematronDir);
        self::assertFileExists($ublSchematron);
        self::assertFileExists($ublSchematronWarning);
        self::assertFileExists($ublXslt);
        self::assertFileExists($ublXsltWarning);
    }

    public function testUblVersionNormalization(): void
    {
        self::assertSame(
            $this->resourcesBase() . '/UBL/EN16931/schematron/BR-FR-Flux2-Schematron-UBL.sch',
            ResourcePaths::ublSchematron(' en16931 ')
        );
    }

    public function testUblInvalidVersionThrowsException(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage("Unsupported UBL version 'UNKNOWN'");

        ResourcePaths::ublSchematron('UNKNOWN');
    }

    private function resourcesBase(): string
    {
        return dirname(__DIR__) . '/resources';
    }
}
