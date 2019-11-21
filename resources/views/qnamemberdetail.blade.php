@extends('layouts.default')

@section('content')

<div class="container-fluid">

  {{ Breadcrumbs::render('qnamemberdetail') }}

<div class="row">
    <!-- col-sm-12 start -->
    <div class="col-sm-12">
    <!-- card -->
    <div class="card">
        <!-- cardbody start -->
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12">

                    @if ($qnaMemberData)
                    <h4 class="header-title">{{ $qnaMemberData->subject }}</h2>
                    @else
                    <h4 class="header-title">Something went wrong.</h4>
                    @endif

                    <hr />

                    @if ($message = Session::get('success'))
                    <div class="row justify-content-end">
                        <div class="col-3 col-align-self-end alert alert-success alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>
                            toastr.success("{{ $message }}");
                            </strong>
                        </div>
                    </div>
                    @endif

                    <div class="row" id="qnaMemberData">
                      <div class="col-md-12 col-xs-12 px-4">

                          <div class="form-group row">
                              <label class="col-md-2 col-form-label ">업체명</label>
                              <div class="col-md-10 col-xs-9">
                                <p class="form-control-static mt-1 mb-1">{{ $qnaMemberData->mem_name }}
                                  <input class="btn btn-primary waves-effect wave-light btn-xs ml-1 mr-1" type="button" value="고객정보" onclick="getMemberInfo({!! json_encode($qnaMemberData->idx)!!})">
                                </p>
                              </div>

                              <label class="col-md-2 col-form-label ">이메일</label>
                              <div class="col-md-10 col-xs-9">
                                <p class="form-control-static mt-1 mb-1">{{ $qnaMemberData->email }}</p>
                              </div>

                              <label class="col-md-2 col-form-label ">연락처</label>
                              <div class="col-md-10 col-xs-9">
                                <p class="form-control-static mt-1 mb-1">{{ $qnaMemberData->phone }}</p>
                              </div>

                              <label class="col-md-2 col-form-label ">첨부파일</label>
                              <div class="col-md-10 col-xs-9">
                                <p class="form-control-static mt-1 mb-1">{{ $qnaMemberData->attach_file ? $qnaMemberData->attach_file : '없음' }}</p>
                              </div>

                              <label class="col-md-2 col-form-label ">문의내용</label>
                              <div class="col-md-10 col-xs-9">
                                  <div class="card card-border">
                                      <div class="card-header border-primary pb-1">
                                          <h4 class="card-title text-primary mb-1">{{ $qnaMemberData->subject }}</h4>
                                          <h4 class="card-title text-primary mb-1 float-right">{{ date("Y-m-d h:i:s", $qnaMemberData->reg_time) }}</h4>
                                      </div>
                                      <div class="card-body">
                                          <p class="mb-0">{!! $qnaMemberData->content !!}</p>
                                      </div>
                                  </div>
                              </div>
                          </div>

                      </div>

                    </div><!--row end-->

                    <div class="col-md-10 col-xs-9" id="replyData">
                        @if ($replyData)
                        <div class="card card-border">
                            <div class="card-header border-success pb-1">
                                <h4 class="card-title text-success mb-1">{{ $replyData->subject }}</h4>
                                <h5 class="card-title text-success mb-1 float-right">{{ date("Y-m-d h:i:s", $replyData->reg_time) }}</h5>
                            </div>

                            <div class="card-body">
                                <p class="mb-0">{!! $replyData->content !!}</p>
                            </div>
                        </div>
                          @endif
                    </div>

                    <div class="form-group row" id="answer">
                        <div class="col-md-10 col-xs-9 offset-md-2">
                            <button type="submit" class="btn btn-danger btn-sm float-right ml-1">취소</button>
                            <button type="submit" class="btn btn-info btn-sm float-right" onclick="answer()">답변하기</button>
                        </div>
                    </div>

                </div>
                    <!-- col-md-12 -->
            </div>
                <!-- row end -->
        </div>
        <!-- cardbody end -->
    </div>
    <!-- card end -->
    </div>
    <!-- col-12 end -->
</div>
<!-- row end -->
</div>
<!-- container-fluid end -->

@toastr_css
@toastr_js
@toastr_render


<script>

// 사이드바 열고 고객정보 보기
function getMemberInfo(idx) {
  console.log(idx);
  sidebarOpen();
}

function answer() {
  console.log('answer');
  var div = document.createElement('div');

  div.className = 'row';

  div.innerHTML = '<div class="col-md-12 col-xs-12">\
                    <div class="card card-border">\
                      <div class="card-header border-success pb-1">\
                          <h4 class="card-title text-success mb-1">{{ $qnaMemberData->subject }}</h4>\
                      </div>\
                      <div class="card-body">\
                          <textarea id="answer_content" class="mb-0" rows="20" style="width:100%;" name="editor"></textarea>\
                          <div class="col-md-10 col-xs-9 offset-md-2">\
                              <button type="submit" class="btn btn-success btn-sm float-right" onclick="register()">등록</button>\
                          </div>\
                      </div>\
                    </div>\
                  </div>';

  document.getElementById('replyData').appendChild(div);
  document.getElementById('answer').remove();

  $('#answer_content').summernote({
      // placeholder: {!! json_encode($qnaMemberData->content) !!},
      tabsize: 2,
      height: 200
  });
}
</script>

@endsection
