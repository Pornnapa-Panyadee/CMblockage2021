
<?php ini_set("memory_limit","521M"); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Blockage PDF</title>
    <style>
		@font-face{
		font-family:  'THSarabunNew';
		font-style: normal;
		font-weight: normal;
		src: url("{{ asset('fonts/THSarabunNew.ttf') }}") format('truetype');
		}
	    @font-face{
		font-family:  'THSarabunNew';
		font-style: normal;
		font-weight: normal;
		src: url("{{ asset('fonts/THSarabunNew Bold.ttf') }}") format('truetype');
		}
		html, body {
			background-color: #fff;
			color: #000000;
			font-family: "THSarabunNew";
		}
		.position-ref {
		position: relative;
		}
		.flex-center {
			align-items: center;
			display: flex;
			justify-content: center;
		}
		.content {
			text-align: left;
			
		}
		.title {
			font-size:15px;
		}
		.m-b-md {
			/* margin-bottom: 2px; */
        }  
        .table{
            width:100%;
            /* margin-bottom:1rem; */
            background-color:transparent;
            border-collapse: collapse;
        }
        
        td {
            
            border: 1px black solid;
        }
        .rotate {
        text-align: center;
        white-space: normal;
        vertical-align: middle;
        width: 1.5em;
        }
        .rotate div {
            -moz-transform: rotate(-90.0deg);  /* FF3.5+ */
            -o-transform: rotate(-90.0deg);  /* Opera 10.5 */
        -webkit-transform: rotate(-90.0deg);  /* Saf3.1+, Chrome */
                margin-left:-10px;
                margin-right: -10px;
                margin-top: -10px;
                text-align: left;
        }

        .checkmark{
            display:inline-block;
            content: '';
            width: 3px;
            height: 10px;
            border: solid #000;
            border-width: 0 1px 1px 0;
            transform: rotate(40deg);
            margin-left: 10px;
        }
        footer {
            position: fixed; 
            bottom: 0cm; 
            left: 0cm; 
            right: 0cm;
            height: 1cm;
            color:#000;
            text-align: right;
            line-height: 1.5cm;
            content: counter(page);
        }
        .text_report{
            font-size: 70px;
        }
        .text_report1{
            font-size: 42px;
            margin-bottom: -20px;
        }
        .text_report2{
            font-size: 60px;
            margin: 60px 0 -20px 0;
        }
        .text_report3{
            font-size: 30px;
            margin: 100px 0 -110px 0;
        }
        .text_report4{
            font-size: 24px;
            margin: 110px 0 -110px 0;
        }
        .text_report5{
            font-size: 56px;
            margin: 100px 0 0 0;
        }
        .text_report6{
            font-size: 18px;
            font-weight: bold;
        }
        .page-break {
            page-break-after: always;
        }
   
	</style>
