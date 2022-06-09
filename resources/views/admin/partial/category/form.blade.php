<div class="col-2 col-sm-2">
    <div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab" role="tablist" aria-orientation="vertical">
        <a
            class="nav-link active"
            id="vert-tabs-base-tab"
            data-toggle="pill"
            href="#vert-tabs-base"
            role="tab"
            aria-controls="vert-tabs-base"
            aria-selected="true">{{getTextAdmin('tab_base_name')}}</a>
        <a
            class="nav-link"
            id="vert-tabs-data-tab"
            data-toggle="pill"
            href="#vert-tabs-data"
            role="tab"
            aria-controls="vert-tabs-data"
            aria-selected="false">{{getTextAdmin('tab_data_name')}}</a>
    </div>
</div>
<div class="col-10 col-sm-10">
    <div class="tab-content" id="vert-tabs-tabContent">
        <div class="tab-pane text-left fade show active" id="vert-tabs-base" role="tabpanel"
             aria-labelledby="vert-tabs-home-tab">
            <div class="card-header p-0 pt-1 border-bottom-0">
                <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                    @foreach ($languages as $abr => $item)
                        <li class="nav-item">
                            <a
                                class="nav-link {{($abr === $defaultPage ? 'active' : '')}}"
                                id="custom-tabs-three-{{$abr}}-tab"
                                data-toggle="pill"
                                href="#custom-tabs-three-{{$abr}}"
                                role="tab"
                                aria-controls="custom-tabs-three-{{$abr}}"
                                aria-selected="true">
                                {{$item['name']}}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content" id="custom-tabs-three-tabContent">
                    @foreach ($languages as $abr => $item)
                        <div
                            class="tab-pane fade {{($abr === $defaultPage) ? ' active show' : ''}}"
                            id="custom-tabs-three-{{$abr}}"
                            role="tabpanel"
                            aria-labelledby="custom-tabs-three-{{$abr}}-tab">

                            <div class="form-group">
                                <label for="{{$abr}}_name">{{getTextAdmin('fiel_name')}}</label>
                                <input
                                    name="description[{{$item['id']}}][name]"
                                    type="text"
                                    class="form-control"
                                    id="{{$abr}}_name"
                                    value="{{old('description.'. $item['id']. '.name', $info['descriptions'][$item['id']]['name'] ?? '')}}"
                                    placeholder="{{getTextAdmin('pl_name')}}">
                            </div>

                            <div class="form-group">
                                <label for="{{$abr}}_h1">{{getTextAdmin('fiel_h1')}}</label>
                                <input
                                    name="description[{{$item['id']}}][h1]"
                                    type="text"
                                    class="form-control"
                                    id="{{$abr}}_h1"
                                    value="{{old('description.'. $item['id']. '.h1',$info['descriptions'][$item['id']]['h1'] ?? '')}}"
                                    placeholder="{{getTextAdmin('pl_h1')}}">
                            </div>

                            <div class="form-group">
                                <label for="cat_title">{{getTextAdmin('fiel_title')}}</label>
                                <input
                                    name="description[{{$item['id']}}][title]"
                                    type="text"
                                    class="form-control"
                                    id="{{$abr}}_title"
                                    value="{{old('description.'. $item['id']. '.title', $info['descriptions'][$item['id']]['title'] ?? '')}}"
                                    placeholder="{{getTextAdmin('pl_title')}}">
                            </div>

                            <div class="form-group">
                                <label for="{{$abr}}_m_description">{{getTextAdmin('fiel_meta_desc')}}</label>
                                <input
                                    name="description[{{$item['id']}}][description]"
                                    type="text"
                                    class="form-control"
                                    id="{{$abr}}_m_description"
                                    value="{{old('description.'. $item['id']. '.description', $info['descriptions'][$item['id']]['description'] ?? '')}}"
                                    placeholder="{{getTextAdmin('pl_meta_desc')}}">
                            </div>

                            <div class="form-group">
                                <label for="{{$abr}}_title">{{getTextAdmin('fiel_meta_key')}}</label>
                                <input
                                    name="description[{{$item['id']}}][keywords]"
                                    type="text"
                                    class="form-control"
                                    id="{{$abr}}_m_keywords"
                                    value="{{old('description.'. $item['id']. '.keywords', $info['descriptions'][$item['id']]['keywords'] ?? '')}}"
                                    placeholder="{{getTextAdmin('pl_meta_key')}}">
                            </div>

                            <div class="form-group">
                                <label>{{getTextAdmin('fiel_sh_desc')}}</label>
                                <textarea
                                    name="description[{{$item['id']}}][short_description]"
                                    class="form-control"
                                    rows="3"
                                    placeholder="{{getTextAdmin('pl_enter')}}">{{old('description.'. $item['id']. '.short_description', $info['descriptions'][$item['id']]['short_description'] ?? '')}}</textarea>
                            </div>

                            <div class="form-group">
                                <label>{{getTextAdmin('fiel_fl_desc')}}</label>
                                <textarea
                                    name="description[{{$item['id']}}][full_description]"
                                    class="form-control"
                                    rows="3"
                                    placeholder="{{getTextAdmin('pl_enter')}}">{{old('description.'. $item['id']. '.full_description', $info['descriptions'][$item['id']]['full_description'] ?? '')}}</textarea>
                            </div>

                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="vert-tabs-data" role="tabpanel" aria-labelledby="vert-tabs-data-tab">
            <div class="card-body">
                <div class="form-group">
                    <label>{{getTextAdmin('fiel_parent')}}</label>
                    <x-selectBox
                        name="main[parent]"
                        :data="$categoryList"
                    />
                </div>
                <div class="form-group">
                    <label for="alias">{{getTextAdmin('fiel_alias')}}</label>
                    <input
                        name="main[alias]"
                        type="text"
                        class="form-control"
                        id="alias"
                        value="{{old('main.alias', $info['alias'] ??'')}}"
                        placeholder="{{getTextAdmin('pl_enter')}}">
                </div>
                <div class="form-group">
                    <div class="text-center">
                        <img src="{{asset($logo)}}" width="100" class="rounded" alt="...">
                    </div>
                </div>
                <div class="form-group">
                    <div class="custom-file">
                        @if (isset($info))
                            <input name="main[load_logo]" type="hidden"
                                   value="{{old('main.load_logo', $info['logo'])}}">
                        @endif
                        <input name="main[img]" type="file" class="custom-file-input" id="img">
                        <label class="custom-file-label" for="img">{{getTextAdmin('fiel_img')}}</label>
                    </div>
                </div>
                <div class="form-group">
                    <label>{{getTextAdmin('fiel_status')}}</label>
                    <x-selectBox
                        name="main[status]"
                        :data="$statusList"
                    />
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col mb-3 text-right mr-3">
            @yield('btnFormSave')
        </div>
    </div>
</div>

