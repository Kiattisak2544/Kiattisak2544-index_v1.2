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
        <div class="d-flex justify-content-between gap-5">
            <a href="#" class="text-decoration-none position-relative">
                <i class="fa-solid fa-bell fs-4"></i>
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    3
                    <span class="visually-hidden">unread messages</span>
                </span>
            </a>

            <div class="dropdown ">
                <a href="#" class="dropdown-toggle link-underline link-underline-opacity-0 " id="dropdownMenuButton1"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <i class='fa-solid fa-user fs-4'></i>
                </a>
                <ul class="dropdown-menu col-md-z-3 " aria-labelledby="dropdownMenuButton1"
                    style="right: 0; left: auto;">
                    <li>
                        <a class="dropdown-item p-2" href="#"><?=$Data_user['Firstname_repair'];?>
                            <?=$Data_user['Lastname_repair'];?>
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="#">
                            <hr>
                        </a>
                    </li>
                    <li><a class="dropdown-item" href="#"><i
                                class="fa-solid fa-gear rounded-circle bg-secondary text-light bg-gradient p-2"></i>
                            ตั้งค่า</a></li>
                    <li><a class="dropdown-item" href="../logout.php"><i
                                class="fa-solid fa-right-to-bracket rounded-circle bg-secondary text-light bg-gradient p-2"></i>
                            ออกจากระบบ</a></li>
                </ul>
            </div>
        </div>
        <!-- </div> -->
    </div>
</nav>