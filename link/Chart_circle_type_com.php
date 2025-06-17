<!DOCTYPE html>
<html>

<head>
    <title>My Chart</title>
    <!-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script> -->
</head>

<body>
    <button class="btn btn-sm btn-primary" id="showYearlyChart">แสดงข้อมูลกราฟรายปี</button>
    <canvas id="yearlyChart" style="display: none; width:600px;max-height:260px"></canvas>
    <canvas id="Chart1" style='width:600px;max-height:260px'></canvas>
    <div id="loading" style="display: none;">กำลังโหลดข้อมูล...</div>
    <div id="error" style="color: red; display: none;">เกิดข้อผิดพลาดในการโหลดข้อมูล</div>

    <div class="col-12 col-md-10 mx-auto mt-1 border shadow-sm bg-body-tertiary rounded">
        <div class="card-header text-center">
            <h5 class="card-title">สรุปการซ่อมคอมพิวเตอร์</h5>
        </div>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col" class=" text-center text-header-1">คอมพิวเตอร์ ภายใน(่JIB)</th>
                        <th scope="col" class=" text-center text-header-1">คอมพิวเตอร์ ภายนอก</th>
                    </tr>
                </thead>
                <tbody id='tbody'>

                </tbody>
            </table>
        </div>
    </div>

    <script>
    $(document).ready(function() {
        var myChart = null;
        var monthlyData = null; // เก็บข้อมูลรายเดือน
        var yearlyData = null; // เก็บข้อมูลรายปี
        var yearlyChartInstance = null;

        // ดึงข้อมูลรายเดือน
        $.ajax({
            url: '/index_v1.2/api/showChart_cricle.php',
            type: 'POST',
            dataType: 'json',
            success: function(res) {
                console.log("✅ ข้อมูลจาก API:", res);
                monthlyData = res.map(function(item) {
                    return {
                        Computer_type: item.Computer_type,
                        total_count: item.total_count
                    };
                });
                updateTable(monthlyData); // อัปเดตตารางด้วยข้อมูลรายเดือน
                createMonthlyChart(monthlyData); // สร้างกราฟรายเดือน    

            }
        });
        // ดึงข้อมูลรายปี
        $.ajax({
            url: '/index_v1.2/api/showChart_year.php',
            type: 'POST',
            dataType: 'json',
            success: function(res) {
                yearlyData = res.map(function(item) {
                    return {
                        Computer_type: item.Computer_type,
                        com_count: item.com_count
                    }
                });
                createYearlyChart(yearlyData); // สร้างกราฟรายปี

            },
            error: function(erroe) {
                console.log('เกิดข้อผิดพลาดในการดึงข้อมูลรายเดือน ❌:', error)
            }
        });
        // ฟังก์ชันอัปเดตตาราง
        function updateTable(data) {
            // console.log("ข้อมูลที่ได้รับใน updateTable:", data);
            if (data && Array.isArray(data)) {
                if (data.length >= 1 && data[0]) {
                    // console.log("ข้อมูล [0]:", data[0]);
                    var jibCount = data[0].total_count || data[0].com_count ;
                } else {
                    var jibCount = '-';
                    console.warn("ไม่มีข้อมูลสำหรับคอมพิวเตอร์ภายใน (JIB)");
                }

                if (data.length >= 2 && data[1]) {
                    // console.log("ข้อมูล [1]:", data[1]);
                    var externalCount = data[1].total_count || data[1].com_count ;
                } else {
                    var externalCount = '-';
                    console.warn("ไม่มีข้อมูลสำหรับคอมพิวเตอร์ภายนอก");
                }

                var html = `
            <tr>
                <td class = 'text-center'>${jibCount}</td>
                <td class = 'text-center'>${externalCount}</td>
            </tr>
        `;
                $('#tbody').html(html);
            } else {
                console.error("ข้อมูลที่ส่งมายัง updateTable ไม่ถูกต้อง:", data);
                $('#tbody').html(`<tr><td colspan="2" class="text-center">ไม่มีข้อมูล</td></tr>`);
            }
        }


        // ฟังก์ชันแปลงประเภทคอมพิวเตอร์เป็นชื่อที่อ่านง่าย
        function Get_label(type) {
            switch (type) {
                case 'computer_out':
                    return 'คอมพิวเตอร์ภายนอก';
                case 'computer_in-jib':
                    return 'คอมพิวเตอร์ภายใน (JIB)';
            }
        }
        // สร้าง event คลิกปุ่มเพื่อแสดงกราฟรายปี
        $('#showYearlyChart').click(function() {
            $('#yearlyChart').toggle();
            $('#Chart1').toggle();
            $('#card-title').html($('#yearlyChart').is(':visible') ?
                'ประเภทการซ่อม ภายใน/ ภายนอก (รายปี)' :
                'ประเภทการซ่อม ภายใน/ ภายนอก (รายเดือน)');

            // สร้างกราฟใหม่เมื่อมีการคลิก
            updateTable($('#yearlyChart').is(':visible') ? yearlyData : monthlyData);
        });

        // ฟังก์ชันสร้างกราฟรายปี
        function createYearlyChart(data) {
            if (data && data.length > 0) {
                const labels = data.map(item => Get_label(item.Computer_type)); // แก้ไขชื่อฟังก์ชัน
                const values = data.map(item => item.com_count);

                if (yearlyChartInstance) {
                    yearlyChartInstance.destroy();
                }

                yearlyChartInstance = new Chart($('#yearlyChart'), {
                    type: 'doughnut',
                    data: {
                        labels: labels,
                        datasets: [{
                            data: values,
                            backgroundColor: [ 'rgba(255, 99, 132, 0.7)',
                            'rgba(54, 162, 235, 0.7)'
                               
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        legend: {
                            position: 'bottom'
                        }
                    }
                });
            } else {
                console.error("ไม่มีข้อมูลสำหรับกราฟรายปี");
            }
        }

        // ฟังก์ชันสร้างกราฟรายเดือน
        function createMonthlyChart(data) {
            // console.log("Monthly Data:", data); // ตรวจสอบข้อมูล

            if (data && data.length > 0) {
                const labels = data.map(item => Get_label(item.Computer_type));
                const values = data.map(item => item.total_count);

                // console.log("Labels:", labels); // ตรวจสอบ labels
                // console.log("Values:", values); // ตรวจสอบ values

                if (myChart) {
                    myChart.destroy();
                }

                myChart = new Chart($('#Chart1'), {
                    type: 'doughnut',
                    data: {
                        labels: labels,
                        datasets: [{
                            data: values,
                            backgroundColor: ['rgba(255, 99, 132, 0.7)',
                                'rgba(54, 162, 235, 0.7)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        legend: {
                            position: 'bottom'
                        }
                    }
                });
            } else {
                console.error("ไม่มีข้อมูลสำหรับกราฟรายเดือน");
            }
        }



        /** 
        $.ajax({
            url: '/index_v1.2/api/showChart_cricle.php',
            type: 'POST',
            dataType: 'json',
            success: function(res) {
                // console.log("✅ ข้อมูลจาก API:", data);
                data = res.map(function(item) {
                    return {
                        Computer_type: item.Computer_type,
                        total_count: item.total_count
                    };
                });

                var html = "";

                html += `
                    <tr>
                        <td class = 'text-center'>${data[0].total_count}</td>
                        <td class = 'text-center'>${data[1].total_count}</td>
                    </tr>
                `;

                $('#tbody').html(html);


                // const data = res.map(item => item.total_count);
                // console.log("Data:", data);


                if (data && res.length > 0) {
                    const labels = res.map(item => {
                        if (item.Computer_type === 'computer_out') {
                            return 'คอมพิวเตอร์ภายนอก';
                        } else if (item.Computer_type === 'computer_in-jib') {
                            return 'คอมพิวเตอร์ภายใน (JIB)';
                        } else {
                            return item.Computer_type;
                        }
                    });
                    const values = res.map(item => item.total_count);

                    // console.log("Labels:", labels);
                    // console.log("Values:", values);

                    if (myChart && myChart.distory) {
                        // ลบกราฟเดิม
                        myChart.destroy();
                    }
                    new Chart($('#Chart1'), {
                        type: 'doughnut',
                        data: {
                            labels: labels,
                            datasets: [{
                                data: values,
                                backgroundColor: [
                                    'rgba(255, 99, 132, 0.7)',
                                    'rgba(54, 162, 235, 0.7)'
                                    // เพิ่มสีเพิ่มเติมตามต้องการ
                                ],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            legend: {
                                position: 'bottom'
                            }
                        }
                    });
                } else {
                    console.error("ไม่มีข้อมูลจาก API");
                    // แสดงข้อผิดพลาดบนหน้าเว็บ
                }
            },
            error: function(error) {
                console.error('เกิดข้อผิดพลาดในการดึงข้อมูล:', error);
                // แสดงข้อผิดพลาดบนหน้าเว็บ
            }
        });


        $('#showYearlyChart').click(function() {
            $('#yearlyChart').toggle();
            // $('#loading').toggle();
            $('#error').hide();
            $('#yearlyChart').empty();

            if ($('#yearlyChart').is(':visible')) {
                $('#Chart1').hide();
                $('#card-title').html('ประเภทการซ่อม ภายใน(JIB)/ ภายนอก (รายปี)');
            } else {
                $('#Chart1').show();
                $('#card-title').html('ประเภทการซ่อม ภายใน(JIB)/ ภายนอก (รายเดือน)');
            }

            $.ajax({
                url: '/index_v1.2/api/showChart_year.php',
                type: 'POST',
                dataType: 'json',
                success: function(res) {
                    // console.log("✅ ข้อมูลจาก API:", data);
                    data = res.map(function(item) {
                        return {
                            Computer_type: item.Computer_type,
                            com_count: item.com_count
                        };
                    });

                    if (data && res.length > 0) {
                        const labels = res.map(item => {
                            if (item.Computer_type === 'computer_out') {
                                return 'คอมพิวเตอร์ภายนอก';
                            } else if (item.Computer_type === 'computer_in-jib') {
                                return 'คอมพิวเตอร์ภายใน (JIB)';
                            } else {
                                return item.Computer_type;
                            }
                        });
                        const values = res.map(item => item.com_count);

                        if (yearlyChartInstance && yearlyChartInstance.destroy) {
                            yearlyChartInstance.destroy();
                            console.log('Graph ID:', yearlyChartInstance.id);
                        }
                        new Chart($('#yearlyChart'), {
                            type: 'doughnut',
                            data: {
                                labels: labels,
                                datasets: [{
                                    data: values,
                                    backgroundColor: [
                                        'rgba(255, 99, 132, 0.7)',
                                        'rgba(54, 162, 235, 0.7)'
                                        // เพิ่มสีเพิ่มเติมตามต้องการ
                                    ],
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: false,
                                legend: {
                                    position: 'bottom'
                                }
                            }
                        });
                    } else {
                        console.error("ไม่มีข้อมูลจาก API");
                        // แสดงข้อผิดพลาดบนหน้าเว็บ
                    }
                },
                error: function(error) {
                    console.error('เกิดข้อผิดพลาดในการดึงข้อมูล:', error);
                    // แสดงข้อผิดพลาดบนหน้าเว็บ
                }
            });
        });*/
    });
    </script>

</body>

</html>