<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2023-01-16 14:05:01 --> Could not find the language line "Value"
ERROR - 2023-01-16 14:05:12 --> Could not find the language line "Value"
ERROR - 2023-01-16 13:07:00 --> Severity: Notice --> Undefined variable: filter_group_id D:\openServer\OpenServer\domains\mscards.loc\application\models\Filters_model.php 103
ERROR - 2023-01-16 14:11:03 --> Could not find the language line "Value"
ERROR - 2023-01-16 13:17:52 --> Severity: error --> Exception: syntax error, unexpected ')' D:\openServer\OpenServer\domains\mscards.loc\application\models\Filters_model.php 105
ERROR - 2023-01-16 13:18:13 --> Severity: Notice --> Array to string conversion D:\openServer\OpenServer\domains\mscards.loc\system\database\DB_query_builder.php 2442
ERROR - 2023-01-16 13:18:13 --> Query error: Unknown column 'id' in 'field list' - Invalid query: SELECT `id` as `id`, `titleRO` as `title`, `valuesRO` as `values`
FROM `category_filters`
WHERE `category_id` = Array
ORDER BY `sorder` ASC, `ID` DESC
ERROR - 2023-01-16 13:18:13 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at D:\openServer\OpenServer\domains\mscards.loc\system\core\Exceptions.php:271) D:\openServer\OpenServer\domains\mscards.loc\system\core\Common.php 570
ERROR - 2023-01-16 13:18:29 --> Severity: Notice --> Array to string conversion D:\openServer\OpenServer\domains\mscards.loc\system\database\DB_query_builder.php 2442
ERROR - 2023-01-16 13:18:29 --> Query error: Unknown column 'Array' in 'where clause' - Invalid query: SELECT `category_id` as `category_id`, `titleRO` as `title`, `valuesRO` as `values`
FROM `category_filters`
WHERE `category_id` = Array
ORDER BY `sorder` ASC, `ID` DESC
ERROR - 2023-01-16 13:18:29 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at D:\openServer\OpenServer\domains\mscards.loc\system\core\Exceptions.php:271) D:\openServer\OpenServer\domains\mscards.loc\system\core\Common.php 570
ERROR - 2023-01-16 13:18:38 --> Severity: Notice --> Array to string conversion D:\openServer\OpenServer\domains\mscards.loc\system\database\DB_query_builder.php 2442
ERROR - 2023-01-16 13:18:38 --> Query error: Unknown column 'Array' in 'where clause' - Invalid query: SELECT `category_id` as `category_id`, `titleRO` as `title`, `valuesRO` as `values`
FROM `category_filters`
WHERE `category_id` = Array
ORDER BY `sorder` ASC, `ID` DESC
ERROR - 2023-01-16 13:18:38 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at D:\openServer\OpenServer\domains\mscards.loc\system\core\Exceptions.php:271) D:\openServer\OpenServer\domains\mscards.loc\system\core\Common.php 570
ERROR - 2023-01-16 13:18:50 --> Query error: Unknown column 'ID' in 'order clause' - Invalid query: SELECT `category_id` as `category_id`, `titleRO` as `title`, `valuesRO` as `values`
FROM `category_filters`
WHERE `category_id` IN('14')
ORDER BY `sorder` ASC, `ID` DESC
ERROR - 2023-01-16 14:00:53 --> Severity: error --> Exception: Cannot use object of type stdClass as array D:\openServer\OpenServer\domains\mscards.loc\application\views\pages\catalog\category.php 97
