<?php

declare(strict_types=1);

namespace TiimePDP\FNFEMEPFranceRFE;

final class FacturXResourcePaths
{
    /**
     * @param string $profile The Factur-X profile. Possible values: BASICWL, EN16931, EXTENDED. Default: EN16931.
     *
     * @return string the path to the XSD directory for the specified Factur-X profile
     *
     * @throws \InvalidArgumentException if the specified profile is not supported
     */
    public static function xsdDir(string $profile = 'EN16931'): string
    {
        $profile = self::normalizeProfile($profile);

        return self::path("Factur-X/{$profile}/1xsd");
    }

    /**
     * @param string $profile The Factur-X profile. Possible values: BASICWL, EN16931, EXTENDED. Default: EN16931.
     *
     * @return string the path to the root XSD file for the specified Factur-X profile
     *
     * @throws \InvalidArgumentException if the specified profile is not supported
     */
    public static function rootXsd(string $profile = 'EN16931'): string
    {
        $profile = self::normalizeProfile($profile);

        return self::path("Factur-X/{$profile}/1xsd/Factur-X_{$profile}.xsd");
    }

    /**
     * @param string $profile The Factur-X profile. Possible values: BASICWL, EN16931, EXTENDED. Default: EN16931.
     *
     * @return string the path to the base Schematron file for the specified Factur-X profile
     *
     * @throws \InvalidArgumentException if the specified profile is not supported
     */
    public static function baseSchematron(string $profile = 'EN16931'): string
    {
        $profile = self::normalizeProfile($profile);
        $baseName = match ($profile) {
            'BASICWL' => 'FACTUR-X_BASIC-WL',
            'EN16931' => 'FACTUR-X_EN16931',
            'EXTENDED' => 'FACTUR-X_EXTENDED',
        };

        return self::path("Factur-X/{$profile}/schematron/{$baseName}.sch");
    }

    /**
     * @param string $profile     The Factur-X profile. Possible values: BASICWL, EN16931, EXTENDED. Default: EN16931.
     * @param bool   $withWarning Whether to include warnings. Default: false.
     *
     * @return string the path to the BR-FR Schematron file for the specified Factur-X profile
     *
     * @throws \InvalidArgumentException if the specified profile is not supported
     */
    public static function brFrSchematron(string $profile = 'EN16931', bool $withWarning = false): string
    {
        $profile = self::normalizeProfile($profile);
        $suffix = $withWarning ? '_WARNING' : '';

        return self::path("Factur-X/{$profile}/schematron/BR-FR-Flux2-Schematron-CII{$suffix}.sch");
    }

    /**
     * @param string $profile The Factur-X profile. Possible values: BASICWL, EN16931, EXTENDED. Default: EN16931.
     *
     * @return string the path to the base XSLT file for the specified Factur-X profile
     *
     * @throws \InvalidArgumentException if the specified profile is not supported
     */
    public static function baseXslt(string $profile = 'EN16931'): string
    {
        $profile = self::normalizeProfile($profile);
        $baseName = match ($profile) {
            'BASICWL' => 'FACTUR-X_BASIC-WL',
            'EN16931' => 'FACTUR-X_EN16931',
            'EXTENDED' => 'FACTUR-X_EXTENDED',
        };

        return self::path("Factur-X/{$profile}/2xslt/{$baseName}.xslt");
    }

    /**
     * @param string $profile     The Factur-X profile. Possible values: BASICWL, EN16931, EXTENDED. Default: EN16931.
     * @param bool   $withWarning Whether to include warnings. Default: false.
     *
     * @return string the path to the BR-FR XSLT file for the specified Factur-X profile
     *
     * @throws \InvalidArgumentException if the specified profile is not supported
     */
    public static function brFrXslt(string $profile = 'EN16931', bool $withWarning = false): string
    {
        $profile = self::normalizeProfile($profile);
        $suffix = $withWarning ? '_WARNING' : '';

        return self::path("Factur-X/{$profile}/2xslt/BR-FR-Flux2-Schematron-CII{$suffix}.xslt");
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

    /**
     * @throws \InvalidArgumentException
     */
    private static function normalizeProfile(string $profile): string
    {
        $normalizedProfile = strtoupper(trim($profile));

        return match ($normalizedProfile) {
            'BASICWL' => 'BASICWL',
            'EN16931' => 'EN16931',
            'EXTENDED' => 'EXTENDED',
            default => throw new \InvalidArgumentException(sprintf(
                "Unsupported Factur-X profile '%s'. Expected one of: BASICWL, EN16931, EXTENDED.",
                $profile
            )),
        };
    }
}
