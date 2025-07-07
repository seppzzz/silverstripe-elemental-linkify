<?php

namespace Zazama\ElementalLinkify\Extensions;

use Silverstripe\Core\Extension;
use SilverStripe\View\Requirements;

class ElementalLinkifyExtension extends Extension {
    public function updateClientConfig(&$clientConfig)
    {
        /*$clientConfig['form']['editorElementalLink'] = [
            'schemaUrl' => $this->getOwner()->Link('methodSchema/Modals/editorElementalLink')
        ];*/
		
		$clientConfig['form']['editorElementalLink'] = [
			'schemaUrl' => \SilverStripe\Core\Injector\Injector::inst()
				->get(\Zazama\ElementalLinkify\Controllers\ElementalLinkifyController::class)
				->Link('methodSchema/editorElementalLink')
		];
    }

}