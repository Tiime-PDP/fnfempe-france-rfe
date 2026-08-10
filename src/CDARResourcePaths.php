<?php

declare(strict_types=1);

namespace TiimePDP\FNFEMEPFranceRFE;

final class CDARResourcePaths
{
    private static function basePath(): string
    {
        $path = realpath(__DIR__ . '/../resources');
        if ($path === false) {
            throw new \RuntimeException('Unable to resolve resources directory path.');
        }
        return $path;
    }

    private static function file(string $relativePath): string
    {
        return self::basePath() . '/' . ltrim($relativePath, '/');
    }

    public static function xsdDir(): string
    {
        return self::file('CDAR/1xsd-CDAR_D22B_uncoupled');
    }

    public static function brFrSchematron(bool $withWarning = false): string
    {
        $suffix = $withWarning ? '_WARNING' : '';

        return self::file("CDAR/schematron/BR-FR-CDV-Schematron-CDAR{$suffix}.sch");
    }

    public static function brFrXslt(bool $withWarning = false): string
    {
        $suffix = $withWarning ? '_WARNING' : '';

        return self::file("CDAR/2xslt/BR-FR-CDV-Schematron-CDAR{$suffix}.xslt");
    }
}
