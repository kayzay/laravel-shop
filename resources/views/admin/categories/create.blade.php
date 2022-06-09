@extends("admin.layout.base")
@section('footerJs')
    <script src="{{asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
    <script>
        $(function () {
            bsCustomFileInput.init();
        });
    </script>
@endsection
@section('btnFormSave')
    <button type="submit" class="btn btn-info" form="categoryForm">{{getTextAdmin('btnSave')}}</button>
@endsection
@section('content')
    @if ($errors->any())
        <div class="callout callout-danger">
            @foreach ($errors->all() as $error)
                <p>{{$error}}</p>
            @endforeach
        </div>
    @endif

    <div class="card card-outline card-primary">
        <div class="card-body">
            <form
                name="category-form"
                id="categoryForm"
                action="{{route('category.store')}}"
                method="POST"
                class="row"
                enctype="multipart/form-data">
                @csrf
                @include('admin.partial.category.form', [
                    'defaultPage' => $defaultPage,
                     'languages' => $languages,
                     'statusList' => $statusList,
                     'categoryList' => $categoryList,
                      'logo' => $logo])
            </form>
        </div>
    </div>
@endsection

