<?php

declare(strict_types=1);

namespace TiimePDP\FNFEMEPFranceRFE;

final class ResourcePaths
{
    public static function base(): string
    {
        $path = realpath(__DIR__ . '/../resources');
        if ($path === false) {
            throw new \RuntimeException('Unable to resolve resources directory path.');
        }

        return $path;
    }

    public static function file(string $relativePath): string
    {
        return self::base() . '/' . ltrim($relativePath, '/');
    }

    public static function ciiXsdDir(): string
    {
        return self::file('CII/1xsd-CII_D22B_uncoupled');
    }

    public static function ublSchematronDir(): string
    {
        return self::file('UBL/EN16931/schematron');
    }

    public static function cdarSchematron(bool $withWarning = false): string
    {
        $suffix = $withWarning ? '_WARNING' : '';

        return self::file("CDAR/schematron/BR-FR-CDV-Schematron-CDAR{$suffix}.sch");
    }

    public static function cdarXslt(bool $withWarning = false): string
    {
        $suffix = $withWarning ? '_WARNING' : '';

        return self::file("CDAR/2xslt/BR-FR-CDV-Schematron-CDAR{$suffix}.xslt");
    }

    public static function facturXSchematron(string $version = 'EN16931', bool $withWarning = false): string
    {
        $normalizedVersion = self::normalizeFacturXVersion($version);
        $suffix = $withWarning ? '_WARNING' : '';

        return self::file("Factur-X/{$normalizedVersion}/schematron/BR-FR-Flux2-Schematron-CII{$suffix}.sch");
    }

    public static function facturXXslt(string $version = 'EN16931', bool $withWarning = false): string
    {
        $normalizedVersion = self::normalizeFacturXVersion($version);
        $suffix = $withWarning ? '_WARNING' : '';

        return self::file("Factur-X/{$normalizedVersion}/2xslt/BR-FR-Flux2-Schematron-CII{$suffix}.xslt");
    }

    private static function normalizeFacturXVersion(string $version): string
    {
        $normalizedVersion = strtoupper(trim($version));

        return match ($normalizedVersion) {
            'BASICWL' => 'BASICWL',
            'EN16931' => 'EN16931',
            'EXTENDED' => 'EXTENDED',
            default => throw new \InvalidArgumentException(sprintf(
                "Unsupported Factur-X version '%s'. Expected one of: BASICWL, EN16931, EXTENDED.",
                $version
            )),
        };
    }
}
