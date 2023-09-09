<div class="customer__add__modal" id="customer__add__modal">
    <div class="backdrop" onclick="showCustomerAddModal()"></div>
    <div class="box">
        <div class="header">
            <div class="title">Customer Details | تفاصيل العميل</div>
            <div class="close__btn" onclick="showCustomerAddModal()">
                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 384 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                    <path d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z" fill="currentColor" />
                </svg>
            </div>
        </div>
        <div class="body">
            <form action="" class="form">
                <div class="form__group">
                    <div class="form__control">
                        <label for="customer_code">Customer Code</label>
                        <input type="text" name="customer_code" id="customer_code" placeholder="Customer Code | رمز العميل">
                    </div>
                </div>
                <div class="form__group">
                    <div class="form__control">
                        <label for="customer_phone">Customer Phone No</label>
                        <input type="text" name="customer_phone" id="customer_phone" placeholder="Customer Phone No | رقم هاتف العميل">
                    </div>
                </div>
                <div class="form__group">
                    <div class="form__control">
                        <label for="customer_name">Customer Name</label>
                        <input type="text" name="customer_name" id="customer_name" placeholder="Customer Name | اسم الزبون">
                    </div>
                </div>
                <div class="form__group">
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
                <div class="form__group">
                    <div class="form__control">
                        <button type="submit" class="btn">Add Customer To Cart</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function showCustomerAddModal() {
        document.getElementById('customer__add__modal').classList.toggle('active');

        if (document.getElementById('customer__add__modal').classList.contains('active')) {
            // getProducts();
        }
    }
</script>