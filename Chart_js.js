//============================
//  LineChart
//============================ 
class LineChart {
    constructor() {
        this.myChart = null;
        this.labels = [
            "มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน",
            "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม",
            "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม"
        ];
        this.monthlyData = Array(12).fill(0);
    }

    showChart(labels, data) {
        const existingChart = Chart.getChart("myChart");

        if (existingChart ) {
            existingChart.destroy();
           
        }
        const ctx = document.getElementById("myChart").getContext("2d");

        this.myChart = new Chart(ctx, {
            type: "line",
            data: {
                labels: labels,
                datasets: [{
                    label: "จำนวนการซ่อมรายเดือน",
                    data: data,
                    backgroundColor: 'rgba(117, 187, 234, 0.8)',
                    borderColor: 'rgb(12, 151, 243)',
                    tension: 0.3,
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'จำนวนเครื่อง'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'เดือน'
                        }
                    }
                }
            }
        });

    }

    loadChartData() {
        $.ajax({
            url: '../api/showChart.php',
            type: 'POST',
            dataType: 'json',
            success: (response) => {
                if (response.success) {

                    response.data.forEach(item => {
                        const monthIndex = parseInt(item.repair_month) - 1;
                        const total_repairs = parseInt(item.total_repairs);

                        if (monthIndex >= 0 && monthIndex < 12) {
                            this.monthlyData[monthIndex] = total_repairs;
                        }

                    });

                    this.showChart(this.labels, this.monthlyData);

                } else {
                    console.log("❌ ข้อมูลไม่สำเร็จ:", response.message);
                }

            }, error: function (xhr, status, error) {
                console.error("❌ เกิดข้อผิดพลาดในการดึงข้อมูล:", error);
            }
        });
    }
}
//============================
//  CircleChart
//============================
class CircleChart {
    constructor() {
        this.monthChart = null;
        this.yearChart = null;
        this.MonthData = [];
        this.YearData = [];
        this.labels = ['คอมพิวเตอร์ในร้าน', 'คอมพิวเตอร์นอกร้าน'];
    }

    Get_label(type) {
        if (type === 'computer_in-jib') return 'คอมพิวเตอร์ภายใน (JIB)';
        if (type === 'computer_out-jib') return 'คอมพิวเตอร์ภายนอก (นอก JIB)';
        return type;
    }

    //ดึงข้อมูลแผนภูมิวงกลมรายเดือน
    fetchMonthlyData() {
        $.ajax({
            url: '/index_v1.2/api/showChart_cricle.php',
            type: 'POST',
            dataType: 'json',
            success: (response) => {

                const month = this.MonthData = response.map(item => ({
                    Computer_type: item.Computer_type,
                    total_count: item.total_count
                }));
                // แสดงข้อมูลในแผนภูมิวงกลม


                this.createMonthChart(this.MonthData);
                this.updateTable(this.MonthData);


            }, error: function (xhr, status, error) {
                console.error("❌ เกิดข้อผิดพลาดในการดึงข้อมูล:", error);
            }
        });
    }

    //ดึงข้อมูลแผนภูมิวงกลมรายปี
    fetchYearlyData() {
        $.ajax({
            url: '/index_v1.2/api/showChart_year.php',
            type: 'POST',
            dataType: 'json',
            success: (response) => {

                this.YearData = response.map(item => ({
                    Computer_type: item.Computer_type,
                    Com_Count: item.Com_Count
                }));
                // แสดงข้อมูลในแผนภูมิวงกลม

                this.createYearChart(this.YearData);
                

                console.log('Year Data Fetched:', this.YearData);






            }, error: function (xhr, status, error) {
                console.error("❌ เกิดข้อผิดพลาดในการดึงข้อมูล:", error);
            }

        });
    }
    createMonthChart(data) {
        const jib = data.find(item => item.Computer_type === 'computer_in-jib');
        const external = data.find(item => item.Computer_type === 'computer_out');

        const values = [
            jib ? jib.total_count || 0 : 0,
            external ? external.total_count || 0 : 0
        ];
        if (this.monthChart !== null){
            this.monthChart.destroy();
            this.monthChart = null;
        } 

        // console.log('Values for Circle Chart:', jib);

        this.monthChart = new Chart(document.getElementById('Chart1'), {
            type: 'doughnut',
            data: {
                labels: this.labels,
                datasets: [{
                    data: values,
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.8)',
                        'rgba(255, 99, 132, 0.8)'
                    ],
                    borderColor: [
                        'rgb(54, 162, 235)',
                        'rgb(255, 99, 132)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',

                    },
                    title: {
                        display: true,
                        text: 'สถานะคอมพิวเตอร์รายเดือน'
                    }
                }
            }
        }
        );
    }

    // สร้างแผนภูมิวงกลมรายปี
    createYearChart(data) {
        const jib = data.find(i => i.Computer_type === 'computer_in-jib');
        const external = data.find(i => i.Computer_type === 'computer_out');

        const values = [
            jib?.Com_Count ?? 0,
            external?.Com_Count ?? 0
        ];

        if (this.yearChart !== null){
            this.yearChart.destroy();
            this.yearChart = null;
        } 

        this.yearChart = new Chart(document.getElementById('yearlyChart'), {
            type: 'doughnut',
            data: {
                labels: this.labels,
                datasets: [{
                    data: values,
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.8)',
                        'rgba(255, 99, 132, 0.8)'
                    ],
                    borderColor: [
                        'rgb(54, 162, 235)',
                        'rgb(255, 99, 132)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',

                    },
                    title: {
                        display: true,
                        text: 'สถานะคอมพิวเตอร์รายปี'
                    }
                }
            }
        }
        );
    }

    updateTable(data) {
        if (!data || !Array.isArray(data)) {
            $('#tbody').html(`<tr><td colspan="2" class="text-center">ไม่มีข้อมูล</td></tr>`);
            return;
        }

        const jib = data.find(item => item.Computer_type === 'computer_in-jib');
        const external = data.find(item => item.Computer_type === 'computer_out');

        const jibCount = (jib?.total_count ?? jib?.Com_Count ?? 0);
        const externalCount = (external?.total_count ?? external?.Com_Count ?? 0);



        const html = `
            <tr>
                <td class="text-center">${jibCount}</td>
                <td class="text-center">${externalCount}</td>
            </tr>`;

        $('#tbody').html(html);
    }

}
function dashboardChartInit() {
    
    // ===== Line Chart =====
    if (document.getElementById('myChart')) {
        const line = new LineChart();
        line.loadChartData();
    }

    // ===== Circle Chart =====
    const circle = new CircleChart();

    if (document.getElementById('Chart1')) {
        circle.fetchMonthlyData();
    }

    if (document.getElementById('yearlyChart')) {
        circle.fetchYearlyData();
    }

    // ===== ปุ่มสลับรายเดือน / รายปี =====
    $('#showYearlyChart').off('click').on('click', function () {
        $('#yearlyChart').toggle();
        $('#Chart1').toggle();

        const isYear = $('#yearlyChart').is(':visible');
        circle.updateTable(isYear ? circle.YearData : circle.MonthData);
    });
}
