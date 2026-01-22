<div id="modal_container">
    <div class="modal fade" id="modal_update" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">แก้ไขใบมัดจำสินค้า</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <form id="form_sale">
                        <div class="row g-2">
                            <div class="col-md-6">
                                <label for="name" class="form-label text-label">ชื่อลูกค้า</label>
                                <input type="text" class="form-control" id="fullname" value="">
                                <span id="name-message" id='message'></span>
                            </div>
                            <div class="col-md-6">
                                <label for="tel" class="form-label text-label">เบอร์โทรศัพท์</label>
                                <input type="text" class="form-control" id="telphone" value="" maxlength="10">
                                <span id="tel-alert" class="message"></span>
                            </div>
                            <div class="col-md-2">
                                <label for="house_number" class="form-label text-label">เลขที่</label>
                                <input type="text" class="form-control" id="house_numbers" >
                            </div>
                            <div class="col-md-2">
                                <label for="district" class="form-label text-label">ตำบล</label>
                                <input type="text" class="form-control" id="districts">
                            </div>
                            <div class="col-md-2">
                                <label for="amphoe" class="form-label text-label">อำเภอ</label>
                                <input type="text" class="form-control" id="amphoes">
                            </div>
                            <div class="col-md-3">
                                <label for="province" class="form-label text-label">จังหวัด</label>
                                <input type="text" class="form-control" id="provinces">
                            </div>
                            <div class="col-md-3">
                                <label for="zipcode" class="form-label text-label">รหัสไปรษณีย์</label>
                                <input type="text" class="form-control" id="zipcodes">
                            </div>
                            <div class="mt-2">
                                <hr>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <p class="text-label">ราคาเครื่อง/รวมอุปกรณ์ทั้งหมด</p>
                                </div>
                                <div class="col-md-1">
                                    <label class="col-form-label text-label">จำนวน</label>
                                </div>
                                <div class="col-md-2">
                                    <input type="number" class="form-control text-label" id="prices">
                                </div>
                                <div class="col-md-1">
                                    <label class="col-form-label text-label">บาท</label>
                                </div>
                                <div class="col-md-2">
                                    <label class="col-form-label text-label">ผู้รับเงิน</label>
                                </div>
                                <div class="col-md-2">
                                    <input type="text" class="form-control text-label" value="<?= $user_name; ?>"
                                        id="name_sales" readonly>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-2">
                                    <p class="text-label">ชำระมัดจำ</p>
                                </div>
                                <div class="col-md-2">
                                    <input class="form-check-input" type="checkbox" value="1" id="type_credits">
                                    <label class="form-check-label text-label" for="type_credit">บัตรเครดิต</label>
                                </div>
                                <div class="col-md-2">
                                    <input class="form-check-input" type="checkbox" value="1" id="type_cashs">
                                    <label class="form-check-label text-label" for="type_cash">เงินสด</label>
                                </div>
                                <div class="col-md-2">
                                    <input class="form-check-input" type="checkbox" value="1" id="type_downs">
                                    <label class="form-check-label text-label" for="type_down">QR CODE</label>
                                </div>
                                <div class="col-md-1">
                                    <label class="col-form-label text-label">จำนวน</label>
                                </div>
                                <div class="col-md-2">
                                    <input type="number" class="form-control text-label" id="deposits">
                                </div>
                                <div class="col-md-1">
                                    <label class="col-form-label text-label">บาท</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8">
                                    <label class="col-form-label text-label">ยอดที่คงเหลือที่ต้องชำระ</label>
                                </div>
                                <div class="col-md-1">
                                    <label class="col-form-label text-label">จำนวน</label>
                                </div>
                                <div class="col-md-2">
                                    <input type="number" class="form-control text-label" id="sums" readonly>
                                </div>
                                <div class="col-md-1">
                                    <label class="col-form-label text-label">บาท</label>
                                </div>
                            </div>
                        </div>
                        <div class="mt-2">
                            <hr>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <p class="text-label">เวลานัดรับเครื่อง/อุปกรณ์</p>
                            </div>
                            <div class="col-md-1">
                                <p class="text-label">วันที่</p>
                            </div>
                            <div class="col-md-4">
                                <input type="date" class="form-control text-label" id="dates">
                            </div>
                            <div class="col-md-1">
                                <p class="text-label">เวลา</p>
                            </div>
                            <div class="col-md-2">
                                <input type="time" class="form-control" id="times" data-mdb-formar24="true" step="60">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="comment" class="text-label fw-bold">ข้อเสนอแนะเพิ่มเติม</label>
                            <textarea class="form-control" id="comment" rows="3"></textarea>
                        </div>
                    </form>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-primary" id="btn-update">Save</button>
                </div>

            </div>
        </div>
    </div>
</div>