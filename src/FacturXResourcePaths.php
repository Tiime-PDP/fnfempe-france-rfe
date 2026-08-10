<?php

declare(strict_types=1);

namespace TiimePDP\FNFEMEPFranceRFE;

final class FacturXResourcePaths
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

    private static function normalizeVersion(string $version): string
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

    public static function xsdDir(string $version = 'EN16931'): string
    {
        $version = self::normalizeVersion($version);
        return self::file("Factur-X/{$version}/1xsd");
    }

    public static function baseSchematron(string $version = 'EN16931'): string
    {
        $version = self::normalizeVersion($version);
        $baseName = match ($version) {
            'BASICWL' => 'FACTUR-X_BASIC-WL',
            'EN16931' => 'FACTUR-X_EN16931',
            'EXTENDED' => 'FACTUR-X_EXTENDED',
        };

        return self::file("Factur-X/{$version}/schematron/{$baseName}.sch");
    }

    public static function brFrSchematron(string $version = 'EN16931', bool $withWarning = false): string
    {
        $version = self::normalizeVersion($version);
        $suffix = $withWarning ? '_WARNING' : '';

        return self::file("Factur-X/{$version}/schematron/BR-FR-Flux2-Schematron-CII{$suffix}.sch");
    }

    public static function baseXslt(string $version = 'EN16931'): string
    {
        $version = self::normalizeVersion($version);
        $baseName = match ($version) {
            'BASICWL' => 'FACTUR-X_BASIC-WL',
            'EN16931' => 'FACTUR-X_EN16931',
            'EXTENDED' => 'FACTUR-X_EXTENDED',
        };

        return self::file("Factur-X/{$version}/2xslt/{$baseName}.xslt");
    }

    public static function brFrXslt(string $version = 'EN16931', bool $withWarning = false): string
    {
        $version = self::normalizeVersion($version);
        $suffix = $withWarning ? '_WARNING' : '';

        return self::file("Factur-X/{$version}/2xslt/BR-FR-Flux2-Schematron-CII{$suffix}.xslt");
    }
}
