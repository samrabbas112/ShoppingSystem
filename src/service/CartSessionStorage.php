<?php
namespace App\service;
use App\Entity\Order;
use App\Repository\OrderRepository;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
class CartSessionStorage{
    private $session;
    private $cart_Repository;
    const cart_key_name='cart_id';
    public function __construct(SessionInterface $session,OrderRepository $cart_Repository){
        $this->session=$session;
        $this->cart_Repository=$cart_Repository;
    }
    public function getCartId() : ?int
    {
       return $this->session->get(self::cart_key_name);
    }
    public function getCart() : ? Order{
        return $this->cart_Repository->findOneBy([
           'id'=>$this->getCartId(),
            'status'=>Order::STATUS_CART
        ]);
    }
    public function setCart(Order $cart){
        $this->session->set(self::cart_key_name,$cart->getId());
    }

}
