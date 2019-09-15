<!-- <img src="assets/img/!buang/dashboard.png" width="100%"> -->
<link rel="stylesheet" type="text/css" href="<?=base_url()?>plugins/datatables/datatables.min.css"/>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>plugins/datatables/scroller.dataTables.min.css"/>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/jquery.dop.BookingCalendar.min.css" />
<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/style_calendar.css" />
<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/dopInfoStyle.css" />
<div class="panel panel-orange">
  	<div class="panel-heading">
		<h5 id="judul"><i class="fa fa-table"></i> Double Klik pada Kotak Tanggal</h5>
		<div class="pull-right" id="btn-panel">
			<a href="<?= base_url('holiday/'); ?>" class="btn btn-md btn-success">Tabel Data</a>
			<a href="<?= base_url('holiday_pns/'); ?>" class="btn btn-md btn-danger">Tambah Data</a>
		</div>
  	</div>
  	<div class="panel-body">
		<div id="backend-container" style="text-align: -webkit-center; padding: 30px 10px;">
		    <div id="backend2">
		        <div class="DOP_BackendBookingCalendar_Container" style="width: 1024px; height: 410px;">
		           <div class="DOP_BackendBookingCalendar_PopUp" style="display: none; width: 850px; height: 400px;">
		               <div class="bg" style="width: 1024px; height: 410px;"></div>
		               <div class="window" style="margin-left: 275px; margin-top: 113.5px;">
		                   <span class="start-date"></span>
		                   <span class="end-date"></span>
		                   <br style="clear:both;" />
		                   <label class="label" for="cims-availability">Golongan Hari</label>
		                   <br/>
		                   <select name="cims-status" id="cims-status" class="select-style">
		                       	<option value="0" id="cims-no-status"></option>
		                       	<option value="1">Hari Kerja</option>
		                       	<option value="2">Hari Libur</option>                     
		                   </select>                 
		                   <span class="buttons_container">
		                       	<input type="button" name="cims-submit" id="cims-submit" class="button-style" value="Kirim" />
		                       	<input type="button" name="cims-exit" id="cims-exit" class="button-style" value="Keluar" />
		                       	<span class="loader"></span>
		                   </span>
		               </div>
		           </div>
		           <div class="DOP_BackendBookingCalendar_Navigation">
		               	<div class="previous_btn" data-info="<?= $params['prev_ym']; ?>"><div class="icon"></div></div>
		               	<div class="next_btn" data-info="<?= $params['next_ym']; ?>"><div class="icon"></div></div>
		               	<div class="month_year"><?= $params['bulanini']; ?></div>
		               	<div class="week">
		                 	<div class="day" style="width: 135px;"><?= $params['dayName'][1]; ?></div>
		                 	<div class="day" style="width: 135px;"><?= $params['dayName'][2]; ?></div>
		                 	<div class="day" style="width: 135px;"><?= $params['dayName'][3]; ?></div>
		                 	<div class="day" style="width: 135px;"><?= $params['dayName'][4]; ?></div>
		                 	<div class="day" style="width: 135px;"><?= $params['dayName'][5]; ?></div>
		                 	<div class="day" style="width: 135px;"><?= $params['dayName'][6]; ?></div>
		                 	<div class="day" style="width: 135px;"><?= $params['dayName'][0]; ?></div><br style="clear:both;" />
		               </div>
		           </div>
		           
		           <div class="DOP_BackendBookingCalendar_Calendar">
		               <div class="DOP_BackendBookingCalendar_Month" style="padding-left: 2px; width: 1024px; height: 400px;">
		                   	<?php foreach($params['calendar'] as $k => $params){ ?>
		                    <div class="DOP_BackendBookingCalendar_Day <?= $params['type'].' '.$params['group']; ?>" id="cims_<?= $params['y'].'-'.$params['m'].'-'.$params['d']; ?>" style="width: 135px; height: 46px;">                            
		                         <span class="header">
		                             <span class="day"><?= $params['d']; ?></span>
		                             <br style="clear:both;"/>
		                         </span>
		                         <span class="content" style="line-height: 27px; height: 27px;"><?= $params['content']; ?></span>
		                    </div>
		                    <?php } ?>
		               </div>
		           </div> 
		      	</div>
			</div>
		</div>
	</div>
