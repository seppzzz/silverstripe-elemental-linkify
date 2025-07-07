<?php

namespace Zazama\ElementalLinkify\Fields;
use SilverStripe\ORM\FieldType\DBHTMLVarchar;
use SilverStripe\View\Parsers\ShortcodeParser;
use SilverStripe\Forms\FormField;

class DBElementalLinkifyShortcode extends DBHTMLVarchar {
    public function RAW(): ?string
    {
        return ShortcodeParser::get_active()->parse($this->value);
    }

    public function scaffoldFormField(?string $title = null, array $params = []): ?FormField

    {
        return ElementalLinkifyDropdownField::create($this->name, $title);
    }
}