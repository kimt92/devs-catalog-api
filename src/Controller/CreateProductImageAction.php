<?php
namespace App\Controller;

use App\Entity\Product;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

final class CreateProductImageAction
{
    public function __invoke(Request $request): Product
    {
        $uploadedFile = $request->files->get('imageFile');
        if (!$uploadedFile) {
            throw new BadRequestHttpException('"Image" is required');
        }

        $product = new Product();
        $product->imageFile = $uploadedFile;
        $product->setName($request->request->get('name'));
        $product->setPrice($request->request->get('price'));
        $product->setQuantity($request->request->get('quantity'));

        return $product;
    }
}