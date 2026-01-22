<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <title>สรุปการซ่อมคอมพิวเตอร์</title>
    <style>
        body {
            font-family: "Sarabun", sans-serif;
            margin: 20px;
        }
        .btn {
            margin-bottom: 10px;
        }
        .table th {
            background-color: #f5f5f5;
        }
    </style>
</head>

<body>
    <button class="btn btn-md btn-primary" id="showYearlyChart">
        <i class="fa-solid fa-eye"></i> แสดงข้อมูลกราฟ
    </button>

    <canvas id="yearlyChart" style="display:none;width:600px;max-height:260px"></canvas>
    <canvas id="Chart1" style="width:600px;max-height:260px"></canvas>

    <div id="loading" style="display:none;">กำลังโหลดข้อมูล...</div>
    <div id="error" style="color:red;display:none;">เกิดข้อผิดพลาดในการโหลดข้อมูล</div>

    <div class="col-12 col-md-10 mx-auto mt-3 border shadow-sm bg-body-tertiary rounded">
        <div class="card-header text-center">
            <h5 class="card-title" id="card-title">สรุปการซ่อมคอมพิวเตอร์ (รายเดือน)</h5>
        </div>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th class="text-center">คอมพิวเตอร์ภายใน (JIB)</th>
                        <th class="text-center">คอมพิวเตอร์ภายนอก</th>
                    </tr>
                </thead>
                <tbody id="tbody">
                    <tr><td colspan="2" class="text-center">กำลังโหลดข้อมูล...</td></tr>
                </tbody>
            </table>
        </div>
    </div>
     <!-- jquery -->
    <!-- <script src="https://code.jquery.com/jquery-3.7.1.js"></script> -->
    <!-- ajax -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->
   

    <script>
        
        // $(document).ready(function () {
        //     let myChart = null;
        //     let yearlyChartInstance = null;
        //     let monthlyData = [];
        //     let yearlyData = [];

        //     // ✅ แปลงชื่อประเภทให้สวยงาม
        //     function Get_label(type) {
        //         if (type === 'computer_in-jib') return 'คอมพิวเตอร์ภายใน (JIB)';
        //         if (type === 'computer_out') return 'คอมพิวเตอร์ภายนอก';
        //         return type;
        //     }

        //     // ✅ ฟังก์ชันอัปเดตตาราง
        //     function updateTable(data) {
        //         if (!data || !Array.isArray(data)) {
        //             $('#tbody').html(`<tr><td colspan="2" class="text-center">ไม่มีข้อมูล</td></tr>`);
        //             return;
        //         }

        //         const jib = data.find(item => item.Computer_type === 'computer_in-jib');
        //         const external = data.find(item => item.Computer_type === 'computer_out');

        //         const jibCount = (jib?.total_count ?? jib?.Com_Count ?? 0);
        //         const externalCount = (external?.total_count ?? external?.Com_Count ?? 0);

        //         const html = `
        //             <tr>
        //                 <td class="text-center">${jibCount}</td>
        //                 <td class="text-center">${externalCount}</td>
        //             </tr>
        //         `;
        //         $('#tbody').html(html);
        //     }

        //     // ✅ สร้างกราฟรายเดือน
        //     function createMonthlyChart(data) {
        //         const jib = data.find(item => item.Computer_type === 'computer_in-jib');
        //         const external = data.find(item => item.Computer_type === 'computer_out');

        //         const labels = ['คอมพิวเตอร์ภายใน (JIB)', 'คอมพิวเตอร์ภายนอก'];
        //         const values = [
        //             jib ? jib.total_count || 0 : 0,
        //             external ? external.total_count || 0 : 0
        //         ];

        //         if (myChart) myChart.destroy();

        //         myChart = new Chart($('#Chart1'), {
        //             type: 'doughnut',
        //             data: {
        //                 labels: labels,
        //                 datasets: [{
        //                     data: values,
        //                     backgroundColor: [
        //                         'rgba(54, 162, 235, 0.7)', // ภายใน
        //                         'rgba(255, 99, 132, 0.7)'  // ภายนอก
        //                     ],
        //                     borderWidth: 1
        //                 }]
        //             },
        //             options: {
        //                 responsive: true,
        //                 maintainAspectRatio: false,
        //                 plugins: { legend: { position: 'bottom' } }
        //             }
        //         });
        //     }

        //     // ✅ สร้างกราฟรายปี
        //     function createYearlyChart(data) {
        //         const jib = data.find(item => item.Computer_type === 'computer_in-jib');
        //         const external = data.find(item => item.Computer_type === 'computer_out');

        //         const labels = ['คอมพิวเตอร์ภายใน (JIB)', 'คอมพิวเตอร์ภายนอก'];
        //         const values = [
        //             jib ? jib.Com_Count || 0 : 0,
        //             external ? external.Com_Count || 0 : 0
        //         ];

        //         if (yearlyChartInstance) yearlyChartInstance.destroy();

        //         yearlyChartInstance = new Chart($('#yearlyChart'), {
        //             type: 'doughnut',
        //             data: {
        //                 labels: labels,
        //                 datasets: [{
        //                     data: values,
        //                     backgroundColor: [
        //                         'rgba(54, 162, 235, 0.7)', // ภายใน
        //                         'rgba(255, 99, 132, 0.7)'  // ภายนอก
        //                     ],
        //                     borderWidth: 1
        //                 }]
        //             },
        //             options: {
        //                 responsive: true,
        //                 maintainAspectRatio: false,
        //                 plugins: { legend: { position: 'bottom' } }
        //             }
        //         });
        //     }

        //     // ✅ ดึงข้อมูลรายเดือน
        //     function fetchMonthlyData() {
        //         $.ajax({
        //             url: '/index_v1.2/api/showChart_cricle.php',
        //             type: 'POST',
        //             dataType: 'json',
        //             success: function (res) {
        //                 monthlyData = res.map(item => ({
        //                     Computer_type: item.Computer_type,
        //                     total_count: item.total_count
        //                 }));
        //                 createMonthlyChart(monthlyData);
        //                 updateTable(monthlyData);
        //             },
        //             error: function () {
        //                 $('#error').show().text('เกิดข้อผิดพลาดในการโหลดข้อมูลรายเดือน');
        //             }
        //         });
        //     }

             // ✅ ดึงข้อมูลรายปี
        //      function fetchYearlyData() {
        //          $.ajax({
        //              url: '/index_v1.2/api/showChart_year.php',
        //              type: 'POST',
        //              dataType: 'json',
        //              success: function (res) {
        //                  yearlyData = res.map(item => ({
        //                      Computer_type: item.Computer_type,
        //                      Com_Count: item.Com_Count
        //                  }));
        //                  createYearlyChart(yearlyData);
        //              },
        //              error: function () {
        //                  $('#error').show().text('เกิดข้อผิดพลาดในการโหลดข้อมูลรายปี');
        //              }
        //          });
        //      }

        //      // ✅ ปุ่มสลับกราฟ รายเดือน ↔ รายปี
        //      $('#showYearlyChart').click(function () {
        //          const showYear = $('#yearlyChart').is(':hidden');
        //          $('#yearlyChart').toggle(showYear);
        //          $('#Chart1').toggle(!showYear);
        //          $('#card-title').text(showYear ?
        //              'สรุปการซ่อมคอมพิวเตอร์ (รายปี)' :
        //              'สรุปการซ่อมคอมพิวเตอร์ (รายเดือน)');
        //          updateTable(showYear ? yearlyData : monthlyData);
        //      });

        //      // ✅ โหลดข้อมูลตอนเปิดหน้า
        //      fetchMonthlyData();
        //      fetchYearlyData();
        //  });
    </script> 
</body>
</html>
