<?php

declare(strict_types=1);

namespace TiimePDP\FNFEMEPFranceRFE;

final class CIIResourcePaths
{
    /**
     * @return string The path to the directory containing the XSD files for CII D22B
     */
    public static function xsdDir(): string
    {
        return self::path('CII/1xsd-CII_D22B_uncoupled');
    }

    /**
     * @return string The path to the root XSD for CII D22B
     */
    public static function rootXsd(): string
    {
        return self::path(
            'CII/1xsd-CII_D22B_uncoupled/CrossIndustryInvoice_100pD22B.xsd'
        );
    }

    /**
     * @param string $profile The profile of the CII standard to use. Supported values are 'EN16931' and 'EXTENDED-CTC-FR'.
     *
     * @return string The path to the base schematron for the specified CII profile
     *
     * @throws \InvalidArgumentException Throws if the provided profile is not supported (EN16931 or EXTENDED-CTC-FR)
     */
    public static function baseSchematron(string $profile = 'EN16931'): string
    {
        $profile = self::normalizeProfile($profile);

        $baseName = match ($profile) {
            'EN16931' => 'EN16931-CII-validation-preprocessed',
            'EXTENDED-CTC-FR' => 'EXTENDED-CTC-FR-CII',
        };

        return self::path("CII/{$profile}/schematron/{$baseName}.sch");
    }

    /**
     * @param string $profile     The profile of the CII standard to use. Supported values are 'EN16931' and 'EXTENDED-CTC-FR'.
     * @param bool   $withWarning Whether to use the schematron with warnings or not
     *
     * @return string The path to the BR-FR schematron for the specified CII profile and warning option
     *
     * @throws \InvalidArgumentException Throws if the provided profile is not supported (EN16931 or EXTENDED-CTC-FR)
     */
    public static function brFrSchematron(string $profile = 'EN16931', bool $withWarning = false): string
    {
        $profile = self::normalizeProfile($profile);

        $suffix = $withWarning ? '_WARNING' : '';

        return self::path("CII/{$profile}/schematron/BR-FR-Flux2-Schematron-CII{$suffix}.sch");
    }

    /**
     * @param string $profile The profile of the CII standard to use. Supported values are 'EN16931' and 'EXTENDED-CTC-FR'.
     *
     * @return string The path to the base XSLT file for the specified CII
     *
     * @throws \InvalidArgumentException Throws if the provided profile is not supported (EN16931 or EXTENDED-CTC-FR)
     */
    public static function baseXslt(string $profile = 'EN16931'): string
    {
        $profile = self::normalizeProfile($profile);

        $baseName = match ($profile) {
            'EN16931' => 'EN16931-CII-validation',
            'EXTENDED-CTC-FR' => 'EXTENDED-CTC-FR-CII',
        };

        return self::path("CII/{$profile}/2xslt/{$baseName}.xslt");
    }

    /**
     * @param string $profile     The profile of the CII standard to use. Supported values are 'EN16931' and 'EXTENDED-CTC-FR'.
     * @param bool   $withWarning Whether to use the XSLT file that includes warning
     *
     * @return string The path to the BR-FR XSLT file for the specified CII profile and warning option
     *
     * @throws \InvalidArgumentException Throws if the provided profile is not supported (EN16931 or EXTENDED-CTC-FR)
     */
    public static function brFrXslt(string $profile = 'EN16931', bool $withWarning = false): string
    {
        $profile = self::normalizeProfile($profile);

        $suffix = $withWarning ? '_WARNING' : '';

        return self::path("CII/{$profile}/2xslt/BR-FR-Flux2-Schematron-CII{$suffix}.xslt");
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
     * @throws \InvalidArgumentException Throws if the provided profile is not supported (EN16931 or EXTENDED-CTC-FR)
     */
    private static function normalizeProfile(string $profile): string
    {
        $normalizedProfile = strtoupper(trim($profile));

        return match ($normalizedProfile) {
            'EN16931' => 'EN16931',
            'EXTENDED-CTC-FR' => 'EXTENDED-CTC-FR',
            default => throw new \InvalidArgumentException(sprintf(
                "Unsupported CII profile '%s'. Expected one of: EN16931, EXTENDED-CTC-FR.",
                $profile
            )),
        };
    }
}
