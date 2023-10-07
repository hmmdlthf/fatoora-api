<?php
//session_start();
require('session.php');
require('database.php');

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>POS</title>
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"/>
    <link rel="stylesheet" href="css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-5 position-relative">
            <div class="row">
                <div class="col-md-12">
                    <div class="quantity-text bg-light-gray border-gray px-3 py-2 d-flex justify-content-between">
                        <span class="pb-2 pt-2" id="cart_title"><strong>Retail Price Selected | سعر التجزئة المحدد</strong></span>
                        <button class="btn btn-success pb-2 pt-2 rounded-0 w-25 float-right" id="holdinvoice">
                            HOLD INVOICE
                        </button>
                    </div>
                </div>
            </div>
            <!-- row end -->
            <div class="row">
                <div id="style-1" class="col-md-12 modal-scroll inventory-height">
                    <input type="hidden" value="<?php echo isset($_SESSION['recID'])?$_SESSION['recID']:''?>" name="cartRecID" id="cartRecID">
                    <table class="border table table-sm mt-1">
                        <thead class="bg-dark-gray font-weight-bold">
                        <tr>
                            <td class="border-bottom border-end px-2">Barcode</td>
                            <td class="border-bottom border-end px-2 w-25">Item</td>
                            <td class="border-bottom border-end px-2">UOM</td> <!-- New Rozmi -->
                            <td class="border-bottom border-end px-2">Quantity</td>
                            <td class="border-bottom border-end px-2">Unit</td>
                            <td class="border-bottom border-end px-2" id="total_col">Total (R)</td>
                            <td class="border-bottom border-end px-2"></td>
                            <!--<td class="border-bottom border-end px-2">Action</td> ORIGIN-->
                        </tr>
                        </thead>
                        <tbody class="border-inside" id="shopping_cart">
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- row end -->
            <input type="hidden" id="dbItemsPrice">
            <div class="sale-balance-area">

                    <div class="border d-flex justify-content-between pb-2 pt-2 px-3 sale_">
                     <span class="font-weight-bold text-center" id="totalSale_desc">
                     <i class="d-block fa fa-chevron-up mb-1 text-black-50"></i>
                     Sale (Retail) | أوكازيون  </span>
                        <span class="font-weight-bold text-center" style="display: none" id="totalWholeSale_desc" >
                            <i class="d-block fa fa-chevron-up mb-1 text-black-50"></i>Sale (WholeSale)</span>
                        <span class="font-weight-bold text-center">
                     <i class="d-block fa fa-chevron-down mb-1 text-black-50"></i>SAR.
                            <span id="totalSale">00</span><span id="totalWholeSale" style="display: none"></span></span>
                    </div>
                <!-- sale_ end -->
                <div class="balance border d-flex justify-content-between mt-1 pb-2 pt-2 px-3 sale_">
                    <span class="font-weight-bold text-center">VAT Amount | قيمة الضريبة</span>
                    <span class="font-weight-bold text-center">SAR.
                        <span id="vat">
                           00
                        </span>
                     </span>
                </div>
                <div class="balance border d-flex justify-content-between mt-1 pb-2 pt-2 px-3 sale_"
                     style="background-color:#A5D0A8">
                    <span class="font-weight-bold text-center">Grand Total | المبلغ الإجمالي</span>
                    <span class="font-weight-bold text-center">SAR.
                        <span id="grandTotal">
                           00
                        </span>
                     </span>
                </div>

                    <div class="balance border d-flex justify-content-between mt-1 pb-2 pt-2 px-3 sale_" id="cash_mode_div"
                         style="background-color:#F2F4CB;display: none">
                        <span class="font-weight-bold text-center">Pay By Cash | الدفع نقدا</span>
                        <span class="font-weight-bold text-center">SAR. <span
                                    id="getCashAmount">00</span></span>
                    </div>


                    <div class="balance border d-flex justify-content-between mt-1 pb-2 pt-2 px-3 sale_" id="card_mode_div"
                         style="background-color:#F2F4CD;display: none">
                        <span class="font-weight-bold text-center">Pay By Card | الدفع بالبطاقة</span>
                        <span class="font-weight-bold text-center">SAR. <span
                                    id="getCardAmount">00</span></span>
                    </div>

                <div class="balance border d-flex justify-content-between mt-1 pb-2 pt-2 px-3 sale_"
                     style="background-color:#CAF0F8">
                    <span class="font-weight-bold text-center">Balance | الرصيد</span>
                    <span class="font-weight-bold text-center">SAR.
                        <span id="totalBalance">

                        </span>
                     </span>
                </div>
            </div>
        </div>
        <!-- col-md-5 end -->
        <div class="col-md-4 p-md-0">
            <div class="border-gray cash-memo col-md-12 position-relative px-2 py-2" style="height: 120px;" id="customer_data">
                <p class="cashcustomer dark-text font-weight-bold m-0">** Retail / Wholesale Customer **</p>
                <p class="light-text">Customer
                    Code:</p>
                <p class="light-text">Customer
                    Phone:</p>
                <p class="light-text">Customer
                    Name:</p>
                <p class="light-text vh light-300"><i class="fa fa-archive me-2 text-brown"></i>SAR. 9,999,999.00 -
                    <span class="font-weight-bold">SAR. 9,999,999.00 remaining</span></p>
                <p class="light-text vh"><i class="fa fa-car-side me-1"></i>No order</p>
                <span><i class="fa"></i></span>
            </div>
            <div class="col-md-12">
                <button class="bg-dark-gray border btn-main hover-btn pt-4 text-black-50 w-100">
                    <i class="d-block fa fa-2x fa-home mb-2 text-gray"></i>
                    Main Menu <br>
                    القائمة الرئيسية
                </button>
            </div>
            <!-- col-md-12 end -->
            <div class="col-md-12 d-flex flex-wrap">
                <div class="col-md-12 d-flex flex-wrap">
                    <button class="bg-medium-gray btn-main cs_btns hover-btn pb-2 pt-2 text-black-50"
                            data-toggle="modal" data-target="#customerpop">
                        Customer | عميل
                    </button>
                    <button class="bg-medium-gray btn-main cs_btns hover-btn pb-2 pt-2 text-black-50"
                            data-toggle="modal">
                        Discount | خصم
                    </button>
                    <button class="bg-medium-gray btn-main cs_btns hover-btn pb-2 pt-2 text-black-50" id="endOfOrder">
                        Suspend | واضح
                    </button>
                    <button class="bg-medium-gray btn-main cs_btns hover-btn pb-2 pt-2 text-black-50 showInventory"
                            data-toggle="modal" data-target="#inventories">
                        Inventory | المخزون
                    </button>
                    <button class="bg-medium-gray btn-main cs_btns hover-btn pb-2 pt-2 text-black-50"
                            data-toggle="modal" data-target="#addNotes">
                        Remarks | ملاحظات
                    </button>
                    <!-- <a href="http://45.126.127.71:8091/emtyaztest/app_Login/" target="_blank" -->
                    <a href="http://erp.emtyaz.co:8091/emtyaz/custom_no_sec_pos_inventory_productsubstitute1/" target="_blank"
                        class="bg-medium-gray btn-main cs_btns hover-btn pb-2 pt-2 text-black-50"
                       style="text-align: center;text-decoration: none;">Substitute | استبدل</a>
                       
                </div>
            </div>
            <!-- col-md-12 end -->
            <div class="col-md-12">
                <button class="btn btn-success pb-2 pt-2 rounded-0 w-100" id="checkout">
                    PROCEED ORDER | الأمر المتابع
                </button>
            </div>
            <!-- col-md-12 end -->
            <div class="col-md-12">
                <div id="calculator">
                    <input type="string" class="calculator-input" placeholder="Product Barcode | الباركود المنتج"
                           id="keyboard-screen" autofocus onfocus="sessionStorage.setItem('focused','keyboard-screen');" >
                    <div class="calculator-row">
                        <div class="calculator-col">
                            <button class="calculator-btn keyboard">7</button>
                        </div>
                        <div class="calculator-col">
                            <button class="calculator-btn keyboard">8</button>
                        </div>
                        <div class="calculator-col">
                            <button class="calculator-btn keyboard">9</button>
                        </div>
                        <div class="calculator-col">
                            <button class="action calculator-btn" id="barcodeBackspace"><i class="fas fa-backspace"></i></button>
                        </div>
                    </div>
                    <div class="calculator-row">
                        <div class="calculator-col">
                            <button class="calculator-btn keyboard">4</button>
                        </div>
                        <div class="calculator-col">
                            <button class="calculator-btn keyboard">5</button>
                        </div>
                        <div class="calculator-col">
                            <button class="calculator-btn keyboard">6</button>
                        </div>
                        <div class="calculator-col">
                            <button class="action calculator-btn" id="barcodeClear">C</button>
                        </div>
                    </div>
                    <div class="calculator-row">
                        <div class="calculator-col" style="flex:3">
                            <div class="calculator-row">
                                <div class="calculator-col">
                                    <button class="calculator-btn keyboard">1</button>
                                </div>
                                <div class="calculator-col">
                                    <button class="calculator-btn keyboard">2</button>
                                </div>
                                <div class="calculator-col">
                                    <button class="calculator-btn keyboard">3</button>
                                </div>
                            </div>
                            <div class="calculator-row">
                                <div class="calculator-col">
                                    <button class="calculator-btn keyboard">0</button>
                                </div>
                                <div class="calculator-col">
                                    <button class="calculator-btn">*</button>
                                </div>
                                <div class="calculator-col">
                                    <button class="calculator-btn action">.</button>
                                </div>
                            </div>
                        </div>
                        <div class="calculator-col">
                            <button class="action calculator-btn" id="addCalCart" style="height: 100%;font-size: 46pt;">↵</button>
                        </div>
                    </div>
                </div>
            </div>
        <!-- col-md-12 end -->
    </div>
    <!-- col-md-4 end -->
    <div class="col-md-3">
        <div class="row">
            <div class="border py-4 text-center">
                <img src="images/logo.png" class="img-fluid" alt="" style="width: 90%;">
            </div>
            <!-- col-md-6 end -->
        </div>
        <div class="col-md-12">
            <button class="bg-success border btn-main mt-1 pb-2 pt-4 text-white w-100" data-toggle="modal"
                    data-target="#amount">
                <i class="d-block fa fa-2x fa-dollar-sign mb-2 text-gray"></i>Payments | المدفوعات
            </button>
        </div>
        <div class="col-md-12 d-flex flex-wrap justify-content-between">
            <button class="bg-medium-gray border btn-main flex-fill font-weight-normal hover-btn pb-2 pt-2 px-2 text-black-50 showSales">
                Recent Sales <br>المبيعات الأخيرة
            </button>
            <button class="bg-medium-yellow border btn-main flex-fill font-weight-normal hover-btn pb-2 pt-2 px-2 text-black-50 showHolds">
                Invoices on Hold <br>الفواتير المعلقة
            </button>
            <!-- col-md-6 end -->
        </div>
        <div class="col-md-12 d-flex flex-wrap justify-content-between">
            <a href="logout.php" class="bg-danger border btn-main flex-fill hover-btn px-2 py-2 text-white" style="text-decoration: none;
    text-align: center;">
                <i class="d-block fa fa-2x fa-sign-in-alt"></i>
                Sign Out <br> خروج</a>
        </div>
        <!-- col-md-12 end -->
        <div id="style-1" class="col-md-12 d-flex flex-wrap justify-content-between max-scroll">
            <?php
            // Getting Product Type In Categories
            /*ORIGINAL MY SQL Code.
            $query = "SELECT * FROM ProductTypeTable";
            $result = $conn->query($query);
            if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()){
            */
            $query = "SELECT * FROM CodeMaster.ProductType WHERE(RecID IN (SELECT ProductTypeRecID FROM Inventory.Product WHERE (Sellable = 'Y')))";
            $result = sqlsrv_query($conn, $query, array(), array("Scrollable" => 'static'));

            while ($row = sqlsrv_fetch_array($result)) {

                ?>
                <button class="bg-white border btn-main flex-fill font-weight-bold hover-btn px-4 py-4 text-black-50 w-100 //showProducts"
                        data-id="<?php echo $row['RecID'] ?>"><?php echo $row['Name'] ?></button>
            <?php } ?>
        </div>
    </div>
    <!-- col-md-3 end -->
