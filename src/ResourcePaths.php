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

    public static function ciiSchematron(string $version = 'EN16931', bool $withWarning = false): string
    {
        $normalizedVersion = self::normalizeCiiVersion($version);
        $suffix = $withWarning ? '_WARNING' : '';

        return self::file("CII/{$normalizedVersion}/schematron/BR-FR-Flux2-Schematron-CII{$suffix}.sch");
    }

    public static function ciiXslt(string $version = 'EN16931', bool $withWarning = false): string
    {
        $normalizedVersion = self::normalizeCiiVersion($version);
        $suffix = $withWarning ? '_WARNING' : '';

        return self::file("CII/{$normalizedVersion}/2xslt/BR-FR-Flux2-Schematron-CII{$suffix}.xslt");
    }

    public static function ublSchematronDir(string $version = 'EN16931'): string
    {
        $normalizedVersion = self::normalizeUblVersion($version);

        return self::file("UBL/{$normalizedVersion}/schematron");
    }

    public static function ublXsdDir(): string
    {
        return self::file('UBL/1xsd_UBL2.1');
    }

    public static function ublSchematron(string $version = 'EN16931', bool $withWarning = false): string
    {
        $normalizedVersion = self::normalizeUblVersion($version);
        $suffix = $withWarning ? '_WARNING' : '';

        return self::file("UBL/{$normalizedVersion}/schematron/BR-FR-Flux2-Schematron-UBL{$suffix}.sch");
    }

    public static function ublXslt(string $version = 'EN16931', bool $withWarning = false): string
    {
        $normalizedVersion = self::normalizeUblVersion($version);
        $suffix = $withWarning ? '_WARNING' : '';

        return self::file("UBL/{$normalizedVersion}/2xslt/BR-FR-Flux2-Schematron-UBL{$suffix}.xslt");
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

    public static function facturXXsdDir(string $version = 'EN16931'): string
    {
        $normalizedVersion = self::normalizeFacturXVersion($version);

        return self::file("Factur-X/{$normalizedVersion}/1xsd");
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

    private static function normalizeCiiVersion(string $version): string
    {
        $normalizedVersion = strtoupper(trim($version));

        return match ($normalizedVersion) {
            'EN16931' => 'EN16931',
            'EXTENDED-CTC-FR' => 'EXTENDED-CTC-FR',
            default => throw new \InvalidArgumentException(sprintf(
                "Unsupported CII version '%s'. Expected one of: EN16931, EXTENDED-CTC-FR.",
                $version
            )),
        };
    }

    private static function normalizeUblVersion(string $version): string
    {
        $normalizedVersion = strtoupper(trim($version));

        return match ($normalizedVersion) {
            'EN16931' => 'EN16931',
            'EXTENDED-CTC-FR' => 'EXTENDED-CTC-FR',
            default => throw new \InvalidArgumentException(sprintf(
                "Unsupported UBL version '%s'. Expected one of: EN16931, EXTENDED-CTC-FR.",
                $version
            )),
        };
    }
}
