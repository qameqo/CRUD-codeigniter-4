        var table_product, table_type_product, table_unit, table_report_product,table_report_user;
        var urlmain = $("#signined").attr('data-url');
        var data_product,data_type,data_unit,data_report_product,data_report_user;
        var data_product_c,data_type_c,data_unit_c,data_report_product_c,data_report_user_c;
        jQuery(function ($) {
            $(document).ajaxSend(function () {});
            $(document).ajaxStart(function () {});
            $(document).ajaxComplete(function () {});
        });
        function data_clean_product(){
            ajax_internal(false, urlmain + "/Product", null, "POST", (result) => {
               data_product_c = result.product;
               $('#tbl_product').DataTable().clear().rows.add(data_product_c).draw();
            })
        }
        function data_clean_type_product(){
            ajax_internal(false, urlmain + "/TypeProduct", null, "POST", (result) => {
               data_type_c = result.type_product;
               $('#tbl_type_product').DataTable().clear().rows.add(data_type_c).draw();
            })
        }
        function data_clean_unit(){
            ajax_internal(false, urlmain + "/Unit", null, "POST", (result) => {
               data_unit_c = result.unit;
               $('#tbl_unit').DataTable().clear().rows.add(data_unit_c).draw();
            })
        }
        function data_clean_report_product(){
            ajax_internal(false, urlmain + "/Report", null, "POST", (result) => {
                data_report_product_c = result.report;
               $('#tbl_report_product').DataTable().clear().rows.add(data_report_product_c).draw();
            })
        }
        function data_clean_report_user(){
            ajax_internal(false, urlmain + "/User", null, "POST", (result) => {
                data_report_user_c = result.user;
               $('#tbl_report_user').DataTable().clear().rows.add(data_report_user_c).draw();
            })
        }
        function get_product() {
            ajax_internal(false, urlmain + "/Product", null, "POST", (result) => {
                // table_product.fnClearTable();
                // if (result.product.length > 0) {
                //     table_product.fnAddData(result.product);
                //     table_product.api().draw(true);
                // } else {
                //     table_product.fnClearTable()
                // }
                data_product = result.product;
                table_product = $("#tbl_product").DataTable({
                    responsive: {
                        details:{
                            display: $.fn.dataTable.Responsive.display.modal({
                                header: function (row){
                                    var data = row.data();
                                    return 'Details for '+data['product_name'];
                                }
                            }),
                            renderer: $.fn.dataTable.Responsive.renderer.tableAll({
                                tableClass: 'table'
                            })
                        }
                    },
                    data: data_product,
                    columns: [
                        {
                            data: null,
                            render: function (data, type, full, meta) {
                                return meta.row + 1;
                            },
                        },
                        {
                            data: 'image_path',
                            orderable: false,
                            render: function (data, type, row, meta) {
                                
                                return '<img onclick="open_modal_image(this)" data-image="'+ urlmain + "/uploads/" + data +'" style="width:50px; cursor:pointer; heigth:50px;" src="'+ urlmain + "/uploads/" + data +'" />';
                            },
                        },
                        {
                            data: 'type_name',
                            type:'string'
                        },
                        {
                            data: 'product_name',
                            type:'string'
                        },
                        {
                            data: 'product_quality',
                            render: function (data, type, row, meta) {
                                return '<span>'+ data +'</span> <i style="cursor:pointer; color:green;" data-quality="'+ row['product_quality'] +'"  data-image-id="'+ row['image_id'] +'" data-image="'+ row['image_path'] +'" data-name="' + row['product_name'] + 
                                    '" data-id="'+ row['product_id'] +'" data-id-unit="'+ row['unit_id'] +'" data-id-type="'+ row['type_id'] +'" onclick="add_quality_product(this)" title="Hello from speech bubble!"  class="fa-solid fa-plus tooltip"></i>&nbsp;<i style="cursor:pointer; color:red;" data-id="' +
                                    row['product_id'] + '"data-name="' + row['product_name'] + '" data-quality="'+ row['product_quality'] +'"  onclick="delete_quality_product(this)" class="fa-solid fa-minus"></i>';
                            },
                            type:'string'
                        },
                        {
                            data: 'unit_name',
                            type:'string'
                        },
                        {
                            data: 'product_update_date',
                            type:'date'
                        },
                        {
                            data: 'product_update_by',
                            type:'string'
                        },
                        {
                            data: null,
                            title: 'Edit',
                            orderable: false,
                            render: function (data, type, row, meta) {
                                return '<i style="cursor:pointer;"data-quality="'+ row['product_quality'] +'"  data-image-id="'+ row['image_id'] +'" data-image="'+ row['image_path'] +'" data-name="' + row['product_name'] + 
                                    '" data-id="'+ row['product_id'] +'" data-id-unit="'+ row['unit_id'] +'" data-id-type="'+ row['type_id'] +'" onclick="edit_product(this)" class="far fa-edit"></i>&nbsp;<i style="cursor:pointer;" data-row="' +
                                    row['product_id'] + '" data-name="' + row['product_name'] + '" onclick="delete_product(this)" class="far fa-trash-alt"></i>';
                            },
                        }
                    ]
                });
            })
        }

        function get_type_product() {
            ajax_internal(false, urlmain + "/TypeProduct", null, "POST", (result) => {
                // table_type_product.fnClearTable();
                // if (result.type_product.length > 0) {
                //     table_type_product.fnAddData(result.type_product);
                //     table_type_product.api().draw(true);
                // } else {
                //     table_type_product.fnClearTable()
                // }
                data_type = result.type_product;
                table_type_product = $("#tbl_type_product").dataTable({
                    responsive: {
                        details:{
                            display: $.fn.dataTable.Responsive.display.modal({
                                header: function (row){
                                    var data = row.data();
                                    return 'Details for '+data['type_name'];
                                }
                            }),
                            renderer: $.fn.dataTable.Responsive.renderer.tableAll({
                                tableClass: 'table'
                            })
                        }
                    },
                    data: data_type,
                    columns: [{
                            data: null,
                            render: function (data, type, full, meta) {
                                return meta.row + 1;
                            },
                        },
                        {
                            title: 'Image',
                            data: 'image_path',
                            orderable: false,
                            render: function (data, type, row, meta) {
                                return '<img onclick="open_modal_image(this)" data-image="'+ urlmain + "/uploads/" + data +'" style="width:50px; cursor:pointer; heigth:50px;" src="'+ urlmain + "/uploads/" + data +'" />';
                            },
                        },
                        {
                            title: 'Name',
                            data: 'type_name',
                            type: 'string',
                            width: '150px'
                        },
                        {
                            title: 'Status',
                            type: 'num',
                            data: 'type_is_active'
                        },
                        {
                            type: 'date',
                            title: 'Create_date',
                            data: 'type_create_date'
                        },
                        {
                            title: 'Create_by',
                            type: 'string',
                            data: 'type_create_by'
                        },
                        {
                            title: 'Update_date',
                            type: 'date',
                            data: 'type_update_date'
                        },
                        {
                            title: 'Update_by',
                            type: 'string',
                            data: 'type_update_by'
                        },
                        {
                            title: 'Edit',
                            data: null,
                            orderable: false,
                            render: function (data, type, row, meta) {
                                return '<i style="cursor:pointer;" data-name="' + row['type_name'] + 
                                    '" data-id-type="'+ row['type_id'] +'" data-image="'+ row['image_path'] +'" data-id-image="'+ row['image_id'] +'" onclick="edit_type_product(this)" class="far fa-edit"></i>&nbsp;<i style="cursor:pointer;" data-row="' +
                                    row['type_id'] + '" data-name="' + row['type_name'] + '" onclick="delete_type_product(this)" class="far fa-trash-alt"></i>';
                            },
                        }
                    ]
                });
            })
        }

        function get_unit() {
            ajax_internal(false, urlmain + "/Unit", null, "POST", (result) => {
                // table_unit.fnClearTable();
                // if (result.unit.length > 0) {
                //     table_unit.fnAddData(result.unit);
                //     table_unit.api().draw(true);
                // } else {
                //     table_unit.fnClearTable()
                // }
                data_unit = result.unit;
                table_unit = $("#tbl_unit").dataTable({
                    responsive: {
                        details:{
                            display: $.fn.dataTable.Responsive.display.modal({
                                header: function (row){
                                    var data = row.data();
                                    return 'Details for '+data['unit_name'];
                                }
                            }),
                            renderer: $.fn.dataTable.Responsive.renderer.tableAll({
                                tableClass: 'table'
                            })
                        }
                    },
                    data: data_unit,
                    columns: [{
                            data: null,
                            render: function (data, type, full, meta) {
                                return meta.row + 1;
                            },
                        },
                        {
                            title: 'Name',
                            type: 'string',
                            data: 'unit_name'
                        },
                        {
                            title: 'Create_date',
                            type: 'date',
                            data: 'unit_create_date'
                        },
                        {
                            title: 'Create_by',
                            type: 'string',
                            data: 'unit_create_by'
                        },
                        {
                            title: 'Update_date',
                            type: 'date',
                            data: 'unit_update_date'
                        },
                        {
                            title: 'Update_by',
                            type: 'string',
                            data: 'unit_update_by'
                        },
                        {
                            title: 'Edit',
                            data: null,
                            orderable: false,
                            render: function (data, type, row, meta) {
                                return '<i style="cursor:pointer;" data-name="' + row['unit_name'] + 
                                    '" data-id="'+ row['unit_id'] +'" onclick="edit_unit(this)" class="far fa-edit"></i>&nbsp;<i style="cursor:pointer;" data-row="' +
                                    row['unit_id'] + '" data-name="' + row['unit_name'] + '" onclick="delete_unit(this)" class="far fa-trash-alt"></i>';
                            },
                        }
                        
                    ]
                });
            })
        }

        function ajax_upload(_loading, _url, _datajson, _type, _callback) {
            $.ajax({
                data: _datajson,
                type: _type,
                dataType: 'json',
                url: _url,
                processData: false,
                contentType: false,
                cache: false,
                beforeSend: function () {
                    if (_loading) {
                        $("#overlay").fadeIn(300);
                    }
                },
                success: function (result) {

                    if (result != null || result != "") {
                        return _callback(result);
                    } else {
                        return _callback(result);
                    }
                },
                error: function (result) {
                    alert("กรุณาลองใหม่อีกครั้ง...")
                }
            }).done(function () {
                setTimeout(function () {
                    $("#overlay").fadeOut(300);
                }, 2000);
            });
        }

        function ajax_internal(_loading, _url, _datajson, _type, _callback) {
            $.ajax({
                data: _datajson,
                type: _type,
                dataType: 'json',
                url: _url,
                beforeSend: function () {
                    if (_loading) {
                        $("#overlay").fadeIn(300);
                    }
                },
                success: function (result) {

                    if (result != null || result != "") {
                        return _callback(result);
                    } else {
                        return _callback(result);
                    }
                },
                error: function (result) {
                    alert("กรุณาลองใหม่อีกครั้ง...")
                }
            }).done(function () {
                setTimeout(function () {
                    $("#overlay").fadeOut(300);
                }, 2000);
            });
        }
        async function getData(_url) {
            const result = await $.ajax({
                type: 'GET',
                url: _url,
                async: false,
            });
            return result;
        }
        async function postData(_url, _datajson) {
            const result = await $.ajax({
                data: _datajson,
                type: 'POST',
                dataType: 'json',
                url: _url,
                cache: false,
                async: false
            });
            return result;
        }

        function genid() {
            return ([1e7] + -1e3 + -4e3 + -8e3 + -1e11).replace(/[018]/g, c => (c ^ crypto.getRandomValues(
                new Uint8Array(1))[0] & 15 >> c / 4).toString(16));
        }

        function gendate() {
            var datetime = new Date();
            return datetime.getFullYear() + "-" + (datetime.getMonth() + 1) + "-" + datetime.getDate() + " " +
                datetime.getHours() + ":" + datetime.getMinutes() + ":" + datetime.getSeconds();
        }

        function signup() {
            var r = confirm("Are you sure?");
            if (r == true) {
                var guid = genid();
                var timestamp = gendate();
                var obj = {};
                obj.id = guid;
                obj.firstname = $("#firstname").val();
                obj.lastname = $("#lastname").val();
                obj.email = $("#email").val();
                obj.password = $("#password").val();
                obj.confirmpassword = $("#confirmpassword").val();
                obj.update_date = timestamp;
                var register_url = urlmain + "/Register";
                var validate_register_url = urlmain + "/Register/validatedata";
                ajax_internal(false, validate_register_url, obj, "POST", (resultvalidate) => {
                    if (resultvalidate.success) {
                        ajax_internal(true, register_url, obj, "POST", (result) => {
                            if (result.success) {
                                toastr.options.progressBar = true,
                                    toastr.success(result.msg);
                                $("#firstname").val("");
                                $("#lastname").val("");
                                $("#email").val("");
                                $("#password").val("");
                                $("#confirmpassword").val("");
                                openTab('btn-tabs-signin', 'divSignin', 'md-info');
                            } else {
                                toastr.options.progressBar = true,
                                    toastr.error(result.msg);
                            }
                        });
                    } else {
                        toastr.options.progressBar = true,
                            toastr.warning(resultvalidate.msg);
                    }
                })
            }
        }

        function signin() {
            var obj = {};
            obj.email = $("#email-signin").val();
            obj.password = $("#password-signin").val();
            var base_url = urlmain + "/Login";
            var validate_url = urlmain + "/Login/validatedata";
            ajax_internal(false, validate_url, obj, "POST", (resultvalidate) => {
                if (resultvalidate.success) {
                    ajax_internal(true, base_url, obj, "POST", (result) => {
                        if (result.success) {
                            $("#email-signin").val("");
                            $("#password-signin").val("");
                            window.location.href = urlmain;
                        } else {
                            toastr.options.progressBar = true,
                                toastr.error(result.msg);
                        }
                    })
                } else {
                    toastr.options.progressBar = true,
                        toastr.warning(resultvalidate.msg);
                }
            })

        }

        function signout() {
            var base_url = urlmain + "/Login/signout"
            ajax_internal(true, base_url, null, "POST", (result) => {
                if (result.success) {
                    window.location.href = urlmain;
                }
            })
        }

        function carousel() {
            bulmaCarousel.attach('#slider', {
                slidesToScroll: 1,
                slidesToShow: 3,
                infinite: true,
                autoplay: true,
                autoplaySpeed: 2000
            });
        }
        carousel();

        function hiddenbtn(idcurrentTabs) {
            if (idcurrentTabs.trim() == "btn-tabs-signin") {
                document.querySelector("#btn-signin").style.display = 'block';
                document.querySelector("#btn-signup").style.display = 'none';
            } else if (idcurrentTabs.trim() == "btn-tabs-signup") {
                document.querySelector("#btn-signin").style.display = 'none';
                document.querySelector("#btn-signup").style.display = 'block';
            }
        }

        function openTab(evt, tabName, idmodal) {
            
            var i, x, tablinks;
            if (idmodal == 'md-info') {
                x = document.getElementsByClassName("content-tab");
                for (i = 0; i < x.length; i++) {
                    x[i].style.display = "none";
                }
                tablinks = document.getElementsByClassName("tab");
                for (i = 0; i < x.length; i++) {
                    tablinks[i].className = tablinks[i].className.replace(" is-active", "");
                }
                document.getElementById(tabName).style.display = "block";
                $("#" + evt).addClass(" is-active");
                hiddenbtn(evt)
            } else if (idmodal == 'md-product') {
                x = document.getElementsByClassName("content-tab-manage");
                for (i = 0; i < x.length; i++) {
                    x[i].style.display = "none";
                }
                tablinks = document.getElementsByClassName("tab-manage");
                for (i = 0; i < x.length; i++) {
                    tablinks[i].className = tablinks[i].className.replace(" is-active", "");
                }
                document.getElementById(tabName).style.display = "block";
                $("#" + evt).addClass(" is-active");
                hiddenbtn(evt)
            }
            if(tabName == "type-product"){
                $("#tbl_type_product").DataTable().responsive.recalc();
            }else if(tabName == "product"){
                $("#tbl_product").DataTable().responsive.recalc();
            }else if(tabName == "unit"){
                $("#tbl_unit").DataTable().responsive.recalc();
            }
        }
        
        class BulmaModal {

            constructor(selector) {
                this.elem = document.querySelector(selector)
                this.close_data()
            }

            show() {
                this.elem.classList.toggle('is-active')
                this.on_show()
            }

            close() {
                this.elem.classList.toggle('is-active')
                this.on_close()
            }

            close_data() {
                var modalClose = this.elem.querySelectorAll("[data-bulma-modal='close'], .modal-background")
                var that = this
                modalClose.forEach(function (e) {
                    e.addEventListener("click", function () {

                        that.elem.classList.toggle('is-active')

                        var event = new Event('modal:close')

                        that.elem.dispatchEvent(event);
                    })
                })
            }

            on_show() {
                var event = new Event('modal:show')
                this.elem.dispatchEvent(event);
            }

            on_close() {
                var event = new Event('modal:close')
                this.elem.dispatchEvent(event);
            }

            addEventListener(event, callback) {
                this.elem.addEventListener(event, callback)
            }
        }

        var btn_add_type_product = document.querySelector("#btn-add-type-product");
        var md_add_type_product = new BulmaModal("#md-add-type-product");
        var btn_report = document.querySelector("#btn-nav-report");
        var btn_report_user = document.querySelector("#btn-nav-report-user");
        var mdl_report_user = new BulmaModal("#md-report-user");
        var btn_manage_product = document.querySelector("#btn-nav-manage-product");
        var mdl_manage_product = new BulmaModal("#md-product");
        var btn = document.querySelector("#btn-nav-signin");
        var mdl = new BulmaModal("#md-info");
        var btn_add_unit = document.querySelector("#btn-add-unit");
        var md_add_unit = new BulmaModal("#md-add-unit");
        var btn_add_product = document.querySelector("#btn-add-product");
        var md_add_product = new BulmaModal("#md-add-product");
        var md_qua_product = new BulmaModal("#md-qua-product");
        var md_report_product = new BulmaModal("#md-report-product");
        var signined = $("#signined").attr('data-signined');
        if (signined == "") {
            btn.addEventListener("click", function () {
                mdl.show()
                openTab('btn-tabs-signin', 'divSignin', 'md-info');
                clearFields('md-info');
            })
        }
        btn_manage_product.addEventListener("click", function () {
            if (signined == "") {
                toastr.options.progressBar = true,
                    toastr.options.positionClass = "toast-top-center",
                    toastr.error('Please Sign in.');
                return false;
            }
            mdl_manage_product.show();
            
            openTab('tabs-type-product', 'type-product', 'md-product')
            document.querySelector("#nav-tabs-manage").scrollTop = 0;
        })
        btn_report.addEventListener("click", function () {
            if (signined == "") {
                toastr.options.progressBar = true,
                    toastr.options.positionClass = "toast-top-center",
                    toastr.error('Please Sign in.');
                return false;
            }
            $("#tbl_report_product").DataTable().responsive.recalc();
            data_clean_report_product();
            md_report_product.show();
        })
        btn_add_type_product.addEventListener("click", function () {
            if (signined == "") {
                toastr.options.progressBar = true,
                    toastr.options.positionClass = "toast-top-center",
                    toastr.error('Please Sign in.');
                return false;
            }
            md_add_type_product.show()
            $('#mode-type-product').attr('data-mode','New');
            var clearname = document.querySelector("#name-type-product");
            var clearimage = document.querySelector("#img-preview");
            if (clearimage.firstChild) {
                clearimage.removeChild(clearimage.firstChild);
            }
            clearimage.removeAttribute('src');
            clearimage.removeAttribute('style');
            clearname.value = "";
            document.getElementById("choose-file").value = null;
            $("#title-type").text('New Type Product');
        })
        btn_add_unit.addEventListener("click", function () {
            if (signined == "") {
                toastr.options.progressBar = true,
                    toastr.options.positionClass = "toast-top-center",
                    toastr.error('Please Sign in.');
                return false;
            }
            md_add_unit.show();
            $('#mode-unit').attr('data-mode','New');
            var clearname = document.querySelector("#name-unit");
            clearname.value = "";
            $("#title-unit").text('New Unit');
        })
        btn_add_product.addEventListener("click", function () {
            if (signined == "") {
                toastr.options.progressBar = true,
                    toastr.options.positionClass = "toast-top-center",
                    toastr.error('Please Sign in.');
                return false;
            }
            md_add_product.show();

            const div_quality_product = document.getElementById("div-quality-product");
            div_quality_product.style.display = null;

            $('#mode-product').attr('data-mode','New');
            var clearname = document.querySelector("#name-product");
            clearname.value = "";
            var clearqua = document.querySelector("#quality-product");
            clearqua.value = "";
            $("#title-product").text('New Product');
            dropdown_type();
            dropdown_unit();
            var clearimage = document.querySelector("#img-preview-pro");
            if (clearimage.firstChild) {
                clearimage.removeChild(clearimage.firstChild);
            }
            clearimage.removeAttribute('src');
            clearimage.removeAttribute('style');
            document.getElementById("choose-file-pro").value = null;
        })
        btn_report_user.addEventListener("click", function () {
            if (signined == "") {
                toastr.options.progressBar = true,
                    toastr.options.positionClass = "toast-top-center",
                    toastr.error('Please Sign in.');
                return false;
            }
            $("#tbl_report_user").DataTable().responsive.recalc();
            data_clean_report_user();
            mdl_report_user.show();
        })

        function edit_type_product(element){
            var signined = $("#signined").attr('data-signined');
            var btn_add_type_product = document.querySelector("#btn-add-type-product");
            var md_add_type_product = new BulmaModal("#md-add-type-product");
            if (signined == "") {
                toastr.options.progressBar = true,
                    toastr.options.positionClass = "toast-top-center",
                    toastr.error('Please Sign in.');
                return false;
            }
            $('.DTED').removeClass('is-active');
            btn_add_type_product.click();
            $('#mode-type-product').attr('data-mode','Edit');
            $('#mode-type-product').attr('data-id-type',$(element).attr('data-id-type'));
            $('#mode-type-product').attr('data-name-type',$(element).attr('data-name'));
            $('#mode-type-product').attr('data-id-image',$(element).attr('data-id-image'));
            $('#mode-type-product').attr('data-name-image',$(element).attr('data-image'));
            var img = $(element).attr('data-image');
            const imgPreview = document.getElementById("img-preview");
            var path = urlmain + "/uploads"+"/"+""+ img
            imgPreview.style.display = "block";
            imgPreview.style.margin = "auto";
            imgPreview.style.marginBottom = "20px";
            imgPreview.innerHTML = '<img src="' + path + '" />';
            $("#name-type-product").val($(element).attr('data-name'));
            $("#title-type").text('Edit Type Product');
        }

        function edit_unit(element){
            var signined = $("#signined").attr('data-signined');
            var btn_add_unit = document.querySelector("#btn-add-unit");
            var md_add_unit = new BulmaModal("#md-add-unit");
            if (signined == "") {
                toastr.options.progressBar = true,
                    toastr.options.positionClass = "toast-top-center",
                    toastr.error('Please Sign in.');
                return false;
            }
            $('.DTED').removeClass('is-active');
            btn_add_unit.click();
            $('#mode-unit').attr('data-mode','Edit');
            $('#mode-unit').attr('data-id-unit',$(element).attr('data-id'));
            $('#mode-unit').attr('data-name-unit',$(element).attr('data-name'));
            $("#name-unit").val($(element).attr('data-name'));
            $("#title-unit").text('Edit Unit');
        }

        function clearFields(fieldid) {
            var container, inputs, index;
            container = document.getElementById(fieldid);
            inputs = container.getElementsByTagName('input');
            for (index = 0; index < inputs.length; ++index) {
                inputs[index].value = '';
            }
        }

        function lazyloading() {
            for (let i = 1; i <= 10; i++) {
                const img = document.createElement("img");
                img.setAttribute("loading", "lazy");
                img.setAttribute("style", "margin-top:20px;");
                img.setAttribute("class", "img-lazy");
                img.setAttribute("src", `https://images.unsplash.com/photo-1550971264-3f7e4a7bb349?ixlib=rb-1.2.1&auto=format&fit=crop&w=1000&q=80`);
                document.body.appendChild(img);
            }
            // observing intersection
            let paragraphs = document.querySelectorAll(".img-lazy");

            const callback = (entries, observer) => {
                entries.forEach((entry) => {
                    if (!entry.isIntersecting) {
                        return;
                    }
                    entry.target.classList.add("lazyload");
                    observer.unobserve(entry.target);
                });
            };

            const options = {
                threshold: 0.7
            };

            const observer = new IntersectionObserver(callback, options);

            paragraphs.forEach((parag) => observer.observe(parag));
        }
        lazyloading()

        const chooseFile = document.getElementById("choose-file");
        const imgPreview = document.getElementById("img-preview");
        const chooseFilePro = document.getElementById("choose-file-pro");
        const imgPreviewPro = document.getElementById("img-preview-pro");
        chooseFile.addEventListener("change", function () {
            getImgData(chooseFile,imgPreview);
        });
        chooseFilePro.addEventListener("change", function () {
            getImgData(chooseFilePro,imgPreviewPro);
        });

        function getImgData(chooseFile,imgPreview) {
            const files = chooseFile.files[0];
            const filestype = files['type'];
            const validImageTypes = ['image/gif','image/jpg','image/jpeg','image/png'];
            if (validImageTypes.includes(filestype)) {
                const fileReader = new FileReader();
                fileReader.readAsDataURL(files);
                fileReader.addEventListener("load", function () {
                    imgPreview.style.display = "block";
                    imgPreview.style.margin = "auto";
                    imgPreview.style.marginBottom = "20px";
                    imgPreview.innerHTML = '<img src="' + this.result + '" />';
                });
                fadeImage(chooseFile.id, imgPreview.id, chooseFile);
            }else{
                document.getElementById(chooseFile.id).value = null;
                toastr.options.progressBar = true,
                    toastr.options.positionClass = "toast-top-center",
                    toastr.warning("Please Choose Type gif, jpeg, png");
                    return false;    
            }
        }

        function fadeImage(idinput, idpre, data) {
            $("#" + idinput).change(function (data) {
                var imageFile = data.target.files[0];
                var reader = new FileReader();
                reader.readAsDataURL(imageFile);
                reader.onload = function (evt) {
                    $('#' + idpre).attr('src', evt.target.result);
                    $('#' + idpre).hide();
                    $('#' + idpre).fadeIn(650);
                }
            });
        }

        $('#btn-save-type-product').on('click', function (e) {
            var mode = $('#mode-type-product').attr('data-mode');
            if(mode == "New"){
                var img = $("#choose-file").prop('files')[0];
                var name = $("#name-type-product").val();
                if (img == undefined) {
                    toastr.options.progressBar = true,
                        toastr.options.positionClass = "toast-top-center",
                        toastr.warning("Please Choose Image...");
                    return false;
                }
                if (name == "") {
                    toastr.options.progressBar = true,
                        toastr.options.positionClass = "toast-top-center",
                        toastr.warning("Please Enter Name Type Product...");
                    return false;
                }
                var r = confirm("Are you sure?");
                if (r == true) {
                    var guid = genid();
                    var guid_type = genid();
                    var timestamp = gendate();
                    var update_by = $("#signined").attr('data-firstname');
                    let formData = new FormData();
                    formData.append('id_img', guid);
                    formData.append('type_name', name);
                    formData.append('update_date', timestamp);
                    formData.append('update_by', update_by);
                    formData.append('image', img);
                    formData.append('id_type', guid_type);
                    var url = urlmain + "/TypeProduct/Add";
                    ajax_upload(true, url, formData, "POST", (result) => {
                        if (result.success) {
                            toastr.options.progressBar = true,
                            toastr.options.positionClass = "toast-top-right",
                                toastr.success(result.msg);
                            setTimeout(function () {
                                $("#cls-md-new-type-product").click();
                            }, 2000);
                            data_clean_type_product();
                        } else {
                            toastr.options.progressBar = true,
                            toastr.options.positionClass = "toast-top-right",
                                toastr.error(result.msg);
                        }

                    });
                    const detail = " Type Product Name: " + name;
                    SaveReport("Add",detail,gendate(),update_by)
                }
            }else if(mode == "Edit"){

                var img;

                var id_type = $('#mode-type-product').attr('data-id-type');
                var id_image = $('#mode-type-product').attr('data-id-image');
                var name_type = $('#mode-type-product').attr('data-name-type');
                var name_image = $('#mode-type-product').attr('data-name-image');

                var valfile = $("#choose-file").val();
                var choosefile = $("#choose-file").prop('files')[0];
                var name = $("#name-type-product").val();
                var timestamp = gendate();
                var update_by = $("#signined").attr('data-firstname');

                let formDataEdit = new FormData();
                formDataEdit.append('id_type', id_type);
                formDataEdit.append('id_img', id_image);
                formDataEdit.append('type_name', name);
                formDataEdit.append('update_date', timestamp);
                formDataEdit.append('update_by', update_by);
                var old = "Old";
                var neww = "New";
                var detailtwo = '';
                if(valfile == ""){
                    formDataEdit.append('status_image', old);
                    img = name_image;
                }else {
                    formDataEdit.append('status_image', neww);
                    img = choosefile;
                    detailtwo = "Edit Image";
                }

                formDataEdit.append('image', img);

                if (img == undefined || img == "") {
                    toastr.options.progressBar = true,
                        toastr.options.positionClass = "toast-top-center",
                        toastr.warning("Please Choose Image...");
                    return false;
                }
                if (name == "") {
                    toastr.options.progressBar = true,
                        toastr.options.positionClass = "toast-top-center",
                        toastr.warning("Please Enter Name Type Product...");
                    return false;
                }
                var r = confirm("Are you sure?");
                if (r == true) {
                    var url = urlmain + "/TypeProduct/Edit";
                    ajax_upload(true, url, formDataEdit, "POST", (result) => {
                        if (result.success) {
                            toastr.options.progressBar = true,
                                toastr.success(result.msg);
                            setTimeout(function () {
                                $("#cls-md-new-type-product").click();
                                // location.reload();
                                data_clean_type_product();
                                if(detailtwo != ''){
                                    sessionStorage.setItem("reloading", "true");
                                    document.location.reload();
                                }
                            }, 2000);
                        } else {
                            toastr.options.progressBar = true,
                                toastr.error(result.msg);
                        }
                    });
                    const detail = " Type Product Name: " + name + " " + detailtwo;
                    SaveReport("Edit",detail,gendate(),update_by)
                }
            }
        });

        $('#btn-save-unit').on('click',function(e){
            var mode = $('#mode-unit').attr('data-mode');
            var name = $('#name-unit').val();
            var timestamp = gendate();
            var update_by = $("#signined").attr('data-firstname');

            if(mode == "New"){
                var r = confirm("Are you sure?");
                if (r == true) {
                    var guid = genid();
                    var obj = {};
                    obj.unit_id = guid;
                    obj.unit_name = name;
                    obj.update_date = timestamp;
                    obj.update_by = update_by;
                    var url = urlmain + "/Unit/Add";
                    ajax_internal(true, url, obj, "POST", (result) => {
                        if (result.success) {
                            toastr.options.progressBar = true,
                            toastr.options.positionClass = "toast-top-right",
                                toastr.success(result.msg);
                            setTimeout(function () {
                                $("#cls-md-new-unit").click();
                            }, 2000);
                            data_clean_unit();
                        } else {
                            toastr.options.progressBar = true,
                            toastr.options.positionClass = "toast-top-right",
                                toastr.error(result.msg);
                        }
                    });
                    const detail = ' Unit Name: ' + name;
                    SaveReport("Add",detail,gendate(),update_by);
                }
            }else if(mode == "Edit"){
                var id = $('#mode-unit').attr('data-id-unit');
                var r = confirm("Are you sure?");
                if (r == true) {
                    var obj = {};
                    obj.unit_id = id;
                    obj.unit_name = name;
                    obj.update_date = timestamp;
                    obj.update_by = update_by;
                    var url = urlmain + "/Unit/Edit";
                    ajax_internal(true, url, obj, "POST", (result) => {
                        if (result.success) {
                            toastr.options.progressBar = true,
                            toastr.options.positionClass = "toast-top-right",
                                toastr.success(result.msg);
                            setTimeout(function () {
                                $("#cls-md-new-unit").click();
                            }, 2000);
                            data_clean_unit();
                        } else {
                            toastr.options.progressBar = true,
                            toastr.options.positionClass = "toast-top-right",
                                toastr.error(result.msg);
                        }
                    });
                    const detail = ' Unit Name: ' + name;
                    SaveReport("Edit",detail,gendate(),update_by);
                }
            }
        })

        $('#nav-tabs-manage').on("scroll", function () {
            fixDiv();
        });

        function fixDiv() {
            var $cache = $('#getFixed');
            var modal_main = $(".modal-card-head");
            if ($('#nav-tabs-manage').scrollTop() > 50) {
                $cache.css({
                    'position': 'fixed',
                    'top': '0px',
                    'width': '100%'
                });
            } else{
                $cache.css({
                    'position': '',
                    'top': '',
                    'left': '',
                    'width': '100%'
                });
            }
        };
        function open_modal_image(element){
            var path = $(element).data('image');
            $("#src-md-modal").attr('src',path)
            $("#modal-image").addClass('is-active');
        }

        function delete_type_product(element){
           var cf = confirm('Are you sure?')
           if(cf){
            var id_type = $(element).data('row');
            var name_type = $(element).data('name');
            var obj = {};
            obj.id_type = id_type;
            
            ajax_internal(true, urlmain + "/TypeProduct/Delete", obj, "POST", (result) => {
                if(result.success){
                        toastr.options.progressBar = true,
                            toastr.success(result.msg);
                        data_clean_type_product();
                }else{
                        toastr.options.progressBar = true,
                            toastr.error(result.msg);
                        data_clean_type_product();
                }
            });
            const detail = ' Type Product Name: ' + name_type;
            SaveReport("Delete",detail,gendate(),$("#signined").attr('data-firstname'));
           }
        }
        function delete_unit(element){
            var cf = confirm('Are you sure?')
            if(cf){
            var id_unit = $(element).data('row');
            var name = $(element).data('name');
            var obj = {};
            obj.id_unit = id_unit;
            
            ajax_internal(true, urlmain + "/Unit/Delete", obj, "POST", (result) => {
                if(result.success){
                        toastr.options.progressBar = true,
                            toastr.success(result.msg);
                        data_clean_unit();
                }else{
                        toastr.options.progressBar = true,
                            toastr.error(result.msg);
                        data_clean_unit();
                }
            });
            const detail = ' Unit Name: ' + name;
            SaveReport("Delete",detail,gendate(),$("#signined").attr('data-firstname'));
           }
        }
        function dropdown_type(data){
            ajax_internal(true, urlmain + "/TypeProduct/TypeProductList", null, "POST", (result) => {
                var ddl_type = $("#ddl-type");
                ddl_type.empty();
                var options = '';
                var arr = result.type;
                if(arr.length > 0){
                    options += '<option value="Choose Type">Choose Type</option>';
                    $.each(arr,function(index,value){
                        options += '<option value="' + value.type_id + '">'+ value.type_name +'</option>';
                    })
                    ddl_type.append(options);
                    if(data != "" && data != null && data != undefined){
                        $("#ddl-type").val(data);
                    }
                }
            });
        }
        function dropdown_unit(data){
            ajax_internal(true, urlmain + "/Unit/UnitList", null, "POST", (result) => {
                var ddl_unit = $("#ddl-unit");
                ddl_unit.empty();
                var options = '';
                var arr = result.unit;
                if(arr.length > 0){
                    options += '<option value="Choose Unit">Choose Unit</option>';
                    $.each(arr,function(index,value){
                        options += '<option value="' + value.unit_id + '">'+ value.unit_name +'</option>';
                    })
                    ddl_unit.append(options);
                    if(data != "" && data != null && data != undefined){
                        $("#ddl-unit").val(data);
                    }
                }
            });
        }
        window.onload = function() {
            var reloading = sessionStorage.getItem("reloading");
            var set_tabs_product = sessionStorage.getItem("set_tabs_product");
            if (reloading) {
                sessionStorage.removeItem("reloading");
                document.querySelector("#btn-nav-manage-product").click();
                if(set_tabs_product){
                    sessionStorage.removeItem("set_tabs_product");
                    document.querySelector("#tabs-product").click();
                }
            }
        }
        $('#btn-save-product').on('click',function(e){
            var mode = $('#mode-product').attr('data-mode');
            if(mode == "New"){
                var img = $("#choose-file-pro").prop('files')[0];
                var name = $("#name-product").val();
                var qua = $("#quality-product").val();
                var type = $("#ddl-type option:selected").val();
                var unit = $("#ddl-unit option:selected").val();
                if (img == undefined) {
                    toastr.options.progressBar = true,
                        toastr.options.positionClass = "toast-top-center",
                        toastr.warning("Please Choose Image...");
                    return false;
                }
                if (type == "Choose Type") {
                    toastr.options.progressBar = true,
                        toastr.options.positionClass = "toast-top-center",
                        toastr.warning("Please Enter Type Product...");
                    return false;
                }
                if (qua == "") {
                    toastr.options.progressBar = true,
                        toastr.options.positionClass = "toast-top-center",
                        toastr.warning("Please Enter Quality Product...");
                    return false;
                }
                if (unit == "Choose Unit") {
                    toastr.options.progressBar = true,
                        toastr.options.positionClass = "toast-top-center",
                        toastr.warning("Please Enter Unit Product...");
                    return false;
                }
                var r = confirm("Are you sure?");
                if (r == true) {
                    var guid_img = genid();
                    var guid_type = type
                    var guid_unit = unit
                    var timestamp = gendate();
                    var update_by = $("#signined").attr('data-firstname');

                    let formData = new FormData();
                    formData.append('id_img', guid_img);
                    formData.append('id_type', guid_type);
                    formData.append('id_unit', guid_unit);
                    formData.append('update_date', timestamp);
                    formData.append('update_by', update_by);
                    formData.append('image', img);
                    formData.append('id_product', genid());
                    formData.append('name_product', name);
                    formData.append('qua_product', qua);

                    var url = urlmain + "/Product/Add";
                    ajax_upload(true, url, formData, "POST", (result) => {
                        if (result.success) {
                            toastr.options.progressBar = true,
                            toastr.options.positionClass = "toast-top-right",
                                toastr.success(result.msg);
                            setTimeout(function () {
                                $("#cls-md-new-product").click();
                            }, 2000);
                            data_clean_product();
                        } else {
                            toastr.options.progressBar = true,
                            toastr.options.positionClass = "toast-top-right",
                                toastr.error(result.msg);
                        }

                    });
                    const detail = ' Product Name: ' + name;
                    SaveReport("Add",detail,gendate(),update_by);
                }
            }else if(mode == "Edit"){
                var img;
                var id_product = $('#mode-product').attr('data-id-product');
                var id_image = $('#mode-product').attr('data-id-image');
                var name_image = $('#mode-product').attr('data-name-image');
                
                var valfile = $("#choose-file-pro").val();
                var choosefile = $("#choose-file-pro").prop('files')[0];
                var name = $("#name-product").val();
                var qua = $("#quality-product").val();
                var type = $("#ddl-type option:selected").val();
                var unit = $("#ddl-unit option:selected").val();
                var timestamp = gendate();
                var update_by = $("#signined").attr('data-firstname');

                let formDataEdit = new FormData();
                formDataEdit.append('id_type', type);
                formDataEdit.append('id_img', id_image);
                formDataEdit.append('id_unit', unit);
                formDataEdit.append('name_product', name);
                formDataEdit.append('quality_product', qua);
                formDataEdit.append('update_date', timestamp);
                formDataEdit.append('update_by', update_by);
                formDataEdit.append('id', id_product);
                var old = "Old";
                var neww = "New";
                var detailtwo = '';
                if(valfile == ""){
                    formDataEdit.append('status_image', old);
                    img = name_image;
                }else {
                    formDataEdit.append('status_image', neww);
                    img = choosefile;
                    detailtwo = 'Edit image';
                }

                formDataEdit.append('image', img);

                if (img == undefined || img == "") {
                    toastr.options.progressBar = true,
                        toastr.options.positionClass = "toast-top-center",
                        toastr.warning("Please Choose Image...");
                    return false;
                }
                if (type == "Choose Type") {
                    toastr.options.progressBar = true,
                        toastr.options.positionClass = "toast-top-center",
                        toastr.warning("Please Enter Type Product...");
                    return false;
                }
                if (name == "") {
                    toastr.options.progressBar = true,
                        toastr.options.positionClass = "toast-top-center",
                        toastr.warning("Please Enter Name Product...");
                    return false;
                }
                if (qua == "") {
                    toastr.options.progressBar = true,
                        toastr.options.positionClass = "toast-top-center",
                        toastr.warning("Please Enter Quality Product...");
                    return false;
                }
                if (unit == "Choose Unit") {
                    toastr.options.progressBar = true,
                        toastr.options.positionClass = "toast-top-center",
                        toastr.warning("Please Enter Unit Product...");
                    return false;
                }
                var r = confirm("Are you sure?");
                if (r == true) {
                    var url = urlmain + "/Product/Edit";
                    ajax_upload(true, url, formDataEdit, "POST", (result) => {
                        if (result.success) {
                            toastr.options.progressBar = true,
                                toastr.success(result.msg);
                            setTimeout(function () {
                                $("#cls-md-new-product").click();
                                // location.reload();
                                data_clean_product();
                                if(detailtwo != ''){
                                    sessionStorage.setItem("reloading", "true");
                                    sessionStorage.setItem("set_tabs_product", "true");
                                    document.location.reload();
                                    tabs_product_active();
                                }
                            }, 2000);
                        } else {
                            toastr.options.progressBar = true,
                                toastr.error(result.msg);
                        }
                    });
                    const detail = ' Product Name: ' + name + " " + detailtwo;
                    SaveReport("Edit",detail,gendate(),update_by);
                }
            }
        });
        function edit_product(element){
            var signined = $("#signined").attr('data-signined');
            var btn_add_product = document.querySelector("#btn-add-product");
            var md_add_product = new BulmaModal("#md-add-product");
            if (signined == "") {
                toastr.options.progressBar = true,
                    toastr.options.positionClass = "toast-top-center",
                    toastr.error('Please Sign in.');
                return false;
            }
            $('.DTED').removeClass('is-active');
            btn_add_product.click();
            const div_quality_product = document.getElementById("div-quality-product");
            div_quality_product.style.display = "none";
            $('#mode-product').attr('data-mode','Edit');
            $('#mode-product').attr('data-id-product',$(element).attr('data-id'));
            $('#mode-product').attr('data-name-product',$(element).attr('data-name'));
            $('#mode-product').attr('data-id-type',$(element).attr('data-id-type'));
            $('#mode-product').attr('data-id-unit',$(element).attr('data-id-unit'));
            $('#mode-product').attr('data-quality-product',$(element).attr('data-quality'));
            $('#mode-product').attr('data-name-image',$(element).attr('data-image'));
            $('#mode-product').attr('data-id-image',$(element).attr('data-image-id'));
            var img = $(element).attr('data-image');
            const imgPreview = document.getElementById("img-preview-pro");
            var path = urlmain + "/uploads"+"/"+""+ img
            imgPreview.style.display = "block";
            imgPreview.style.margin = "auto";
            imgPreview.style.marginBottom = "20px";
            imgPreview.innerHTML = '<img src="' + path + '" />';
            $("#name-product").val($(element).attr('data-name'));
            $("#quality-product").val($(element).attr('data-quality'));
            dropdown_type($(element).attr('data-id-type'));
            dropdown_unit($(element).attr('data-id-unit'));
            $("#title-product").text('Edit Product');
        }
        function delete_product(element){
            var cf = confirm('Are you sure?');
            if(cf){
                var product_id = $(element).data('row');
                var name = $(element).data('name');
                var obj = {};
                obj.product_id = product_id;
                ajax_internal(true, urlmain + "/Product/Delete", obj, "POST", (result) => {
                    if(result.success){
                            toastr.options.progressBar = true,
                                toastr.success(result.msg);
                            data_clean_product();
                    }else{
                            toastr.options.progressBar = true,
                                toastr.error(result.msg);
                            data_clean_product();
                    }
                });
                const detail = ' Product Name: ' + name;
                SaveReport("Delete",detail,gendate(),$("#signined").attr('data-firstname'));
            }
        }
        $(".navbar-burger").click(function() {

            // Toggle the "is-active" class on both the "navbar-burger" and the "navbar-menu"
            $(".navbar-burger").toggleClass("is-active");
            $(".navbar-menu").toggleClass("is-active");
      
        });
        function add_quality_product(element){
            var signined = $("#signined").attr('data-signined');
            var md_qua_product = new BulmaModal("#md-qua-product");
            if (signined == "") {
                toastr.options.progressBar = true,
                    toastr.options.positionClass = "toast-top-center",
                    toastr.error('Please Sign in.');
                return false;
            }
            md_qua_product.show();
            $('#qua-product').val("");
            $('#mode-qua-product').attr('data-mode','Add');
            $('#mode-qua-product').attr('data-name-product',$(element).attr('data-name'));
            $('#mode-qua-product').attr('data-id-product',$(element).attr('data-id'));
            $('#mode-qua-product').attr('data-qua-product',$(element).attr('data-quality'));
            $("#qua-product-txt").text($(element).attr('data-quality'));
            $("#title-qua-product").text('Add Quality Product');
            document.getElementById("qua-product").placeholder = "Enter Add Quality...";
        }
        function delete_quality_product(element){
            var signined = $("#signined").attr('data-signined');
            var md_qua_product = new BulmaModal("#md-qua-product");
            if (signined == "") {
                toastr.options.progressBar = true,
                    toastr.options.positionClass = "toast-top-center",
                    toastr.error('Please Sign in.');
                return false;
            }
            md_qua_product.show();
            $('#qua-product').val("");
            $('#mode-qua-product').attr('data-mode','Delete');
            $('#mode-qua-product').attr('data-name-product',$(element).attr('data-name'));
            $('#mode-qua-product').attr('data-id-product',$(element).attr('data-id'));
            $('#mode-qua-product').attr('data-qua-product',$(element).attr('data-quality'));
            $("#qua-product-txt").text($(element).attr('data-quality'));
            $("#title-qua-product").text('Delete Quality Product');
            document.getElementById("qua-product").placeholder = "Enter Delete Quality...";
        }
        $("#btn-save-qua-product").click(function(){
            var qua = $('#qua-product').val();
            if(qua == null || qua == ""){
                toastr.options.progressBar = true,
                    toastr.options.positionClass = "toast-top-center",
                    toastr.warning('Please Enter Quality.');
                return false; 
            }
            var obj = {};
            obj.product_id = $('#mode-qua-product').attr('data-id-product');
            obj.product_qua = $('#qua-product').val();
            obj.mode = $('#mode-qua-product').attr('data-mode');
            obj.update_by = $("#signined").attr('data-firstname');
            obj.update_date = gendate();
            var r = confirm("Are you sure?");
            if (r == true) {
                ajax_internal(true, urlmain + "/Product/Add_Qua_Product", obj, "POST", (result) => {
                    if (result.success) {
                        toastr.options.progressBar = true,
                        toastr.options.positionClass = "toast-top-right",
                            toastr.success(result.msg);
                        setTimeout(function () {
                            $("#cls-md-qua-product").click();
                        }, 2000);
                        data_clean_product();
                    } else {
                        toastr.options.progressBar = true,
                        toastr.options.positionClass = "toast-top-right",
                            toastr.error(result.msg);
                    }
                });
                var detail = $('#mode-qua-product').attr('data-name-product') + "จำนวน " + $('#qua-product').val();
                var mode = $('#mode-qua-product').attr('data-mode');
                var update_by = $("#signined").attr('data-firstname');
                if(mode == "Add"){
                    SaveReport(mode,detail,gendate(),update_by)
                }else{
                    SaveReport(mode,detail,gendate(),update_by)
                }
            }
        });
        function CheckNumber(){
            if(event.keyCode < 48 || event.keyCode > 57){
                event.returnValue = false;
            }
        }

        window.onresize = function(event) {
            $("#tbl_type_product").DataTable().responsive.recalc();
            $("#tbl_product").DataTable().responsive.recalc();
            $("#tbl_unit").DataTable().responsive.recalc();
            $("#tbl_report_product").DataTable().responsive.recalc();
            $("#tbl_report_user").DataTable().responsive.recalc();
            window.scrollTo(0,0);
        };

        function get_report(){
            ajax_internal(false, urlmain + "/Report", null, "POST", (result) => {
                data_report_product = result.report;
                table_report_product = $("#tbl_report_product").DataTable({
                    responsive: {
                        details:{
                            display: $.fn.dataTable.Responsive.display.modal({
                                header: function (row){
                                    var data = row.data();
                                    return 'Details for Action';
                                }
                            }),
                            renderer: $.fn.dataTable.Responsive.renderer.tableAll({
                                tableClass: 'table'
                            })
                        }
                    },
                    data: data_report_product,
                    columns: [
                        {
                            data: 'id',
                            type: 'num',
                        },
                        {
                            data: 'action',
                            type: 'string'
                        },
                        {
                            data: 'detail',
                            type: 'string'
                        },
                        {
                            data: 'action_date',
                            type: 'date'
                        },
                        {
                            data: 'action_by',
                            type: 'string'
                        },
                    ]
                });
            })
        }
        function get_user(){
            ajax_internal(false, urlmain + "/User", null, "POST", (result) => {
                data_report_user = result.user;
                table_report_user = $("#tbl_report_user").DataTable({
                    responsive: {
                        details:{
                            display: $.fn.dataTable.Responsive.display.modal({
                                header: function (row){
                                    var data = row.data();
                                    return 'Details for User';
                                }
                            }),
                            renderer: $.fn.dataTable.Responsive.renderer.tableAll({
                                tableClass: 'table'
                            })
                        }
                    },
                    data: data_report_user,
                    columns: [
                        {
                            data: null,
                            render: function (data, type, full, meta){
                                return meta.row + 1;
                            }
                        },
                        {
                            data: 'firstname',
                            type: 'string'
                        },
                        {
                            data: 'lastname',
                            type: 'string'
                        },
                        {
                            data: 'email',
                            type: 'string'
                        },
                        {
                            data: 'level',
                            type: 'num'
                        },
                        {
                            data: 'is_active',
                            type: 'num'
                        },
                        {
                            data: 'create_date',
                            type: 'date'
                        },
                        {
                            data: 'create_by',
                            type: 'string'
                        },
                    ]
                });
            });
        }
        function SaveReport(action,detail,date,by){
            var obj ={};
            obj.action = action;
            obj.detail = action+detail+" Date "+date+" By "+by;
            obj.action_date = date;
            obj.action_by = by;
            ajax_internal(false, urlmain + "/Report/SaveReport", obj, "POST", (result) => {
            })
        }
        $('button[aria-label="close"]').click(function(){
            window.scrollTo(0,0);
        })
        // get class ทั้งหมดที่มีคำเหมือนเท่ากับ
        $('[class*="_test"]').css('color','green');
        $('[class*="_test2"]').css('color','red');
        $('[class*="_test3"]').css('color','black');
        function Export_Excel(id,name,sheet){
            let table = document.querySelector('#'+id);
            TableToExcel.convert(table,{
                name: name +'.xlsx',
                sheet: {
                    name: sheet
                }
            });
        }
        var testcommitpush;