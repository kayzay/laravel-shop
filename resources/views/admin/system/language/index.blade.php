@extends("admin.layout.base")
@section('footerJs')

   {{-- <script>
        GoAjax.data = {texx:12};
        GoAjax.send(
            '{{route('system.language.store')}}',
            'POST',
            function ($data) {
                console.log($data);
            }
        );
        let checkBox = null;


    </script>--}}
@endsection
@section('content')
    <div class="row row mb-4">
        <div class="col-md-3">
            <a
                href="{{route('system.language.create')}}"
                type="button"
                class="btn btn-block btn-outline-success">
                {{getTextAdmin('add_btn')}}
            </a>
        </div>
    </div>
    @if(Session::has('status'))
        <div class="callout callout-success">
            {!!Session::get('status')!!}
        </div>
    @endif
    <div class="card card-outline card-primary">
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">{{getTextAdmin('tb_name')}}</th>
                    <th scope="col">{{getTextAdmin('tb_abr')}}</th>
                    <th scope="col">{{getTextAdmin('tb_local')}}</th>
                    <th scope="col">{{getTextAdmin('tb_status')}}</th>
                    <th scope="col">{{getTextAdmin('tb_action')}}</th>
                </tr>
                </thead>
                <tbody>
                @if (!empty($data))
                    @foreach ($data as $item)
                        <tr>
                            <th>{{$item['id']}}</th>
                            <td>{{$item['name']}}</td>
                            <td>{{$item['abr']}}</td>
                            <td>{{$item['local']}}</td>
                            <td>
                                <span
                                    class="badge {{($item['available'] == 1) ? 'bg-success': 'bg-danger'}}">
                                    {{$textConvert($item['available'])}}
                                </span>
                            </td>
                            <td>
                                @if(config('app.language_id') == $item['id'])
                                    <span class="badge bg-danger">
                                        {{getTextAdmin('language_def')}}
                                    </span>
                                    @else
                                <a
                                    href="{{route('system.language.edit', $item['id'])}}"
                                    title="{{getTextAdmin('bt_edit')}}"
                                    class="btn btn-info btn-sm">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>
                                    @endif
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="4" class="text-center">
                            ....
                        </td>
                    </tr>
                @endif
                </tbody>
            </table>
            @if (!empty($pagination))
                @if ($pagination['total'] > $pagination['from'])

                    <ul class="pagination pagination mt-2 ">
                        @foreach ($pagination['links'] as $item)
                            <li class="page-item">
                                <a class="page-link" href="{{$item['url']}}">
                                    {{html_entity_decode($item['label'])}}
                                </a>
                            </li>
                        @endforeach
                    </ul>

                @endif
            @endif
        </div>
    </div>
@endsection

