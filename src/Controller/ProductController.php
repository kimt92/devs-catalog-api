<?php
namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class ProductController
{

      public function postimage(Request $request): Product
        {
            $uploadedFile = $request->files->get('imageFile');

            if (!$uploadedFile) {
                throw new BadRequestHttpException('postimage is required');
            }

            $product = new Product();
            $product->imageFile = $uploadedFile;

            return $product;
        }




}