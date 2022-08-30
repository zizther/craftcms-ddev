<?php
/**
 * BusinessLogic module for custom functionality on the site
 */

namespace modules\businesslogic;

use yii\base\Event;
use yii\base\Module;

use Craft;
use craft\elements\Entry;
use craft\events\ModelEvent;
use craft\events\RegisterComponentTypesEvent;
use craft\i18n\PhpMessageSource;
use craft\web\View;
use craft\web\twig\variables\CraftVariable;

use modules\businesslogic\extensions\BusinessLogicTwigExtension;
use modules\businesslogic\variables\BusinessLogicVariable;

/**
 * Custom module class.
 *
 * This class will be available throughout the system via:
 * `Craft::$app->getModule('businesslogic')`.
 *
 * You can change its module ID ("businesslogic") to something else from
 * config/app.php.
 *
 * If you want the module to get loaded on every request, uncomment this line
 * in config/app.php:
 *
 *     'bootstrap' => ['businesslogic']
 *
 * Learn more about Yii module development in Yii's documentation:
 * http://www.yiiframework.com/doc-2.0/guide-structure-modules.html
 */
class BusinessLogic extends Module
{
    // Constants
    // =========================================================================


    // Static Methods
    // =========================================================================

    /**
     * Static property that is an instance of this module class so that it can be accessed via
     * Businesslogic::$instance
     *
     * @var BusinesslogicModule
     */
    public static $instance;

    /**
     * @inheritdoc
     */
    public function __construct($id, $parent = null, array $config = [])
    {
        Craft::setAlias('@modules/businesslogic', $this->getBasePath());
        $this->controllerNamespace = 'modules\businesslogic\controllers';

        // Translation category
        $i18n = Craft::$app->getI18n();
        /** @noinspection UnSafeIsSetOverArrayInspection */
        if (!isset($i18n->translations[$id]) && !isset($i18n->translations[$id.'*'])) {
            $i18n->translations[$id] = [
                'class' => PhpMessageSource::class,
                'sourceLanguage' => 'en-GB',
                'basePath' => '@modules/businesslogic/translations',
                'forceTranslation' => true,
                'allowOverrides' => true,
            ];
        }

        // Base template directory
        // Event::on(View::class, View::EVENT_REGISTER_CP_TEMPLATE_ROOTS, function (RegisterTemplateRootsEvent $e) {
        //     if (is_dir($baseDir = $this->getBasePath().DIRECTORY_SEPARATOR.'templates')) {
        //         $e->roots[$this->id] = $baseDir;
        //     }
        // });

        // Set this as the global instance of this module class
        static::setInstance($this);

        parent::__construct($id, $parent, $config);
    }

    /**
     * Set our $instance static property to this class so that it can be accessed via
     * BusinessLogicModule::$instance
     *
     * Called after the module class is instantiated; do any one-time initialization
     * here such as hooks and events.
     *
     * If you have a '/vendor/autoload.php' file, it will be loaded for you automatically;
     * you do not need to load it in your init() method.
     *
     */
    public function init()
    {
        parent::init();
        self::$instance = $this;

        // Add in our Twig extensions
        Craft::$app->view->registerTwigExtension(new BusinessLogicTwigExtension);

        // Handle any console commands
        $request = Craft::$app->getRequest();
        if ($request->getIsConsoleRequest()) {
            $this->controllerNamespace = 'modules\businesslogic\console\controllers';
        }

        // Register our components (services)
        // Allow us to use BusinessLogic::$instance->myService->myMethod();
        // $this->setComponents([
        //     'hashid' => HashidService::class,
        // ]);

        // Register listeners
        $this->_registerListeners();

        /**
         * Logging in Craft involves using one of the following methods:
         *
         * Craft::trace(): record a message to trace how a piece of code runs. This is mainly for development use.
         * Craft::info(): record a message that conveys some useful information.
         * Craft::warning(): record a warning message that indicates something unexpected has happened.
         * Craft::error(): record a fatal error that should be investigated as soon as possible.
         *
         * Unless `devMode` is on, only Craft::warning() & Craft::error() will log to `craft/storage/logs/web.log`
         *
         * It's recommended that you pass in the magic constant `__METHOD__` as the second parameter, which sets
         * the category to the method (prefixed with the fully qualified class name) where the constant appears.
         *
         * To enable the Yii debug toolbar, go to your user account in the AdminCP and check the
         * [] Show the debug toolbar on the front end & [] Show the debug toolbar on the Control Panel
         *
         * http://www.yiiframework.com/doc-2.0/guide-runtime-logging.html
         */
        Craft::info(
            Craft::t(
                'businesslogic',
                '{name} module loaded',
                ['name' => 'BusinessLogic']
            ),
            __METHOD__
        );
    }


    // Public Methods
    // =========================================================================
    /**
     * Registers the field types.
     *
     * @param RegisterComponentTypesEvent $event
     */
    public function handleRegisterFieldTypes(RegisterComponentTypesEvent $event)
    {

    }// END handleRegisterFieldTypes


    // Private Methods
    // =========================================================================
    private function _registerListeners()
    {

    }

}
