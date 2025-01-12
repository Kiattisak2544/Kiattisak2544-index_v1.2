  
    var page = 1;
    // Page ทั้งหมด
    var totalpage = 0;
    var data = data_table();
    var html = "";
    var text = "";

    function render_data() {
        var html = "";
        for (var i = (page - 1) * 10; i < page * 10; i++) {
            if (i < data.length) {
                if (data[i].status === "1") {
                    repairClass = 'text-success';
                    repairText = 'ซ่อมแล้ว';
                } else {
                    repairClass = 'text-danger';
                    repairText = 'ไม่ซ่อม';
                }
                html += ` <tr>
                <td class='text-center' style = 'font-size:14px'>${data[i].id}</td>
                <td class='text-center' style = 'font-size:14px'>${data[i].firstname}   ${data[i].lastname}</td>
                <td class='text-center' style = 'font-size:14px'>${data[i].telephone}</td>
                <td class='' style = 'font-size:14px'>${data[i].detail}</td>   
                <td class='text-center ${repairClass}' style='font-size:14px'>${repairText}</td>
                <td class='text-center' style = 'font-size:14px'><button class='btn btn-sm btn-success btn-access' data = '${data[i].id}'><i class="fa-solid fa-check"></i></button></td> 
                <td class='text-center' style = 'font-size:14px'><button class='btn btn-sm btn-danger'><i class="fa-solid fa-x"></i></button></td> 
                </tr>
        `;
            }
            $("#response").html(html);
            // ceil ปัดเศษ ในกรณีหารกันแล้วมีเลขทศนิยม
            totalpage = Math.ceil(data.length / 10);
            var pagination_html = "";
            pagination_html =
                `<div onclick="back_page()" class="btn btn btn-secondary"><i class="fa-solid fa-arrow-left"></i> </div>`;
            for (let i = 1; i <= totalpage; i++) {
                pagination_html += `<div id="page${i}" onclick="current_page(${i})" class="btn btn btn-outline-secondary ${page === i ? "active" : ""
                }  " aria-current='page'>${i}</div>`;
            }
            pagination_html +=
                `<div onclick="next_page()" class="number-pagination btn btn btn-secondary"><i class="fa-solid fa-arrow-right"></i> </div>`;

            // update page
            $("#btn-group").html(pagination_html);
        }
    }

    function next_page() {
        if (page != totalpage) {
            page++;
            render_data();
        }
    }

    function back_page() {
        if (page != 1) {
            page--;
            render_data();
        }
    }

    function current_page(cupage) {
        page = cupage;

        render_data();
    }

    function data_table() {
        $.ajax({
            url: "/index_v1.2/api/fecth_table.php",
            type: "post",
            dataType: "JSON",
            success: function(res) {
                data = res.map(function(item) {
                    return {
                        id: item.id_broken,
                        firstname: item.firstname,
                        lastname: item.lastname,
                        detail: item.mainternace_detail,
                        status: item.status,
                        telephone: item.telephone,
                    };
                });
                render_data();
            },
        });
    }


  
   