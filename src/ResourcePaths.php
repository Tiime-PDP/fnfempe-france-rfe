<?php

declare(strict_types=1);

namespace TiimePdp\FnfempeFranceRfe;

final class ResourcePaths
{
    private const RESOURCES_DIR = __DIR__ . '/../resources';

    public static function base(): string
    {
        return self::RESOURCES_DIR;
    }

    public static function file(string $relativePath): string
    {
        return self::RESOURCES_DIR . '/' . ltrim($relativePath, '/');
    }

    public static function ciiXsdDir(): string
    {
        return self::file('CII/1xsd-CII_D22B_uncoupled');
    }

    public static function ublSchematronDir(): string
    {
        return self::file('UBL/EN16931/schematron');
    }
}
