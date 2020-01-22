<?php


namespace OrviSoft\Enhancedecommerce\Model\Config\Source;

class ToTrack implements \Magento\Framework\Option\ArrayInterface
{

    public function toOptionArray()
    {
        return [['value' => 'products', 'label' => __('Products')],['value' => 'categories', 'label' => __('Categories')],['value' => 'cart', 'label' => __('Cart')],['value' => 'checkout', 'label' => __('Checkout')],['value' => 'order', 'label' => __('Order')]];
    }

    public function toArray()
    {
        return ['products' => __('Products'),'categories' => __('Categories'),'cart' => __('Cart'),'checkout' => __('Checkout'),'order' => __('Order')];
    }
}
