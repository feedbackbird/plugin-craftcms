<?php

namespace FeedbackBird\Plugin\services;

use Craft;
use yii\base\Component;

class Assets extends Component
{
    public function generateAssets()
    {
        return Craft::$app->getView()->renderTemplate('feedbackbird/_assets.twig');
    }
}