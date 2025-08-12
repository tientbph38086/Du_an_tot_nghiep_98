@extends('layouts.admin')

@section('content')
    <div class="lh-main-content">
        <div class="container-fluid">
            <div class="lh-page-title">
                <div class="lh-breadcrumb">
                    <h5>Danh mục Bài viết</h5>
                    <ul>
                        <li><a href="{{ route('admin.dashboard') }}">Trang chủ</a></li>
                        <li>Danh mục Bài viết</li>
                    </ul>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-12 col-md-12">
                    <div class="lh-card" id="categoriesTbl">
                        <div class="lh-card-header">
                            <h4 class="lh-card-title">Danh sách Danh mục Bài viết</h4>
                            <div class="header-tools">
                                <a href="javascript:void(0)" class="m-r-10 lh-full-card"><i class="ri-fullscreen-line"
                                        title="Full Screen"></i></a>
                                <div class="lh-date-range dots">
                                    <span></span>
                                </div>
                                <button class="btn btn-primary ms-2"
                                    onclick="window.location.href='{{ route('admin.postcategory.create') }}'">
                                    Thêm Danh Mục
                                </button>
                            </div>
                        </div>

                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                        <div class="lh-card-content card-default">
                            <div class="table-responsive">
                                <table id="categories_table" class="table table-striped table-hover">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>STT</th>
                                            <th>Tên danh mục</th>
                                            <th>Ngày tạo</th>
                                            <th>Thao tác</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($categories as $key => $category)
                                            <tr>
                                                <td class="text-center">{{ $key + 1 }}</td>
                                                <td>{{ $category->name }}</td>
                                                <td>{{ $category->created_at->format('d/m/Y H:i') }}</td>
                                                <td>
                                                    <div class="btn-group">
                                                        <button type="button"
                                                            class="btn btn-outline-secondary dropdown-toggle"
                                                            data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="ri-settings-3-line"></i>
                                                        </button>
                                                        <ul class="dropdown-menu">
                                                            <li>
                                                                <a class="dropdown-item"
                                                                    href="{{ route('admin.postcategory.show', $category->id) }}">
                                                                    <i class="ri-eye-line"></i> Xem
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a class="dropdown-item"
                                                                    href="{{ route('admin.postcategory.edit', $category->id) }}">
                                                                    <i class="ri-edit-line"></i> Sửa
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <form
                                                                    action="{{ route('admin.postcategory.destroy', $category->id) }}"
                                                                    method="POST"
                                                                    onsubmit="return confirm('Bạn có chắc muốn xóa?');">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit"
                                                                        class="dropdown-item text-danger">
                                                                        <i class="ri-delete-bin-line"></i> Xóa
                                                                    </button>
                                                                </form>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="text-center">Không có danh mục nào.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
