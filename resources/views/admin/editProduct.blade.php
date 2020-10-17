@extends('admin_layout')

@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Cập nhật Sản Phẩm
            </header>
            <?php
                $message = Session::get('message');
                if ( $message){
                    echo '<span class="text-alert">'.$message.'</span>';
                    Session::put('message',null);
                }
            ?>
            <div class="panel-body">
                @foreach($edit_product as $key => $edit_value)
                <div class="position-center">
                    <form role="form" action="{{URL::to('/update-product/'.$edit_value->product_id)}}" method="post">
                    {{csrf_field()}}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên Thương Hiệu</label>
                            <input type="text" name="product_name" class="form-control" id="exampleInputEmail1" value="{{ $edit_value->product_name }}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả Thương Hiệu</label>
                            <textarea style="resize: none" rows="5" class="form-control" name="product_desc" id="exampleInputPassword1" placeholder="Mô tả sản phẩm">{{ $edit_value->product_desc }}</textarea>

                        </div>
                        <button type="submit" name="update_product" class="btn btn-info">Cập Nhật Thương Hiệu</button>
                    </form>
                </div>
                @endforeach
            </div>
        </section>

    </div>

</div>

@endsection