<?php

namespace App\EventListener;

use App\Entity\BookCopy;
use App\Service\FileUploader;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Class BookFileUploadListener
 * @package App\EventListener
 */
class BookFileUploadListener
{
    /**
     * @var FileUploader
     */
    private $uploader;

    /**
     * ImageUploadListener constructor.
     * @param $uploader
     */
    public function __construct(FileUploader $uploader)
    {
        $this->uploader = $uploader;
    }

    /**
     * @param LifecycleEventArgs $args
     */
    public function prePersist(LifecycleEventArgs $args) {
        $entity = $args->getEntity();

        $this->uploadFile($entity);
    }

    /**
     * @param PreUpdateEventArgs $args
     */
    public function preUpdate(PreUpdateEventArgs $args) {
        $entity = $args->getEntity();

        $this->uploadFile($entity);
    }

    /**
     * @param $entity
     */
    private function uploadFile($entity) {
        if (!$entity instanceof BookCopy) {
            return;
        }

        $file = $entity->getFilePath();

        if ($file instanceof UploadedFile) {
            $fileName = $this->uploader->upload($file);
            $entity->setFilePath(BookCopy::IMAGE_UPLOAD_DIRECTORY. $fileName);
        }
    }
}