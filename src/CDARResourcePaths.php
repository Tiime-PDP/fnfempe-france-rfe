<?php

declare(strict_types=1);

namespace TiimePDP\FNFEMEPFranceRFE;

final class CDARResourcePaths
{
    /**
     * @return string The path to the directory containing the XSD files for CDAR D22B
     */
    public static function xsdDir(): string
    {
        return self::path('CDAR/1xsd-CDAR_D22B_uncoupled');
    }

    /**
     * @return string The path to the root XSD for CDAR D22B
     */
    public static function rootXsd(): string
    {
        return self::path(
            'CDAR/1xsd-CDAR_D22B_uncoupled/CrossDomainAcknowledgementAndResponse_100pD22B.xsd'
        );
    }

    /**
     * @param bool $withWarning Whether to return the schematron with or without warnings
     *
     * @return string The path to the BR-FR schematron for CDAR D22B, with or without warnings
     */
    public static function brFrSchematron(bool $withWarning = false): string
    {
        $suffix = $withWarning ? '_WARNING' : '';

        return self::path("CDAR/schematron/BR-FR-CDV-Schematron-CDAR{$suffix}.sch");
    }

    /**
     * @param bool $withWarning Whether to return the XSLT with or without warnings
     *
     * @return string The path to the BR-FR XSLT for CDAR D22B, with or without warnings
     */
    public static function brFrXslt(bool $withWarning = false): string
    {
        $suffix = $withWarning ? '_WARNING' : '';

        return self::path("CDAR/2xslt/BR-FR-CDV-Schematron-CDAR{$suffix}.xslt");
    }

    private static function basePath(): string
    {
        // @phpstan-ignore-next-line
        return realpath(__DIR__.'/../resources');
    }

    private static function path(string $relativePath): string
    {
        return self::basePath().'/'.ltrim($relativePath, '/');
    }
}
