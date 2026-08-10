<?php

declare(strict_types=1);

namespace TiimePDP\FNFEMEPFranceRFE;

final class UblResourcePaths
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
            'EN16931' => 'EN16931',
            'EXTENDED-CTC-FR' => 'EXTENDED-CTC-FR',
            default => throw new \InvalidArgumentException(sprintf(
                "Unsupported UBL version '%s'. Expected one of: EN16931, EXTENDED-CTC-FR.",
                $version
            )),
        };
    }

    public static function xsdDir(): string
    {
        return self::file('UBL/1xsd_UBL2.1');
    }

    public static function schematronDir(string $version = 'EN16931'): string
    {
        $version = self::normalizeVersion($version);
        return self::file("UBL/{$version}/schematron");
    }

    public static function baseSchematron(string $version = 'EN16931'): string
    {
        $version = self::normalizeVersion($version);
        $baseName = match ($version) {
            'EN16931' => 'EN16931-UBL-validation-preprocessed',
            'EXTENDED-CTC-FR' => 'EXTENDED-CTC-FR-UBL',
        };

        return self::file("UBL/{$version}/schematron/{$baseName}.sch");
    }

    public static function brFrSchematron(string $version = 'EN16931', bool $withWarning = false): string
    {
        $version = self::normalizeVersion($version);
        $suffix = $withWarning ? '_WARNING' : '';

        return self::file("UBL/{$version}/schematron/BR-FR-Flux2-Schematron-UBL{$suffix}.sch");
    }

    public static function baseXslt(string $version = 'EN16931'): string
    {
        $version = self::normalizeVersion($version);
        $baseName = match ($version) {
            'EN16931' => 'EN16931-UBL-validation',
            'EXTENDED-CTC-FR' => 'EXTENDED-CTC-FR-UBL',
        };

        return self::file("UBL/{$version}/2xslt/{$baseName}.xslt");
    }

    public static function brFrXslt(string $version = 'EN16931', bool $withWarning = false): string
    {
        $version = self::normalizeVersion($version);
        $suffix = $withWarning ? '_WARNING' : '';

        return self::file("UBL/{$version}/2xslt/BR-FR-Flux2-Schematron-UBL{$suffix}.xslt");
    }
}
