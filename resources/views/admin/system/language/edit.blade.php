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
                action="{{route('system.language.update', $info['id'])}}"
                method="POST"
                class="row">
            @csrf
            @method('PATCH')
            @include('admin.partial.language.form', ['info' => $info])
        </form>
        <div class="row pb-2">
            <div class="col-12">
                <button
                    type="submit"
                    form="admin_form"
                    class="btn btn-success float-right">
                        {{getTextAdmin('btnSave')}}
                </button>
            </div>
        </div>
    </section>
@endsection
