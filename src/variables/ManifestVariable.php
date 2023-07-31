<?php

namespace FeedbackBird\Plugin\variables;

use FeedbackBird\Plugin\FeedbackBird;

class ManifestVariable
{
    public function renderJavascript(array $attributes = [])
    {
        return FeedbackBird::getInstance()->assets->generateAssets();
    }
}