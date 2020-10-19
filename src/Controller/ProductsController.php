<?php

declare(strict_types=1);

namespace App\Controller;

use App\DTO\CreateProductRequest;
use App\Entity\Product;
use App\Model\IdGenerator;
use App\Model\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

final class ProductsController extends AbstractController
{
    public function create(
        Request $request,
        ValidatorInterface $validator,
        SerializerInterface $serializer,
        IdGenerator $idGenerator,
        ProductRepository $productRepository,
        EntityManagerInterface $entityManager
    ): Response {
        $createProductRequest = $serializer->deserialize(
            $request->getContent(),
            CreateProductRequest::class,
            'json'
        );

        $violations = $validator->validate($createProductRequest);

        if (0 !== count($violations)) {
            return $this->json($violations, Response::HTTP_BAD_REQUEST);
        }

        $product = new Product(
            $idGenerator->generate(),
            $createProductRequest->name,
            $createProductRequest->price,
        );

        $productRepository->add($product);

        $entityManager->flush();

        return $this->json($product, Response::HTTP_CREATED);
    }
}
