@extends('layout.back_base')
@section('title') Zero|CMS - {{__('_basic.page-create')}} @stop
@section('content')
    @include('widgets.content-msgInfo')
    <h2 class="page-header">{{__('_basic.page-create')}}</h2>
    <form method="post" accept-charset="utf-8">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="nav-tabs-custom">

            <ul class="nav nav-tabs">
                <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">主要内容</a></li>
                <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">附加内容</a></li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane active" id="tab_1">
                    <div class="form-group">
                        <label>标题
                            <small class="text-red">*</small>
                        </label>
                        <input type="text" class="form-control" name="title" autocomplete="off"
                               value="" placeholder="标题">
                    </div>
                    <div class="form-group">
                        <label>缩略图 <a href="javascript:void(0);" class="uploadPic" data-id="thumb"><i
                                        class="fa fa-fw fa-picture-o" title="上传"></i></a> <a href="javascript:void(0);"
                                                                                             class="previewPic"
                                                                                             data-id="thumb"><i
                                        class="fa fa-fw fa-eye" title="预览小图"></i></a></label>
                        <input type="text" class="form-control" id="thumb" name="thumb"
                               value=""
                               placeholder="缩略图地址：如{{ url('') }}/assets/img/yas_logo.png">
                    </div>
                   {{-- <div class="form-group">--}}
                   {{--     <label>网址缩略名--}}
                   {{--         <small class="text-red">*</small>--}}
                   {{--     </label>--}}
                   {{--     <div class="input-group mono url_slug">--}}
                   {{--             <p>--}}
                   {{--                 {{ url('') }}/{category}/<input type="text" id="slug" name="slug" autocomplete="off"--}}
                   {{--                             value="" class="slug" maxlength="30" pattern="[A-z0-9_-]+">.html--}}
                   {{--             </p>--}}
                   {{--     </div>--}}
                   {{-- </div>--}}
                    <div class="form-group">
                        <label>正文
                            <small class="text-red">*</small>
                        </label>
                        <textarea class="form-control" id="ckeditor" name="content"></textarea>
                        @include('scripts.endCKEditor'){{-- 引入CKEditor编辑器相关JS依赖 --}}
                    </div>
                </div><!-- /.tab-pane -->
                <div class="tab-pane" id="tab_2">
                    <div class="form-group">
                        <label>外链地址</label>
                        <input type="text" class="form-control" name="outer_link"
                               value="" placeholder="http://example.com/">
                    </div>
                    <div class="form-group">
                        <label>是否置顶
                            <small class="text-red">*</small>
                        </label>
                        <div class="input-group">
                            <input type="radio" name="is_top" value="0" checked >
                            <label class="choice" for="radiogroup">否</label>
                            <input type="radio" name="is_top" value="1" >
                            <label class="choice" for="radiogroup">是</label>
                        </div>
                    </div>
                </div><!-- /.tab-pane -->

                <button type="submit" class="btn btn-primary">创建单页</button>

            </div><!-- /.tab-content -->

        </div>
    </form>
    <div id="layerPreviewPic" class="fn-hide"></div>
    @stop

    @section('extraPlugin')

            <!--引入Layer组件-->
    <script src="{{ asset('plugins/layer/layer.min.js') }}"></script>
    <!--引入iCheck组件-->
    <script src="{{ asset('plugins/iCheck/icheck.min.js') }}" type="text/javascript"></script>
    <!--引入Chosen组件-->
    @include('scripts.endChosen')

    @stop


    @section('filledScript')
            <!--缩略名自适应宽度 来自typecho-->
    var slug = $('#slug');

    if (slug.length > 0) {
    var sw = slug.width();
    if (slug.val().length > 0) {
    slug.css('width', 'auto').attr('size', slug.val().length);
    }
    slug.bind('input propertychange', function () {
    var t = $(this), l = t.val().length;
    if (l > 0) {
    t.css('width', 'auto').attr('size', l);
    } else {
    t.css('width', sw).removeAttr('size');
    }
    }).width();
    }

    <!--启用iCheck响应checkbox与radio表单控件-->
    $('input[type="radio"]').iCheck({
    radioClass: 'iradio_flat-blue',
    increaseArea: '20%' // optional
    });
    $('input[type="checkbox"]').iCheck({
    checkboxClass: 'icheckbox_flat-blue',
    increaseArea: '20%' // optional
    });
    @include('scripts.endSinglePic') {{-- 引入单个图片上传与预览JS，依赖于Layer --}}
@stop