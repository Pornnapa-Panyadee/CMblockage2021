<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Blockage::CRflood</title>


    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Mitr|Prompt" rel="stylesheet">
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/myCss.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('fonts/fontawesome/css/fontawesome-all.css') }}">
    <!-- Styles -->
    <style>
        html,
        body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Mitr', sans-serif;

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
            font-size: 16px;
        }

        .links>a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }

        input[data-readonly] {
            pointer-events: none;
        }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

</head>

<body>
    <div class="dashboard-main-wrapper">
        @include('includes.head')
        @include('includes.header')
        <div class="dashboard-wrapper">
                
            <div class="flex-center position-ref full-height">
                   

                <div class="content">
                    <div class="title m-b-md">
                        <img src="{{ asset('images/logo/head_form.png') }}" width="100%">
                    </div>
                    <div class="row" style="padding-left:30px;">
                        <h4><a href="{{ asset('/blocker') }}">รายละเอียดแบบสำรวจ </a> &raquo; เพิ่มแบบสำรวจใหม่ </h4>
                        
                    </div>
                    {{-- <div class="row" style="padding-left:30px;">    
                            <img src="{{ asset('images/logo/s1p.png') }}" width="30%">
                            <img src="{{ asset('images/logo/s2.png') }}" width="30%">
                            <img src="{{ asset('images/logo/s3.png') }}" width="30%">
                    </div> --}}


                    <div class="title m-b-md form-group">

                        <form action="{{route('form.storeform')}}" method="get" onsubmit="return confirm('บันทึกข้อมูล เรียบร้อย !!');">
                            <table class="table table-borderless">
                                <tr>
                                    <th colspan="3">ลำน้ำที่เกิดปัญหาการกีดขวางทางน้ำ</th>
                                </tr>
                                <tr>
                                    <th>ชื่อลำน้ำ : </th>
                                    <td><input type="text" id="river_name" name="river_name" placeholder="-- กรอกชื่อ --" required onchange="validateForm(this.id)">
                                        <div class="invalid-feedback"></div>
                                    </td>

                                </tr>
                                <tr>
                                    <th align="right"> เป็นสาขาของแม่น้ำ :</th>
                                    <td><input type="text" id="river_main" name="river_main" placeholder="-- กรอกชื่อ --" required onchange="validateForm(this.id)">
                                        <div class="invalid-feedback"></div>
                                    </td>
                                </tr>
                                
                            </table>
                            <br>
                            {{-- 1 ลักษณะทั่วไป--}}
                            <h4><span class="number">1 </span>  ลักษณะทั่วไป  </h4> </td>

                            <table class="table table-borderless">

                                {{-- 1.1 --}}
                                <tr>
                                    <th colspan="2">1.1 ประเภทลำน้ำ : </th>
                                    <td>
                                        <select id="river_type" name="river_type" required onchange="validateForm(this.id)">
                                            <option value="">-- เลือกประเภท --</option>
                                            <option value="แม่น้ำสายหลัก">แม่น้ำสายหลัก</option>
                                            <option value="แม่น้ำสาขา">แม่น้ำสาขา</option>
                                            <option value="ลำห้วย">ลำห้วย</option>
                                        </select>
                                        <div class="invalid-feedback"></div>


                                    </td>
                                </tr>
                                <tr>
                                    <th colspan="2">1.2 ที่ตั้งของช่วงเวลาที่เกิดปัญหา </th>
                                </tr>

                                <tr>
                                    <td align="right">จังหวัด : </td>
                                    <td colspan="2">
                                        <select id="blk_province" name="blk_province" value=''>
                                            <option value="chiangrai">เชียงราย</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>

                                    <td align="right">อำเภอ : </td>
                                    <td colspan="2">

                                        <select id='blk_district' name='blk_district' required onchange="validateForm(this.id)">
                                            <option value=''>-- เลือกอำเภอ --</option>

                                            <!-- Read district -->

                                            @foreach($districtData['data'] as $village)
                                            <option value='{{ $village->vill_district }}'>{{ $village->vill_district  }}</option>
                                            @endforeach

                                        </select>
                                        <div class="invalid-feedback"></div>


                                    </td>
                                </tr>

                                <tr>
                                    <td align="right">ตำบล : </td>
                                    <td colspan="2">
                                        <select id="blk_tumbol" name="blk_tumbol" required onchange="validateForm(this.id)">
                                            <option value=''>-- เลือกตำบล --</option>
                                        </select>
                                        <div class="invalid-feedback"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="right">หมู่บ้าน : </td>
                                    <td colspan="2">
                                        <select id="blk_village" name="blk_village" required onchange="validateForm(this.id)">
                                            <option value=''>-- เลือกหมู่บ้าน --</option>
                                        </select>
                                        <div class="invalid-feedback"></div>
                                    </td>
                                </tr>
                            </table>
                            <table style="margin-left:10px;" class="table table-borderless">
                                <tr>
                                    <td colspan="5">พิกัดเริ่มต้นของปัญหา : </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><input type="text" id="latstart" name="latstart" placeholder="Latitude" >
                                        <div class="invalid-feedback"></div>
                                    </td>
                                    <td><input type="text" id="longstart" name="longstart" placeholder="Longitude" >
                                        <div class="invalid-feedback"></div>
                                    </td>
                                    <td align="right"> <button type="button" onclick="getStLocation()">Location</button>
                                </tr>
                                <tr>
                                    <td colspan="5">พิกัดสิ้นสุดของปัญหา : </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><input type="text" id="latend" name="latend" placeholder="Latitude" >
                                        <div class="invalid-feedback"></div>
                                    </td>
                                    <td><input type="text" id="longend" name="longend" placeholder="Longitude" >
                                        <div class="invalid-feedback"></div>
                                    </td>
                                    <td align="right"><button type="button" onclick="getFinLocation()">Location</button>
                                    <td>
                                </tr>

                            </table>
                            {{-- 1.3 --}}
                            <table class="table table-form table-borderless">
                                <tr>
                                    <th colspan="4">1.3 หน้าตัดของลำน้ำเดิมในอดีตก่อนเกิดปัญหา </th>
                                </tr>
                                <tr>
                                    <td width="9%"></td>
                                    <td><input type="number" id="cross_width_past" name="past[width]" placeholder="กว้าง (ม.)" step="any" required onchange="validateForm(this.id)">
                                        <div class="invalid-feedback"></div>
                                    </td>
                                    <td><input type="number" id="cross_depth_past" name="past[depth]" placeholder="ลึก (ม.)" step="any" required onchange="validateForm(this.id)">
                                        <div class="invalid-feedback"></div>
                                    </td>
                                    <td><input type="text" id="cross_slope_past" name="past[slop]" placeholder="ความลาดชันตลิ่ง" step="any" required onchange="validateForm(this.id)">
                                        <div class="invalid-feedback"></div>
                                    </td>
                                </tr>
                            </table>
                            {{-- 1.4 --}}
                            <table class="table table-form table-borderless">

                                <tr>
                                    <th colspan="4">1.4 หน้าตัดของช่วงลำน้ำในปัจจุบันที่เกิดปัญหา </th>
                                </tr>
                                <tr>

                                    <td style="padiing-left:20px;" colspan="3">1.4.1. หน้าตัดของลำน้ำ<b>ก่อน</b>ถึงช่วงที่เริ่มที่เกิดปัญหา </td>
                                </tr>
                                <tr>
                                    <td width="9%"></td>
                                    <td><input type="number" id="cross_width_now" name="current_start[width]" placeholder="กว้าง (ม.)" step="any" required onchange="validateForm(this.id)">
                                        <div class="invalid-feedback"></div>
                                    </td>
                                    <td><input type="number" id="cross_depth_now" name="current_start[depth]" placeholder="ลึก (ม.)" step="any" required onchange="validateForm(this.id)">
                                        <div class="invalid-feedback"></div>
                                    </td>
                                    <td><input type="text" id="cross_slope_now" name="current_start[slop]" placeholder="ความลาดชันตลิ่ง" step="any" required onchange="validateForm(this.id)">
                                        <div class="invalid-feedback"></div>
                                    </td>
                                </tr>
                                <tr>

                                    <td colspan="3" style="pading-left:20px;">1.4.2. หน้าตัดของลำน้ำที่<b>แคบที่สุด</b>ในช่วงของลำน้ำที่เกิดปัญหา </td>
                                </tr>
                                <tr>
                                    <td colspan="2" align="center"><input type="radio" id="xsection_status" name="current_narrow[type]" value="waterway" required onclick="xsectionRadioValidation()"><label for="xsection_status"> ทางน้ำเปิด </label></td>
                                    <td><input type="radio" id="xsection_status2" name="current_narrow[type]" value="culvert" required onclick="xsectionRadioValidation()" /><label for="xsection_status2">ท่อลอด</label></td>
                                    <td><input type="radio" id="xsection_status3" name="current_narrow[type]" value="other" required onclick="xsectionRadioValidation()" /><label for="xsection_status3">อื่นๆ</label></td>
                                </tr>
                                <tr>
                                    <td colspan="5">
                                        <div id="showwaterway" class="myDiv" style="background-color:#fff;">
                                            <table align="center">
                                                <tr>
                                                    <td><input type="number" id="cross_width_narrow" name="current_narrow[width]" placeholder="กว้าง (ม.)"></td>
                                                </tr>
                                                <tr>
                                                    <td><input type="number" id="cross_depth_narrow" name="current_narrow[depth]" placeholder="ลึก (ม.)"></td>
                                                </tr>
                                                <tr>
                                                    <td><input type="text" id="cross_slope_narrow" name="current_narrow[slop]" placeholder="ความลาดชันตลิ่ง"></td>
                                                </tr>

                                            </table>
                                        </div>
                                        <div id="showculvert" class="myDiv" style="background-color:#fff;">
                                            <table align="center" class="table table-form table-borderless" style="background-color:#fff;">
                                                <tr>

                                                    <td><input type="radio" id="culvert_round" value="round" name="current_narrow[culvert]" onclick="culvertValidate()"><label for="culvert_round">ท่อกลม</label></td>
                                                    <td><input type="number" id="diameter_culvert" name="current_narrow[culvert][diameter]" step="any" placeholder="เส้นผ่าศูนย์กลาง (ม.)" disabled></td>
                                                    <td><input type="number" id="num_culvert1" name="current_narrow[culvert][num]" step="any" placeholder="จำนวนท่อ (ช่อง)" disabled> </td>
                                                </tr>
                                                <tr>

                                                    <td ><input type="radio" id="culvert_square" value="square" name="current_narrow[culvert]" onclick="culvertValidate()"><label for="culvert_square">ท่อเหลี่ยม</label></td>
                                                    <td ><input type="number" id="width_culvert" name="current_narrow[culvert][width]" placeholder="กว้าง (ม.)" step="any" disabled></td>
                                                    <td ><input type="number" id="high_culvert" name="current_narrow[culvert][high]" placeholder="สูง (ม.)" step="any" disabled></td>
                                                    <td ><input type="number" id="num_culvert2" name="current_narrow[culvert][num]" placeholder="จำนวนท่อ (ช่อง)" step="any" disabled></td>
                                                </tr>
                                            </table>

                                        </div>
                                        <div id="showother" class="myDiv" style="background-color:#fff;">
                                            <table align="center" class="table table-form table-borderless" style="background-color:#fff;">
                                                <tr>
                                                    <td width="5%">
                                                    <td>
                                                    <td><textarea rows="5" cols="80" id="current_narrow" name="current_narrow[other]" placeholder="ระบุลักษณะ"></textarea></td>
                                                </tr>

                                            </table>
                                        </div>
                                    </td>
                                </tr>
                                <tr>

                                    <td colspan="3" style="padiing-left:20px;">1.4.3. หน้าตัดของลำน้ำ<b>ท้ายน้ำ</b>หลังช่วงที่เกิดปัญหา </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><input type="number" id="cross_width_end" name="current_end[width]" placeholder="กว้าง (ม.)" step="any" required onchange="validateForm(this.id)">
                                        <div class="invalid-feedback"></div>
                                    </td>
                                    <td><input type="number" id="cross_depth_end" name="current_end[depth]" placeholder="ลึก (ม.)" step="any" required onchange="validateForm(this.id)">
                                        <div class="invalid-feedback"></div>
                                    </td>
                                    <td><input type="text" id="cross_slope_end" name="current_end[slope]" placeholder="ความลาดชันตลิ่ง" step="any" required onchange="validateForm(this.id)">
                                        <div class="invalid-feedback"></div>
                                    </td>
                                </tr>
                            </table>
                            {{-- 1.4 --}}
                            <table class="table table-form table-borderless">
                                <tr>
                                    <th colspan="3">1.5 ความยาวของช่วงลำน้ำที่เกิดปัญหา </th>
                                </tr>
                            </table>
                            <table class="table table-form table-borderless">
                                <tr>
                                    <td colspan="2" align="center"><input type="radio" id="blk_length1"  name="blk_length_type" required value="น้อยกว่า 10 เมตร"><label for="blk_length1">น้อยกว่า 10 เมตร. </label></td>
                                    <td><input type="radio" id="blk_length2"  name="blk_length_type" required onclick="causeOfDamageValidate()" value="10 -1000 เมตร" ><label for="blk_length2"> 10 -1000 เมตร.</label></td>
                                    <td><input type="radio" id="blk_length3"  name="blk_length_type" reuquired onclick="causeOfDamageValidate()"value="มากกว่า 1 กิโลเมตร"><label for="blk_length3">มากกว่า 1 กิโลเมตร</label></td>
                                </tr>
                                <tr >
                                    <td colspan="2"></td>
                                    <td >
                                        <select id="blk_length" name="blk_length" class="blk_length_div">
                                            <option value="">-- ระบุระยะ --</option>
                                            <option value="10-50 เมตร">10-50 เมตร</option>
                                            <option value="50-100 เมตร">50-100 เมตร</option>
                                            <option value="100-200 เมตร">100-200 เมตร</option>
                                            <option value="200-400 เมตร">200-400 เมตร</option>
                                            <option value="400-600 เมตร">400-600 เมตร</option>
                                            <option value="600-800 เมตร">600-800 เมตร</option>
                                            <option value="800-1000 เมตร">800-1000 เมตร</option>
                                        </select>
                                    </td>
                                    <td><input type="text" id="blk_length_1k" class="blk_length_div" name="blk_length" placeholder="-- ระบุระยะมากกว่า 1 กม.--" ></td>
                                </tr>

                            </table>
                            {{-- 1.5 --}}
                            <table class="table table-form table-borderless">
                                <tr>
                                    <th>1.6 การดาดผิวของลำน้ำ </th>
                                    <td><input type="radio" id="blk_surface1" value="ไม่ดาดผิว" name="blk_surface" required onclick="blk_surfaceValidate()"><label for="blk_surface1">ไม่ดาดผิว</label></td>
                                    <td><input type="radio" id="blk_surface2" value="ดาดผิว" name="blk_surface" required onclick="blk_surfaceValidate()"><label for="blk_surface2">ดาดผิว</label></td>
                                    <td></td>
                                </tr>
                                <tr>

                                    <td align="right">วัสดุที่ดาดผิวของลำน้ำ : </td>
                                    <td colspan="2"><input type="text" id="blk_surface_detail" name="blk_surface_detail" placeholder="ระบุวัสดุ" disabled>
                                        <div class="invalid-feedback"></div>
                                    </td>

                                </tr>

                            </table>
                            {{-- 1.7 --}}
                            <table class="table table-form table-borderless">
                                    <tr>
                                        <th>1.7 ความลาดชันท้องน้ำช่วงที่เกิดปัญหา </th>
                                        <td colspan="2"><input type="text" id="blk_slope_bed" name="blk_slope_bed" placeholder="ระบุความลาดชัน">
                                        </td>
    
                                    </tr>
    
                                </table>
                            {{-- 2 ความเสียหาย --}}
                            <h4><span class="number">2</span>ความเสียหายที่เคยเกิดขึ้น</h4>
                            <table class="table table-form table-borderless" >
                                <tr>
                                    <th colspan="6">2.1 ลักษณะของความเสียหาย </th>
                                </tr>
                            </table>
                            <table align="center"  class="table-damages table-borderless" width="80%">
                                <tr>

                                    <td colspan="3"><input type="hidden" name="damage_type[flood]" value="0">
                                                    <input type="checkbox" id="damage_type1"  name="damage_type[flood]" value="1" onclick="damageLevelRadioValidation()"> 
                                                    <label for="damage_type1">น้ำท่วม</label>
                                    </td>
                                </tr>
                                <tr align="center">
                                    <td width="5%"></td>
                                    <td ><input type="hidden" name="damage_level[flood]" value="0">
                                        <input type="radio" id="damageflood1" name="damage_level[flood]" value="low" disabled/> 
                                        <label for="damageflood1">น้อย</label>
                                    </td>
                                    <td><input type="radio" id="damageflood2" name="damage_level[flood]" value="medium" disabled/><label for="damageflood2"> ปานกลาง</label></td>
                                    <td><input type="radio" id="damageflood3" name="damage_level[flood]" value="high" disabled/> <label for="damageflood3">มาก</label></td>
                                </tr>
                                <tr>

                                    <td colspan="3"><input type="hidden" name="damage_type[waste]" value="0">
                                                    <input type='checkbox' id="damage_type2"  name='damage_type[waste]' value="1" onclick="damageLevelRadioValidation()">
                                                    <label for="damage_type2">น้ำเสีย</label>
                                    </td>
                                </tr>
                                <tr align="center">
                                    <td width="5%"></td>
                                    <td><input type="hidden" name="damage_level[waste]" value="0">
                                        <input type="radio" id="damagewaste1" name="damage_level[waste]" value="low" disabled/>
                                        <label for="damagewaste1"> น้อย </label>
                                    </td>
                                    <td><input type="radio" id="damagewaste2" name="damage_level[waste]" value="medium" disabled/><label for="damagewaste2"> ปานกลาง </label></td>
                                    <td><input type="radio" id="damagewaste3" name="damage_level[waste]" value="high" disabled/><label for="damagewaste3"> มาก </label></td>
                                </tr>
                                <tr >
                                   <td width="10%"><input type="hidden" name="damage_type[other]" value="0">
                                                    <input type="checkbox" id="damage_type3"  name='damage_type[other]' value="1" onclick="damageLevelRadioValidation()">
                                                    <label for="damage_type3">อื่นๆ </label>
                                    <td colspan="2">
                                        <input type="hidden" name="damage_level[other][detail]" value="NULL">
                                                    <input type="text" name="damage_level[other][detail]" id="damageotherdetail" size="5" placeholder="ระบุ">
                                    </td>
                                </tr>
                                <tr align="center">
                                    <td width="5%"></td>
                                    <td><input type="hidden" name="damage_level[other][level]" value="0">
                                        <input type="radio" id="damageother1" name="damage_level[other][level]" value="low" disabled/>
                                        <label for="damageother1"> น้อย </label>
                                    </td>
                                    <td><input type="radio" id="damageother2" name="damage_level[other][level]" value="medium" disabled/> <label for="damageother2">ปานกลาง </label></td>
                                    <td><input type="radio" id="damageother3" name="damage_level[other][level]" value="high" disabled/> <label for="damageother3">มาก </label></td>
                                </tr>
                            </table>

                            <table class="table table-form table-borderless">

                                <tr>
                                    <th colspan="5">2.2 ความถี่ที่เกิดความเสียหาย </th>
                                </tr>
                            </table>
                            <table align="center" width="80%" class="table table-form table-borderless">
                                <tr>
                                    <td></td>
                                    <td colspan="2"><input type="radio" id="damage_frequency1" value="มากกว่า 4 ปีครั้ง" name="damage_frequency" required><label for="damage_frequency1">มากกว่า 4 ปีครั้ง </label></td>
                                    <td><input type="radio" id="damage_frequency2" value="2-4 ปีครั้ง" name="damage_frequency" required><label for="damage_frequency2">2-4 ปีครั้ง </label></td>
                                    <td><input type="radio" id="damage_frequency3" value="ทุกปี" name="damage_frequency" required> <label for="damage_frequency3">ทุกปี </label></td>

                                </tr>
                            </table>
                            <br>
                            {{-- ข้อ 3 สภาพปัญหา --}}
                            <h4><span class="number">3</span>สภาพปัญหา</h4>
                            <table class="table table-form table-borderless">
                                <tr>
                                    <th colspan="6">3.1 สาเหตุการกีดขวางลำน้ำโดย (เลือกได้หลายข้อ) </th>
                                </tr>
                            </table>
                            <table align="center" class="table table-form table-borderless">
                                {{-- ธรรมชาติ --}}
                                <tr>

                                    <td colspan="2">ธรรมชาติ</td>
                                </tr>
                                <tr>

                                    <td><input type="checkbox" id="nat_erosion" name="nat_erosion" value="1"/> <label for="nat_erosion"> ตลิ่งพัง, การกัดเซาะ </label></td>
                                    <td><input type="checkbox" id="nat_shoal" name="nat_shoal" value="1"/><label for="nat_shoal"> การทับถมของตะกอน (ลำน้ำตื้นเขิน)</label></td>


                                </tr>
                                <tr>

                                    <td><input type="checkbox" id="nat_missing" name="nat_missing" value="1"/><label for="nat_missing">ลำน้ำขาดหาย</label></td>
                                    <td><input type="checkbox" id="nat_winding" name="nat_winding" value="1"/> <label for="nat_winding">ลักษณะทางกายภาพของล้ำน้ำ </label></td>


                                </tr>   
                                <tr>

                                    <td><input type="checkbox" id="nat_weed" name="nat_weed" onclick="causeOfDamageValidate()" value="1"/> <label for="nat_weed"> วัชพืช </label></td>
                                    <td><input type="text" id="nat_cause_5_detail" name="nat_weed_detail" placeholder="ระบุวัชพืช"></td>
                                <tr>

                                    <td><input type="checkbox" id="nat_other" name="nat_other" onclick="causeOfDamageValidate()" value="1"/> <label for="nat_other"> อื่นๆ </label></td>
                                    <td><input type="text" id="nat_cause_6_detail" name="nat_other_detail" placeholder="ระบุ"></td>
                                </tr>
                                {{-- มนุษย์ --}}
                            </table>
                            <table class="table table-form table-borderless">
                                <tr>    
                                    <td colspan="2">มนุษย์</td>
                                </tr>
                                {{-- สิ่งปลูกสร้าง --}}

                                <tr>

                                    <td colspan="2"><input type="checkbox" id="hum_structure" name="hum_structure" onclick="damageLevelRadioValidation()" value="1"/><label for="hum_structure" >สิ่งปลูกสร้าง</label></td>
                                </tr>
                                <tr>
                                    <td style="padding-left:20px;" colspan="2"><input type="radio" id="hum_str_gov" name="hum_str_owner_type" value="ราชการ" onclick="causeOfDamageValidate()"/><label for="hum_str_gov">เป็นส่วนราชการ </label></td>

                                </tr>
                                <tr>
                                    <td colspan="3">
                                        <table align="center" class="table-form table-borderless">
                                            <tr>
                                                <td >ส่วนของอาคาร</td><td> <input type="text" id="hum_stc_bld_num" name="hum_stc_bld_num" placeholder="ระบุ (หลัง)"> </td>
                                                <td >รั้ว</td><td><input type="text" id="hum_stc_fence_num" name="hum_stc_fence_num" placeholder="ระบุ  (หลัง)"> </td>
                                                <td >อื่นๆ </td><td><input type="text" id="hum_str_other" name="hum_str_other" placeholder="ระบุ"></td>
                                            
                                            </tr>
                                        </table>
                                    </td>
                                </tr>

                                <tr>
                                    <td style="padding-left:20px;" colspan="2"><input type="radio" id="hum_str_bu" name="hum_str_owner_type" value="เอกชน" onclick="causeOfDamageValidate()"/><label for="hum_str_bu">เป็นสวนของเอกชนหรือส่วนบุคคล </label></td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <table align="center" class="table-form table-borderless">
                                            <tr>

                                               
                                                <td>ส่วนของอาคาร</td>
                                                <td ><input type="text" id="hum_stc_bld_num2" name="hum_stc_bld_bu_num" placeholder="ระบุ (หลัง)"></td>
                                                <td >รั้ว</td>
                                                <td ><input type="text" id="hum_stc_fence_num2" name="hum_stc_fence_bu_num" placeholder="ระบุ (หลัง)"></td>
                                                <td >อื่นๆ</td>
                                                <td ><input type="text" id="hum_str_other2" name="hum_str_other_bu" placeholder="ระบุ"></td>


                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding-bottom:20px;"></td>
                                </tr>
                                {{-- infa --}}
                                <tr>
                                    <td colspan="2"><input type="checkbox" name="hum_type" id="huminfa" value="ระบบสาธารณูปโภค" /> <label for="huminfa"> ระบบสาธารณูปโภค (ถนน ท่อลอด สะพานและอื่นๆ) </label></td>
                                </tr>
                                <tr>
                                    <td style="padding-left:40px;"><input type="checkbox" id="hum_road" name="hum_road" value="1"/><label for="hum_road">ถนนขวางทางน้ำ </label></td>
                                    <td style="padding-left:40px;"><input type="checkbox" id="hum_smallconvert" name="hum_smallconvert" value="1"/><label for="hum_smallconvert">ท่อลอดถนนที่ตัดลำน้ำมีขนาดเล็กเกินไประบายน้ำหลากไม่ทัน</label></td>
                                </tr>
                                <tr>
                                    <td style="padding-left:40px;"><input type="checkbox" id="hum_road_paralel" name="hum_road_paralel" value="1"/> <label for="hum_road_paralel">ถนนขนานลำน้ำสร้างกินพื้นที่ลำน้ำ </label></td>
                                    <td style="padding-left:40px;"><input type="checkbox" id="hum_replaced_convert" name="hum_replaced_convert" value="1"/><label for="hum_replaced_convert">วางท่อตามแนวลำน้ำทดแทนลำน้ำเดิม</label></td>
                                </tr>
                                <tr>
                                    <td style="padding-left:40px;" colspan="2"> <input type="checkbox" id="hum_bridge_pile" name="hum_bridge_pile" value="1"/><label for="hum_bridge_pile">สะพานมีหน้าตัดแคบเกินไป หรือมีต่อม่อมากเกินไปในช่วงฤดูน้ำหลากระบายไม่ทัน</label></td>
                                </tr>
                                <tr>
                                    <td style="padding-bottom:10px;"></td>
                                </tr>
                                <tr>
                                    <td ><input type="checkbox" id="hum_soil_cover" name="hum_soil_cover" value="1"/><label for="hum_soil_cover">การถมดิน </label></td>
                                </tr>
                                <tr>
                                    <td ><input type="checkbox" id="hum_trash" name="hum_trash" value="1"/><label for="hum_trash">สิ่งปฏิกูล </label></td>
                                </tr>
                                <tr>
                                    <td><input type="checkbox" id="hum_other" name="hum_other" onclick="causeOfDamageValidate()" value="1"/><label for="hum_other">อื่นๆ </label></td>
                                    <td ><input type="text" name="hum_other_detail" id="hum_other_detail" placeholder="ระบุ" /></td>
                                </tr>
                            </table>
                            {{-- 3.2 --}}
                            <table class="table table-form table-borderless">

                                <tr>
                                    <th colspan="6">3.2 ระดับกีดขวาง (เปอร์เซ็นต์คิดโดนพื้นที่ที่ถูกกีดขวางต่อพื้นที่ลำน้ำเดิม) </th>
                                </tr>
                            </table>
                            <table align="center" class="table table-form table-borderless"> 
                                <tr>
                                    <td ><input type="radio" id="problevel1" name="prob_level" value="1-30%" required /> <label for="problevel1">น้อย (1-30%) </label></td>
                                    <td ><input type="radio" id="problevel2" name="prob_level" value="30-70%" required /><label for="problevel2">กลาง (30-70%)</label></td>
                                    <td ><input type="radio" id="problevel3" name="prob_level" value="มากกว่า 70%" required /><label for="problevel3">มาก (มากกว่า 70%)</label></td>
                                </tr>
                            </table>
                            <br>
                            {{-- ข้อ 4 การแก้ไข --}}

                            <h4><span class="number">4</span> การดำเนินการแก้ไขของหน่วยงานท้องถิ่น และหน่วยงานที่รับผิดชอบ</h4>

                            <table align="center" class="table table-form table-borderless">
                                <tr>
                                    <td align="right">หน่วยงานที่รับผิดชอบ :</td>
                                    <td colspan="6"><input type="text" id="responsed_dept" name="responsed_dept" required onchange="validateForm(this.id)">
                                        <div class="invalid-feedback"></div>
                                    </td>
                                </tr>
                                <tr>

                                    <td style="padding-left:40px;"><input type="radio" id="sol_how" name="sol_how" value="ปรับปรุงแก้ไข" required onclick="solHowValidate()" ><label for="sol_how">ปรับปรุงแก้ไขโดย </label></td>
                                    <td colspan="4"><input type="text" id="responsed_dept2" name="sol_edit" placeholder="(วิธีแก้ไขหรือโครงการ)" disabled></td>
                                </tr>
                                <tr>

                                    <td style="padding-left:40px;"><input type="radio" id="sol_how2" name="sol_how" value="เจรจา" required onclick="solHowValidate()" ><label for="sol_how2">เจรจา</label></td>
                                    <td style="padding-left:40px;" colspan="2"><input type="radio" id="sol_how3" name="sol_how" value="ฟ้องร้อง" required onclick="solHowValidate()" ><label for="sol_how3">ฟ้องร้อง</label></td>
                                    <td style="padding-left:40px;" colspan="2"><input type="radio" id="sol_how4" name="sol_how" value="รื้อถอน" required onclick="solHowValidate()" ><label for="sol_how4">รื้อถอน</label></td>
                                    <td style="padding-left:40px;" colspan="2" 99><input type="radio" id="sol_how5" name="sol_how" value="ยังไม่ได้ดำเนินการ" required onclick="solHowValidate()" ><label for="sol_how5">ยังไม่ได้ดำเนินการ</label></td>
                                </tr>
                            </table>
                            {{-- 4.1 --}}
                            <table class="table table-form table-borderless">
                                <tr>
                                    <th colspan="6">4.1 ผลการดำเนินการ </th>
                                </tr>
                            </table>
                            <table class="table table-form table-borderless">
                                <tr>
                                    <td width="15%"></td>
                                    <td colspan="2"><input type="radio" id="result_selector1" name="result_selector" value="ได้ผลดีสามารถแก้ไขปัญหาได้" required><label for="result_selector1">ได้ผลดีสามารถแก้ไขปัญหาได้</label></td>
                                    <td colspan="2"><input type="radio" id="result_selector2" name="result_selector" value="ได้ผลดีพอสมควรแก้ไขปัญหาได้บางส่วน" required><label for="result_selector2">ได้ผลดีพอสมควรแก้ไขปัญหาได้บางส่วน</label></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td colspan="2"><input type="radio" id="result_selector3" name="result_selector" value="ได้ผลไม่ดีเท่าที่ควรแก้ไขปัญหาได้น้อย" required><label for="result_selector3"> ได้ผลไม่ดีเท่าที่ควรแก้ไขปัญหาได้น้อย</label></td>
                                    <td colspan="2"><input type="radio" id="result_selector4" name="result_selector" value="ไม่ได้ผล" required><label for="result_selector4"> ไม่ได้ผล </label></td>
                                </tr>
                            </table>
                            {{-- 4.2 --}}
                            <table class="table table-form table-borderless">
                                <tr>
                                    <th colspan="6">4.2 สถานภาพปัจจุบันของโครงการที่แก้ไขปัญหาได้ </th>
                                </tr>

                            </table>
                            <table align="center" width="90%" class="table table-form table-borderless">
                                <tr>
                                    <td><input type="radio" id="proj_status1" name="proj_status" value="plan" required onclick="projStatusValidate()"/><label for="proj_status1"> อยู่ในแผน </label></td>
                                    <td><input type="radio" id="proj_status2" name="proj_status" value="received" required onclick="projStatusValidate()"/><label for="proj_status2">ได้รับงบประมาณแล้ว</label></td>
                                    <td><input type="radio" id="proj_status3" name="proj_status" value="making" required /><label for="proj_status3">กำลังปรับปรุงก่อสร้าง</label> </td>
                                    <td><input type="radio" id="proj_status4" name="proj_status" value="noplan" required /><label for="proj_status4">ยังไม่มีในแผน </label></td>
                                </tr>
                                <tr>
                                    <td colspan="5">
                                        <div id="showplan" class="myDiv" style="background-color:#fff;padding-top:30px;padding-bottom:30px;">
                                            <table align="center" >
                                                <tr></tr>
                                                <tr>
                                                    <td>ลักษณะโครงการ: </td>
                                                    <td><input type="number" id="proj_year" name="proj_year" step="any" placeholder="ระบุปี พ.ศ"></td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td><input type="text" id="proj_name" name="proj_name" step="any" placeholder="ระบุชื่อโครงการ"></td>
                                                </tr>
                                                <tr>
                                                    <td>งบประมาณ: </td>
                                                    <td><input type="number" id="proj_budget" name="proj_budget" step="any" placeholder="ระบุงบประมาณ"></td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div id="showreceived" class="myDiv" style="background-color:#fff;padding-top:10px;padding-bottom:30px;">
                                            <table align="center">
                                                <tr></tr>
                                                <tr>
                                                    <td>ลักษณะโครงการ: </td>
                                                    <td><input type="text" id="proj_name2" name="proj_name2" step="any" placeholder="ระบุชื่อโครงการ"></td>
                                                </tr>

                                                <tr>
                                                    <td>งบประมาณ: </td>
                                                    <td><input type="number" id="proj_budget2" name="proj_budget2" step="any" placeholder="ระบุงบประมาณ"></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </td>
                                </tr>
                            </table>

                            <br><br>
                            <button type="submit" class="butsummit" onclick="validateCheckbox(); hum_stcValidate();hum_stcValidate2();">บันทึกข้อมูล</button>






                        </form>
                    </div>
                </div>

            </div> {{--flex-center --}}
        </div>
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/main-js.js') }}"></script>
    <script src="{{ asset('js/shortable-nestable/Sortable.min.js') }}"></script>
    <script src="{{ asset('js/shortable-nestable/sort-nest.js') }}"></script>
    <script src="{{ asset('js/shortable-nestable/jquery.nestable.js') }}"></script>
    <script src="{{ asset('js/location.js') }}"></script>
    <script src="{{ asset('js/showhide.js') }}"></script>
    <script src="{{ asset('js/chooseLocation.js') }}"></script>
    <script src="{{ asset('js/validateNewForm.js') }}"></script>
    <!-- {{-- <script>
                $(document).ready(function(){
                    $('input:checkbox').click(function() {
                        $('input:checkbox').not(this).prop('checked', false);
                    });
                });
        </script> --}} -->
</body>

</html>