<?php

namespace spec\Haska\Validation;

use Haska\Validation\FactoryInterface;
use Haska\Validation\ValidatorInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class FormValidatorSpec extends ObjectBehavior
{
	function let(FactoryInterface $validatorFactory)
	{
		$this->beAnInstanceOf('spec\Haska\Validation\ExampleValidator');
		$this->beConstructedWith($validatorFactory);
	}

	function it_validates_a_set_of_valid_data(FactoryInterface $validatorFactory, ValidatorInterface $validator)
	{
		$fakeFormData = ['username' => 'joe'];

		$validatorFactory->make($fakeFormData, $this->getValidationRules(), [])->willReturn($validator);
		$validator->fails()->willReturn(false);

		$this->validate($fakeFormData)->shouldReturn(true);
	}

	function it_throws_an_exception_for_invalid_form_data(FactoryInterface $validatorFactory, ValidatorInterface $validator)
	{
		$fakeFormData = ['username' => ''];

		$validatorFactory->make($fakeFormData, $this->getValidationRules(), [])->willReturn($validator);
		$validator->fails()->willReturn(true);
		$validator->errors()->willReturn([]);

		$this->shouldThrow('Haska\Validation\FormValidationException')->duringValidate($fakeFormData);
	}
}

class ExampleValidator extends \Haska\Validation\FormValidator {
	protected $rules = ['username' => 'required'];
}
