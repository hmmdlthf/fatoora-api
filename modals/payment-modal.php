<div class="payment_add__modal modal" id="payment_add__modal">
    <div class="backdrop" onclick="showPaymentModal()"></div>
    <div class="box">
        <div class="header">
            <div class="title">Payment Via Cash / Card | الدفع نقدا / بطاقة</div>
            <div class="close__btn" onclick="showPaymentModal()">
                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 384 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                    <path d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z" fill="currentColor" />
                </svg>
            </div>
        </div>
        <div class="body">
            <form action="" class="form" id="payment_add_form">
                <div class="form__group">
                    <div class="form__control">
                        <div class="switch switch-on" id="switch">
                            <input type="checkbox" name="pay_by_cash" id="pay_by_cash" checked>
                        </div>
                        <label for="pay_by_cash">Pay By Cash | الدفع نقدا</label>
                    </div>
                    <div class="form__control" id="cash_amount_form_control">
                        <label for="cash_amount">Cash Amount</label>
                        <input type="text" name="cash_amount" id="cash_amount" placeholder="Enter Amount | أدخل المبلغ">
                    </div>
                </div>
                <div class="form__group">
                    <div class="form__control">
                        <div class="switch" id="switch">
                            <input type="checkbox" name="pay_by_card" id="pay_by_card">
                        </div>
                        <label for="pay_by_card">Pay By Card</label>
                    </div>
                    <div class="form__control hidden" id="card_amount_form_control">
                        <label for="card_amount">Card Amount</label>
                        <input type="text" name="card_amount" id="card_amount" placeholder="Enter Amount | أدخل المبلغ">
                    </div>
                </div>
                <div class="form__group">

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
                        <button type="submit" class="btn">Apply</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function showPaymentModal() {
        document.getElementById('payment_add__modal').classList.toggle('active');

        if (document.getElementById('payment_add__modal').classList.contains('active')) {
            // getProducts();
        }
    }
</script>