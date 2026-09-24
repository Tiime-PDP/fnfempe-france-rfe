<?php

declare(strict_types=1);

namespace TiimePDP\FNFEMEPFranceRFE\Tests;

use PHPUnit\Framework\TestCase;
use TiimePDP\FNFEMEPFranceRFE\CDARResourcePaths;

/**
 * @internal
 *
 * @coversNothing
 */
final class CDARResourcePathsTest extends TestCase
{
    public function testCdarPaths(): void
    {
        self::assertSame($this->resourcesBase().'/CDAR/1xsd-CDAR_D22B_uncoupled', CDARResourcePaths::xsdDir());
        self::assertSame(
            $this->resourcesBase().'/CDAR/schematron/BR-FR-CDV-Schematron-CDAR.sch',
            CDARResourcePaths::brFrSchematron()
        );
        self::assertSame(
            $this->resourcesBase().'/CDAR/2xslt/BR-FR-CDV-Schematron-CDAR.xslt',
            CDARResourcePaths::brFrXslt()
        );
    }

    public function testCdarBrFrSchematronWithWarning(): void
    {
        self::assertSame(
            $this->resourcesBase().'/CDAR/schematron/BR-FR-CDV-Schematron-CDAR_WARNING.sch',
            CDARResourcePaths::brFrSchematron(true)
        );
    }

    public function testCdarRootXsd(): void
    {
        self::assertSame(
            $this->resourcesBase().'/CDAR/1xsd-CDAR_D22B_uncoupled/CrossDomainAcknowledgementAndResponse_100pD22B.xsd',
            CDARResourcePaths::rootXsd()
        );
    }

    public function testCdarBrFrXsltWithWarning(): void
    {
        self::assertSame(
            $this->resourcesBase().'/CDAR/2xslt/BR-FR-CDV-Schematron-CDAR_WARNING.xslt',
            CDARResourcePaths::brFrXslt(true)
        );
    }

    private function resourcesBase(): string
    {
        return dirname(__DIR__).'/resources';
    }
}
