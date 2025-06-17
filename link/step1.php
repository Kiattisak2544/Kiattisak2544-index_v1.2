<div class="modal-body ">
                            <?php include('timeline.php') ?>
                            <p class="position-absolute top-1 mt-0 mx-4 text-cusstomer">ข้อมูลลูกค้า</p>
                            <div class="col-md-12 p-1 border rounded border-1 mt-3 ">

                                <div class="row g-1 p-3">
                                    <div class="col-12 col-md-4">
                                        <label for="firstname" class="col-form-label col-form-label-sm">ชื่อ</label>
                                        <input type="text" class="form-control form-control-sm" id=firstname">
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <label for="lastname" class="col-form-label col-form-label-sm">นามสกุล</label>
                                        <input type="text" class="form-control form-control-sm" id=lasstname">
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <label for="telnumber" class="col-form-label col-form-label-sm">เบอร์โทร</label>
                                        <input type="text" class="form-control form-control-sm" id=telnumber">
                                    </div>
                                    <div class="col-12 col-md-3">
                                        <label for="district" class="col-form-label col-form-label-sm">ตำบล</label>
                                        <input type="text" class="form-control form-control-sm" id="district">
                                    </div>
                                    <div class="col-12 col-md-3">
                                        <label for="amphoe" class="col-form-label col-form-label-sm">อำเภอ</label>
                                        <input type="text" class="form-control form-control-sm" id="amphoe">
                                    </div>
                                    <div class="col-12 col-md-3">
                                        <label for="province" class="col-form-label col-form-label-sm">จังหวัด</label>
                                        <input type="text" class="form-control form-control-sm" id="province">
                                    </div>
                                    <div class="col-12 col-md-3">
                                        <label for="zipcode"
                                            class="col-form-label col-form-label-sm">รหัสไปรษณีย์</label>
                                        <input type="text" class="form-control form-control-sm" id="zipcode">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="mdal">Close</button>
                            <button type="button" class="btn btn-primary next-btn">ถัดไป</button>
                        </div>