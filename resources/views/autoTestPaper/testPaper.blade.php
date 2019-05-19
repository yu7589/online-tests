@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="card" style="width:650px; hight:978px;">
            <div class="card-body">
                <div style="border: 1px dashed black;font-size:12pt;">
                    <div style="text-align:center;">诚信保证</div>
                    <div style="margin-bottom:3px; ">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;本人知晓我校考场规则和违纪处分条例的有关规定，保证遵守考场规则，诚实做人。                                     
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    本人签字：<input type='text' style='border:none; border-bottom:black solid 1px; width:80px;'>
                    </div>
                </div>
                <div style="font-size:12pt;">
                    编号：<input type='text' style='border:none; border-bottom:black solid 1px; width:80px;'>
                </div>
                <div>
                    <div style="text-align:center; font-size:18pt;">西北工业大学考试试题（卷）</div>
                    <div style="text-align:center; font-size:14pt; width:586px;">20  &nbsp;&nbsp;&nbsp;—20   &nbsp;&nbsp;&nbsp;&nbsp;学年第   &nbsp;&nbsp;&nbsp;&nbsp;学期</div>
                </div>
                <div>
                    <div style="font-size:12pt;">开课学院<input type='text' style='border:none; border-bottom:black solid 1px; width:190px;'>
                    课程<input type='text' style='border:none; border-bottom:black solid 1px; width:190px;'>
                    学时<input type='text' style='border:none; border-bottom:black solid 1px; width:80px;'>
                    </div>
                </div>
                <div>
                    <div style="font-size:12pt;">考试日期<input type='text' style='border:none; border-bottom:black solid 1px; width:130px;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    考试时间<input type='text' style='border:none; border-bottom:black solid 1px; width:60px;'>小时
                    &nbsp;&nbsp;&nbsp;
                    考试形式（$\begin{matrix} 开 \\ 闭 \end{matrix}$）（$\begin{matrix} A \\ B \end{matrix}$）卷
                    </div>
                </div>
                <div style="margin-left:10px; font-size:12pt;">
                    <table style="text-align:center;width:580px;" border=1;>
                        <tbody>
                            <tr>
                                <td style="text-align:center;">题号</td>
                                <td>一</td>
                                <td>二</td>
                                <td>三</td>
                                <td>四</td>
                                <td>五</td>
                                <td>六</td>
                                <td>七</td>
                                <td>总分</td>
                            </tr>
                            <tr>
                                <td>得分</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <br>
                
                <div style="border: 1px solid black;font-size:12pt;">
                    <div>
                    <table style="text-align:center;width:606px;" border=1;>
                        <tbody>
                            <tr>
                                <td style="padding:4px; text-align:center;width:101px;">考生班级</td>
                                <td style="text-align:center;width:101px;"></td>
                                <td style="text-align:center;width:101px;">学 号</td>
                                <td style="text-align:center;width:101px;"></td>
                                <td style="text-align:center;width:101px;">姓 名</td>
                                <td style="text-align:center;width:101px;"></td>
                            </tr>
                        </tbody>
                    </table>
                    </div>
                    <div style="margin:8px;font-size:12pt;">
                        <div>
                        一、判断题<br>
                            @foreach ($problems as $problem)
                                @if($problem->type == 1)
                                <script>
                                    document.write($judgcount);
                                    $judgcount = $judgcount + 1;
                                </script>. {{ $problem->stem }} <br>
                                @endif
                            @endforeach
                        </div>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <div>
                        二、选择题<br>
                            @foreach ($problems as $problem)
                                @if($problem->type == 2)
                                <script>
                                    document.write($selectcount);
                                    $selectcount = $selectcount + 1;
                                </script>. {{ $problem->stem }} <br>
                                    &nbsp;A.{{ explode(";", str_replace('*', '', $problem->answer), 4)[0] }}
                                    &nbsp;B.{{ explode(";", str_replace('*', '', $problem->answer), 4)[1] }}
                                    &nbsp;C.{{ explode(";", str_replace('*', '', $problem->answer), 4)[2] }}
                                    &nbsp;D.{{ explode(";", str_replace('*', '', $problem->answer), 4)[3] }}<br>
                                @endif
                            @endforeach
                        </div>
                        <div>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        三、填空题<br>
                            @foreach ($problems as $problem)
                                @if($problem->type == 3)
                                <script>
                                    document.write($fillcount);
                                    $fillcount = $fillcount + 1;
                                </script>. {{ $problem->stem }} <br>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

<script>
var $judgcount=1;
var $selectcount=1;
var $fillcount=1;
var $shortanswercount=1;
</script>