</head>
<body>
    <div class="row" align="center" > 
    <!-- รายงานสรุป -->
        <div class="text_report">รายงานสรุป</div>
        <div class="text_report1">ข้อมูลสภาพปัญหาและแนวทางการแก้ไขปัญหาเบื้องต้น</div>
        <div class="text_report1">ของตำแหน่งการกีดขวางทางน้ำ</div>
        <?php if ($tumbol!="sum"){?>
            <div class="text_report2">ตำบล{{$tumbol}}</div>
            <div class="text_report1">อำเภอ{{$amp}} จังหวัดเชียงใหม่</div>
        <?php }else{ ?> 
            <div class="text_report5">อำเภอ{{$amp}} จังหวัดเชียงใหม่</div>
        <?php }?>
        <div class="text_report3"> โครงการพัฒนาระบบการสํารวจและบริหารจัดการพื้นที่เสี่ยงภัยน้ําท่วมและดินถล่ม </div>
        <div class="text_report3">บนพื้นฐานของเทคโนโลยีสารสนเทศและการจัดการขั้นสูง</div>
        <div class="text_report4">กิจกรรมการพัฒนาระบบข้อมูลของสิ่งกีดขวางทางน้ำในลำน้ำคูคลองและถนนในจังหวัดเชียงใหม่</div>
    </div>
    <footer>
        หมายเหตุ ข้อมูลใช้เพื่อการศึกษาวางแผน ไม่สามารถใช้อ้างอิงทางกฎหมายและคดีความ
    </footer>

    <div class="flex-center position-ref full-height">
            <div class="content">
                <div class="page-break"></div>
                <div class="title m-b-md">
                    <?php 
                            function DateTimeThai($strDate)
                                {
                                    $strYear = (date("Y",strtotime($strDate))+543)-2500;
                                    $strMonth= date("n",strtotime($strDate));
                                    $strDay= date("j",strtotime($strDate));
                                    // $strHour= date("H",strtotime($strDate));
                                    // $strMinute= date("i",strtotime($strDate));
                                    // $strSeconds= date("s",strtotime($strDate));
                                    $strMonthCut =  Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
                                    $strMonthThai=$strMonthCut[$strMonth];
                                    return "$strDay/$strMonth/$strYear ";
                                }
                            function checkCuase($text) {
                                if($text!=NULL ||$text!=0 ){
                                    $img='https://cmblockage.cmfightflood.com/images/logo/checkOnly.png';
                                    echo "<div class=\"checkmark\"></div>";
                                }else{
                                    return '';
                                }
                            }
                            function checkRisk($level,$fq){
                                if($level=="มาก"){
                                    $l=3;
                                }else if($level=="ปานกลาง"){
                                    $l=2;
                                }else{
                                    $l=1;
                                }

                                if($fq=="ทุกปี"){
                                    $f=3;
                                }else if($fq=="2-4 ปีครั้ง"){
                                    $f=2;
                                }else{
                                    $f=1;
                                }
                                
                                $cal=$l*$f;

                                if($cal<3){
                                    return "น้อย";
                                }
                                else if($cal<6){
                                    return "ปานกลาง";
                                }else{
                                    return "มาก";
                                }
                            }
                            function checklevel($flood,$waste,$other) {
                                if($flood!=NULL||$flood!=0){
                                    if($flood=="low"){
                                        $level="น้อย";
                                    }else if( $flood=="medium"){
                                        $level="ปานกลาง";
                                    }else if( $flood=="high") {
                                        $level="มาก";
                                    }else{
                                        $level=NULL;
                                    }
                                }else if($waste!=NULL||$waste!=0){
                                    if($waste=="low"){
                                        $level="น้อย";
                                    }else if( $waste=="medium"){
                                        $level="ปานกลาง";
                                    }else if( $waste=="high") {
                                        $level="มาก";
                                    }else{
                                        $level=NULL;
                                    }

                                }else if($other!=NULL||$other!=0){
                                    if($other=="low"){
                                        $level="น้อย";
                                    }else if( $other=="medium"){
                                        $level="ปานกลาง";
                                    }else if( $other=="high") {
                                        $level="มาก";
                                    }else{
                                        $level=NULL;
                                    }
                                }
                                    return $level;
                            }
                        ?>
                    
                    <table class="table table-bordered">
                    <thead align="center" >
                        <tr style="background-color:#C0C0C0">
                            <td rowspan="4" class="text-center">#</td>
                            <td rowspan="4" class="text-center">รหัส</td>
                            <td rowspan="4" >หมู่บ้าน</td>
                            <td rowspan="4" >ตำบล</td>
                            <td rowspan="4" >ชื่อลำน้ำ</td>
                            
                            <td rowspan="2" colspan="2" >พิกัดเริ่มต้น</td>
                            <td rowspan="2" colspan="2" >พิกัดสิ้นสุด</td>
                            <td width="10%" rowspan="4" >วันที่สำรวจ</td>

                            <td colspan="16">สาเหตุและสภาพปัญหา</td>
                            <td rowspan="4" >ระดับความเสี่ยง<br>จากการกีดขวาง<br>ทางน้ำ</td>
                        </tr>
                        <tr style="background-color:#C0C0C0">
                            <td colspan="6" > ธรรมชาติ</td>
                            <td colspan="10"> มนุษย์</td>
                           
                        </tr>
                        <tr>
                            <td rowspan="2">X</td>
                            <td rowspan="2">Y</td>
                            <td rowspan="2">X</td>
                            <td rowspan="2">Y</td>
                            <td rowspan="2" class='rotate' > <div>ตลิ่งพัง</div></td>
                            <td rowspan="2" class='rotate' > <div>ลำน้ำตื้นเขิน</div></td>
                            <td rowspan="2" class='rotate'> <div>ลำน้ำขาดหาย</div> </td>
                            <td rowspan="2" class='rotate'> <div>ลำน้ำคดเคี้ยว</div> </td>
                            <td rowspan="2" class='rotate' > <div>วัชพืช </div></td>
                            <td rowspan="2" class='rotate'> <div>อื่นๆ</div> </td>
                            <td colspan="2" > สิ่งปลูกสร้าง</td>
                            <td colspan="5" > ระบบสาธารณูปโภค</td>
                            <td rowspan="2" class='rotate' > <div>การถมดิน</div></td>
                            <td rowspan="2" class='rotate' > <div>สิ่งปฏิกูล</div></td>
                            <td rowspan="2" class='rotate'> <div>อื่นๆ</div></td>
                            
                        </tr>
                        <tr >
                            <td class="rotate" style="padding-top:20;padding-bottom:20px;" > <div>ส่วนราชการ</div></td>
                            <td class="rotate" > <div>ส่วนเอกชน</div></td>
                            <td class="rotate" > <div>ถนนขวาง</div></td>
                            <td class="rotate" > <div>ท่อลอดเล็ก</div></td>
                            <td class="rotate" > <div>ถนนขนาน</div></td>
                            <td class="rotate" ><div> วางท่อแทน</div></td>
                            <td class="rotate" ><div> สะพาน</div></td>
                        </tr>
                    </thead>
                   
                    <?php $num =count($problem);
                        for($i = 0;$i < $num;$i++){?>
                        <tr align="center" >
                            <?php
                              $string=$problem[$i]->blk_village;
                              $vill=explode(' ', $string);
                              $vill=$vill[2];
                              if($problem[$i]->prob_level=="1-30%"){
                                $lev="น้อย";
                                $problem[$i]->prob_level="1-30";
                              }else if($problem[$i]->prob_level=="30-70%"){
                                $lev="ปานกลาง";
                                $problem[$i]->prob_level="30-70";
                              }else{
                                $lev="มาก";
                                $problem[$i]->prob_level=">70";
                              }
                              $damage=json_decode($problem[$i]->damage_level);
                            //   echo $damage->flood;
                                $level=checklevel($damage->flood,$damage->waste,$damage->other->level);
                            ?>
                             
                            <td scope="row">{{$i+1}}</td>
                            <td>{{$problem[$i]->blk_id}}</td>
                            <td>{{$vill}} </td>
                            <td>{{$problem[$i]->blk_tumbol}} </td>
                            <td>{{$problem[$i]->river_name}}</td>
                            {{-- <td> - - </td>
                            <td> - - </td>
                            <td> - - </td>
                            <td> - - </td> --}}

                            <td>{{ $problem[$i]->lat_utm_start}} </td>
                            <td>{{ $problem[$i]->lng_utm_start}} </td>
                            <td>{{$problem[$i]->lat_utm_stop}} </td>
                            <td>{{$problem[$i]->lng_utm_stop}} </td>
                            <td>{{DateTimeThai($problem[$i]->created_at)}} </td>
                            <td>{{checkCuase($problem[$i]->nat_erosion)}}</td> 
                            <td>{{checkCuase($problem[$i]->nat_shoal)}}</td>
                            <td>{{checkCuase($problem[$i]->nat_missing)}}</td>
                            <td>{{checkCuase($problem[$i]->nat_winding)}}</td>
                            <td>{{checkCuase($problem[$i]->nat_weed_detail)}}</td>
                            <td>{{checkCuase($problem[$i]->nat_other)}}</td>
                            <td>{{checkCuase($problem[$i]->gov)}}</td>
                            <td>{{checkCuase($problem[$i]->bu)}}</td>
                            <td>{{checkCuase($problem[$i]->hum_road)}}</td>
                            <td>{{checkCuase($problem[$i]->hum_smallconvert)}}</td>
                            <td>{{checkCuase($problem[$i]->hum_road_paralel)}}</td>
                            <td>{{checkCuase($problem[$i]->hum_replaced_convert)}}</td>
                            <td>{{checkCuase($problem[$i]->hum_bridge_pile)}}</td>
                            <td>{{checkCuase($problem[$i]->hum_soil_cover)}}</td>
                            <td>{{checkCuase($problem[$i]->hum_trash)}}</td>
                            <td>{{checkCuase($problem[$i]->hum_other_detail)}}</td>
                            <td>{{checkRisk($level,$problem[$i]->damage_frequency)}}</td>               
                        </tr>
                    <?php }?>
                    <tbody>
                        
                    </tbody>
                    </table>
                    
                </div>
            </div>
    </div>
   
        
</body>
</html>