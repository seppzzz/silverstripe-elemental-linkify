<?php

namespace Zazama\ElementalLinkify\Controllers;

use SilverStripe\Admin\LeftAndMain;
use SilverStripe\Forms\Form;
use SilverStripe\Control\HTTPRequest;
use SilverStripe\Forms\Schema\FormSchema;
use SilverStripe\Forms\FormFactory;
use SilverStripe\Forms\Remote\FormSchemaRequestHandler;
use SilverStripe\Control\HTTPResponse;
use Zazama\ElementalLinkify\Forms\ElementalLinkifyFormFactory;

class ElementalLinkifyController extends LeftAndMain
{
	private static $url_segment = 'elemental-link';
	private static $menu_title = 'Elemental Link Modal';
	private static $url_rule = '/$Action/$ID/$OtherID';
	private static $required_permission_codes = [];

	private static $allowed_actions = [
		'editorElementalLink',
		'methodSchema'
	];

	public function getClientConfig(): array
	{
		return array_merge(
			parent::getClientConfig(),
			[
				'form' => [
					'editorElementalLink' => [
						'schemaUrl' => $this->Link('methodSchema/editorElementalLink')
					]
				]
			]
		);
	}

	public function editorElementalLink(): Form
	{
		return ElementalLinkifyFormFactory::singleton()->getForm(
			$this,
			'editorElementalLink',
			[ 'RequireLinkText' => false ]
		);
	}

	/**
	 * This is required for methodSchema/* to work
	 */
	public function methodSchema(HTTPRequest $request): HTTPResponse
	{
		$name = $request->param('ID');

		$context = [
			'RequireLinkText' => false
		];

		$factory = ElementalLinkifyFormFactory::singleton();
		$form = $factory->getForm($this, $name, $context);

		$schema = \SilverStripe\Forms\Schema\FormSchema::create()->getMultipartSchema(
			$request->getHeader('X-FormSchema-Request') ?? ['schema', 'state'],
			$name,
			$form
		);

		return HTTPResponse::create(json_encode($schema))
			->addHeader('Content-Type', 'application/json');
	}
	
	
	
	
	
	
	
	
}
