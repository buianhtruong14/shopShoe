@extends('admin_layout')

@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm danh mục sản phẩm
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
                    <form role="form" action="{{URL::to('/save-category-product')}}" method="post">
                    {{csrf_field()}}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên danh mục</label>
                            <input type="text" name="category_product_name" class="form-control" id="exampleInputEmail1" placeholder="Tên danh mục">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả Danh Mục</label>
                            <textarea style="resize: none" rows="5" class="form-control" name="category_product_desc" id="exampleInputPassword1" placeholder="Mô tả sản phẩm"></textarea>

                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Từ khóa Danh Mục</label>
                            <textarea style="resize: none" rows="5" class="form-control" name="meta_keywords" id="exampleInputPassword1" placeholder="Mô tả sản phẩm"></textarea>

                        </div>
                        <!-- <div class="form-group">
                                    <label for="exampleInputFile">File input</label>
                                    <input type="file" id="exampleInputFile">
                                    <p class="help-block">Example block-level help text here.</p>
                                </div> -->
                        <div class="form-group">
                            <label for="exampleInputFile">Hiển Thị</label>
                            <select name="category_product_status" class="form-control input-sm m-bot15">
                                <option value = "0">Ẩn</option>
                                <option value = "1">Hiển Thị</option>
                            </select>
                        </div>
                        <button type="submit" name="add_category_product" class="btn btn-info">Thêm Danh Mục</button>
                    </form>
                </div>

            </div>
        </section>

    </div>

</div>

@endsection