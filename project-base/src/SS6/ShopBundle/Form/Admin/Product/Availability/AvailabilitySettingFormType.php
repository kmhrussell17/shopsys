<?php

namespace SS6\ShopBundle\Form\Admin\Product\Availability;

use SS6\ShopBundle\Form\FormType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\ChoiceList\ObjectChoiceList;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints;

class AvailabilitySettingFormType extends AbstractType {

	/**
	 * @var \SS6\ShopBundle\Model\Product\Availability\Availability[]
	 */
	private $availabilities;

	/**
	 * @param \SS6\ShopBundle\Model\Product\Availability\Availability[] $availabilities
	 */
	public function __construct(array $availabilities) {
		$this->availabilities = $availabilities;
	}

	/**
	 * @return string
	 */
	public function getName() {
		return 'availability_setting';
	}

	/**
	 * @param \Symfony\Component\Form\FormBuilderInterface $builder
	 * @param array $options
	 */
	public function buildForm(FormBuilderInterface $builder, array $options) {
		$builder
			->add('defaultInStockAvailability', FormType::CHOICE, [
				'required' => true,
				'choice_list' => new ObjectChoiceList($this->availabilities, 'name', [], null, 'id'),
				'constraints' => [
					new Constraints\NotBlank(['message' => 'Prosím vyberte výchozí dostupnost pro zboží skladem']),
				],
			])
			->add('save', FormType::SUBMIT);
	}

	public function setDefaultOptions(OptionsResolverInterface $resolver) {
		$resolver->setDefaults([
			'attr' => ['novalidate' => 'novalidate'],
		]);
	}

}