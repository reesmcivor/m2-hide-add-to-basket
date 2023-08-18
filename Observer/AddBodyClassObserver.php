<?php
namespace ReesMcIvor\HideAddToBasket\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Event\Observer;

class AddBodyClassObserver implements ObserverInterface
{
    protected $registry;
    protected $pageConfig;

    public function __construct(
        \Magento\Framework\Registry         $registry,
        \Magento\Framework\View\Page\Config $pageConfig
    )
    {
        $this->registry = $registry;
        $this->pageConfig = $pageConfig;
    }

    public function execute(Observer $observer)
    {
        $product = $this->registry->registry('current_product');
        if ($product) {
            $hideAddToCart = $product->getCustomAttribute('hide_addtocart');
            if ($hideAddToCart && $hideAddToCart->getValue() == '1') {
                $this->pageConfig->addBodyClass('hide-add-to-basket');
            }

            $hidePrice = $product->getCustomAttribute('hide_price');
            if ($hidePrice && $hidePrice->getValue() == '1') {
                $this->pageConfig->addBodyClass('hide-price');
            }
        }
    }
}
