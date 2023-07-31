<?php

namespace FeedbackBird\Plugin\models;

use craft\base\Model;

/**
 * FeedbackBird settings
 */
class Settings extends Model
{
    public $widgetStatus = true;
    public $uID = '';

    public function defineRules(): array
    {
        return [
            [['uID'], 'required'],
            ['uID', 'string'],
            ['widgetStatus', 'boolean', 'trueValue' => true, 'falseValue' => false],
        ];
    }
}
