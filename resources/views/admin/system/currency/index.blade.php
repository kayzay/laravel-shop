@extends("admin.layout.base")
@section('footerJs')

@endsection
@section('content')
    <div class="row row mb-4">
        <div class="col-md-3">
{{--            <a--}}
{{--                href="{{route('system.currency.create')}}"--}}
{{--                type="button"--}}
{{--                class="btn btn-block btn-outline-success">--}}
{{--                {{getTextAdmin('add_btn')}}--}}
{{--            </a>--}}
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
                    <th scope="col">{{__('currency.tb_name')}}</th>
                    <th scope="col">{{__('currency.tb_abr')}}</th>
                    <th scope="col">{{__('currency.tb_symbol')}}</th>
                    <th scope="col">{{__('currency.tb_default')}}</th>
                    <th scope="col">{{__('currency.tb_use')}}</th>
                    <th scope="col">{{__('currency.tb_course')}}</th>
                    <th scope="col">{{__('currency.tb_status')}}</th>
                    <th scope="col">{{__('currency.tb_action')}}</th>
                </tr>
                </thead>
                <tbody>
                @if (!empty($data))
                    @foreach ($data as $item)
                        <tr>
                            <th>{{$item['id']}}</th>
                            <td>{{$item['name']}}</td>
                            <td>{{$item['abr']}}</td>
                            <td>{{$item['symbol']}}</td>
                            <td>
                                <span class="badge {{($item['default'] == 1) ? 'bg-success': 'bg-danger'}}">
                                    {{($item['default'] ? 'true' : 'false')}}
                                </span>
                            </td>
                            <td>
                                <span class="badge {{($item['default'] == 1) ? 'bg-success': 'bg-danger'}}">
                                    {{($item['use']) ? 'true' : 'false'}}
                                </span>
                            </td>
                            <td>{{$item['course']}}</td>
                            <td>
                                <span
                                    class="badge {{($item['status'] == 1) ? 'bg-success': 'bg-danger'}}">
                                    {{$textConvert($item['status'])}}
                                </span>
                            </td>
                            <td>

                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="8" class="text-center">
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

