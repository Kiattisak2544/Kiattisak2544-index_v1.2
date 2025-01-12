<nav class="navbar navbar-expand-md  navbar-light bg-body shadow-sm z-3 p-3 mb-0 bg-body rounded">
    <?php
                $web = new websystem();
                $Data_user = $web->Display_user()
            ?>
    <div class="container justify-content-between">
        <a class="btn-md btn-body " data-bs-toggle="collapse" href="#collapseExample" role="button"
            aria-expanded="false" aria-controls="collapseExample">
            <span class="navbar-toggler-icon"></span>
        </a>

        <a class="navbar-brand text-sm-center fs-5" href="#">DASHBORD</a>
        <div class="d-flex justify-content-end">
            <a href="#" class="fs-5 ms-5"><i class="fa-solid fa-bell"></i></a>
            <div class="dropdown">
                <a href="#" class="fs-5 ms-5 dropdown-toggle " id="dropdownMenuButton1" data-bs-toggle="dropdown"
                    aria-expanded="false"><i class="fa-solid fa-user"></i></a>
                <ul class="dropdown-menu " aria-labelledby="dropdownMenuButton1" style="right: 0; left: auto;">
                    <li><a class="dropdown-item p-2" href="#"><?=$Data_user['Firstname_repair'];?>
                            <?=$Data_user['Lastname_repair'];?></a></li>
                    <li><a class="dropdown-item" href="#">
                            <hr>
                        </a></li>
                    <li><a class="dropdown-item" href="#"><i
                                class="fa-solid fa-gear rounded-circle bg-secondary text-light bg-gradient p-2"></i>
                            ตั้งค่า</a></li>
                    <li><a class="dropdown-item" href="#"><i
                                class="fa-solid fa-right-to-bracket rounded-circle bg-secondary text-light bg-gradient p-2"></i>
                            ออกจากระบบ</a></li>
                </ul>
            </div>
        </div>
        <!-- </div> -->
    </div>
</nav>