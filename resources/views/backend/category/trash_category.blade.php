@extends('layouts.admin');
@section('content')
<div class="row">
    <div class="col-lg-8">
        <form action="{{ route('trash_category.restore') }}" method="POST">
            @csrf
            <div class="card">
                <div class="card-header">
                    <h2>Trash Category List</h2>
                </div>
                <div class="card-body">
                    @if(session('trash_restore'))
                        <div class="alert alert-success">{{ session('trash_restore') }}</div>
                    @endif
                    @if(session('permanent_delete'))
                        <div class="alert alert-success">{{ session('permanent_delete') }}</div>
                    @endif
                    <table class="table table-bordered">
                        <tr>
                            <th>
                                @if($trash_category->isNotEmpty())
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="checkbox" id="chkSelectAll" class="form-check-input">
                                            Checked
                                            <i class="input-frame"></i></label>
                                    </div>
                                @endif
                            </th>
                            <th>SL</th>
                            <th>Category Name</th>
                            <th>Icon</th>
                            <th>Action</th>
                        </tr>

                        @forelse($trash_category as $sl=>$trash)
                            <tr>
                                <td>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input chkDel" name="trash_id[]"
                                                value="{{ $trash->id }}">
                                            <i class="input-frame"></i></label>
                                    </div>
                                </td>
                                <td>{{ $sl+1 }}</td>
                                <td>{{ $trash->category_name }}</td>
                                <td>
                                    <img src="{{ asset('uploads/category') }}/{{ $trash->icon }}"
                                        alt="">
                                </td>
                                <td>
                                    <a href="{{ route('trash.restore', $trash->id) }}"
                                        class="btn btn-info btn-icon">
                                        <i data-feather="corner-up-right"></i>
                                    </a>
                                    <a href="{{ route('trash.delete', $trash->id) }}"
                                        class="btn btn-danger btn-icon ml-2">
                                        <i data-feather="trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">No Data Found</td>
                            </tr>
                        @endforelse
                    </table>
                    @if($trash_category->isNotEmpty())
                        <button class="btn btn-primary mt-2" name="restore" type="submit">Restore</button>
                        <button class="btn btn-danger mt-2" name="delete" type="submit">Delete</button>
                    @endif
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('footer_content')
<script>
    $("#chkSelectAll").on('click', function () {
        this.checked ? $(".chkDel").prop("checked", true) : $(".chkDel").prop("checked", false);
    })

</script>
@endsection
