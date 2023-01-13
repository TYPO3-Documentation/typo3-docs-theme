<?php

declare(strict_types=1);

namespace T3Docs\Theme\Directives;

use Doctrine\RST\Directives\Directive;

/**
 * Many documents contain directives that should not be interpreted anymore.
 * You can use this class to register a directive that is doing nothing and
 * just ignored.
 *
 * ```
 * [
 *     //...
 *     new IgnoredDirective('directive-to-be-ignored'),
 * ]
 * ```
 *
 *
 */
final class IgnoredDirective extends Directive
{
    private string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
