# Mage2 Module OrviSoft Enhancedecommerce

    `orvisoft/module-enhancedecommerce`

 - [Main Functionalities](#markdown-header-main-functionalities)
 - [Installation](#markdown-header-installation)
 - [Configuration](#markdown-header-configuration)
 - [Specifications](#markdown-header-specifications)


## Main Functionalities
To track enhanced eCommerce tracking on Google with the help of this module.

## Installation
\* = in production please use the `--keep-generated` option

### Type 1: Zip file

 - Unzip the zip file in `app/code/OrviSoft`
 - Enable the module by running `php bin/magento module:enable OrviSoft_Enhancedecommerce`
 - Apply database updates by running `php bin/magento setup:upgrade`\*
 - Flush the cache by running `php bin/magento cache:flush`

### Type 2: Composer

 - Make the module available in a composer repository for example:
    - private repository `repo.magento.com`
    - public repository `packagist.org`
    - public github repository as vcs
 - Add the composer repository to the configuration by running `composer config repositories.repo.magento.com composer https://repo.magento.com/`
 - Install the module composer by running `composer require orvisoft/module-enhancedecommerce`
 - enable the module by running `php bin/magento module:enable OrviSoft_Enhancedecommerce`
 - apply database updates by running `php bin/magento setup:upgrade`\*
 - Flush the cache by running `php bin/magento cache:flush`


## Configuration

 - Status (enhanced_ecommerce/options/is_active)

 - Analytics ID (enhanced_ecommerce/options/analytics_id)

 - What To Track? (enhanced_ecommerce/options/to_track)

 - brand (enhanced_ecommerce/options/brand)


## Specifications

 - Helper
	- OrviSoft\Enhancedecommerce\Helper\Track

 - Block
	- Tracking\Common > tracking/common.phtml

 - Block
	- Tracking\Product > tracking/product.phtml

 - Block
	- Tracking\Category > tracking/category.phtml

 - Block
	- Tracking\Cart\Cart > tracking/cart/cart.phtml

 - Block
	- Tracking\Cart\Checkout > tracking/cart/checkout.phtml

 - Block
	- Tracking\Cart\Order > tracking/cart/order.phtml
