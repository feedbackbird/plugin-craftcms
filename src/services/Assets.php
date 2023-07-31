<?php

namespace FeedbackBird\Plugin\services;

use Craft;
use craft\helpers\Template;
use FeedbackBird\Plugin\FeedbackBird;
use FeedbackBird\Plugin\models\Settings;
use yii\base\Component;
use craft\web\View;

class Assets extends Component
{
    private FeedbackBird $plugin;
    private Settings $settings;

    public function __construct($config = [])
    {
        parent::__construct($config);

        $this->plugin = FeedbackBird::getInstance();
        $this->settings = $this->plugin->getSettings();
    }

    public function getTemplate($template, $variables = [])
    {
        $oldMode = Craft::$app->view->getTemplateMode();
        Craft::$app->view->setTemplateMode(View::TEMPLATE_MODE_CP);

        $html = Craft::$app->view->renderTemplate($template, $variables);

        Craft::$app->view->setTemplateMode($oldMode);

        return Template::raw($html);
    }

    public function generateAssets()
    {
        if (!$this->settings->widgetStatus) {
            return;
        }

        return $this->getTemplate('feedbackbird/_assets.twig', [
            'uid' => $this->settings->uID,
            'widgetPosition' => $this->settings->widgetPosition,
            'widgetColor' => $this->settings->widgetColor,
            'widgetButtonLabel' => $this->settings->widgetButtonLabel,
            'widgetSubtitle' => $this->settings->widgetSubtitle,
        ]);
    }
}