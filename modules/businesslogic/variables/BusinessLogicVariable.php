<?php
/**
 * Site module for Craft CMS 3.x
 */

namespace modules\businesslogic\variables;

use modules\businesslogic\BusinessLogic;

use Craft;

/**
 * BusinessLogic Variable
 *
 * Craft allows modules to provide their own template variables, accessible from
 * the {{ craft }} global variable (e.g. {{ craft.businessLogicModule }}).
 *
 * https://craftcms.com/docs/plugins/variables
 *
 * @author    Nathan Reed
 * @since     1.0.0
 */
class BusinessLogicVariable
{
    /**
     * Whatever you want to output to a Twig template can go into a Variable method.
     * You can have as many variable functions as you want. From any Twig template,
     * call it like this:
     *
     *      {{ craft.businessLogic.entriesLimit }}
     *
     *  or
     *     {{ craft.businessLogic.entriesLimit(10) }}
     *
     * @param null $element
     *
     * @return string
     */

    // Public Methods
    // =========================================================================


}
