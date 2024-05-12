@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h2>Product Add</h2>
                <a href="{{ route('product.list') }}" class="btn btn-primary"><i data-feather="list"></i>Product List</a>
            </div>
            <div class="card-body">
                <form action="{{ route('product.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-5">
                            <div class="mb-3">
                                <label for="" class="form-label">Select Category</label>
                                <select name="category_id" class="form-select category">
                                    <option value="">category select</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="mb-3">
                                <label for="" class="form-label">Select subcategory</label>
                                <select name="subcategory_id" class="form-select subcategory">
                                    <option value="">subcategory select</option>
                                    @foreach($subcategories as $subcategory)
                                        <option value="{{ $subcategory->id }}">{{ $subcategory->subcategory_name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('subcategory_id')
                                    <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="mb-3">
                                <label for="" class="form-label">Select Brand</label>
                                <select name="brand_id" class="form-select">`
                                    <option value="">Brand select</option>
                                    @foreach($brands as $brand)
                                        <option value="{{ $brand->id }}">{{ $brand->brand_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-5">
                            <div class="mb-3">
                                <label for="" class="form-label">Product Name</label>
                                <input type="text" class="form-control" name="product_name"
                                    placeholder="enter product name">
                                @error('product_name')
                                    <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="mb-3">
                                <label for="" class="form-label">Product Price</label>
                                <input type="number" class="form-control" name="price"
                                    placeholder="enter product price">
                                @error('price')
                                    <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="mb-3">
                                <label for="" class="form-label">Discount</label>
                                <input type="number" class="form-control" name="discount"
                                    placeholder="enter product discount">
                            </div>
                        </div>
                        <div class="col-lg-10">
                            <div class="mb-3">
                                <label for="" class="form-label">Tag</label>
                                <input type="text" class="form-control border-0 px-0" name="tag" id="input-tags"
                                    placeholder="enter product tag">
                            </div>
                        </div>
                        <div class="col-lg-10">
                            <div class="mb-3">
                                <label for="" class="form-label">Short Description</label>
                                <textarea class="form-control" id="summernote3" name="short_desp" cols="80" rows="10"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-10">
                            <div class="mb-3">
                                <label for="" class="form-label">Long Description</label>
                                <textarea name="long_desp" id="summernote" cols="50" rows="10"
                                     class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-10">
                            <div class="mb-3">
                                <label for="" class="form-label">Additional Information</label>
                                <textarea name="add_info" id="summernote2" cols="800" rows="10"
                                    placeholder="enter additional information" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="mb-3">
                                <label for="" class="form-label">Preview Image</label>
                                <input type="file" class="form-control" name="preview"
                                    onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                                @error('preview')
                                    <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                                <img src="" id="blah" alt="" width="150">
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <label for="" class="form-label">Thumbnail Image</label>
                            <div class="mb-3">
                                <div class="upload__box">
                                    <div class="upload__btn-box">
                                        <label class="upload__btn">
                                            <p>Upload images</p>
                                            <input type="file" multiple="" name="thumbnail[]" data-max_length="20"
                                                class="upload__inputfile">
                                        </label>
                                    </div>
                                    <div class="upload__img-wrap"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-10">
                            <div class="mb-3 d-flex justify-content-end">
                                <button class="btn btn-success" type="submit">Add Product</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer_content')
<script>
    $("#input-tags").selectize({
        delimiter: ",",
        persist: false,
        create: function (input) {
            return {
                value: input,
                text: input,
            };
        },
    });

</script>

<script>
    $('.category').change(function () {
        var category_id = $(this).val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: '/getSubcategory',
            type: 'post',
            data: {
                category_id: category_id
            },
            success: function (data) {
                $('.subcategory').html(data);
            }
        })
    })

</script>
<script>
    $(document).ready(function () {
        $('#summernote').summernote();
        $('#summernote2').summernote();
        $('#summernote3').summernote();
    });

</script>
<script>
    jQuery(document).ready(function () {
        ImgUpload();
    });

    function ImgUpload() {
        var imgWrap = "";
        var imgArray = [];

        $('.upload__inputfile').each(function () {
            $(this).on('change', function (e) {
                imgWrap = $(this).closest('.upload__box').find('.upload__img-wrap');
                var maxLength = $(this).attr('data-max_length');

                var files = e.target.files;
                var filesArr = Array.prototype.slice.call(files);
                var iterator = 0;
                filesArr.forEach(function (f, index) {

                    if (!f.type.match('image.*')) {
                        return;
                    }

                    if (imgArray.length > maxLength) {
                        return false
                    } else {
                        var len = 0;
                        for (var i = 0; i < imgArray.length; i++) {
                            if (imgArray[i] !== undefined) {
                                len++;
                            }
                        }
                        if (len > maxLength) {
                            return false;
                        } else {
                            imgArray.push(f);

                            var reader = new FileReader();
                            reader.onload = function (e) {
                                var html =
                                    "<div class='upload__img-box'><div style='background-image: url(" +
                                    e.target.result + ")' data-number='" + $(
                                        ".upload__img-close").length + "' data-file='" + f
                                    .name +
                                    "' class='img-bg'><div class='upload__img-close'></div></div></div>";
                                imgWrap.append(html);
                                iterator++;
                            }
                            reader.readAsDataURL(f);
                        }
                    }
                });
            });
        });

        $('body').on('click', ".upload__img-close", function (e) {
            var file = $(this).parent().data("file");
            for (var i = 0; i < imgArray.length; i++) {
                if (imgArray[i].name === file) {
                    imgArray.splice(i, 1);
                    break;
                }
            }
            $(this).parent().parent().remove();
        });
    }

</script>
@if(session('product_success'))
    <script>
        Swal.fire({
            position: "top-end",
            icon: "success",
            title: "{{ session('product_success') }}",
            showConfirmButton: false,
            timer: 1500
        });

    </script>

@endif
@endsection
