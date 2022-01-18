<?php
namespace App\Controller;
use App\Entity\Order;
use App\Entity\Orderitem;
use App\Entity\Payment;
use App\Entity\Product;
use App\Form\CartType;
use App\Form\checkoutType;
use App\Manager\CartManager;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

/**
 * Class CartController
 * @package App\Controller
 */
class CartController extends AbstractController
{
    /**
     * @Route("/cart", name="cart")
     */
    public function index(CartManager $cartManager): Response
    {
        $cart = $cartManager->getCurrentCart();

        $form = $this->createForm(CartType::class, $cart);

        return $this->renderForm('cart/index.html.twig', [
            'cart' => $cart,
            'form' => $form,
        ]);
    }
    /**
     * @Route("/order_history{id}", name="order_history")
     *@ParamConverter("order")
     */
    public function order_history(Request $request,ManagerRegistry $doctrine ,Order $order,Orderitem $orderitem):Response{

        $order=$doctrine->getRepository(Order::class)->gethhjh($order->getId());
//        dd($order);
        $orderitemm=$doctrine->getRepository(Orderitem::class)->findAllGreaterThanPrice($orderitem->getId());
//        $product=$doctrine->getRepository(Product::class)->findByid($orderitem->getId());
//
//        dd($product);

//        $em=$this->getDoctrine()->getManager();
//        $query=$em->createQuery(
//            'SELECT * FROM App\Entity\Product p LEFT JOIN App\Entity\Orderitem'
//        )

//        dd($orderitemm);

        return $this->renderForm('order_history.html.twig', [
            'orderitem'=>$orderitemm,
           'order'=>$order,

        ]);
    }
    /**
     * @Route("/checkout/{id}", name="checkout")
     * @ParamConverter("order")
     */
    public function checkout(Request $request,ManagerRegistry $doctrine,Order  $order):Response{
        $checkout=new Payment();
        $form = $this->createForm(checkoutType::class,$checkout);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $doctrine->getManager();;
            $em->persist($checkout);
            $em->flush();

            return $this->redirectToRoute('order_history',['id'=>$order->getId()]);
        }
        return $this->renderForm('cart/checkout.html.twig', [
            'form' => $form,
        ]);
    }
}