<nav class="collaspse show border col-12 col-md-12 col-lg-2 p-0 z-2 position-sm-absolute bg-body "
    id="collapseExample">
    <ul class="navbar-nav me-4 d-block me-auto mb-2 mb-lg-0 p-3">
        <li class="nav-item">
            <a class="nav-link " href="#" id="dashbord" link-data="dashbord.php"><i
                    class="fa-solid fa-chart-line"></i> หน้า
                Dashbord</a>
        </li>
         <li class="nav-item">
            <div class="dropdown">
                <a class="nav-link " href="#" link-data ="regis_customer.php"><i class="fa-solid fa-user-plus" ></i><span class='mx-1'>สมัครสมาชิก</span></a>
            </div>
        </li>
        <div class="dropdown">
            <li class="nav-item">
                <div class="dropdown dropbtn">
                    <a class="nav-link" href="#" id="repair_page" ><i class="fa-solid fa-toolbox"></i>
                    ประวัติการซ่อม</a> 

                    
                <div class="dropdown-content">
                    
                     <a class="dropdown-list nav-link" href="#" link-data ="repair.php" ><i class="fa-solid fa-check"></i> ซ่อมแล้ว</a>
                     <a class="dropdown-list nav-link" href="#" link-data ="no_repair.php"><i class="fa-solid fa-x"></i> ยังไม่ได้ซ่อม</a>
                    
                </div>
                </div>
               
            </li>
        </div>
        <li class="nav-item">
            <div class="dropdown">
                <a class="nav-link " href="#"><i class="fa-solid fa-hammer"></i> ข้อมูลการส่งเคลม</a>

            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="../logout.php"><i class="fa-solid fa-sign-out"></i> ออกจากระบบ</a>
        </li>

    </ul>
</nav>
</body>