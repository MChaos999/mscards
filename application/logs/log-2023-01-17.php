<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2023-01-17 16:54:39 --> 404 Page Not Found: Undefined/filter_products
ERROR - 2023-01-17 16:56:45 --> 404 Page Not Found: Undefined/filter_products
ERROR - 2023-01-17 16:59:53 --> 404 Page Not Found: Undefined/filter_products
ERROR - 2023-01-17 16:41:57 --> Query error: Unknown column 'products.promoInfo' in 'order clause' - Invalid query: SELECT `products`.`id` as `id`, `products`.`code` as `code`, `products`.`category_id` as `category_id`, `products`.`uriRO` as `uri`, `products`.`titleRO` as `title`, `products`.`promoInfoRO` as `promoInfo`, `products`.`isShown` as `isShown`, (SELECT product_prices.price FROM product_prices WHERE product_prices.product_id=products.id LIMIT 1) as price, (SELECT product_images.img FROM product_images WHERE product_images.product_id=products.id LIMIT 1) as img, (SELECT categories.uriRO FROM categories WHERE categories.id=products.category_id) as cat_uri, (SELECT categories.titleRO FROM categories WHERE categories.id=products.category_id) as cat_title
FROM `products`
WHERE `products`.`isShown` = 1
ORDER BY `products`.`promoInfo` DESC, `products`.`sorder` ASC
 LIMIT 1
