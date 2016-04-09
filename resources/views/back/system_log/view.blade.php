@extends('layout.back_base')
@section('title') Zero|CMS - {{__('_log.log-view')}} @stop
@section('content')

              <div class="box box-primary">

                <div class="box-header with-border">
                  <h3 class="box-title">{{__('_log.log-view')}}</h3>
                  <p>以下为本条系统日志详情。</p>
                  <div class="basic_info bg-info">
                     <ul>
                        <li>ID：<span class="text-muted">{{ $sys_log->id }}</span></li>
                        <li>操作者昵称：<span class="text-green">{{ $sys_log->user->nickname }}</span></li>
                        <li>操作者真实姓名：<span class="text-green">{{ $sys_log->user->realname }}</span></li>
                        <li>
                            操作类型：
                            <span class="text-yellow">
                            @if(empty($userType))
                            {{ $sys_log->type }}
                            @else
                            {{ $userType[$sys_log->type] }}
                            @endif
                            </span>
                        </li>
                        <li>操作URL：<b>{{ $sys_log->url }}</b></li>
                        <li>操作内容：<b class="text-red">{{ $sys_log->content }}</b></li>
                        <li>操作时间：<span class="text-info">{{ $sys_log->created_at }}</span></li>
                    </ul>
                  </div>
                </div><!-- /.box-header -->

              </div>

@stop