</div>
<!-- row end -->
</div>
<!-- container -->
<!-- Modal -->
<div class="modal fade" id="products" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-body modal-body-custom">
            </div>
        </div>
    </div>
</div>
<!-- Modal Inventory -->
<div class="modal fade" id="inventories" tabindex="-1" role="dialog" aria-labelledby="inventoryModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="inventoryModalLabel">All Inventory | كل الجرد</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" id="inventory-dismiss">&times;</span>
                </button>
            </div>
            <div class="modal-body modal-body-inventories">
            </div>
        </div>
    </div>
</div>
<!-- Modal Sales-->
<div class="modal fade" id="sales" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Total Sales</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id='style-1' class='d-flex flex-wrap fruits-container justify-content-around max-scroll'>
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">Action</th>
                            <th scope="col">Customer</th>
                            <th scope="col">Invoice #</th>
                            <th scope="col">Invoice Date</th>
                            <th scope="col">Total Amount</th>
                            <th scope="col">Invoice</th>
                        </tr>
                        </thead>
                        <tbody id="modal-body-sales"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal Holdon Invoices-->
<div class="modal fade" id="invoices" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Invoices on Hold</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id='style-1' class='d-flex flex-wrap fruits-container justify-content-around max-scroll'>
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">Rec ID</th>
                            <th scope="col">Customer</th>
                            <th scope="col">Invoice #</th>
                            <th scope="col">Invoice Date</th>
                            <th scope="col">Total Amount</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody id="modal-body-invoices"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal Customer -->
