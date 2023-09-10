<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/login/utils.php';

session_check();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POS | Dashoard</title>


    <link rel="stylesheet" href="/sccs/styles.css">
    <link rel="stylesheet" href="/sccs/common.css">
    <link rel="stylesheet" href="/sccs/forms.css">
    <link rel="stylesheet" href="/sccs/table.css">
    <link rel="stylesheet" href="/sccs/dashboard.css">
    <link rel="stylesheet" href="/sccs/calculator.css">
    <link rel="stylesheet" href="/sccs/modal.css">
    <link rel="stylesheet" href="/sccs/inventory-modal.css">
    <link rel="stylesheet" href="/sccs/customer-modal.css">
    <link rel="shortcut icon" href="/favicon.svg" type="image/x-icon">
</head>

<body>
    <script>
        var session_time = <?php echo $_SESSION['login_time_stamp']; ?>;
    </script>

    <div class="col-5">
        <div class="top">
            <div class="header">
                <div class="title">Retail Price Selected | سعر التجزئة المحدد</div>
                <div class="btn" onclick="holdInvoice()">HOLD INVOICE</div>
            </div>
            <div class="table" id="cart__table">
                <table>
                    <thead style="position: sticky;">
                        <tr>
                            <th>Barcode</th>
                            <th>Item</th>
                            <th>UOM</th>
                            <th>Quantity</th>
                            <th>Unit</th>
                            <th>Total (R)</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>871600200899</td>
                            <td>Rainbow Sweetened Condensed Milk (397 ML * 48.00 Can)</td>
                            <td>CT</td>
                            <td>
                                <div class="quantity">
                                    <input class="cart__record__quantity__input" type="text" name="quantity" id="quantity" value="1.0000">
                                    <span class="cart__record__A">A</span>
                                </div>
                            </td>
                            <td>280.00
                                <span>
                                    <div class="switch" id="switch">
                                        <input class="is__wholesale__switch" type="checkbox" name="is__wholesale" id="is__wholesale">
                                    </div>
                                </span>
                            </td>
                            <td>280.00</td>
                            <td><button class="cart__record__deleteBtn">D</button></td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
        <div class="bottom">
            <div class="totals" id="totals">
                <div class="total__card" id="totals_sub_total">
                    <div class="title">Sale (Retail) | أُوكَازيُون</div>
                    <div class="amount">SAR. <span id="sub__total">280.00</span></div>
                </div>
                <div class="total__card" id="totals_vat_total">
                    <div class="title">VAT Amount | قيمة الضريبة</div>
                    <div class="amount">SAR. <span id="vat__total">42.00</span></div>
                </div>
                <div class="total__card bg__green" id="totals_grand_total">
                    <div class="title">Grand Total | المجموع الإجمالي</div>
                    <div class="amount">SAR. <span id="grand__total">322.00</span></div>
                </div>
                <div class="total__card bg__blue" id="totals_balance_total">
                    <div class="title">Balance | توازن</div>
                    <div class="amount">SAR. <span id="balance__total">322.00</span></div>
                </div>
            </div>
        </div>

    </div>
    <div class="col-4">
        <div class="customer__detail__screen">
            <div class="title">**Retail / Wholesale Customer**</div>
            <div class="detail">Customer Code: <span id="customer__code"></span></div>
            <div class="detail">Customer Phone: <span id="customer__phone"></span></div>
            <div class="detail">Customer Name: <span id="customer__name"></span></div>
        </div>
        <div class="main__menu">
            <div class="icon">
                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 576 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                    <path d="M543.8 287.6c17 0 32-14 32-32.1c1-9-3-17-11-24L512 185V64c0-17.7-14.3-32-32-32H448c-17.7 0-32 14.3-32 32v36.7L309.5 7c-6-5-14-7-21-7s-15 1-22 8L10 231.5c-7 7-10 15-10 24c0 18 14 32.1 32 32.1h32v69.7c-.1 .9-.1 1.8-.1 2.8V472c0 22.1 17.9 40 40 40h16c1.2 0 2.4-.1 3.6-.2c1.5 .1 3 .2 4.5 .2H160h24c22.1 0 40-17.9 40-40V448 384c0-17.7 14.3-32 32-32h64c17.7 0 32 14.3 32 32v64 24c0 22.1 17.9 40 40 40h24 32.5c1.4 0 2.8 0 4.2-.1c1.1 .1 2.2 .1 3.3 .1h16c22.1 0 40-17.9 40-40V455.8c.3-2.6 .5-5.3 .5-8.1l-.7-160.2h32z" fill="currentColor" />
                </svg>
                <div class="text">Main Menu</div>
                <div class="text__arabic">القائمة الرئيسية</div>
            </div>
            <div class="main__menu__btns">
                <div class="col">
                    <div class="menu__btn" onclick="showCustomerAddModal()">Cutomer | عميل</div>
                    <div class="menu__btn">Suspend | تعليق</div>
                    <div class="menu__btn">Remarks | ملاحظات</div>
                </div>
                <div class="col">
                    <div class="menu__btn">Discount | تخفيض</div>
                    <div class="menu__btn" onclick="showInventoryModal()">Inventory | جرد</div>
                    <div class="menu__btn">Other | آخر</div>
                </div>
            </div>
        </div>
        <button class="order__btn btn">PROCEED ORDER | متابعة الطلب</button>
        <input class="calc__screen" dir="rtl" type="text" name="calc__code" id="calc__code" placeholder="Product Barcode | كود المنتج" autofocus>
        <div class="calc">
            <div class="col">
                <div class="calc__btn" id="key_7">7</div>
                <div class="calc__btn" id="key_4">4</div>
                <div class="calc__btn" id="key_1">1</div>
                <div class="calc__btn" id="key_0">0</div>
            </div>
            <div class="col">
                <div class="calc__btn" id="key_8">8</div>
                <div class="calc__btn" id="key_5">5</div>
                <div class="calc__btn" id="key_2">2</div>
                <div class="calc__btn" id="key_multiply">*</div>
            </div>
            <div class="col">
                <div class="calc__btn" id="key_9">9</div>
                <div class="calc__btn" id="key_6">6</div>
                <div class="calc__btn" id="key_3">3</div>
                <div class="calc__btn" id="key_period">.</div>
            </div>
            <div class="col">
                <div class="calc__btn" id="key_close">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" id="backspace">
                        <path fill="none" d="M0 0h24v24H0V0z"></path>
                        <path d="M22 3H7c-.69 0-1.23.35-1.59.88L.37 11.45c-.22.34-.22.77 0 1.11l5.04 7.56c.36.52.9.88 1.59.88h15c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-3.7 13.3c-.39.39-1.02.39-1.41 0L14 13.41l-2.89 2.89c-.39.39-1.02.39-1.41 0-.39-.39-.39-1.02 0-1.41L12.59 12 9.7 9.11c-.39-.39-.39-1.02 0-1.41.39-.39 1.02-.39 1.41 0L14 10.59l2.89-2.89c.39-.39 1.02-.39 1.41 0 .39.39.39 1.02 0 1.41L15.41 12l2.89 2.89c.38.38.38 1.02 0 1.41z" fill="currentColor"></path>
                    </svg>
                </div>
                <div class="calc__btn" id="key_reset">C</div>
                <div class="calc__btn calc__btnEnter" id="key_enter">
                    <svg xmlns="http://www.w3.org/2000/svg" height="5rem" viewBox="0 0 24 24" id="enter">
                        <path d="M19,6a1,1,0,0,0-1,1v4a1,1,0,0,1-1,1H7.41l1.3-1.29A1,1,0,0,0,7.29,9.29l-3,3a1,1,0,0,0-.21.33,1,1,0,0,0,0,.76,1,1,0,0,0,.21.33l3,3a1,1,0,0,0,1.42,0,1,1,0,0,0,0-1.42L7.41,14H17a3,3,0,0,0,3-3V7A1,1,0,0,0,19,6Z" fill="currentColor"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>
    <div class="col-3">
        <div class="header">
            <div>شركة امتياز لخدمات التموين</div>
            <div>emtyaz for catering company</div>
            <div>رقم ضريبة القيمة المضافة</div>
        </div>
        <div class="btn payments__btn">
            <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 320 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                <path d="M160 0c17.7 0 32 14.3 32 32V67.7c1.6 .2 3.1 .4 4.7 .7c.4 .1 .7 .1 1.1 .2l48 8.8c17.4 3.2 28.9 19.9 25.7 37.2s-19.9 28.9-37.2 25.7l-47.5-8.7c-31.3-4.6-58.9-1.5-78.3 6.2s-27.2 18.3-29 28.1c-2 10.7-.5 16.7 1.2 20.4c1.8 3.9 5.5 8.3 12.8 13.2c16.3 10.7 41.3 17.7 73.7 26.3l2.9 .8c28.6 7.6 63.6 16.8 89.6 33.8c14.2 9.3 27.6 21.9 35.9 39.5c8.5 17.9 10.3 37.9 6.4 59.2c-6.9 38-33.1 63.4-65.6 76.7c-13.7 5.6-28.6 9.2-44.4 11V480c0 17.7-14.3 32-32 32s-32-14.3-32-32V445.1c-.4-.1-.9-.1-1.3-.2l-.2 0 0 0c-24.4-3.8-64.5-14.3-91.5-26.3c-16.1-7.2-23.4-26.1-16.2-42.2s26.1-23.4 42.2-16.2c20.9 9.3 55.3 18.5 75.2 21.6c31.9 4.7 58.2 2 76-5.3c16.9-6.9 24.6-16.9 26.8-28.9c1.9-10.6 .4-16.7-1.3-20.4c-1.9-4-5.6-8.4-13-13.3c-16.4-10.7-41.5-17.7-74-26.3l-2.8-.7 0 0C119.4 279.3 84.4 270 58.4 253c-14.2-9.3-27.5-22-35.8-39.6c-8.4-17.9-10.1-37.9-6.1-59.2C23.7 116 52.3 91.2 84.8 78.3c13.3-5.3 27.9-8.9 43.2-11V32c0-17.7 14.3-32 32-32z" fill="currentColor" />
            </svg>
            <div>Payments | المدفوعات</div>
        </div>
        <div class="couple__btns">
            <div class="btn" onclick="showSalesModal()">
                <div class="text">Recent Sales</div>
                <div class="text__arabic">المبيعات الأخيرة</div>
            </div>
            <div class="btn" onclick="showInvoiceOnHoldModal()">
                <div class="text">Invoices on Hold</div>
                <div class="text__arabic">الفاتورة معلقة</div>
            </div>
        </div>
        <div class="signout__btn" onclick="document.location = '/login/logout.php'">
            <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                <path d="M352 96l64 0c17.7 0 32 14.3 32 32l0 256c0 17.7-14.3 32-32 32l-64 0c-17.7 0-32 14.3-32 32s14.3 32 32 32l64 0c53 0 96-43 96-96l0-256c0-53-43-96-96-96l-64 0c-17.7 0-32 14.3-32 32s14.3 32 32 32zm-9.4 182.6c12.5-12.5 12.5-32.8 0-45.3l-128-128c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L242.7 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l210.7 0-73.4 73.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l128-128z" fill="currentColor" />
            </svg>
            <div class="text">Sign Out</div>
            <div class="text__arabic">خروج</div>
        </div>
        <div class="category__btns">
            <div class="category__btn">Bakery & Bread</div>
            <div class="category__btn">Baby</div>
            <div class="category__btn">Beverages</div>
            <div class="category__btn">Dairy, Egg and Cheese</div>
            <div class="category__btn">Frozen</div>
            <div class="category__btn">Frozen</div>
            <div class="category__btn">Frozen</div>
            <div class="category__btn">Frozen</div>
            <div class="category__btn">Frozen</div>
            <div class="category__btn">Frozen</div>
        </div>
    </div>


    <?php include $ROOT . '/modals/invoice-on-hold.php'; ?>

    <?php include $ROOT . '/modals/sales-modal.php'; ?>
    
    <?php include $ROOT . '/modals/customer-modal.php'; ?>
    
    <script src="/js/inventory.js"></script>

    <?php include $ROOT . '/modals/inventory-modal.php'; ?>
    
    <script src="/js/script.js"></script>
    <script src="/js/scroll.js"></script>
    <script src="/js/calculator.js"></script>
    <script src="/js/session.js"></script>
    <script src="/js/cart.js"></script>
</body>

</html>