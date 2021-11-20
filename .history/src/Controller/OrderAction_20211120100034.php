<?php

namespace App\Controller;
 
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use App\Entity\Consommable;
use App\Repository\TypeConsommableRepository;
use App\Service\FileUploader;
 
#[AsController]
final class OrderAction extends AbstractController
{
    public function __invoke(Request $request, FileUploader $fileUploader)
    {
        $uploadedFile = $request->files->get('file');
        if (!$uploadedFile) {
            throw new BadRequestHttpException('"file" is required');
        }
 
        // create a new entity and set its values
        $consom = new Consommable();
        $repo = new TypeConsommableRepository();
        
        $consom->name = $request->get('name');
        $consom->description = $request->get('description');
        $consom->price = $request->get('price');

        $selected = $repo->findOneBy(array('id' => 3)); //(3); //"3";//$request->get('typeConsommable');
        $consom->typeConsommable = $selected;


        $consom->status = $request->get('status');
 
        // upload the file and save its filename
        $consom->picture = $fileUploader->upload($uploadedFile);
 
        return $consom;
    }
}

