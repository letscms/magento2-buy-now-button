<?php
namespace Letscms\BuyNowBtn\Block\Product;


use Magento\Framework\View\Element\Template;
use Magento\Catalog\Model\Product;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;
use Letscms\PinCodeBasedProductPrice\Helper\Data as Helper;

class ListProduct extends Template
{
    protected $product;
    public $helper;
    protected $registry;
    protected $productCollectionFactory;
    public function __construct(
        Template\Context $context,
        CollectionFactory $productCollectionFactory,
        \Magento\Framework\Registry $registry,
        Product $product,
        Helper $helper,
        array $data = []
    ) {
        $this->product = $product;
        $this->helper = $helper;
        $this->productCollectionFactory = $productCollectionFactory;
        $this->registry = $registry;
        parent::__construct($context, $data);
    }
public function getConfigData(){
    $enable_status = $this->helper->getConfig('LetscmsBuyNowBtn_General/general/enable_status');
    $Button_Bg = $this->helper->getConfig('LetscmsBuyNowBtn_General/general/Button_Bg');
    $Button_Color = $this->helper->getConfig('LetscmsBuyNowBtn_General/general/Button_Color');
    $data = [
        'enable_status'=> $enable_status,
        
        'Button_Bg' => $Button_Bg,
          'Button_Color' => $Button_Color,
          // 'Text_Color' => $Text_Color,
        
      ];
      // print_r($data);
      // die;
      return $data;
}
    public function getProduct()
    {
        $productIds = [];
        // $products = $this->getLayout()->getBlock('category.product.list')->getLoadedProductCollection();
        $categoryBlock = $this->getLayout()->getBlock('category.products.list');
$products = $categoryBlock->getLoadedProductCollection();

        foreach ($products as $product) {
            $productIds[] = $product->getId();
        }

        return $productIds;
    }

    public function getBuyNowUrl()
    {
        return $this->getUrl('BuyNowBtn/Cart/add'); // Adjusted to your module name
    }
}
