<div class="col-md-12">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">{{getTextAdmin('general')}}</h3>
            <div class="card-tools">
                <button type="submit" class="btn btn-tool" title="{{getTextAdmin('btnSave')}}">
                    <i class="fas fa-save"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="form-group">
                <label for="name">{{getTextAdmin('adm_name')}}</label>
                <input
                    name="name"
                    type="text"
                    id="name"
                    value="{{old('name', $info['name'] ?? '')}}"
                    class="form-control">
            </div>
            <div class="form-group">
                <label for="email">{{getTextAdmin('adm_email')}}</label>
                <input
                    name="email"
                    type="text"
                    id="email"
                    value="{{old('email', $info['email'] ?? '')}}"
                    class="form-control">
            </div>
            <div class="form-group">
                <label for="password">{{getTextAdmin('adm_pass')}}</label>
                <input
                    name="password"
                    type="password"
                    id="password"
                    value="{{old('password')}}"
                    class="form-control">
            </div>
            <div class="form-group">
                <label for="inputStatus">{{getTextAdmin('adm_group')}}</label>
                <x-selectBox
                    name="group"
                    :data="$groupList"/>
            </div>
            <div class="form-group">
                <label for="inputStatus">{{getTextAdmin('adm_status')}}</label>
                <x-selectBox
                    name="status"
                    :data="$statusList"/>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
