@extends("admin.layout.base")
@section('footerJs')

@endsection
@section('content')
    @if ($errors->any())
        <div class="callout callout-danger">
            @foreach ($errors->all() as $error)
                <p>{{$error}}</p>
            @endforeach
        </div>
    @endif
    <section class="content">
        <form   name="admin_form"
                id="admin_form"
                action="{{route('system.language.store')}}"
                method="POST"
                class="row">
            @csrf
            @include('admin.partial.language.form')
        </form>
        <div class="row pb-2">
            <div class="col-12">
                <button type="submit" form="admin_form" class="btn btn-success float-right">{{__('language.btnSave')}}</button>
            </div>
        </div>
    </section>
@endsection
