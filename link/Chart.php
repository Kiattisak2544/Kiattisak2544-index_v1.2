
<!DOCTYPE html>
<html>

<head>
    <title>My Chart</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
</head>

<body>
    <canvas id="myChart" style='width:600px;max-height:1000px'></canvas>

    <script>
    $(document).ready(function() {
        if ($("#myChart").length === 0) {
            console.error("❌ ไม่พบ <canvas id='myChart'> ใน DOM");
            return;
        }

        $.ajax({
            url: "/index_v1.2/api/showChart.php",
            type: "POST",
            dataType: "JSON",
            success: function(res) {
                if (!res || !Array.isArray(res) || res.length == 0) {
                    console.warn("❌ ข้อมูลจาก API ไม่ถูกต้อง หรือมีจำนวนเดือนไม่ครบ");
                    return;
                }
                const data = new Array(12).fill(0); // สร้าง array ขนาด 12 ช่องเริ่มต้นด้วย 0
                // console.log("✅ ข้อมูลจาก API:", res);
                res.forEach(item => {
                    const month = parseInt(item.repair_month); // แปลงเดือนให้เป็นตัวเลข
                    const total = parseInt(item.total_repairs); // แปลงจำนวนการซ่อมให้เป็นตัวเลข

                    // console.log("✅ เดือน:", month, "จำนวนการซ่อม:", total);

                    if (month >= 1 && month <= 12) {
                        data[month - 1] =
                            total; // ใส่ค่าใน index ที่ถูกต้อง (0 คือมกราคม, 1 คือกุมภาพันธ์, ...)
                    }
                    // console.log("✅ ข้อมูลที่อัปเดต:", data);
                });

                const labels = [
                    "มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน",
                    "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม",
                    "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม"
                ];

                // console.log("✅ ข้อมูลที่ใช้แสดงในกราฟ:", data);

                showChart(labels, data);
            },
            error: function(xhr, status, error) {
                console.error("❌ เกิดข้อผิดพลาดในการเรียก API:", error);
            }
        });

        let myChart = null;

        function showChart(labels, data) {
            const ctx = document.getElementById('myChart').getContext('2d');

            if (myChart !== null) {
                myChart.destroy();
            }

            myChart = new Chart(ctx, {
                type: "line",
                data: {
                    labels: labels,
                    datasets: [{
                        label: "จำนวนการซ่อมรายเดือน",
                        data: data,
                        backgroundColor: 'rgba(117, 187, 234, 0.8)',
                        borderColor: 'rgb(12, 151, 243)',
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
                                text: ''
                            }
                        }
                    }
                }
            });
        }
    });
    </script>
</body>

</html>
