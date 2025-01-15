<?php
namespace Letscms\BuyNowBtn\Plugin;

class ProductList {

    public function afterGetProductDetailsHtml(
        \Magento\Catalog\Block\Product\ListProduct $subject,
        $result,
        \Magento\Catalog\Model\Product $product
    ) {
        // return $result . $product->getId();
    }
}