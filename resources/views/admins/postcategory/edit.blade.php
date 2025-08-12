@extends('layouts.admin')
@section('content')
    <div class="lh-main-content">
        <div class="container-fluid">
            <div class="lh-page-title">
                <div class="lh-breadcrumb">
                    <h5>Danh mục Bài viết</h5>
                    <ul>
                        <li><a href="{{ route('admin.dashboard') }}">Trang chủ</a></li>
                        <li>Sửa Danh mục</li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-xxl-12 col-xl-8 col-md-12">
                    <div class="lh-card" id="postcategoryEdit">
                        <div class="lh-card-header">
                            <h4 class="lh-card-title">Sửa Danh mục Bài viết</h4>
                        </div>
                        <div class="lh-card-content card-booking">
                            <form action="{{ route('admin.postcategory.update', $category->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="row mtb-m-12">
                                    <div class="col-md-12 col-sm-12">
                                        <div class="lh-user-detail">
                                            <ul>
                                                <li>
                                                    <strong>Tên danh mục <span class="text-danger">*</span>: </strong>
                                                    <div class="form-group">
                                                        <input type="text" name="name" placeholder="Tên danh mục"
                                                            value="{{ old('name', $category->name) }}" class="form-control">
                                                        @error('name')
                                                            <p class="text-danger">{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                </li>
                                                <li>
                                                    <button type="submit" class="lh-btn-primary">Lưu</button>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