ERROR - 2023-01-17 16:50:21 --> Severity: Notice --> Undefined property: Catalog::$menu D:\openServer\OpenServer\domains\mscards.loc\application\controllers\frontend\Catalog.php 283
ERROR - 2023-01-17 16:50:21 --> Severity: Notice --> Trying to get property 'uri' of non-object D:\openServer\OpenServer\domains\mscards.loc\application\controllers\frontend\Catalog.php 283
ERROR - 2023-01-17 16:50:21 --> Severity: Notice --> Trying to get property 'uri' of non-object D:\openServer\OpenServer\domains\mscards.loc\application\controllers\frontend\Catalog.php 283
ERROR - 2023-01-17 16:50:21 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at D:\openServer\OpenServer\domains\mscards.loc\system\core\Exceptions.php:271) D:\openServer\OpenServer\domains\mscards.loc\system\core\Common.php 570
ERROR - 2023-01-17 16:50:22 --> Severity: Notice --> Undefined property: Catalog::$menu D:\openServer\OpenServer\domains\mscards.loc\application\controllers\frontend\Catalog.php 283
ERROR - 2023-01-17 16:50:22 --> Severity: Notice --> Trying to get property 'uri' of non-object D:\openServer\OpenServer\domains\mscards.loc\application\controllers\frontend\Catalog.php 283
ERROR - 2023-01-17 16:50:22 --> Severity: Notice --> Trying to get property 'uri' of non-object D:\openServer\OpenServer\domains\mscards.loc\application\controllers\frontend\Catalog.php 283
ERROR - 2023-01-17 16:50:22 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at D:\openServer\OpenServer\domains\mscards.loc\system\core\Exceptions.php:271) D:\openServer\OpenServer\domains\mscards.loc\system\core\Common.php 570
ERROR - 2023-01-17 16:50:23 --> Severity: Notice --> Undefined property: Catalog::$menu D:\openServer\OpenServer\domains\mscards.loc\application\controllers\frontend\Catalog.php 283
ERROR - 2023-01-17 16:50:23 --> Severity: Notice --> Trying to get property 'uri' of non-object D:\openServer\OpenServer\domains\mscards.loc\application\controllers\frontend\Catalog.php 283
ERROR - 2023-01-17 16:50:23 --> Severity: Notice --> Trying to get property 'uri' of non-object D:\openServer\OpenServer\domains\mscards.loc\application\controllers\frontend\Catalog.php 283
ERROR - 2023-01-17 16:50:23 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at D:\openServer\OpenServer\domains\mscards.loc\system\core\Exceptions.php:271) D:\openServer\OpenServer\domains\mscards.loc\system\core\Common.php 570
ERROR - 2023-01-17 16:52:29 --> Severity: Notice --> Undefined offset: 2 D:\openServer\OpenServer\domains\mscards.loc\application\controllers\frontend\Catalog.php 283
ERROR - 2023-01-17 16:52:29 --> Severity: Notice --> Trying to get property 'uri' of non-object D:\openServer\OpenServer\domains\mscards.loc\application\controllers\frontend\Catalog.php 283
ERROR - 2023-01-17 16:59:23 --> Severity: Notice --> Array to string conversion D:\openServer\OpenServer\domains\mscards.loc\system\database\DB_query_builder.php 2442
ERROR - 2023-01-17 16:59:23 --> Query error: Unknown column 'Array' in 'where clause' - Invalid query: SELECT `products`.`id`, `products`.`category_id`
FROM `products`
JOIN `product_filters_value` ON `product_filters_value`.`product_id`=`products`.`id`
WHERE `product_filters_value`.`valueRO` = Array
AND `products`.`category_id` IN('14')
AND `products`.`isShown` = 1
ERROR - 2023-01-17 16:59:23 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at D:\openServer\OpenServer\domains\mscards.loc\system\core\Exceptions.php:271) D:\openServer\OpenServer\domains\mscards.loc\system\core\Common.php 570
ERROR - 2023-01-17 16:59:24 --> Severity: Notice --> Array to string conversion D:\openServer\OpenServer\domains\mscards.loc\system\database\DB_query_builder.php 2442
ERROR - 2023-01-17 16:59:24 --> Query error: Unknown column 'Array' in 'where clause' - Invalid query: SELECT `products`.`id`, `products`.`category_id`
FROM `products`
JOIN `product_filters_value` ON `product_filters_value`.`product_id`=`products`.`id`
WHERE `product_filters_value`.`valueRO` = Array
AND `products`.`category_id` IN('14')
AND `products`.`isShown` = 1
ERROR - 2023-01-17 16:59:24 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at D:\openServer\OpenServer\domains\mscards.loc\system\core\Exceptions.php:271) D:\openServer\OpenServer\domains\mscards.loc\system\core\Common.php 570
ERROR - 2023-01-17 16:59:25 --> Severity: Notice --> Array to string conversion D:\openServer\OpenServer\domains\mscards.loc\system\database\DB_query_builder.php 2442
ERROR - 2023-01-17 16:59:25 --> Query error: Unknown column 'Array' in 'where clause' - Invalid query: SELECT `products`.`id`, `products`.`category_id`
FROM `products`
JOIN `product_filters_value` ON `product_filters_value`.`product_id`=`products`.`id`
WHERE `product_filters_value`.`valueRO` = Array
AND `products`.`category_id` IN('14')
AND `products`.`isShown` = 1
ERROR - 2023-01-17 16:59:25 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at D:\openServer\OpenServer\domains\mscards.loc\system\core\Exceptions.php:271) D:\openServer\OpenServer\domains\mscards.loc\system\core\Common.php 570
ERROR - 2023-01-17 16:59:32 --> Severity: Notice --> Array to string conversion D:\openServer\OpenServer\domains\mscards.loc\system\database\DB_query_builder.php 2442
ERROR - 2023-01-17 16:59:32 --> Query error: Unknown column 'Array' in 'where clause' - Invalid query: SELECT `products`.`id`, `products`.`category_id`
FROM `products`
JOIN `product_filters_value` ON `product_filters_value`.`product_id`=`products`.`id`
WHERE `product_filters_value`.`valueRO` = Array
AND `products`.`category_id` IN('14')
AND `products`.`isShown` = 1
ERROR - 2023-01-17 16:59:32 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at D:\openServer\OpenServer\domains\mscards.loc\system\core\Exceptions.php:271) D:\openServer\OpenServer\domains\mscards.loc\system\core\Common.php 570
ERROR - 2023-01-17 16:59:48 --> Severity: Notice --> Array to string conversion D:\openServer\OpenServer\domains\mscards.loc\system\database\DB_query_builder.php 2442
ERROR - 2023-01-17 16:59:48 --> Query error: Unknown column 'Array' in 'where clause' - Invalid query: SELECT `products`.`id`, `products`.`category_id`
FROM `products`
JOIN `product_filters_value` ON `product_filters_value`.`product_id`=`products`.`id`
WHERE `product_filters_value`.`valueRO` = Array
AND `products`.`category_id` IN('14')
AND `products`.`isShown` = 1
ERROR - 2023-01-17 16:59:48 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at D:\openServer\OpenServer\domains\mscards.loc\system\core\Exceptions.php:271) D:\openServer\OpenServer\domains\mscards.loc\system\core\Common.php 570
ERROR - 2023-01-17 17:57:54 --> Query error: Unknown column '$this-' in 'where clause' - Invalid query: SELECT `products`.`id`, `products`.`category_id`
FROM `products`
JOIN `product_filters_value` ON `product_filters_value`.`product_id`=`products`.`id`
WHERE `product_filters_value`.`valueRO` IN('Red')
AND `products`.`isShown` = 1
AND `$this-` > tblname.category_id IN('14')
