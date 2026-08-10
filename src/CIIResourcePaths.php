<?php

declare(strict_types=1);

namespace TiimePDP\FNFEMEPFranceRFE;

final class CIIResourcePaths
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
                "Unsupported CII version '%s'. Expected one of: EN16931, EXTENDED-CTC-FR.",
                $version
            )),
        };
    }

    public static function xsdDir(): string
    {
        return self::file('CII/1xsd-CII_D22B_uncoupled');
    }

    public static function baseSchematron(string $version = 'EN16931'): string
    {
        $version = self::normalizeVersion($version);
        $baseName = match ($version) {
            'EN16931' => 'EN16931-CII-validation-preprocessed',
            'EXTENDED-CTC-FR' => 'EXTENDED-CTC-FR-CII',
        };

        return self::file("CII/{$version}/schematron/{$baseName}.sch");
    }

    public static function brFrSchematron(string $version = 'EN16931', bool $withWarning = false): string
    {
        $version = self::normalizeVersion($version);
        $suffix = $withWarning ? '_WARNING' : '';

        return self::file("CII/{$version}/schematron/BR-FR-Flux2-Schematron-CII{$suffix}.sch");
    }

    public static function baseXslt(string $version = 'EN16931'): string
    {
        $version = self::normalizeVersion($version);
        $baseName = match ($version) {
            'EN16931' => 'EN16931-CII-validation',
            'EXTENDED-CTC-FR' => 'EXTENDED-CTC-FR-CII',
        };

        return self::file("CII/{$version}/2xslt/{$baseName}.xslt");
    }

    public static function brFrXslt(string $version = 'EN16931', bool $withWarning = false): string
    {
        $version = self::normalizeVersion($version);
        $suffix = $withWarning ? '_WARNING' : '';

        return self::file("CII/{$version}/2xslt/BR-FR-Flux2-Schematron-CII{$suffix}.xslt");
    }
}