<div class="modal fade" id="customerpop" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Customer Details | تفاصيل العميل</h5>
            </div>
            <div class="modal-body">
                <form action="" method="" class="">
                    <div class="form-group mb-2">
                        <label class="mb-2">Customer Code</label>
                        <input type="phone" class="form-control" id="customerCode"
                               placeholder="Customer Code | كود العميل">
                    </div>
                    <div class="form-group mb-2">
                        <label class="mb-2">Customer Phone No</label>
                        <input type="phone" class="form-control" id="customerNo"
                               placeholder="Customer Phone | هاتف العميل">
                    </div>
                    <div class="form-group mb-4">
                        <label class="mb-2">Customer Name</label>
                        <input type="phone" class="form-control" id="customerName"
                               placeholder="Customer Name | اسم الزبون">
                    </div>
                    <!-- Start -->
                    <div id="calculator">
                        <div class="calculator-row">
                            <div class="calculator-col">
                                <button class="calculator-btn keyboard-customer">7</button>
                            </div>
                            <div class="calculator-col">
                                <button class="calculator-btn keyboard-customer">8</button>
                            </div>
                            <div class="calculator-col">
                                <button class="calculator-btn keyboard-customer">9</button>
                            </div>
                        </div>
                        <div class="calculator-row">
                            <div class="calculator-col">
                                <button class="calculator-btn keyboard-customer">4</button>
                            </div>
                            <div class="calculator-col">
                                <button class="calculator-btn keyboard-customer">5</button>
                            </div>
                            <div class="calculator-col">
                                <button class="calculator-btn keyboard-customer">6</button>
                            </div>
                        </div>
                        <div class="calculator-row">
                            <div class="calculator-col">
                                <button class="calculator-btn keyboard-customer">1</button>
                            </div>
                            <div class="calculator-col">
                                <button class="calculator-btn keyboard-customer">2</button>
                            </div>
                            <div class="calculator-col">
                                <button class="calculator-btn keyboard-customer">3</button>
                            </div>
                        </div>
                        <div class="calculator-row">
                            <div class="calculator-col">
                                <button class="calculator-btn keyboard-customer">+</button>
                            </div>
                            <div class="calculator-col">
                                <button class="calculator-btn keyboard-customer">0</button>
                            </div>
                            <div class="calculator-col">
                                <button class="action calculator-btn" id="customerClear">c</button>
                            </div>
                        </div>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary" id="addCustomer">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal Amount -->
