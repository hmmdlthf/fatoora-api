<div class="bulk_clearance__modal modal" id="bulk_clearance__modal">
    <div class="backdrop" onclick="showBulkClearanceModal()"></div>
    <div class="box">
        <div class="header">
            <div class="title">B2C Invoice BulkClearance</div>
            <div class="close__btn" onclick="showBulkClearanceModal()">
                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 384 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                    <path d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z" fill="currentColor" />
                </svg>
            </div>
        </div>
        <div class="body">
            <form action="" class="form" id="bulk_clearance_form">
                <div class="progress__bar single__step">
                    <div class="progress__bar-inner"></div>
                    <div class="progress__step progress__step-1">
                        <div class="bar"></div>
                        <div class="circle">
                            <svg xmlns="http://www.w3.org/2000/svg" height="16" width="14" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.-->
                                <path d="M438.6 105.4c12.5 12.5 12.5 32.8 0 45.3l-256 256c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L160 338.7 393.4 105.4c12.5-12.5 32.8-12.5 45.3 0z" />
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="form__group">
                    <div class="form__control">
                        <button type="submit" class="btn">Start Clearance</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="js/bulkClearance.js"></script>

<script>
    function showBulkClearanceModal() {
        document.getElementById('bulk_clearance__modal').classList.toggle('active');

        if (document.getElementById('bulk_clearance__modal').classList.contains('active')) {
            // updateBulkClearanceProgress();
        }
    }
</script>