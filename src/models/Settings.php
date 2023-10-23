<?php

namespace FeedbackBird\Plugin\models;

use craft\base\Model;

/**
 * FeedbackBird settings
 */
class Settings extends Model
{
    public $widgetStatus = true;
    public $widgetPosition = 'top-right';
    public $widgetColor = '5562E0';
    public $widgetButtonLabel = '';
    public $widgetSubtitle = '';
    public $uID = '';

    public function defineRules(): array
    {
        return [
            [['widgetPosition', 'uID'], 'required'],
            ['widgetStatus', 'boolean', 'trueValue' => true, 'falseValue' => false],
            ['widgetPosition', 'in', 'range' => ['top-right', 'top-left', 'right', 'left']],
            ['widgetColor', 'string'],
            ['widgetButtonLabel', 'string'],
            ['widgetSubtitle', 'string'],
            ['uID', 'string'],
        ];
    }
}
