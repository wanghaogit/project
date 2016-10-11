@extends("admin.base.base")

@section("content")
	    <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            商品信息
            <small>表格管理</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Tables</a></li>
            <li class="active">Simple</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-md-12">
              <div class="box">
                <div class="box-header with-border">
                  <span class="glyphicon glyphicon-th"></span><h3 class="box-title">商品信息管理</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table class="table table-bordered">
                    <tr>
                      <th style="width: 80px">序号</th>
                      <th style="width: 80px">商品名称</th>
                      <th style="width: 80px">价格</th>
                      <th style="width: 80px">图片</th>
                      <th style="width: 80px">库存</th>
                      <th style="width: 80px">是否上架</th>
                      <th style="width: 80px">删除</th>
                      <th style="width: 80px">描述</th>
                      <th style="width: 100px">操作</th>
                    </tr>
                    @foreach($list as $goods)
                    <tr>
                      <td>{{ $goods->id }}</td>
                      <td>{{ $goods->goodsName }}</td>
                      <td>{{ $goods->shopPrice }}</td>
                      <td class="dropdown user user-menu" >
                        <img  style="height:100px;"src="{{ asset('phoneImg') }}/{{ $goods->Img }} " class="user-image" alt="User Image" >
                      </td>
                      <td>{{ $goods->goodsStock }}</td>
                      <td>{{ $goods->isOnsale }}</td>
                      <td>{{ $goods->isBin }}</td>
                      <td>{{ $goods->desCription }}</td>
                      <td>
                        <a href="javascript:doDel({{ $goods->id }});">删除</a>
                        <a href="/admin/goods/{{ $goods->id }}/edit">修改</a>
                      </td>
                    </tr>
                    @endforeach
                  </table>
                </div><!-- /.box-body -->
                <div class="box-footer clearfix">
                  <ul class="pagination pagination-sm no-margin pull-right">
                    <li><a href="#">&laquo;</a></li>
                    <li><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">&raquo;</a></li>
                  </ul>
                </div>
              </div><!-- /.box -->

             
            </div><!-- /.col -->
    
          </div><!-- /.row -->
        
        </section><!-- /.content -->
        <!-- 执行删除的js特效开始 -->
        <script type="text/javascript">
          function doDel(id){
            if(confirm('确定删除吗?')){
              // alert(id);
              //1 获得form表单节点对象
              var myform = document.myform;
              //2 设置提交方式 
              myform.action = "{{ URL('admin/goods') }}"+"/"+id;//提交地址 
              myform.submit();//执行表单提交
            }
          }

        </script>
        <!-- 执行删除的js特效结束 -->
        <!-- 执行删除开始 -->
        <form action="" method="post" name="myform">
          <input type="hidden" name="_token" value="{{ csrf_token()}}">
          <input type="hidden" name="_method" value="delete">
        </form>
        <!-- 执行删除结束 -->

     
@endsection