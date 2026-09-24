<?php

declare(strict_types=1);

namespace TiimePDP\FNFEMEPFranceRFE;

final class UBLResourcePaths
{
    /**
     * @return string The path to the XSD directory for UBL 2.1.
     */
    public static function xsdDir(): string
    {
        return self::path('UBL/1xsd_UBL2.1');
    }

    /**
     * @param string                 $profile      the UBL profile, either 'EN16931' or 'EXTENDED-CTC-FR'
     * @param 'CreditNote'|'Invoice' $documentType the UBL document type, either 'Invoice' or 'CreditNote'
     *
     * @throws \InvalidArgumentException if the document type or profile is not supported
     */
    public static function rootXsd(string $profile = 'EN16931', string $documentType = 'Invoice'): string
    {
        self::normalizeProfile($profile);

        $documentType = match (strtoupper(trim($documentType))) {
            'INVOICE' => 'Invoice',
            'CREDITNOTE' => 'CreditNote',
            default => throw new \InvalidArgumentException(sprintf(
                "Unsupported UBL document type '%s'. Expected one of: Invoice, CreditNote.",
                $documentType
            )),
        };

        return self::path("UBL/1xsd_UBL2.1/maindoc/UBL-{$documentType}-2.1.xsd");
    }

    /**
     * @param string $profile The UBL profile, either 'EN16931' or 'EXTENDED-CTC-FR'. Default: 'EN16931'.
     *
     * @return string the path to the Schematron directory for the specified UBL profile
     *
     * @throws \InvalidArgumentException if the specified profile is not supported
     */
    public static function schematronDir(string $profile = 'EN16931'): string
    {
        $profile = self::normalizeProfile($profile);

        return self::path("UBL/{$profile}/schematron");
    }

    /**
     * @param string $profile The UBL profile, either 'EN16931' or 'EXTENDED-CTC-FR'. Default: 'EN16931'.
     *
     * @return string the path to the base Schematron file for the specified UBL profile
     *
     * @throws \InvalidArgumentException if the specified profile is not supported
     */
    public static function baseSchematron(string $profile = 'EN16931'): string
    {
        $profile = self::normalizeProfile($profile);
        $baseName = match ($profile) {
            'EN16931' => 'EN16931-UBL-validation-preprocessed',
            'EXTENDED-CTC-FR' => 'EXTENDED-CTC-FR-UBL',
        };

        return self::path("UBL/{$profile}/schematron/{$baseName}.sch");
    }

    /**
     * @param string $profile     The UBL profile, either 'EN16931' or 'EXTENDED-CTC-FR'. Default: 'EN16931'.
     * @param bool   $withWarning Whether to include warnings. Default: false.
     *
     * @return string the path to the BR-FR Schematron file for the specified UBL profile
     *
     * @throws \InvalidArgumentException if the specified profile is not supported
     */
    public static function brFrSchematron(string $profile = 'EN16931', bool $withWarning = false): string
    {
        $profile = self::normalizeProfile($profile);
        $suffix = $withWarning ? '_WARNING' : '';

        return self::path("UBL/{$profile}/schematron/BR-FR-Flux2-Schematron-UBL{$suffix}.sch");
    }

    /**
     * @param string $profile The UBL profile, either 'EN16931' or 'EXTENDED-CTC-FR'. Default: 'EN16931'.
     *
     * @return string the path to the base XSLT file for the specified UBL profile
     *
     * @throws \InvalidArgumentException if the specified profile is not supported
     */
    public static function baseXslt(string $profile = 'EN16931'): string
    {
        $profile = self::normalizeProfile($profile);
        $baseName = match ($profile) {
            'EN16931' => 'EN16931-UBL-validation',
            'EXTENDED-CTC-FR' => 'EXTENDED-CTC-FR-UBL',
        };

        return self::path("UBL/{$profile}/2xslt/{$baseName}.xslt");
    }

    /**
     * @param string $profile     The UBL profile, either 'EN16931' or 'EXTENDED-CTC-FR'. Default: 'EN16931'.
     * @param bool   $withWarning Whether to include warnings. Default: false.
     *
     * @return string the path to the BR-FR XSLT file for the specified UBL profile
     *
     * @throws \InvalidArgumentException if the specified profile is not supported
     */
    public static function brFrXslt(string $profile = 'EN16931', bool $withWarning = false): string
    {
        $profile = self::normalizeProfile($profile);
        $suffix = $withWarning ? '_WARNING' : '';

        return self::path("UBL/{$profile}/2xslt/BR-FR-Flux2-Schematron-UBL{$suffix}.xslt");
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

    private static function normalizeProfile(string $profile): string
    {
        $normalizedProfile = strtoupper(trim($profile));

        return match ($normalizedProfile) {
            'EN16931' => 'EN16931',
            'EXTENDED-CTC-FR' => 'EXTENDED-CTC-FR',
            default => throw new \InvalidArgumentException(sprintf(
                "Unsupported UBL profile '%s'. Expected one of: EN16931, EXTENDED-CTC-FR.",
                $profile
            )),
        };
    }
}
