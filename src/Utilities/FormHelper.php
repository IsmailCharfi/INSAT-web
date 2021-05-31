<?php


namespace App\Utilities;


use App\Entity\Document;
use phpDocumentor\Reflection\Types\Self_;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\File;

class FormHelper
{

    public const PDF = "application/pdf";
    public const JPEG = "image/jpeg";
    public const PNG = "image/png";
    public const GIF = "image/gif";

    public static function addFileInput(FormBuilderInterface $builder, string $name, string $label, array $constraints = []): ?FormBuilderInterface
    {
        if (!$builder)
            return $builder;

        return $builder->add($name, FileType::class, [
            'label' => $label,
            'mapped' => false,
            'required' => false,
            'constraints' => $constraints,
        ]);
    }

    public static function addPdfFileInput(FormBuilderInterface $builder, string $name, string $label): ?FormBuilderInterface
    {
        return self::addFileInput($builder, $name, $label,[
            new File([
                'mimeTypes' => [self::PDF],
                'mimeTypesMessage' => 'Please upload a valid PDF document',
            ])
        ]);
    }

    public static function addImgFileInput(FormBuilderInterface $builder, string $name, string $label): ?FormBuilderInterface
    {
        return self::addFileInput($builder, $name, $label,[
            new File([
                'mimeTypes' => [self::JPEG, self::PNG, self::GIF],
                'mimeTypesMessage' => 'Please upload a valid Image document',
            ])
        ]);
    }

    public static function handleUpload($form, $name, ?Document $document, $fileUploader) : ?Document{
        $file = $form->get($name)->getData();

        if(!$file)
            return $document;

        return $fileUploader->upload($file, $document);
    }
}
