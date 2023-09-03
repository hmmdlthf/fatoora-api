<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POS | Dashoard</title>

    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">


    <link rel="shortcut icon" href="/favicon.svg" type="image/x-icon">
</head>

<body>
    <div class="container-fluid vh-100 d-flex justify-content-center">

        <div class="row w-100 vh-100 py-3">
            <div class="col-5 d-flex flex-column justify-content-between">
                <div class="row">
                    <div class="col-12">
                        <div class="row border p-2">
                            <div class="col-12 d-flex justify-content-between">
                                <div class="title">Retail Price Selected</div>
                                <div class="btn btn-success">HOLD INVOICE</div>
                            </div>
                        </div>
                        <div class="row border">
                            <table class="table m-0">
                                <thead>
                                    <tr>
                                        <th scope="col">Barcode</th>
                                        <th scope="col">Item</th>
                                        <th scope="col">UOM</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Unit</th>
                                        <th scope="col">Total(R)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td scope="col"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="row" id="no__cart__records">
                            <div class="col-12 text-center p-3 border">
                                Your Cart is Empty!
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row border">
                    <div class="col-12 fw-bold">
                        <div class="row border mb-1">
                            <div class="col-12 p-3">
                                <div class="row">
                                    <div class="col-12 px-5 d-flex justify-content-between">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                            <path d="M201.4 137.4c12.5-12.5 32.8-12.5 45.3 0l160 160c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L224 205.3 86.6 342.6c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3l160-160z" />
                                        </svg>
                                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                            <path d="M201.4 342.6c12.5 12.5 32.8 12.5 45.3 0l160-160c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L224 274.7 86.6 137.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l160 160z" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 d-flex justify-content-between">
                                        <div class="">Sale (Retail) | </div>
                                        <div class="" id="sale__amount">SAR. 0.00</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row border mb-1">
                            <div class="col-12 p-3 d-flex justify-content-between">
                                <div class="">VAT Amount | </div>
                                <div class="" id="sale__amount">SAR. 0.00</div>
                            </div>
                        </div>
                        <div class="row border mb-1">
                            <div class="col-12 p-3 d-flex justify-content-between" style="background-color: #A6D0A8;">
                                <div class="">Grand Total | </div>
                                <div class="" id="sale__amount">SAR. 0.00</div>
                            </div>
                        </div>
                        <div class="row border">
                            <div class="col-12 p-3 d-flex justify-content-between" style="background-color: #C7F3F6;">
                                <div class="">Balance | </div>
                                <div class="" id="sale__amount">SAR. 0.00</div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="row border">
                    <div class="col-12">
                        <div class="title fw-bold">** Retail/Wholesale Customer**</div>
                        <div class="detail pb-5">
                            <div class="detail">Customer code: <span class="fw-bold" id="customer__code"></span></div>
                            <div class="detail">Customer Phone: <span class="fw-bold" id="customer__phone"></span></div>
                            <div class="detail">Customer Name: <span class="fw-bold" id="customer__name"></span></div>
                        </div>
                    </div>
                </div>
                <div class="row border">
                    <div class="col-12 p-3 fw-bold text-secondary" style="background-color: #E6EBEE;">
                        <div class="icon d-flex flex-column align-items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" height="3rem" class="mb-1" viewBox="0 0 576 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                <path d="M543.8 287.6c17 0 32-14 32-32.1c1-9-3-17-11-24L512 185V64c0-17.7-14.3-32-32-32H448c-17.7 0-32 14.3-32 32v36.7L309.5 7c-6-5-14-7-21-7s-15 1-22 8L10 231.5c-7 7-10 15-10 24c0 18 14 32.1 32 32.1h32v69.7c-.1 .9-.1 1.8-.1 2.8V472c0 22.1 17.9 40 40 40h16c1.2 0 2.4-.1 3.6-.2c1.5 .1 3 .2 4.5 .2H160h24c22.1 0 40-17.9 40-40V448 384c0-17.7 14.3-32 32-32h64c17.7 0 32 14.3 32 32v64 24c0 22.1 17.9 40 40 40h24 32.5c1.4 0 2.8 0 4.2-.1c1.1 .1 2.2 .1 3.3 .1h16c22.1 0 40-17.9 40-40V455.8c.3-2.6 .5-5.3 .5-8.1l-.7-160.2h32z" fill="currentColor" />
                            </svg>
                            <div>Main Menu</div>
                            <div>القائمة الرئيسية</div>
                        </div>
                    </div>
                </div>
                <div class="row border" style="background-color: #F1F5F6;">
                    <div class="col-6">
                        <div class="row border p-3 d-flex justify-content-center text-center menu__btn">
                            Customer
                        </div>
                        <div class="row border p-3 d-flex justify-content-center text-center menu__btn">
                            Suspend
                        </div>
                        <div class="row border p-3 d-flex justify-content-center text-center menu__btn">
                            Remarks
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="row border p-3 d-flex justify-content-center text-center menu__btn">
                            Discount
                        </div>
                        <div class="row border d-flex justify-content-center menu__btn">
                            <button type="button" class="btn btn-light p-3" data-bs-toggle="modal" data-bs-target="#all__inventory__modal">Inventory</button>
                        </div>
                        <div class="row border p-3 d-flex justify-content-center text-center menu__btn">
                            Other
                        </div>



                        <div class="modal fade" tabindex="-1" id="all__inventory__modal" aria-hidden="true" aria-labelledby="all__inventory__modalLabel">
                            <div class="container my-5">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <div class="modal-title" id="all__inventory__modalLabel">All Inventory</div>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-12 d-flex justify-content-between">
                                                <div>
                                                    Show
                                                    <span>
                                                        <select name="" id="">
                                                            <option value="10">10</option>
                                                            <option value="25">25</option>
                                                            <option value="50">50</option>
                                                            <option value="100">100</option>
                                                        </select>
                                                    </span>
                                                    entries
                                                </div>
                                                <div>
                                                    search: <input type="search" name="" id="all__inventory__search">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">
                                                            <div class="d-flex justify-content-between">
                                                                <div class="text">ID</div>
                                                                <div class="px-1 d-flex align-items-start" id="th__c1">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" class="sort__down" height=".7em" viewBox="0 0 320 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                                                        <path d="M182.6 470.6c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-9.2-9.2-11.9-22.9-6.9-34.9s16.6-19.8 29.6-19.8H288c12.9 0 24.6 7.8 29.6 19.8s2.2 25.7-6.9 34.9l-128 128z" />
                                                                    </svg>
                                                                    <svg xmlns="http://www.w3.org/2000/svg" class="sort__up d-none" height=".7em" viewBox="0 0 320 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                                                        <path fill="000000" d="M182.6 41.4c-12.5-12.5-32.8-12.5-45.3 0l-128 128c-9.2 9.2-11.9 22.9-6.9 34.9s16.6 19.8 29.6 19.8H288c12.9 0 24.6-7.8 29.6-19.8s2.2-25.7-6.9-34.9l-128-128z" />
                                                                    </svg>
                                                                    <svg xmlns="http://www.w3.org/2000/svg" class="sort__both d-none" height=".7em" viewBox="0 0 320 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                                                        <path d="M137.4 41.4c12.5-12.5 32.8-12.5 45.3 0l128 128c9.2 9.2 11.9 22.9 6.9 34.9s-16.6 19.8-29.6 19.8H32c-12.9 0-24.6-7.8-29.6-19.8s-2.2-25.7 6.9-34.9l128-128zm0 429.3l-128-128c-9.2-9.2-11.9-22.9-6.9-34.9s16.6-19.8 29.6-19.8H288c12.9 0 24.6 7.8 29.6 19.8s2.2 25.7-6.9 34.9l-128 128c-12.5 12.5-32.8 12.5-45.3 0z" />
                                                                    </svg>
                                                                </div>
                                                            </div>
                                                        </th>
                                                        <th scope="col">
                                                            <div class="d-flex justify-content-between">
                                                                <div class="text">Place</div>
                                                                <div class="px-1 d-flex align-items-start" id="th__c2">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" class="sort__down d-none" height=".7em" viewBox="0 0 320 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                                                        <path d="M182.6 470.6c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-9.2-9.2-11.9-22.9-6.9-34.9s16.6-19.8 29.6-19.8H288c12.9 0 24.6 7.8 29.6 19.8s2.2 25.7-6.9 34.9l-128 128z" />
                                                                    </svg>
                                                                    <svg xmlns="http://www.w3.org/2000/svg" class="sort__up d-none" height=".7em" viewBox="0 0 320 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                                                        <path fill="000000" d="M182.6 41.4c-12.5-12.5-32.8-12.5-45.3 0l-128 128c-9.2 9.2-11.9 22.9-6.9 34.9s16.6 19.8 29.6 19.8H288c12.9 0 24.6-7.8 29.6-19.8s2.2-25.7-6.9-34.9l-128-128z" />
                                                                    </svg>
                                                                    <svg xmlns="http://www.w3.org/2000/svg" class="sort__both " height=".7em" viewBox="0 0 320 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                                                        <path d="M137.4 41.4c12.5-12.5 32.8-12.5 45.3 0l128 128c9.2 9.2 11.9 22.9 6.9 34.9s-16.6 19.8-29.6 19.8H32c-12.9 0-24.6-7.8-29.6-19.8s-2.2-25.7 6.9-34.9l128-128zm0 429.3l-128-128c-9.2-9.2-11.9-22.9-6.9-34.9s16.6-19.8 29.6-19.8H288c12.9 0 24.6 7.8 29.6 19.8s2.2 25.7-6.9 34.9l-128 128c-12.5 12.5-32.8 12.5-45.3 0z" />
                                                                    </svg>
                                                                </div>
                                                            </div>
                                                        </th>
                                                        <th scope="col">
                                                            <div class="d-flex justify-content-between">
                                                                <div class="text">UPC</div>
                                                                <div class="px-1 d-flex align-items-start" id="th__c2">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" class="sort__down d-none" height=".7em" viewBox="0 0 320 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                                                        <path d="M182.6 470.6c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-9.2-9.2-11.9-22.9-6.9-34.9s16.6-19.8 29.6-19.8H288c12.9 0 24.6 7.8 29.6 19.8s2.2 25.7-6.9 34.9l-128 128z" />
                                                                    </svg>
                                                                    <svg xmlns="http://www.w3.org/2000/svg" class="sort__up d-none" height=".7em" viewBox="0 0 320 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                                                        <path fill="000000" d="M182.6 41.4c-12.5-12.5-32.8-12.5-45.3 0l-128 128c-9.2 9.2-11.9 22.9-6.9 34.9s16.6 19.8 29.6 19.8H288c12.9 0 24.6-7.8 29.6-19.8s2.2-25.7-6.9-34.9l-128-128z" />
                                                                    </svg>
                                                                    <svg xmlns="http://www.w3.org/2000/svg" class="sort__both " height=".7em" viewBox="0 0 320 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                                                        <path d="M137.4 41.4c12.5-12.5 32.8-12.5 45.3 0l128 128c9.2 9.2 11.9 22.9 6.9 34.9s-16.6 19.8-29.6 19.8H32c-12.9 0-24.6-7.8-29.6-19.8s-2.2-25.7 6.9-34.9l128-128zm0 429.3l-128-128c-9.2-9.2-11.9-22.9-6.9-34.9s16.6-19.8 29.6-19.8H288c12.9 0 24.6 7.8 29.6 19.8s2.2 25.7-6.9 34.9l-128 128c-12.5 12.5-32.8 12.5-45.3 0z" />
                                                                    </svg>
                                                                </div>
                                                            </div>
                                                        </th>
                                                        <th scope="col">
                                                            <div class="d-flex justify-content-between">
                                                                <div class="text">
                                                                    <div>Item</div>
                                                                    <div>Number</div>
                                                                </div>
                                                                <div class="px-1 d-flex align-items-start" id="th__c2">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" class="sort__down d-none" height=".7em" viewBox="0 0 320 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                                                        <path d="M182.6 470.6c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-9.2-9.2-11.9-22.9-6.9-34.9s16.6-19.8 29.6-19.8H288c12.9 0 24.6 7.8 29.6 19.8s2.2 25.7-6.9 34.9l-128 128z" />
                                                                    </svg>
                                                                    <svg xmlns="http://www.w3.org/2000/svg" class="sort__up d-none" height=".7em" viewBox="0 0 320 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                                                        <path fill="000000" d="M182.6 41.4c-12.5-12.5-32.8-12.5-45.3 0l-128 128c-9.2 9.2-11.9 22.9-6.9 34.9s16.6 19.8 29.6 19.8H288c12.9 0 24.6-7.8 29.6-19.8s2.2-25.7-6.9-34.9l-128-128z" />
                                                                    </svg>
                                                                    <svg xmlns="http://www.w3.org/2000/svg" class="sort__both " height=".7em" viewBox="0 0 320 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                                                        <path d="M137.4 41.4c12.5-12.5 32.8-12.5 45.3 0l128 128c9.2 9.2 11.9 22.9 6.9 34.9s-16.6 19.8-29.6 19.8H32c-12.9 0-24.6-7.8-29.6-19.8s-2.2-25.7 6.9-34.9l128-128zm0 429.3l-128-128c-9.2-9.2-11.9-22.9-6.9-34.9s16.6-19.8 29.6-19.8H288c12.9 0 24.6 7.8 29.6 19.8s2.2 25.7-6.9 34.9l-128 128c-12.5 12.5-32.8 12.5-45.3 0z" />
                                                                    </svg>
                                                                </div>
                                                            </div>
                                                        </th>
                                                        <th scope="col">
                                                            <div class="d-flex justify-content-between">
                                                                <div class="text">
                                                                    <div>Product</div>
                                                                    <div>Name</div>
                                                                </div>
                                                                <div class="px-1 d-flex align-items-start" id="th__c2">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" class="sort__down d-none" height=".7em" viewBox="0 0 320 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                                                        <path d="M182.6 470.6c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-9.2-9.2-11.9-22.9-6.9-34.9s16.6-19.8 29.6-19.8H288c12.9 0 24.6 7.8 29.6 19.8s2.2 25.7-6.9 34.9l-128 128z" />
                                                                    </svg>
                                                                    <svg xmlns="http://www.w3.org/2000/svg" class="sort__up d-none" height=".7em" viewBox="0 0 320 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                                                        <path fill="000000" d="M182.6 41.4c-12.5-12.5-32.8-12.5-45.3 0l-128 128c-9.2 9.2-11.9 22.9-6.9 34.9s16.6 19.8 29.6 19.8H288c12.9 0 24.6-7.8 29.6-19.8s2.2-25.7-6.9-34.9l-128-128z" />
                                                                    </svg>
                                                                    <svg xmlns="http://www.w3.org/2000/svg" class="sort__both " height=".7em" viewBox="0 0 320 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                                                        <path d="M137.4 41.4c12.5-12.5 32.8-12.5 45.3 0l128 128c9.2 9.2 11.9 22.9 6.9 34.9s-16.6 19.8-29.6 19.8H32c-12.9 0-24.6-7.8-29.6-19.8s-2.2-25.7 6.9-34.9l128-128zm0 429.3l-128-128c-9.2-9.2-11.9-22.9-6.9-34.9s16.6-19.8 29.6-19.8H288c12.9 0 24.6 7.8 29.6 19.8s2.2 25.7-6.9 34.9l-128 128c-12.5 12.5-32.8 12.5-45.3 0z" />
                                                                    </svg>
                                                                </div>
                                                            </div>
                                                        </th>
                                                        <th scope="col">
                                                            <div class="d-flex justify-content-between">
                                                                <div class="text">
                                                                    <div>Unit</div>
                                                                    <div>Measure</div>
                                                                </div>
                                                                <div class="px-1 d-flex align-items-start" id="th__c2">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" class="sort__down d-none" height=".7em" viewBox="0 0 320 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                                                        <path d="M182.6 470.6c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-9.2-9.2-11.9-22.9-6.9-34.9s16.6-19.8 29.6-19.8H288c12.9 0 24.6 7.8 29.6 19.8s2.2 25.7-6.9 34.9l-128 128z" />
                                                                    </svg>
                                                                    <svg xmlns="http://www.w3.org/2000/svg" class="sort__up d-none" height=".7em" viewBox="0 0 320 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                                                        <path fill="000000" d="M182.6 41.4c-12.5-12.5-32.8-12.5-45.3 0l-128 128c-9.2 9.2-11.9 22.9-6.9 34.9s16.6 19.8 29.6 19.8H288c12.9 0 24.6-7.8 29.6-19.8s2.2-25.7-6.9-34.9l-128-128z" />
                                                                    </svg>
                                                                    <svg xmlns="http://www.w3.org/2000/svg" class="sort__both " height=".7em" viewBox="0 0 320 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                                                        <path d="M137.4 41.4c12.5-12.5 32.8-12.5 45.3 0l128 128c9.2 9.2 11.9 22.9 6.9 34.9s-16.6 19.8-29.6 19.8H32c-12.9 0-24.6-7.8-29.6-19.8s-2.2-25.7 6.9-34.9l128-128zm0 429.3l-128-128c-9.2-9.2-11.9-22.9-6.9-34.9s16.6-19.8 29.6-19.8H288c12.9 0 24.6 7.8 29.6 19.8s2.2 25.7-6.9 34.9l-128 128c-12.5 12.5-32.8 12.5-45.3 0z" />
                                                                    </svg>
                                                                </div>
                                                            </div>
                                                        </th>
                                                        <th scope="col">
                                                            <div class="d-flex justify-content-between">
                                                                <div class="text">Custom1</div>
                                                                <div class="px-1 d-flex align-items-start" id="th__c2">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" class="sort__down d-none" height=".7em" viewBox="0 0 320 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                                                        <path d="M182.6 470.6c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-9.2-9.2-11.9-22.9-6.9-34.9s16.6-19.8 29.6-19.8H288c12.9 0 24.6 7.8 29.6 19.8s2.2 25.7-6.9 34.9l-128 128z" />
                                                                    </svg>
                                                                    <svg xmlns="http://www.w3.org/2000/svg" class="sort__up d-none" height=".7em" viewBox="0 0 320 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                                                        <path fill="000000" d="M182.6 41.4c-12.5-12.5-32.8-12.5-45.3 0l-128 128c-9.2 9.2-11.9 22.9-6.9 34.9s16.6 19.8 29.6 19.8H288c12.9 0 24.6-7.8 29.6-19.8s2.2-25.7-6.9-34.9l-128-128z" />
                                                                    </svg>
                                                                    <svg xmlns="http://www.w3.org/2000/svg" class="sort__both " height=".7em" viewBox="0 0 320 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                                                        <path d="M137.4 41.4c12.5-12.5 32.8-12.5 45.3 0l128 128c9.2 9.2 11.9 22.9 6.9 34.9s-16.6 19.8-29.6 19.8H32c-12.9 0-24.6-7.8-29.6-19.8s-2.2-25.7 6.9-34.9l128-128zm0 429.3l-128-128c-9.2-9.2-11.9-22.9-6.9-34.9s16.6-19.8 29.6-19.8H288c12.9 0 24.6 7.8 29.6 19.8s2.2 25.7-6.9 34.9l-128 128c-12.5 12.5-32.8 12.5-45.3 0z" />
                                                                    </svg>
                                                                </div>
                                                            </div>
                                                        </th>
                                                        <th scope="col">
                                                            <div class="d-flex justify-content-between">
                                                                <div class="text">Custom2</div>
                                                                <div class="px-1 d-flex align-items-start" id="th__c2">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" class="sort__down d-none" height=".7em" viewBox="0 0 320 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                                                        <path d="M182.6 470.6c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-9.2-9.2-11.9-22.9-6.9-34.9s16.6-19.8 29.6-19.8H288c12.9 0 24.6 7.8 29.6 19.8s2.2 25.7-6.9 34.9l-128 128z" />
                                                                    </svg>
                                                                    <svg xmlns="http://www.w3.org/2000/svg" class="sort__up d-none" height=".7em" viewBox="0 0 320 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                                                        <path fill="000000" d="M182.6 41.4c-12.5-12.5-32.8-12.5-45.3 0l-128 128c-9.2 9.2-11.9 22.9-6.9 34.9s16.6 19.8 29.6 19.8H288c12.9 0 24.6-7.8 29.6-19.8s2.2-25.7-6.9-34.9l-128-128z" />
                                                                    </svg>
                                                                    <svg xmlns="http://www.w3.org/2000/svg" class="sort__both " height=".7em" viewBox="0 0 320 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                                                        <path d="M137.4 41.4c12.5-12.5 32.8-12.5 45.3 0l128 128c9.2 9.2 11.9 22.9 6.9 34.9s-16.6 19.8-29.6 19.8H32c-12.9 0-24.6-7.8-29.6-19.8s-2.2-25.7 6.9-34.9l128-128zm0 429.3l-128-128c-9.2-9.2-11.9-22.9-6.9-34.9s16.6-19.8 29.6-19.8H288c12.9 0 24.6 7.8 29.6 19.8s2.2 25.7-6.9 34.9l-128 128c-12.5 12.5-32.8 12.5-45.3 0z" />
                                                                    </svg>
                                                                </div>
                                                            </div>
                                                        </th>
                                                        <th scope="col">
                                                            <div class="d-flex justify-content-between">
                                                                <div class="text">
                                                                    <div>Retail</div>
                                                                    <div>Price</div>
                                                                </div>
                                                                <div class="px-1 d-flex align-items-start" id="th__c2">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" class="sort__down d-none" height=".7em" viewBox="0 0 320 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                                                        <path d="M182.6 470.6c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-9.2-9.2-11.9-22.9-6.9-34.9s16.6-19.8 29.6-19.8H288c12.9 0 24.6 7.8 29.6 19.8s2.2 25.7-6.9 34.9l-128 128z" />
                                                                    </svg>
                                                                    <svg xmlns="http://www.w3.org/2000/svg" class="sort__up d-none" height=".7em" viewBox="0 0 320 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                                                        <path fill="000000" d="M182.6 41.4c-12.5-12.5-32.8-12.5-45.3 0l-128 128c-9.2 9.2-11.9 22.9-6.9 34.9s16.6 19.8 29.6 19.8H288c12.9 0 24.6-7.8 29.6-19.8s2.2-25.7-6.9-34.9l-128-128z" />
                                                                    </svg>
                                                                    <svg xmlns="http://www.w3.org/2000/svg" class="sort__both " height=".7em" viewBox="0 0 320 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                                                        <path d="M137.4 41.4c12.5-12.5 32.8-12.5 45.3 0l128 128c9.2 9.2 11.9 22.9 6.9 34.9s-16.6 19.8-29.6 19.8H32c-12.9 0-24.6-7.8-29.6-19.8s-2.2-25.7 6.9-34.9l128-128zm0 429.3l-128-128c-9.2-9.2-11.9-22.9-6.9-34.9s16.6-19.8 29.6-19.8H288c12.9 0 24.6 7.8 29.6 19.8s2.2 25.7-6.9 34.9l-128 128c-12.5 12.5-32.8 12.5-45.3 0z" />
                                                                    </svg>
                                                                </div>
                                                            </div>
                                                        </th>
                                                        <th scope="col">
                                                            <div class="d-flex justify-content-between">
                                                                <div class="text">
                                                                    <div>Wholesale</div>
                                                                    <div>price</div>
                                                                 </div>
                                                                <div class="px-1 d-flex align-items-start" id="th__c2">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" class="sort__down d-none" height=".7em" viewBox="0 0 320 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                                                        <path d="M182.6 470.6c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-9.2-9.2-11.9-22.9-6.9-34.9s16.6-19.8 29.6-19.8H288c12.9 0 24.6 7.8 29.6 19.8s2.2 25.7-6.9 34.9l-128 128z" />
                                                                    </svg>
                                                                    <svg xmlns="http://www.w3.org/2000/svg" class="sort__up d-none" height=".7em" viewBox="0 0 320 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                                                        <path fill="000000" d="M182.6 41.4c-12.5-12.5-32.8-12.5-45.3 0l-128 128c-9.2 9.2-11.9 22.9-6.9 34.9s16.6 19.8 29.6 19.8H288c12.9 0 24.6-7.8 29.6-19.8s2.2-25.7-6.9-34.9l-128-128z" />
                                                                    </svg>
                                                                    <svg xmlns="http://www.w3.org/2000/svg" class="sort__both " height=".7em" viewBox="0 0 320 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                                                        <path d="M137.4 41.4c12.5-12.5 32.8-12.5 45.3 0l128 128c9.2 9.2 11.9 22.9 6.9 34.9s-16.6 19.8-29.6 19.8H32c-12.9 0-24.6-7.8-29.6-19.8s-2.2-25.7 6.9-34.9l128-128zm0 429.3l-128-128c-9.2-9.2-11.9-22.9-6.9-34.9s16.6-19.8 29.6-19.8H288c12.9 0 24.6 7.8 29.6 19.8s2.2 25.7-6.9 34.9l-128 128c-12.5 12.5-32.8 12.5-45.3 0z" />
                                                                    </svg>
                                                                </div>
                                                            </div>
                                                        </th>
                                                        <th scope="col">
                                                            <div class="d-flex justify-content-between">
                                                                <div class="text">Stock</div>
                                                                <div class="px-1 d-flex align-items-start" id="th__c2">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" class="sort__down d-none" height=".7em" viewBox="0 0 320 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                                                        <path d="M182.6 470.6c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-9.2-9.2-11.9-22.9-6.9-34.9s16.6-19.8 29.6-19.8H288c12.9 0 24.6 7.8 29.6 19.8s2.2 25.7-6.9 34.9l-128 128z" />
                                                                    </svg>
                                                                    <svg xmlns="http://www.w3.org/2000/svg" class="sort__up d-none" height=".7em" viewBox="0 0 320 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                                                        <path fill="000000" d="M182.6 41.4c-12.5-12.5-32.8-12.5-45.3 0l-128 128c-9.2 9.2-11.9 22.9-6.9 34.9s16.6 19.8 29.6 19.8H288c12.9 0 24.6-7.8 29.6-19.8s2.2-25.7-6.9-34.9l-128-128z" />
                                                                    </svg>
                                                                    <svg xmlns="http://www.w3.org/2000/svg" class="sort__both " height=".7em" viewBox="0 0 320 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                                                        <path d="M137.4 41.4c12.5-12.5 32.8-12.5 45.3 0l128 128c9.2 9.2 11.9 22.9 6.9 34.9s-16.6 19.8-29.6 19.8H32c-12.9 0-24.6-7.8-29.6-19.8s-2.2-25.7 6.9-34.9l128-128zm0 429.3l-128-128c-9.2-9.2-11.9-22.9-6.9-34.9s16.6-19.8 29.6-19.8H288c12.9 0 24.6 7.8 29.6 19.8s2.2 25.7-6.9 34.9l-128 128c-12.5 12.5-32.8 12.5-45.3 0z" />
                                                                    </svg>
                                                                </div>
                                                            </div>
                                                        </th>
                                                        <th scope="col">
                                                            <div class="d-flex justify-content-between">
                                                                <div class="text">Action</div>
                                                                <div class="px-1 d-flex align-items-start" id="th__c2">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" class="sort__down d-none" height=".7em" viewBox="0 0 320 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                                                        <path d="M182.6 470.6c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-9.2-9.2-11.9-22.9-6.9-34.9s16.6-19.8 29.6-19.8H288c12.9 0 24.6 7.8 29.6 19.8s2.2 25.7-6.9 34.9l-128 128z" />
                                                                    </svg>
                                                                    <svg xmlns="http://www.w3.org/2000/svg" class="sort__up d-none" height=".7em" viewBox="0 0 320 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                                                        <path fill="000000" d="M182.6 41.4c-12.5-12.5-32.8-12.5-45.3 0l-128 128c-9.2 9.2-11.9 22.9-6.9 34.9s16.6 19.8 29.6 19.8H288c12.9 0 24.6-7.8 29.6-19.8s2.2-25.7-6.9-34.9l-128-128z" />
                                                                    </svg>
                                                                    <svg xmlns="http://www.w3.org/2000/svg" class="sort__both " height=".7em" viewBox="0 0 320 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                                                        <path d="M137.4 41.4c12.5-12.5 32.8-12.5 45.3 0l128 128c9.2 9.2 11.9 22.9 6.9 34.9s-16.6 19.8-29.6 19.8H32c-12.9 0-24.6-7.8-29.6-19.8s-2.2-25.7 6.9-34.9l128-128zm0 429.3l-128-128c-9.2-9.2-11.9-22.9-6.9-34.9s16.6-19.8 29.6-19.8H288c12.9 0 24.6 7.8 29.6 19.8s2.2 25.7-6.9 34.9l-128 128c-12.5 12.5-32.8 12.5-45.3 0z" />
                                                                    </svg>
                                                                </div>
                                                            </div>
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td scope="col">1</td>
                                                        <td>W</td>
                                                        <td>8716200200899</td>
                                                        <td>1000001</td>
                                                        <td>Raibow Sweetened Condensed Milk (397 ML * 48.00 Can)</td>
                                                        <td>CT</td>
                                                        <td>Lorem, ipsum dolor.</td>
                                                        <td>Lorem.</td>
                                                        <td>280.0000</td>
                                                        <td>278.0000</td>
                                                        <td>3</td>
                                                        <td>
                                                            <button class="btn btn-success">Add Cart</button>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td scope="col">1</td>
                                                        <td>W</td>
                                                        <td>8716200200899</td>
                                                        <td>1000001</td>
                                                        <td>Raibow Sweetened Condensed Milk (397 ML * 48.00 Can)</td>
                                                        <td>CT</td>
                                                        <td>Lorem, ipsum dolor.</td>
                                                        <td>Lorem.</td>
                                                        <td>280.0000</td>
                                                        <td>278.0000</td>
                                                        <td>3</td>
                                                        <td>
                                                            <button class="btn btn-success">Add Cart</button>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td scope="col">1</td>
                                                        <td>W</td>
                                                        <td>8716200200899</td>
                                                        <td>1000001</td>
                                                        <td>Raibow Sweetened Condensed Milk (397 ML * 48.00 Can)</td>
                                                        <td>CT</td>
                                                        <td>Lorem, ipsum dolor.</td>
                                                        <td>Lorem.</td>
                                                        <td>280.0000</td>
                                                        <td>278.0000</td>
                                                        <td>3</td>
                                                        <td>
                                                            <button class="btn btn-success">Add Cart</button>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td scope="col">1</td>
                                                        <td>W</td>
                                                        <td>8716200200899</td>
                                                        <td>1000001</td>
                                                        <td>Raibow Sweetened Condensed Milk (397 ML * 48.00 Can)</td>
                                                        <td>CT</td>
                                                        <td>Lorem, ipsum dolor.</td>
                                                        <td>Lorem.</td>
                                                        <td>280.0000</td>
                                                        <td>278.0000</td>
                                                        <td>3</td>
                                                        <td>
                                                            <button class="btn btn-success">Add Cart</button>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td scope="col">1</td>
                                                        <td>W</td>
                                                        <td>8716200200899</td>
                                                        <td>1000001</td>
                                                        <td>Raibow Sweetened Condensed Milk (397 ML * 48.00 Can)</td>
                                                        <td>CT</td>
                                                        <td>Lorem, ipsum dolor.</td>
                                                        <td>Lorem.</td>
                                                        <td>280.0000</td>
                                                        <td>278.0000</td>
                                                        <td>3</td>
                                                        <td>
                                                            <button class="btn btn-success">Add Cart</button>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td scope="col">1</td>
                                                        <td>W</td>
                                                        <td>8716200200899</td>
                                                        <td>1000001</td>
                                                        <td>Raibow Sweetened Condensed Milk (397 ML * 48.00 Can)</td>
                                                        <td>CT</td>
                                                        <td>Lorem, ipsum dolor.</td>
                                                        <td>Lorem.</td>
                                                        <td>280.0000</td>
                                                        <td>278.0000</td>
                                                        <td>3</td>
                                                        <td>
                                                            <button class="btn btn-success">Add Cart</button>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td scope="col">1</td>
                                                        <td>W</td>
                                                        <td>8716200200899</td>
                                                        <td>1000001</td>
                                                        <td>Raibow Sweetened Condensed Milk (397 ML * 48.00 Can)</td>
                                                        <td>CT</td>
                                                        <td>Lorem, ipsum dolor.</td>
                                                        <td>Lorem.</td>
                                                        <td>280.0000</td>
                                                        <td>278.0000</td>
                                                        <td>3</td>
                                                        <td>
                                                            <button class="btn btn-success">Add Cart</button>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td scope="col">1</td>
                                                        <td>W</td>
                                                        <td>8716200200899</td>
                                                        <td>1000001</td>
                                                        <td>Raibow Sweetened Condensed Milk (397 ML * 48.00 Can)</td>
                                                        <td>CT</td>
                                                        <td>Lorem, ipsum dolor.</td>
                                                        <td>Lorem.</td>
                                                        <td>280.0000</td>
                                                        <td>278.0000</td>
                                                        <td>3</td>
                                                        <td>
                                                            <button class="btn btn-success">Add Cart</button>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-dialog">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row border text-white">
                    <button type="button" class="btn btn-success col-12 p-3">PROCEED ORDER | متابعة الطلب</button>
                </div>
                <div class="row border">
                    <div class="col-12 text-end p-0">
                        <input class="w-100 p-3" dir="rtl" type="text" name="" id="" placeholder="Product Barcode | باركود المنتج">
                    </div>
                </div>
                <div class="row text-white">
                    <div class="col-3">
                        <div class="row p-2 bg-secondary border calc__button">
                            <div class="col text-center">7</div>
                        </div>
                        <div class="row p-2 bg-secondary border calc__button">
                            <div class="col text-center">4</div>
                        </div>
                        <div class="row p-2 bg-secondary border calc__button">
                            <div class="col text-center">1</div>
                        </div>
                        <div class="row p-2 bg-secondary border calc__button">
                            <div class="col text-center">0</div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="row p-2 bg-secondary border calc__button">
                            <div class="col text-center">8</div>
                        </div>
                        <div class="row p-2 bg-secondary border calc__button">
                            <div class="col text-center">5</div>
                        </div>
                        <div class="row p-2 bg-secondary border calc__button">
                            <div class="col text-center">2</div>
                        </div>
                        <div class="row p-2 bg-secondary border calc__button">
                            <div class="col text-center">*</div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="row p-2 bg-secondary border calc__button">
                            <div class="col text-center">9</div>
                        </div>
                        <div class="row p-2 bg-secondary border calc__button">
                            <div class="col text-center">6</div>
                        </div>
                        <div class="row p-2 bg-secondary border calc__button">
                            <div class="col text-center">3</div>
                        </div>
                        <div class="row p-2 bg-secondary border calc__button">
                            <div class="col text-center">.</div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="row p-2 bg-secondary border calc__button">
                            <div class="col text-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" id="backspace">
                                    <path fill="none" d="M0 0h24v24H0V0z"></path>
                                    <path d="M22 3H7c-.69 0-1.23.35-1.59.88L.37 11.45c-.22.34-.22.77 0 1.11l5.04 7.56c.36.52.9.88 1.59.88h15c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-3.7 13.3c-.39.39-1.02.39-1.41 0L14 13.41l-2.89 2.89c-.39.39-1.02.39-1.41 0-.39-.39-.39-1.02 0-1.41L12.59 12 9.7 9.11c-.39-.39-.39-1.02 0-1.41.39-.39 1.02-.39 1.41 0L14 10.59l2.89-2.89c.39-.39 1.02-.39 1.41 0 .39.39.39 1.02 0 1.41L15.41 12l2.89 2.89c.38.38.38 1.02 0 1.41z" fill="currentColor"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="row p-2 bg-secondary border calc__button">
                            <div class="col text-center">C</div>
                        </div>
                        <div class="row p-2 bg-secondary border calc__buttonLong">
                            <div class="col text-center">
                                <svg xmlns="http://www.w3.org/2000/svg" height="5rem" viewBox="0 0 24 24" id="enter">
                                    <path d="M19,6a1,1,0,0,0-1,1v4a1,1,0,0,1-1,1H7.41l1.3-1.29A1,1,0,0,0,7.29,9.29l-3,3a1,1,0,0,0-.21.33,1,1,0,0,0,0,.76,1,1,0,0,0,.21.33l3,3a1,1,0,0,0,1.42,0,1,1,0,0,0,0-1.42L7.41,14H17a3,3,0,0,0,3-3V7A1,1,0,0,0,19,6Z" fill="currentColor"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="row mb-2">
                    <div class="col-12 p-3 border">
                        <div class="text-danger">EMTYAZ FOR CATERING COMPANY</div>
                        <div class="text-success">VAT No: r.....</div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 p-3 d-flex justify-content-center bg-success text-white">
                        <div class="d-flex flex-column">
                            <svg xmlns="http://www.w3.org/2000/svg" height="3rem" viewBox="0 0 320 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                <path d="M160 0c17.7 0 32 14.3 32 32V67.7c1.6 .2 3.1 .4 4.7 .7c.4 .1 .7 .1 1.1 .2l48 8.8c17.4 3.2 28.9 19.9 25.7 37.2s-19.9 28.9-37.2 25.7l-47.5-8.7c-31.3-4.6-58.9-1.5-78.3 6.2s-27.2 18.3-29 28.1c-2 10.7-.5 16.7 1.2 20.4c1.8 3.9 5.5 8.3 12.8 13.2c16.3 10.7 41.3 17.7 73.7 26.3l2.9 .8c28.6 7.6 63.6 16.8 89.6 33.8c14.2 9.3 27.6 21.9 35.9 39.5c8.5 17.9 10.3 37.9 6.4 59.2c-6.9 38-33.1 63.4-65.6 76.7c-13.7 5.6-28.6 9.2-44.4 11V480c0 17.7-14.3 32-32 32s-32-14.3-32-32V445.1c-.4-.1-.9-.1-1.3-.2l-.2 0 0 0c-24.4-3.8-64.5-14.3-91.5-26.3c-16.1-7.2-23.4-26.1-16.2-42.2s26.1-23.4 42.2-16.2c20.9 9.3 55.3 18.5 75.2 21.6c31.9 4.7 58.2 2 76-5.3c16.9-6.9 24.6-16.9 26.8-28.9c1.9-10.6 .4-16.7-1.3-20.4c-1.9-4-5.6-8.4-13-13.3c-16.4-10.7-41.5-17.7-74-26.3l-2.8-.7 0 0C119.4 279.3 84.4 270 58.4 253c-14.2-9.3-27.5-22-35.8-39.6c-8.4-17.9-10.1-37.9-6.1-59.2C23.7 116 52.3 91.2 84.8 78.3c13.3-5.3 27.9-8.9 43.2-11V32c0-17.7 14.3-32 32-32z" fill="currentColor" />
                            </svg>
                            Payments
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6 p-3 d-flex justify-content-center" style="background-color: #F0F6F4;">
                        <div class="d-flex flex-column">
                            <div>Recent Sales</div>
                            <div>المبيعات الأخيرة</div>
                        </div>
                    </div>
                    <div class="col-6 p-3 d-flex justify-content-center" style="background-color: #FFFEA7;">
                        <div class="d-flex flex-column">
                            <div>Invoices on Hold</div>
                            <div>الفواتير في الانتظار</div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 p-3 d-flex justify-content-center bg-danger text-white">
                        <div class="d-flex flex-column align-items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" height="3rem" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                <path d="M352 96l64 0c17.7 0 32 14.3 32 32l0 256c0 17.7-14.3 32-32 32l-64 0c-17.7 0-32 14.3-32 32s14.3 32 32 32l64 0c53 0 96-43 96-96l0-256c0-53-43-96-96-96l-64 0c-17.7 0-32 14.3-32 32s14.3 32 32 32zm-9.4 182.6c12.5-12.5 12.5-32.8 0-45.3l-128-128c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L242.7 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l210.7 0-73.4 73.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l128-128z" fill="currentColor" />
                            </svg>
                            <div>Sign out</div>
                            <div>خروج</div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="row border">
                            <div class="col-12 d-flex justify-content-center text-center p-3">Bakery & Bread</div>
                        </div>
                        <div class="row border">
                            <div class="col-12 d-flex justify-content-center text-center p-3">Baby</div>
                        </div>
                        <div class="row border">
                            <div class="col-12 d-flex justify-content-center text-center p-3">Baverages</div>
                        </div>
                        <div class="row border">
                            <div class="col-12 d-flex justify-content-center text-center p-3">Dairy, Egg and Cheese</div>
                        </div>
                        <div class="row border">
                            <div class="col-12 d-flex justify-content-center text-center p-3">Frozen</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>



    <script src="js/script.js"></script>
    <script src="js/bootstrap.js"></script>
</body>

</html>