<div class="modal fade" id="amount" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Payment Via Cash / Card | الدفع نقدا / بالبطاقة</h5>
            </div>
            <div class="modal-body">
                <div class="form-group mb-1">
                    <div class="radio">
                        <label><input type="radio" name="paymentModeOpt" checked value="Pay By Cash"> Pay By Cash |
                            الدفع نقدا</label>
                    </div>
                </div>
                <div class="form-group mb-4">
                    <div class="radio">
                        <label><input type="radio" name="paymentModeOpt" value="Pay By Card"> Pay By Card | الدفع
                            بالبطاقة</label>
                    </div>
                </div>
                <div class="form-group mb-4">
                    <label class="mb-2">Amount</label>
                    <input type="phone" class="form-control" placeholder="Enter Amount | أدخل المبلغ"
                           id="paymentModeAmount">
                </div>
                <!-- Start -->
                <div id="calculator">
                    <div class="calculator-row">
                        <div class="calculator-col">
                            <button class="calculator-btn keyboard-payments">7</button>
                        </div>
                        <div class="calculator-col">
                            <button class="calculator-btn keyboard-payments">8</button>
                        </div>
                        <div class="calculator-col">
                            <button class="calculator-btn keyboard-payments">9</button>
                        </div>
                    </div>
                    <div class="calculator-row">
                        <div class="calculator-col">
                            <button class="calculator-btn keyboard-payments">4</button>
                        </div>
                        <div class="calculator-col">
                            <button class="calculator-btn keyboard-payments">5</button>
                        </div>
                        <div class="calculator-col">
                            <button class="calculator-btn keyboard-payments">6</button>
                        </div>
                    </div>
                    <div class="calculator-row">
                        <div class="calculator-col">
                            <button class="calculator-btn keyboard-payments">1</button>
                        </div>
                        <div class="calculator-col">
                            <button class="calculator-btn keyboard-payments">2</button>
                        </div>
                        <div class="calculator-col">
                            <button class="calculator-btn keyboard-payments">3</button>
                        </div>
                    </div>
                    <div class="calculator-row">
                        <div class="calculator-col">
                            <button class="calculator-btn keyboard-payments">0</button>
                        </div>
                        <div class="calculator-col">
                            <button class="action calculator-btn" id="amountClear">c</button>
                        </div>
                    </div>
                </div>
                <br>
                <button type="submit" class="btn btn-primary" id="paymentMode">Apply</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal Price -->
