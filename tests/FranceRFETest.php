<?php

declare(strict_types=1);

namespace TiimePDP\FNFEMEPFranceRFE\Tests;

use PHPUnit\Framework\TestCase;
use TiimePDP\FNFEMEPFranceRFE\FranceRFE;

/**
 * @internal
 *
 * @coversNothing
 */
final class FranceRFETest extends TestCase
{
    public function testVersionMatchesUpstreamTracker(): void
    {
        self::assertSame(
            trim(file_get_contents(dirname(__DIR__).'/.github/upstream-france-rfe-version.txt')),
            FranceRFE::VERSION
        );
    }
}
