<?php
class Sms_Form_OrderDestinationForm extends Zend_Form
{
	public function init()
	{
		$this->setMethod('post');
		$this->setAttrib('id', 'jQueryValidation');

		// create hidden id
		$id = $this->createElement('hidden', 'id');
		$id->setDecorators(array('ViewHelper'));
		$this->addElement($id);
		
		// create hidden order_id
		$order_id = $this->createElement('hidden', 'order_id');
		$order_id->setDecorators(array('ViewHelper'));
		$this->addElement($order_id);

		// create destination_type
		$destination_type = $this->createElement('select', 'destination_type')
			->setLabel('Destination Type:')
			->setRequired(true);
		foreach ($this->getDestinationTypes() as $key => $value)
		{
			$destination_type->addMultiOption($key, $value);
		}
		$this->addElement($destination_type);
		
		// create destination_value
		$destination_value = $this->createElement('textarea', 'destination_value')
			->setLabel('Destination Value:')
			->setRequired(true)
			->setAttrib('class', 'validate[required]')
			->setAttrib('cols', 43)
			->setAttrib('rows', 4);
		$this->addElement($destination_value);		
		
		// create dispatch_date
		$dispatch_date = $this->createElement('text', 'dispatch_date')
			->setLabel('Date the issue occurred (yyyy-mm-dd hh:mm:ss):')
			->setRequired(true)
			->addValidator('regex', false, array(
				'pattern' => '/^(\d{2}|\d{4})(?:\-)?([0]{1}\d{1}|[1]{1}[0-2]{1})(?:\-)?([0-2]{1}\d{1}|[3]{1}[0-1]{1})(?:\s)?([0-1]{1}\d{1}|[2]{1}[0-3]{1})(?::)?([0-5]{1}\d{1})(?::)?([0-5]{1}\d{1})$/',
				'messages' => array(
					'regexInvalid'   => "Invalid type given, value should be yyyy-mm-dd hh:mm:ss",
					'regexNotMatch' => "'%value%' does not match against pattern '%pattern%'",
					'regexErrorous'  => "There was an internal error while using the pattern '%pattern%'"
				)
			))
			->setAttrib('size', 30)
			->setAttrib('class', 'validate[required,custom[dateTime24]]');
		$this->addElement($dispatch_date);
		
		// create submit
		$submit = $this->createElement('submit', 'submit');
		$submit->setLabel('Submit Form');
		$this->addElement($submit);
	}
	
	public function getDestinationTypes()
	{
		$types[] = '';
		$types[] = 'Type 1';
		$types[] = 'Type 2';
		$types[] = 'Type 3';
		$types[] = 'Type 4';
		
		return $types;
	}
}



























