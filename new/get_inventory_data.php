<?php

require('database.php');

// DB table to use
$table = 'POS.V_ProductRetail_Inventory_No_WE';

// Table's primary key
$primaryKey = 'RecID';

// Array of database columns which should be read and sent back to DataTables.
$columns = array(
    array( 'db' => 'RecID', 'dt' => 0 ),
    array( 'db' => 'UPC',  'dt' => 1 ),
    array( 'db' => 'SKU',   'dt' => 2 ),
    array( 'db' => 'Description',     'dt' => 3 ),
    array( 'db' => 'ProductPackageTypeCode', 'dt' => 4 ),
    array( 'db' => 'DescriptionAR', 'dt' => 5 ),
    array( 'db' => 'ProductPackageTypeCodeAR', 'dt' => 6 ),
    array( 'db' => 'RetailPrice', 'dt' => 7 ),
    array( 'db' => 'WholesalePrice', 'dt' => 8),
    array( 'db' => 'StockOnHand', 'dt' => 9),
    array( // This is where the new button is placed
        'db' => 'ProductSubstituteRecID',
        'dt' => 10,
        'formatter' => function( $d, $row ) {
            return "<div class='btn btn-primary' onclick='SubstituteButtonFunction()'>Substitute</div>";

        }
    ),
    array( 'db' => 'StatusRecID', 'dt' => 11, 
        'formatter' => function( $d, $row ) {
            return "<div class='btn btn-success' onclick='addToCart(this,\"inventories\")' data-id='" . $row['RecID'] . "' data-sku='" . $row['SKU'] . "' data-description='" . $row['Description'] . "' data-packageType='" . $row['ProductPackageTypeCode'] . "' data-descriptionAR='" . $row['DescriptionAR'] . "' data-packageTypeAR='" . $row['ProductPackageTypeCodeAR'] . "' data-price='" . $row['RetailPrice'] . "' data-wholesale='" . $row['WholesalePrice'] . "' data-upc='" . $row['UPC'] . "'>إضافة صنف</div>";
        }
    )
);

// SQL server connection information
$sql_details = array(
    'user' => '',
    'pass' => '',
    'db'   => '',
    'host' => ''
);

require( 'ssp.class.php' );

echo json_encode(
    SSP::simple( $_GET, $conn, $table, $primaryKey, $columns )
);
?>
