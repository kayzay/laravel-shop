<!--product-->
@extends("admin.layout.base")

@section('headerStyle')
    <link rel="stylesheet" href="{{asset('plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
@endsection

@section('footerJs')
<script src="{{asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"> </script>
<script src="{{asset('plugins/select2/js/select2.full.min.js')}}"></script>
<script>
    $(function () {
        $('.select2').select2();
        bsCustomFileInput.init();
    });
</script>
<style>
    .select2-results__option[aria-selected=true] {
        display: none;
    }
</style>
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
                action="{{route('product.update',  $info['id'])}}"
                method="POST"
                class="row"
                enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                @include('admin.partial.product.form', [
                    'defaultPage' => $defaultPage,
                     'languages' => $languages ?? [],
                     'statusList' => $statusList ?? [],
                     'categoryList' => $categoryList ?? [],
                     'logo' => $logo ?? '',
                     'categoryIds' => $categoryIds ?? false,
                     'info' => $info])
            </form>
        </div>
    </div>
@endsection

