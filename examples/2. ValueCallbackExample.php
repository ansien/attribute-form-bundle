<?php

declare(strict_types=1);

namespace Ansien\AttributeFormBundle\Examples;

use Ansien\AttributeFormBundle\Attribute\Form;
use Ansien\AttributeFormBundle\Attribute\FormField;
use Ansien\AttributeFormBundle\Form\CallbackType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Validator\Constraints as Assert;

#[Form]
class CallbackExample
{
    public array $enabledCurrencies;

    #[FormField(ChoiceType::class, [
        'choices' => [CallbackType::VALUE, 'enabledCurrencies'],
        'choice_label' => [CallbackType::FUNCTION, 'getCurrencyLabelCb'],
    ])]
    #[Assert\NotBlank]
    public ?string $currency = null;

    public function __construct(array $enabledCurrencies)
    {
        $this->enabledCurrencies = $enabledCurrencies;
    }

    public function getCurrencyLabelCb(): callable
    {
        return fn ($value) => $value . ' + Value Example';
    }
}
