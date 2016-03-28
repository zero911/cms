@extends('layout.back_base')
@section('title') Zero|CMS - {{__('_basic.setting_ype-edit')}} @stop

@section('content')
            @include('widgets.content-msgInfo')
              <h2 class="page-header">修改动态设置分组</h2>
              <form method="post"  accept-charset="utf-8">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <div class="nav-tabs-custom">
                  <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">主要内容</a></li>
                  </ul>
                  <div class="tab-content">
                    
                    <div class="tab-pane active" id="tab_1">
                      <div class="form-group">
                        <label>动态设置分组名 <small class="text-red">*</small> <span class="text-green small">只能全小写的英文字母与下划线（a-z_）组合</span></label>
                        <input type="text" class="form-control" name="name" autocomplete="off" value="{{ Input::old('name', isset($data) ? $data->name : null) }}" placeholder="动态设置分组名">
                      </div>
                      <div class="form-group">
                        <label>动态设置分组值 <span class="text-green small">建议中文</span></label>
                        <input type="text" class="form-control" name="value" value="{{ Input::old('value', isset($data) ? $data->value : null) }}" placeholder="动态设置分组值">
                      </div>
                      <div class="form-group">
                        <label>排序 <small class="text-red">*</small> <span class="text-green small">数字</span></label>
                        <input type="text" class="form-control" name="sort" value="{{ Input::old('sort', isset($data) ? $data->sort : null) }}" maxlength="6" placeholder="排序">
                      </div>
                    </div><!-- /.tab-pane -->

                    <button type="submit" class="btn btn-primary">修改动态设置分组</button>

                  </div><!-- /.tab-content -->
                  
              </div>
              </form>

@stop
