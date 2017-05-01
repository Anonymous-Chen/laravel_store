@extends('layouts.master')

@section('title', '购物车')

@section('js')
    <script type="text/javascript">
//        $(function() {
//            $("#checkAll").click(function() {
//                $('input[name="subBox[]"]').attr("checked",this.checked);
//            });
//            var $subBox = $("input[name='subBox[]']");
//            $subBox.click(function(){
//                $("#checkAll").attr("checked",$subBox.length == $("input[name='subBox[]']:checked").length ? true : false);
//            });
//        });

        function fun(){
            var val = document.getElementById("val").value.split(",");
            var boxes = document.getElementsByName("subBox[]");
            for(i=0;i<boxes.length;i++){
                for(j=0;j<val.length;j++){
                    if(boxes[i].value == val[j]){
                        boxes[i].checked = true;
                        break
                    }
                }
            }
        }
        function checkAl(){

            var val = document.getElementById("checkAll");
            var boxes = document.getElementsByName("subBox[]");
            var num = 0;

            if(val.checked == true){
                for(i=0;i<boxes.length;i++){
                    if ( boxes[i].checked == false ){
                        boxes[i].checked = true;
                        $id = boxes[i].value;
                        $price = document.getElementById("price"+$id).innerHTML.substring(1) ;
                        getMessage($id,$price);
                    }
                }
            }else{
                for(i=0;i<boxes.length;i++){
                    if ( boxes[i].checked == true  ){
                        boxes[i].checked = false;
                        $id = boxes[i].value;
                        $price = document.getElementById("price"+$id).innerHTML.substring(1) ;
                        getMessage($id,$price);
                    }
                }

            }

        }

        function getMessage($id,$price) {
            var mychar=   document.getElementById("msg");
            var val = document.getElementById("check"+$id);


            if(val.checked == true){
                mychar.innerHTML = parseFloat(mychar.innerHTML) + parseFloat($price) ;

                var valcheckAll = document.getElementById("checkAll");
                var boxes1 = document.getElementsByName("subBox[]");
                var num1 = 0;
                for(j=0;j<boxes1.length;j++){
                    if ( boxes1[j].checked == true ){
                        num1 ++;
                    }
                }
                if ( boxes1.length == num1 ){
                    valcheckAll.checked = true;
                }
            }else{
                document.getElementById("checkAll").checked = false;
                mychar.innerHTML = parseFloat(mychar.innerHTML) - parseFloat($price) ;

            }

        }
//      aJAX  用例，已弃用
        function getMessage1($x1,$x2){
            $.ajax({
                type:'get',
                url:'{{url('order/te')}}/'+$x1+'/'+$x2,
                data:'_token = <?php echo csrf_token() ?>',
                success:function(data){
                    $("#msg").html(data.msg);
                }
            });
        }



    </script>
@endsection

@section('sidebar')
    @parent
@endsection

@section('content')
    <br><br><br>


    @include('layouts.message')
    <form action="{{url('/order/result2')}}" method="post">
        {{ csrf_field() }}

    <div class="row">
        <div class="col-sm-12 col-md-10 col-md-offset-1">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th class=" text-center" ><input id="checkAll" type="checkbox"  onclick="checkAl()"/></th>
                    <th>商品</th>
                    <th class="text-center"></th>
                    <th class="text-center">小计</th>
                    <th> </th>
                </tr>
                </thead>
                <tbody>
                @foreach($items as $item)
                    <tr>
                        <td class="col-sm-1 col-md-1 text-center">
                            <input name="subBox[]" type="checkbox" value="{{$item->id}}" id="check{{$item->id}}" onclick="getMessage( {{$item->id}},{{$item->product->price}} )" />
                        </td>
                        <td class="col-sm-8 col-md-6">
                            <div class="media">
                                <a class="thumbnail pull-left" href="#"> <img class="media-object" src="{{$item->product->imageurl}}" style="width: 100px; height: 72px;"> </a>
                                <div class="media-body" style=" text-align:center;">
                                    <h4 class="media-heading"><a href="#">{{$item->product->name}}</a></h4>
                                </div>
                            </div></td>
                        <td class="col-sm-1 col-md-1" style="text-align: center">
                        </td>

                        <td class="col-sm-1 col-md-1 text-center" ><strong><div id="price{{$item->id}}">${{$item->product->price}}</div></strong></td>
                        <td class="col-sm-1 col-md-1">
                            <a href="{{url("/order/result")}}/{{$item->id}}"
                               onclick="if(confirm('确认立即购买？') == false) return false"
                            > <button type="button" class="btn btn-success">
                                    <span class="fa fa-play"></span> 立即购买
                                </button>
                            </a>
                        </td>
                        <td class="col-sm-1 col-md-1">
                            <a href="{{url("/removeItem")}}/{{$item->id}}"
                               onclick="if(confirm('小主真的不要我了啊，，。') == false) return false"
                            > <button type="button" class="btn btn-danger">
                                    <span class="fa fa-remove"></span> 移除
                                </button>
                            </a>
                        </td>
                    </tr>
                @endforeach

                <tr>
                    <td>   </td>
                    <td>   </td>
                    <td>   </td>
                    <td><h3>总价</h3></td>
                    <td class="text-right"><h3><strong><div id="msg"> 0 </div></strong></h3></td>
                </tr>
                <tr>
                    <td>   </td>
                    <td>   </td>
                    <td>   </td>
                    <td>
                        <a href="{{url("/")}}"> <button type="button" class="btn btn-default">
                                <span class="fa fa-shopping-cart"></span> 继续购物
                            </button>
                        </a></td>
                    <td>
                        <button type="submit" class="btn btn-success"
                                onclick="if(confirm('确认购买这些？') == false) return false"
                        >
                            结算 <span class="fa fa-play"></span>
                        </button>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    </form>




@endsection