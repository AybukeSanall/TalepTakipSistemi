<body class="mod-bg-1 ">
        <script>
         
            'use strict';

            var classHolder = document.getElementsByTagName("BODY")[0],
           
                themeSettings = (localStorage.getItem('themeSettings')) ? JSON.parse(localStorage.getItem('themeSettings')) :
                {},
                themeURL = themeSettings.themeURL || '',
                themeOptions = themeSettings.themeOptions || '';
            /** 
             * Load theme options
             **/
            if (themeSettings.themeOptions)
            {
                classHolder.className = themeSettings.themeOptions;
                console.log("%c✔ Theme settings loaded", "color: #148f32");
            }
            else
            {
                console.log("Heads up! Theme settings is empty or does not exist, loading default settings...");
            }
            if (themeSettings.themeURL && !document.getElementById('mytheme'))
            {
                var cssfile = document.createElement('link');
                cssfile.id = 'mytheme';
                cssfile.rel = 'stylesheet';
                cssfile.href = themeURL;
                document.getElementsByTagName('head')[0].appendChild(cssfile);
            }
           
            var saveSettings = function()
            {
                themeSettings.themeOptions = String(classHolder.className).split(/[^\w-]+/).filter(function(item)
                {
                    return /^(nav|header|mod|display)-/i.test(item);
                }).join(' ');
                if (document.getElementById('mytheme'))
                {
                    themeSettings.themeURL = document.getElementById('mytheme').getAttribute("href");
                };
                localStorage.setItem('themeSettings', JSON.stringify(themeSettings));
            }
         
            var resetSettings = function()
            {
                localStorage.setItem("themeSettings", "");
            }

        </script>
       
             

        <script src="js/vendors.bundle.js"></script>
        <script src="js/app.bundle.js"></script>
      
        <script src="js/datagrid/datatables/datatables.bundle.js"></script>
        <script>
            $(document).ready(function()
            {



                // Event Lot
                var events = $("#app-eventlog");

                // Column Definitions
                var columnSet = [
                {
                    title: "RowId",
                    id: "DT_RowId",
                    data: "DT_RowId",
                    placeholderMsg: "Server Generated ID",
                    "visible": false,
                    "searchable": false,
                    type: "readonly"
                },
                {
                    title: "Kategori",
                    id: "status",
                    data: "status",
                    type: "select",
                    "options": [
                        "Bilgisayar",
                        "Mouse",
                        "Klavye",
                        "Mobilya"
                    ]
                },
              
                {
                    title: "Ürün Adedi ",
                    id: "balance",
                    data: "balance",
                    type: "number",
                    placeholderMsg: "Ürün Adedi",
                    defaultValue: "1"
                },
               /* {
                    title: "Activation Date",
                    id: "adate",
                    data: "adate",
                    type: "date",
                    pattern: "((?:19|20)\d\d)-(0?[1-9]|1[012])-([12][0-9]|3[01]|0?[1-9])",
                    placeholderMsg: "yyyy-mm-dd",
                    errorMsg: "*Invalid date format. Format must be yyyy-mm-dd"
                },*/
                {
                    title: "Birim",
                    id: "status",
                    data: "status",
                    type: "select",
                    "options": [
                        "Din Hizmetleri Genel Müdürlüğü",
                        "Eğitim Hizmetleri Genel Müdürlüğü ",
                        "Hac ve Umre Hizmetleri Genel Müdürlüğü ",
                        "Dini Yayınlar Genel Müdürlüğü",
                        "Dış İlişkiler Genel Müdürlüğü",
                        "İnsan Kaynakları Genel Müdürlüğü",
                        "Yönetim Hizmetleri Genel Müdürlüğü",
                        "Rehberlik ve Teftiş Başkanlığı",
                        "Strateji Geliştirme Başkanlığı",
                        "İç Denetim Birimi Başkanlığı",
                        "Hukuk Müşavirliği"
                    ]
                },
                {
                    title: "Ad-Soyad",
                    id: "user",
                    data: "user",
                    type: "text",
                    //pattern: "^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$",
                    placeholderMsg: "Ad Soyad",
                    //errorMsg: "*Invalid email - Enter valid email.",
                    //unique: true,
                    //uniqueMsg: "Email already in use"
                },
                {
                    title: "Ürün Açıklama/Gerekçesi",
                    id: "user",
                    data: "user",
                    type: "text",
                    placeholderMsg: "Ürünü İsteme Gerekçesi",
                    
                },
                {
                    title: "Acc. Balance",
                    id: "balance",
                    data: "balance",
                    type: "number",
                    placeholderMsg: "Amount due",
                    defaultValue: "1"
                }]

                /* start data table */
                var myTable = $('#dt-basic-example').dataTable(
                {
                    
                    dom: "<'row mb-3'<'col-sm-12 col-md-6 d-flex align-items-center justify-content-start'f><'col-sm-12 col-md-6 d-flex align-items-center justify-content-end'B>>" +
                        "<'row'<'col-sm-12'tr>>" +
                        "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                    ajax: "media/data/server-demo.json", //ajax:register.php?mode=get
                    columns: columnSet,
                  //birden fazla satır seçilmemesi için
                    select: 'single',
                    /* altEditor at work */
                    altEditor: true,
                    responsive: true,
                    /* buttons uses classes from bootstrap, see buttons page for more details */
                    buttons: [
                    {
                        extend: 'selected',
                        text: '<i class="fal fa-times mr-1"></i> Sil',
                        name: 'delete',
                        className: 'btn-primary btn-sm mr-1'
                    },
                    {
                        extend: 'selected',
                        text: '<i class="fal fa-edit mr-1"></i> Düzenle',
                        name: 'edit',
                        className: 'btn-primary btn-sm mr-1'
                    },
                    {
                        text: '<i class="fal fa-plus mr-1"></i> Ekle',
                        name: 'add',
                        className: 'btn-success btn-sm mr-1'
                    },
                    {
                        text: '<i class="fal fa-sync mr-1"></i> Yenile',
                        name: 'refresh',
                        className: 'btn-primary btn-sm'
                    }],
                    columnDefs: [
                    {
                        targets: 1,
                        render: function(data, type, full, meta)
                        {
                            var badge = {
                                "active":
                                {
                                    'title': 'Aktif',
                                    'class': 'badge-success'
                                },
                                "inactive":
                                {
                                    'title': 'Aktif Değil',
                                    'class': 'badge-warning'
                                },
                                "disabled":
                                {
                                    'title': 'Devre Dışı',
                                    'class': 'badge-danger'
                                }
                            };
                            if (typeof badge[data] === 'undefined')
                            {
                                return data;
                            }
                            return '<span class="badge ' + badge[data].class + ' badge-pill">' + badge[data].title + '</span>';
                        },
                    },
                    {
                        targets: 7,
                        type: 'currency',
                        render: function(data, type, full, meta)
                        {
                            //var number = Number(data.replace(/[^0-9.-]+/g,""));
                            if (data >= 0)
                            {
                                return '<span class="text-success fw-500">$' + data + '</span>';
                            }
                            else
                            {
                                return '<span class="text-danger fw-500">$' + data + '</span>';
                            }
                        },
                    },
                    {
                        targets: 6,
                        render: function(data, type, full, meta)
                        {
                            var package = {
                                "free":
                                {
                                    'title': 'Free',
                                    'class': 'bg-fusion-50',
                                    'info': 'Free users are restricted to 30 days of use'
                                },
                                "silver":
                                {
                                    'title': 'Silver',
                                    'class': 'bg-fusion-50 bg-fusion-gradient'
                                },
                                "gold":
                                {
                                    'title': 'Gold',
                                    'class': 'bg-warning-500 bg-warning-gradient'
                                },
                                "platinum":
                                {
                                    'title': 'Platinum',
                                    'class': 'bg-trans-gradient'
                                },
                                "payg":
                                {
                                    'title': 'PAYG',
                                    'class': 'bg-success-500 bg-success-gradient'
                                }
                            };
                            if (typeof package[data] === 'undefined')
                            {
                                return data;
                            }
                            return '<div class="has-popover d-flex align-items-center"><span class="d-inline-block rounded-circle mr-2 ' + package[data].class + '" style="width:15px; height:15px;"></span><span>' + package[data].title + '</span></div>';
                        },
                    }, ],

                    /* default callback for insertion: mock webservice, always success */
                    onAddRow: function(dt, rowdata, success, error)
                    {
                        console.log("Missing AJAX configuration for INSERT");
                        console.log(dt,ro)
                        success(rowdata);

                        // demo only below:
                        events.prepend('<p class="text-success fw-500">' + JSON.stringify(rowdata, null, 4) + '</p>');
                    },
                    onEditRow: function(dt, rowdata, success, error)
                    {
                        console.log("Missing AJAX configuration for UPDATE");
                        success(rowdata);

                        // demo only below:
                        events.prepend('<p class="text-info fw-500">' + JSON.stringify(rowdata, null, 4) + '</p>');
                    },
                    onDeleteRow: function(dt, rowdata, success, error)
                    {
                        console.log("Missing AJAX configuration for DELETE");
                        success(rowdata);

                        // demo only below:
                        events.prepend('<p class="text-danger fw-500">' + JSON.stringify(rowdata, null, 4) + '</p>');
                    },
                });

            });

        </script>
        <script></script>
    </body>