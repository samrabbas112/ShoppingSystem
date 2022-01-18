<?php
namespace App\Controller\user;
use App\Entity\Category;
use App\Entity\Product;
use App\Entity\Orderitem;
use App\Form\AddToCartType;
use App\Manager\CartManager;
use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\RequestStack;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class UserDashboard extends AbstractController
{

    /**
     * @IsGranted("ROLE_USER")
     */
    /**
     * @Route("/user", name="user")
     */
    public function index(Request $request, ManagerRegistry $doctrine, CartManager $cartManager, CategoryRepository $categoryRepository): Response
    {
//        $Orderitem=new Orderitem();
//        $form = $this->createForm(AddToCartType::class,$Orderitem);
        $product = $doctrine->getRepository(Product::class)->findAll();
        $items = array();
        foreach ($product as $doc) {
            $items[] = $doc;
        }
//        $form->handleRequest($request);
//
//        if ($form->isSubmitted() && $form->isValid()) {
//            $item = $form->getData();
//            $item->setProduct($product);
//
//            $cart = $cartManager->getCurrentCart();
//            $cart
//                ->addItem($item)
//                ->setUpdatedAt(new \DateTime());
//
//            $cartManager->save($cart);
//
////            return $this->redirectToRoute('product.detail', ['id' => $product->getId()]);
//        }

        return $this->renderForm('UserDashboard.html.twig', [

            "Product" => $items,

        ]);
    }
//    /**
//     * @Route("/search_category", name="search_category")
//     */
//    public function search_category(Request $request, ManagerRegistry $doctrine, CategoryRepository $categoryRepository):Response
//    {
//
//        $form = $this->createForm(SearchType::class);
//        return $this->renderForm('Search.html.twig',[
//            'form'=>$form,
//
//        ]);
//    }
    /**
     * @Route("/product{id}", name="product.detail")
     */
    public function detail(Product $product, Request $request, CartManager $cartManager):Response
    {
        $form = $this->createForm(AddToCartType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $item = $form->getData();

            $item->setProduct($product);


            $cart = $cartManager->getCurrentCart();

            $cart
                ->addItem($item)
                ->setUpdatedAt(new \DateTime());

            $cartManager->save($cart);

            return $this->redirectToRoute('cart');
        }
        return $this->renderForm('random.html.twig', [

            "Product" => $product,
            'form'=>$form,

        ]);
    }
}