<?php

namespace App\Controller;
 
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use App\Entity\superheroes;
use App\Service\FileUploader;
 
final class OrderAction extends AbstractController
{
    public function __invoke(Request $request, FileUploader $fileUploader): superheroes
    {
        $uploadedFile = $request->files->get('path');
        if (!$uploadedFile) {
            throw new BadRequestHttpException('"file" is required');
        }
 
        // create a new entity and set its values
        $superhero = new superheroes();
        $superhero->name = $request->get('name');
        $superhero->slug = $request->get('slug');
        $superhero->featured = $request->get('featured');
        $superhero->created_at = $request->get('created_at');
 
        // upload the file and save its filename
        $superhero->cover = $fileUploader->upload($uploadedFile);
 
        return $superhero;
    }
}