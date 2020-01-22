<?php


namespace OrviSoft\Enhancedecommerce\Helper;

use Magento\Framework\App\Helper\AbstractHelper;

class Track extends AbstractHelper
{

    /**
     * @param \Magento\Framework\App\Helper\Context $context
     */
    public function __construct(
        \Magento\Framework\App\Helper\Context $context
    ) {
        parent::__construct($context);
    }
}
