<?php
// src/Form/Type/TaskType.php
namespace App\Form\Type;

use App\Entity\Task;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class TaskType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('save', SubmitType::class, ['label' => 'Create Xliff File']);

        $builder->add('xlfFile', FileType::class, ['required' => false, 'label' => 'Please upload the XLF File to insert automatically the elements.']);

        $builder->add('sourceLanguage');
        $builder->add('targetLanguage');
        $builder->add('productName');

        $builder->add('xliffElements', CollectionType::class, [
                'entry_type' => XliffElementType::class,
                'entry_options' => ['label' => false],
                'allow_add' => true,
                'by_reference' => false,
                'allow_delete' => true,
            ]
        );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
            'data_class' => Task::class,
            ]
        );
    }
}
