<?php

namespace Letscms\BuyNowBtn\Controller\Cart;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Checkout\Model\Cart;
use Magento\Catalog\Api\ProductRepositoryInterface;

class Add extends Action
{
    protected $cart;
    protected $productRepository;

    public function __construct(
        Context $context,
        Cart $cart,
        ProductRepositoryInterface $productRepository
    ) {
        $this->cart = $cart;
        $this->productRepository = $productRepository;
        parent::__construct($context);
    }

    public function execute()
    {
        $productId = $this->getRequest()->getParam('product_id'); // Get product ID from request
        $product = $this->productRepository->getById($productId);
        //remove old product on Cart
        $this->cart->truncate();
        // Add product to cart and proceed to checkout
        $this->cart->addProduct($product, ['qty' => 1]);
        $this->cart->save();

        return $this->resultRedirectFactory->create()->setPath('checkout');
    }
}
