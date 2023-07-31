<?php

namespace FeedbackBird\Plugin;

use Craft;
use craft\web\twig\variables\CraftVariable;
use FeedbackBird\Plugin\models\Settings;
use craft\base\Model;
use craft\base\Plugin;
use FeedbackBird\Plugin\services\Assets;
use FeedbackBird\Plugin\variables\ManifestVariable;
use yii\base\Event;

/**
 * FeedbackBird plugin
 *
 * @method static FeedbackBird getInstance()
 * @method Settings getSettings()
 * @author VeronaLabs <support@veronalabs.com>
 * @copyright VeronaLabs
 * @license MIT
 */
class FeedbackBird extends Plugin
{
    public string $schemaVersion = '1.0.0';
    public bool $hasCpSettings = true;

    public static function config(): array
    {
        return [
            'components' => [
                'assets' => Assets::class,
            ],
        ];
    }

    public function init(): void
    {
        parent::init();

        // Defer most setup tasks until Craft is fully initialized
        Craft::$app->onInit(function () {
            $this->attachEventHandlers();
        });
    }

    protected function createSettingsModel(): ?Model
    {
        return Craft::createObject(Settings::class);
    }

    protected function settingsHtml(): ?string
    {
        return Craft::$app->view->renderTemplate('feedbackbird/_settings.twig', [
            'plugin' => $this,
            'settings' => $this->getSettings(),
        ]);
    }

    private function attachEventHandlers(): void
    {
        // Handler: CraftVariable::EVENT_INIT
        Event::on(CraftVariable::class, CraftVariable::EVENT_INIT, function (Event $event) {
            /** @var CraftVariable $variable */
            $variable = $event->sender;
            $variable->set('feedbackBird', ManifestVariable::class);
        });
    }
}
