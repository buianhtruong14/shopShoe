@extends('admin_layout')

@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm sản phẩm
            </header>
            <?php
                $message = Session::get('message');
                if ( $message){
                    echo '<span class="text-alert">'.$message.'</span>';
                    Session::put('message',null);
                }
            ?>
            <div class="panel-body">
                <div class="position-center">
                    <form role="form" action="{{URL::to('/save-product')}}" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên Sản Phẩm</label>
                            <input type="text" name="product_name" class="form-control" id="exampleInputEmail1" placeholder="Tên Sản Phẩm">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Giá Sản Phẩm</label>
                            <input type="text" name="product_price" class="form-control" id="exampleInputEmail1" placeholder="Giá Sản Phẩm">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Hình Ảnh Sản Phẩm</label>
                            <input type="file" name="product_image" class="form-control" id="exampleInputEmail1" placeholder="Hình Ảnh Sản Phẩm">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Cỡ Sản Phẩm</label>
                            <input type="text" name="product_size" class="form-control" id="exampleInputEmail1" placeholder="Cỡ Sản Phẩm">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả Sản Phẩm</label>
                            <textarea style="resize: none" rows="5" class="form-control" name="product_desc" id="exampleInputPassword1" placeholder="Mô tả sản phẩm"></textarea>

                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">Thương Hiệu</label>
                            <select name="brand_id" class="form-control input-sm m-bot15">
                                @foreach($brand_product as $key => $brand_pro)
                                <option value = "{{ $brand_pro->brand_id }}">{{ $brand_pro->brand_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">Danh Mục</label>
                            <select name="category_id" class="form-control input-sm m-bot15">
                                @foreach($category_product as $key => $cate_pro)
                                <option value = "{{ $cate_pro->category_id }}">{{ $cate_pro->category_name }}</option>
                                @endforeach
                                
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">Hiển Thị</label>
                            <select name="product_status" class="form-control input-sm m-bot15">
                                <option value = "0">Ẩn</option>
                                <option value = "1">Hiển Thị</option>
                            </select>
                        </div>
                        <button type="submit" name="add_product" class="btn btn-info">Thêm Sản Phẩm</button>
                    </form>
                </div>

            </div>
        </section>

    </div>

</div>

@endsection