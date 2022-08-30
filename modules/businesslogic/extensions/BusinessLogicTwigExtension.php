<?php

namespace modules\businesslogic\extensions;

use craft\helpers\Template;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;


class BusinessLogicTwigExtension extends AbstractExtension
{
    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName(): string
    {
        return 'Business Logic';
    }

    public function getFilters(): array
    {
        return [
            new TwigFilter('widno', [$this, 'widnoFunction']),
        ];
    }

    /**
     * Get Twig Functions.
     *
     * @return array
     */
    public function getFunctions(): array
    {
        return [
            new TwigFunction('widno', [$this, 'widnoFunction']),
        ];
    }

    /**
     * Stops widows
     *
     * @param [string] $str [The string to add the &nbsp; to]
     *
     * @return [string] [The updated string]
     */
    public function widnoFunction($str)
    {

        $str = preg_replace( '|([^\s])\s+([^\s]+)\s*$|', '$1&nbsp;$2', $str);

        return Template::raw($str);

    }// END widnoFilter
}