<div class="modal fade" id="changePrice" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Retail / Wholesale Price | سعر البيع بالتجزئة /
                    الجملة</h5>
            </div>
            <div class="modal-body">
                <form action="" method="" class="">
                    <div class="form-group mb-1">
                        <div class="radio">
                            <label><input type="radio" name="priceOpt" checked value="1"> Select Retail Price | حدد سعر
                                التجزئة</label>
                        </div>
                    </div>
                    <div class="form-group mb-4">
                        <div class="radio">
                            <label><input type="radio" name="priceOpt" value="2"> Select Wholesale Price | حدد سعر
                                الجملة</label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary" id="setPrice">Apply</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Add noted -->
<div class="modal fade" id="addNotes" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Remarks</h5>
            </div>
            <div class="modal-body">
                <form action="" method="" class="">
                    <div class="form-group mb-1">
                        <textarea name="notesValueGet" id="notesValueGet" cols="30" rows="10"
                                  class="form-control mb-2"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary" id="notes">Add Remarks</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal Discouunt -->
<div class="modal fade" id="discountpop" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Customer Discount</h5>
            </div>
            <div class="modal-body">
                <form action="" method="" class="">
                    <div class="form-group mb-4">
                        <label class="mb-2">Discount %</label>
                        <input type="phone" class="form-control" placeholder="Enter Discount Ex: 10"
                               id="discountAmount">
                    </div>
                    <button type="submit" class="btn btn-primary" id="addDiscount">Apply</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="js/jquery.min.js"></script>
<script src="js/jquery.dataTables.min.js"></script>

<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/custom.js"></script>
<script src="js/sum2.js"></script>
<script src="js/typeahead.min.js"></script>

</body>
</html>