</div>

<!-- <script type="text/JavaScript" src="<?=base_url()?>assets/js/jquery.dop.BookingCalendar.min.js"></script>
<script type="text/JavaScript" src="<?=base_url()?>assets/js/jquery.min.js"></script> -->
<script src="<?=base_url()?>plugins/datatables/datatables.min.js"></script>
<script src="<?=base_url()?>plugins/datatables/dataTables.scroller.min.js"></script>
<script type="text/javascript">
    $("#datatable").DataTable();
</script>
<script type="text/JavaScript">
    $(document).ready(function(){
        var year = 2013;
        
        $('#backend2 .previous_btn, #backend2 .next_btn').click(function(){
            ym = $(this).attr('data-info');
            //console.log(ym);
            $('#backend2 .DOP_BackendBookingCalendar_Month').html('');
            $.ajax({
                type: "GET",
                url : 'holiday_pns/libur/'+ym,
                dataType: 'json',
                beforeSend: function ( xhr ) {
                },
                success: function ( data ) {
                    $("#backend2 .DOP_BackendBookingCalendar_Month").html(data.detail);
                    $("#backend2 .next_btn").attr('data-info', data.next);
                    $("#backend2 .previous_btn").attr('data-info', data.prev);
                    $("#backend2 .month_year").html(data.current);
                    setClickableCalendar();
                },
                error : function ( err ) {
                }
            });
        });
        
        $('#btn_holiday').click(function(){
            $("#backend").html('hari libur');
        });
        
        //
        var on_select = false, 
            g = false, 
            i, u, v, A, 
            y = false;
        v = 'Hari Kerja';
        A = 'Hari Libur';
        u = 'Hari Khusus';
        i = '%';
        var start_select_id= false;
        var p = new Array();
            p = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        var l = new Array();
        var DefaultPrice = [23,56,78];
        var B = new Date(),
            n = B.getFullYear(),
            j = B.getMonth() + 1,
            t = B.getDate();
        var SaveURL = 'holiday_pns/save';
        var setClickableCalendar = function() {
            $("#backend2 .DOP_BackendBookingCalendar_Day").click(function () {
                //console.log($(this).attr('id'));
                var cur = $(this);
                if (!cur.hasClass("past_day")) {
                    if (!on_select) {
                        on_select = true;
                        start_select_id = cur.attr("id")
                    } else {
                        on_select = false;
                        s = cur.attr("id");
                        showBackendPopUp()
                    }
                    initBackendSelection(cur.attr("id"))
                }
            });
        }
        setClickableCalendar();
        
        $("#backend2 .DOP_BackendBookingCalendar_Day").hover(function () {
            var F = $(this);
            if (on_select) {
                initBackendSelection(F.attr("id"))
            }
        });
        
        var validateCharacters = function (I, H) {
            var F = I.split("");
            for (var G = 0; G < F.length; G++) {
                if (H.indexOf(F[G]) == -1) {
                    return false
                }
            }
            return true
        };
        
        var initBackendSelection = function (select_id) {
            $(".DOP_BackendBookingCalendar_Day").removeClass("selected");
            if (select_id < start_select_id) {
                $(".DOP_BackendBookingCalendar_Day").each(function () {
                    var G = $(this);
                    if (G.attr("id") >= select_id && G.attr("id") <= start_select_id && !G.hasClass("past_day")) {
                        G.addClass("selected")
                    }
                })
            } else {
                $(".DOP_BackendBookingCalendar_Day").each(function () {
                    var G = $(this);
                    if (G.attr("id") >= start_select_id && G.attr("id") <= select_id && !G.hasClass("past_day")) {
                        G.addClass("selected")
                    }
                })
            }
        };
        
        var initBackendPopUp = function () {
            $("#backend2 .DOP_BackendBookingCalendar_PopUp").css("display", "block");
            //$("#backend2 .DOP_BackendBookingCalendar_PopUp").width(width());
            //$("#backend2 .DOP_BackendBookingCalendar_PopUp").height(height());
            $("#backend2 .DOP_BackendBookingCalendar_PopUp .bg").width($("#backend2 .DOP_BackendBookingCalendar_PopUp").width());
            $("#backend2 .DOP_BackendBookingCalendar_PopUp .bg").height($("#backend2 .DOP_BackendBookingCalendar_PopUp").height());
            $("#backend2 .DOP_BackendBookingCalendar_PopUp .window").css("margin-left", ($("#backend2 .DOP_BackendBookingCalendar_PopUp").width() - $("#backend2 .DOP_BackendBookingCalendar_PopUp .window").width()) / 2);
            $("#backend2 .DOP_BackendBookingCalendar_PopUp .window").css("margin-top", ($("#backend2 .DOP_BackendBookingCalendar_PopUp").height() - $("#backend2 .DOP_BackendBookingCalendar_PopUp .window").height()) / 2);
            $("#backend2 .DOP_BackendBookingCalendar_PopUp").css("display", "none");
            $("#backend2 #cims-submit").click(function () {
                if ($("#backend2 #cims-status").val() != 0){                    
                     setBackendData()
                }else{
                     alert('Pilih Golongan Hari !');
                }
                /* // arief
                if (validateCharacters($("#backend2 #cims-price").val(), "0123456789")) {
                    setBackendData()
                } else {
                    alert(o)
                }
                */
                
                
            });
            $("#backend2 #cims-reset").click(function () {
                resetBackendPopUp()
            });
            $("#backend2 #cims-exit").click(function () {
                hideBackendPopUp()
            });
           /* // arief
            $("#backend2 #cims-status").change(function (id) {
                console.log(DefaultPrice[$(this).val()-1]);
                $("#cims-price").val(DefaultPrice[$(this).val()-1]);
            })
            */
        };
        initBackendPopUp();
        
        var resetBackendPopUp = function () {
            $("#cims-no-status").attr("selected", "selected");
            //$("#cims-price").val(""); //arif
            //setBackendData()
        };
        
        var hideBackendPopUp = function () {
            //console.log('hide popup');
            $(".DOP_BackendBookingCalendar_PopUp .window .loader").css("display", "none");
            $(".DOP_BackendBookingCalendar_Day").removeClass("selected");
            $(".DOP_BackendBookingCalendar_PopUp").stop(true, true).fadeOut(y, function () {})
        };
        
        var setBackendData = function () {
            $("#backend2 .DOP_BackendBookingCalendar_PopUp .window .loader").css("display", "block");
            var Y = new Array(),
                ab = new Array,
                O = new Array(),
                S = l,
                W, N, T, aa, R, P = n + "-" + (j < 10 ? "0"+j:j) + "-" + (t < 10 ? "0" + t : t),
                H, U, M, J, X, F, Q, G, Z, L, K, I, V;
            /*   
            if ($("#cims-price").val() == "") {
                V = 0
            } else {
                V = parseInt($("#cims-price").val(), 10)
            }
            */
            
            if (start_select_id > s) {
                X = start_select_id.split("_")[1];
                H = s.split("_")[1]
            } else {
                H = start_select_id.split("_")[1];
                X = s.split("_")[1]
            }
            U = parseInt(H.split("-")[0], 10);
            M = parseInt(H.split("-")[1], 10);
            J = parseInt(H.split("-")[2], 10);
            F = parseInt(X.split("-")[0], 10);
            Q = parseInt(X.split("-")[1], 10);
            G = parseInt(X.split("-")[2], 10);
            for (W = 0; W < S.length; W++) {
                if (S[W].split(";;")[0] >= P) {
                    if (S[W].split(";;")[0] < H) {
                        ab.push(S[W])
                    } else {
                        if (S[W].split(";;")[0] > X) {
                            O.push(S[W])
                        }
                    }
                }
            }
            for (N = U; N <= F; N++) {
                Z = 1;
                if (N == U) {
                    Z = M
                }
                L = 12;
                if (N == F) {
                    L = Q
                }
                for (T = Z; T <= L; T++) {
                    R = new Date(N, T, 0).getDate();
                    K = 1;
                    if (N == U && T == M) {
                        K = J
                    }
                    I = R;
                    if (N == F && T == Q) {
                        I = G
                    }
                    for (aa = K; aa <= I; aa++) {
                        if ($("#cims-status").val() != 0) {
                            Y.push(N + "-" + (T < 10 ? "0"+T:T) + "-" + (aa < 10 ? "0"+aa:aa) + ";;" + $("#cims-status").val())
                        }
                    }
                }
            }
            l = [];
            if (ab.length > 0) {
                l = ab.concat(Y, O)
            } else {
                l = Y.concat(O)
            }
            
            $("#backend2 .DOP_BackendBookingCalendar_Day").each(function () {
                var ac = $(this);
                if (ac.hasClass("selected")) {
                    ac.removeClass("hari_kerja").removeClass("hari_libur").removeClass("hari_khusus");
                    if ($("#cims-status").val() == 1) {
                        ac.addClass("hari_kerja");
                        //$(".price", this).html(i + " " + V);
                        $(".content", this).html(v)
                    } else {
                        if ($("#cims-status").val() == 2) {
                            ac.addClass("hari_libur");
                            //$(".price", this).html(i + " " + V);
                            $(".content", this).html(A)
                        } else {
                            if ($("#cims-status").val() == 3) {
                                ac.addClass("hari_khusus");
                                //$(".price", this).html(i + " " + V);
                                $(".content", this).html(u)
                            } else {
                                //$(".price", this).html("");
                                $(".content", this).html("&nbsp;")
                            }
                        }
                    }
                }
            });
            //console.log("l"+l);
            saveBackendData()
        };
        
        var saveBackendData = function () {
            $.post(SaveURL, {
                data_lbr: l.join(",")
            }, function (F) {
                hideBackendPopUp()
            })
            l="";
        };
        
        var showBackendPopUp = function () {
            var H, F, N, G, O, M, I, J, L, K;
            if (start_select_id > s) {
                M = start_select_id.split("_")[1];
                H = s.split("_")[1]
            } else {
                H = start_select_id.split("_")[1];
                M = s.split("_")[1]
            }
            F = H.split("-")[0], N = H.split("-")[1], G = p[parseInt(N, 10) - 1], O = H.split("-")[2];
            I = M.split("-")[0], J = M.split("-")[1], L = p[parseInt(J, 10) - 1], K = M.split("-")[2];
            if (g == 1) {
                $("#backend2 .DOP_BackendBookingCalendar_PopUp .window .start-date").html(G + " " + O + ", " + F)
            } else {
                $("#backend2 .DOP_BackendBookingCalendar_PopUp .window .start-date").html(O + " " + G + " " + F)
            }
            if (start_select_id != s) {
                if (g == 1) {
                    $("#backend2 .DOP_BackendBookingCalendar_PopUp .window .end-date").html(L + " " + K + ", " + I)
                } else {
                    $("#backend2 .DOP_BackendBookingCalendar_PopUp .window .end-date").html(K + " " + L + " " + I)
                }
            } else {
                $("#backend2 .DOP_BackendBookingCalendar_PopUp .window .end-date").html("")
            }
            $("#backend2 .DOP_BackendBookingCalendar_PopUp").stop(true, true).fadeIn(y, function () {})
        };
        
       
        
        //setTimeout(function(){ console.log($(".previous_btn").hasClass("disabled")); $(".previous_btn").removeClass("disabled")}, 100);
        
        $('#refresh1').click(function(){
            $('#backend').html('');
            $('#backend').DOPBookingCalendar({
                'Type':'BackEnd', 
                'DataURL': 'holiday_pns/load',
                'SaveURL': 'holiday_pns/save',
                PriceLabel: "Persentase",
                Currency: "%",
                AvailableText: "Hari Kerja",
                BookedText: "Hari Libur",
                UnavailableText: "Hari Khusus",
                DayNames: ["Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu"],
                MonthNames: ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"],
                SubmitBtnText: "Kirim",
                ResetBtnText: "Ulangi",
                ExitBtnText: "Keluar",
                InvalidPriceText: "Error! Masukkan angka untuk Persentase."
            });
        });
        
    });
</script>