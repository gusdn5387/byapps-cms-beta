<script>
    if (location.href.indexOf("/appsdetail/") == -1) {
       <?
        $tablist = '<a class="nav-item nav-link" id="nav-search-info-tab" data-toggle="tab" href="#nav-search-info" role="tab" aria-controls="nav-search-info" aria-selected="false">검색업체 정보</a>';
       ?>
    }
    var mode = 'all';
    function refreshComment(){
        $('.comments').html('');
        $.ajax({
            url: '{{ Route("comment") }}',
            type: 'POST',
            data: {
                idx: {{ request()->route()->parameter('idx') }},
                mmid: mode,
                _token: "{{ csrf_token() }}"
            },
            success: function(response) {
                response.forEach( data =>
                    $('.comments').append(`<li style="font-size:.8rem;border-bottom: 1px dotted #ccc;padding-bottom:12px;margin-bottom:8px">${data.comment}<br>-${data.mem_name}, ${data.reg_time}<span style="float:right;margin-right:5px;">${data.mmid}</span></li>`)
                );
            }
        })
    }
    $(document).ready(function(){
        $.ajax({
            url: '{{ Route("comment") }}',
            type: 'POST',
            data: {
                idx: {{ request()->route()->parameter('idx') }},
                mmid: mode,
                _token: "{{ csrf_token() }}"
            },
            success: function(response) {
                response.forEach( data =>
                    $('.comments').append(`<li style="font-size:.8rem;border-bottom: 1px dotted #ccc;padding-bottom:12px;margin-bottom:8px">${data.comment}<br>-${data.mem_name}, ${data.reg_time}<span style="float:right;margin-right:5px;">${data.mmid}</span></li>`)
                );
                $('#nav-comment .custom-select').change(function(){
                    mode = $(this).val();
                    $.ajax({
                        async: false,
                        url: '{{ Route("comment") }}',
                        type: 'POST',
                        data: {
                            idx: {{ request()->route()->parameter('idx') }},
                            mmid: mode,
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            $('.comments').html('');
                            response.forEach( data =>
                                $('.comments').append(`<li style="font-size:.8rem;border-bottom: 1px dotted #ccc;padding-bottom:12px;margin-bottom:8px">${data.comment}<br>-${data.mem_name}, ${data.reg_time}<span style="float:right;margin-right:5px;">${data.mmid}</span></li>`)
                            );
                        }
                    });
                })
                $('#sendComment').submit(function( event ) {
                    event.preventDefault();
                    var msg = $(this).find('input[name=message]').val();
                    if(!msg)return;
                    $(this).find('input[name=message]').val('')
                    $.ajax({
                        async: false,
                        url: '{{ Route("commentsend") }}',
                        type: 'POST',
                        data: {
                            pidx: {{ request()->route()->parameter('idx') }},
                            mmid: mode,
                            comment: msg,
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(data) {
                            $('.comments').html(`<li style="font-size:.8rem;border-bottom: 1px dotted #ccc;padding-bottom:12px;margin-bottom:8px">${data.comment}<br>-${data.mem_name}, ${data.reg_time}<span style="float:right;margin-right:5px;">${data.mmid}</span></li>`+$('.comments').html())
                        },
                    });
                });
            },
        });
    })

</script>

<div id="sidebar-close" class="my-2"><i class="mdi mdi-close"></i></div>

        <form id="search" class="navbar-nav flex-row ml-md-auto d-none d-md-flex form-inline">
            <div class="form-group">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">검색</button>
            </div>
        </form>


            <div id="app_noti" class="card-body row" >
                <div class="col-12" style="overflow:auto;" >
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link active" id="nav-comment-tab" data-toggle="tab" href="#nav-comment" role="tab" aria-controls="nav-comment" aria-selected="true">댓글</a>
                            <?= $tablist ?>
                            <a class="nav-item nav-link" id="nav-cc-tab" data-toggle="tab" href="#nav-cc" role="tab" aria-controls="nav-comment" aria-selected="true">회원정보</a>
                        </div>
                    </nav>
                    <div class="tab-content">
                        <!-- #nav-comment -->
                        <div class="tab-pane px-3 active" id="nav-comment" role="tabpanel" aria-labelledby="nav-comment-tab">
                                <!-- <div id="comment"> -->
                                <div>
                                <!-- 코멘트박스 -->
                                    <select name="" class="custom-select my-1 mr-sm-2">
                                        <option value="order">주문</option>
                                        <option value="payment">결제</option>
                                        <option value="new_update">업데이트</option>
                                        <option value="apps">앱상세</option>
                                        <option value="reseller">리셀러</option>
                                        <option value="myqna">문의</option>
                                        <option value="ma">MA</option>
                                        <option value="all" selected>전체</option>
                                    </select>
                                    <ul class="comments" style="overflow-y: auto;max-height:500px;">
                                    </ul>

                                    <div id="comment_box" class="row" >
                                        <!-- comment component 자리 -->
                                    </div>
                                <!-- //코멘트박스 -->
                                </div>
                                <!-- 코멘트 푸터 고정-->
                                <div class="box-footer">
                                    <form id="sendComment" method="post">
                                    <div class="input-group">
                                    <div class="checkbox checkbox-danger my-2">
                                            <label>
                                                <input type="checkbox" value="" >
                                                <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                            </label>
                                        </div>
                                        <input type="text" name="message" placeholder="Type Message ..." class="form-control" style="height:35px">
                                        <span class="input-group-btn">
                                            <button type="submit" class="btn btn-warning btn-flat">Send</button>
                                        </span>
                                    </div>
                                    </form>
                                </div><!-- 코멘트 푸터 고정-->
                            </div>
                        <!-- #nav-comment -->
                        <div class="tab-pane px-3" id="nav-search-info" role="tabpanel" aria-labelledby="nav-search-info">
                                <!-- card -->
                                    <h3 class="card-title my-2">
                                        <a class="text-dark" >

                                        </a>
                                    </h3>

                                    <div id="app_noti" class="row" >

                                        <div class="col-12" style="overflow:auto;" >
                                            <nav>
                                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                                    <a class="nav-item nav-link active" id="nav-company-info-tab" data-toggle="tab" href="#nav-company-info" role="tab" aria-controls="nav-company-info" aria-selected="true">업체정보</a>
                                                    <a class="nav-item nav-link" id="nav-app-info-tab" data-toggle="tab" href="#nav-app-info" role="tab" aria-controls="nav-app-info" aria-selected="false">서비스기간</a>
                                                </div>
                                            </nav>

                                            <!-- tab content-->
                                            <div class="tab-content">
                                                <!-- #nav-company-info -->
                                                <div class="tab-pane px-3 active" id="nav-company-info" role="tabpanel" aria-labelledby="nav-company-info-tab">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group row">
                                                                <label class="col-md-3 col-xs-12 control-label">ID</label>
                                                                <strong class="form-control-static mr-3">email@example.com</strong>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label class="col-md-5 col-xs-12 control-label">RESELLER</label>
                                                                <strong class="form-control-static">cafe24</strong>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label class="col-md-5 col-xs-12 control-label">비밀번호</label>
                                                                <input type="password" name="pw" class="col-4" value="">
                                                            </div>
                                                            <div class="form-group row">
                                                                <label class="col-md-5 col-xs-12 control-label">비밀번호 확인</label>
                                                                <input type="password" name="check_pw" class="col-4" value="">
                                                            </div>

                                                        </div>

                                                        <div class="col-md-12">
                                                            <div class="form-group row">
                                                                <label class="col-md-5 col-xs-12 control-label">대표자</label>
                                                                <strong class="form-control-static">정민희</strong>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label class="col-md-5 col-xs-12 control-label">담당자</label>
                                                                <strong class="form-control-static mr-3">정민희</strong>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label class="col-md-5 col-xs-12 control-label">연락처</label>
                                                                <input type="text" name="phone" class="col-4" value="010-9804-8898">
                                                            </div>
                                                            <div class="form-group row">
                                                                <label class="col-md-5 col-xs-12 control-label">이메일</label>
                                                                <input type="text" name="email" class="col-4" value="byapps01@naver.com">
                                                            </div>
                                                        </div>
                                                        <button type="button" class="btn btn-sm btn-inverse waves-effect w-md waves-light float-right"> <i class="mdi mdi-account"></i> <span>회원정보 수정</span> </button>
                                                    </div>
                                                </div>
                                                <!-- //#nav-company-info -->

                                                    <!-- #nav-company-info -->
                                                    <div class="tab-pane fade px-3 text-black" id="nav-app-info" role="tabpanel" aria-labelledby="nav-app-info-tab">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group row">
                                                                    <label class="col-md-5 col-xs-12 control-label">APP ID</label>
                                                                    <strong class="form-control-static">yeosinj</strong>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label class="col-md-5 col-xs-12 control-label">APP NAME</label>
                                                                    <input type="text" name="pw" class="col-4" value="여신제이">
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label class="col-md-5 col-xs-12 control-label">부가서비스</label>
                                                                    <div class="col-md-7 col-xs-12 px-0">
                                                                        <div class="checkbox checkbox-warning">
                                                                            <label>
                                                                                <input type="checkbox" value="iphone" checked="">
                                                                                <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                                                                푸쉬자동화
                                                                            </label>
                                                                        </div>
                                                                        <div class="checkbox checkbox-warning">
                                                                            <label>
                                                                                <input type="checkbox" value="iphone" checked="">
                                                                                <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                                                                웹푸쉬
                                                                            </label>
                                                                        </div>
                                                                        <br>
                                                                        <div class="checkbox checkbox-pink">
                                                                            <label>
                                                                                <input type="checkbox" value="android" >
                                                                                <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                                                                MA통합
                                                                            </label>
                                                                        </div>
                                                                        <div class="checkbox checkbox-purple">
                                                                            <label>
                                                                                <input type="checkbox" value="iphone" checked="">
                                                                                <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                                                                리타겟팅
                                                                            </label>
                                                                        </div>
                                                                        <div class="checkbox checkbox-purple">
                                                                            <label>
                                                                                <input type="checkbox" value="android" checked="">
                                                                                <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                                                                MA
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label class="col-md-5 col-xs-12 control-label">이용기간</label>
                                                                    <div class="input-daterange input-group col-md-7 col-xs-12" id="date-range">
                                                                        <input class="form-control input-limit-datepicker" type="text" name="daterange" value="06/01/2015 - 06/07/2015"/>
                                                                        <input type="text" class="form-control col-md-2 col-xs-2" name="count-day" value="">일
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label class="col-md-5 col-xs-12control-label">APP OS</label>
                                                                    <div class="checkbox checkbox-success m-t-0">
                                                                        <label>
                                                                            <input type="checkbox" value="android" checked="">
                                                                            <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                                                            android
                                                                        </label>
                                                                    </div>
                                                                    <div class="checkbox checkbox-info ml-3">
                                                                        <label>
                                                                            <input type="checkbox" value="iphone" checked="">
                                                                            <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                                                            ios
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label class="col-md-5 col-xs-12 control-label">이용기간</label>

                                                                <div class="form-inline">
                                                                    <div class="input-daterange input-group row" id="date-range">
                                                                        <input type="date" class="col-md-3 col-xs-3" name="start">
                                                                        <div class="input-group-append">
                                                                            <span class="input-group-text bg-custom text-white b-0">to</span>
                                                                        </div>
                                                                        <input type="date" class="col-md-3 col-xs-3" name="end">
                                                                        <input type="text" class="col-md-2 col-xs-2" name="count-day" value="">일
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div> <!-- //#nav-company-info -->
                                                </div><!-- //tab content-->
                                            </div>

                                    </div><!-- //card body -->
                            </div>
                            <div class="tab-pane px-3" id="nav-cc" role="tabpanel" aria-labelledby="nav-cc-tab">
                                <div class="row">
                                    <div class="col-sm-12">
                                      @if(isset($mem_id) && $mem_id != null)
                                        <?$userInfoData = getUserData($mem_id)?>
                                        <h4 class="header-title">{{ $userInfoData->mem_nick }}</h2>

                                        <hr />

                                        <div class="row">
                                            <div class="col-md-12 col-xs-12 px-4">
                                                <div class="form-group row" id="paymentData">
                                                    <label class="col-md-4 col-form-label ">RESELLER ID</label>
                                                    <div class="col-md-8 col-xs-9">
                                                      <p class="form-control-static mt-1 mb-1">
                                                        {{ $userInfoData->recom_id }} &nbsp&nbsp
                                                        <?$resellerData = getResellerInfo($userInfoData->recom_id);?>
                                                        @if($resellerData != null)
                                                        <strong>{{ $resellerData->company }}
                                                        ({{ $resellerData->mem_name }}, {{ $resellerData->cellno }}, {{ $resellerData->phoneno }})
                                                        </strong>
                                                        @endif
                                                      </p>

                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-md-4 col-form-label">고객 ID</label>
                                                    <input type="text" class="form-control col-md-8" id="mem_id" name="mem_id" value="{{ $userInfoData->mem_id }}">
                                                    <div class="col-md-12 col-xs-9">
                                                        <div class="form-inline">
                                                            <div class="input-group">
                                                                <input class="btn btn-primary waves-effect wave-light btn-xs mr-1 col-md-3" type="button" value="회원로그인" onclick="getMemberInfo({!! json_encode($userInfoData->idx)!!})">
                                                                <input class="btn btn-info waves-effect btn-xs mr-1 col-md-3" type="button" value="주문내역" onclick="goToAppsOrderList()">
                                                                <input class="btn btn-info waves-effect btn-xs mr-1 col-md-3" type="button" value="결제내역" onclick="goToAppsPaymentList()">
                                                                <input class="btn btn-success waves-effect btn-xs mr-1 col-md-3" type="button" value="앱 관리">
                                                                <input class="btn btn-warning waves-effect btn-xs mr-1 col-md-3" type="button" value="프로모션 발급">
                                                                <input class="btn btn-danger waves-effect btn-xs mr-1 col-md-3" type="button" value="ID 변경">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-md-4 col-form-label">새 비밀번호</label>
                                                    <div class="col-md-8 col-xs-9">
                                                      <div class="form-inline">
                                                          <div class="input-group">
                                                              <input type="password" class="form-control mr-1" id="new_passwd" name="new_passwd" value="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-md-4 col-form-label">새 비밀번호 확인</label>
                                                    <div class="col-md-8 col-xs-9">
                                                        <div class="form-inline">
                                                            <div class="input-group">
                                                                <input type="password" class="form-control" id="new_passwd_confirm" name="new_passwd_confirm" value="">
                                                                <input class="btn btn-info waves-effect btn-xs " type="button" value="비밀번호 초기화 메일발송">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-md-4 col-form-label">업체명</label>
                                                    <div class="col-md-8 col-xs-9">
                                                      <div class="form-inline">
                                                          <div class="input-group">
                                                              <input type="text" class="form-control" id="mem_nick" name="mem_nick" value="{{ $userInfoData->mem_nick }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-md-4 col-form-label">대표자명</label>
                                                    <div class="col-md-8 col-xs-9">
                                                      <div class="form-inline">
                                                          <div class="input-group">
                                                              <input type="text" class="form-control" id="ceo_name" name="ceo_name"  value="{{ $userInfoData->ceo_name }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-md-4 col-form-label">담당자명</label>
                                                    <div class="col-md-8 col-xs-9">
                                                      <div class="form-inline">
                                                          <div class="input-group">
                                                              <input type="text" class="form-control" id="mem_name" name="mem_name" value="{{ $userInfoData->mem_name }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-md-4 col-form-label">연락처</label>
                                                    <div class="col-md-8 col-xs-9">
                                                      <div class="form-inline">
                                                          <div class="input-group">
                                                              <input type="text" class="form-control" id="cellno" name="cellno" value="{{ $userInfoData->cellno }}">
                                                              <input class="btn btn-info waves-effect btn-xs ml-1" type="button" value="SMS 보내기">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-md-4 col-form-label">만료알림 연락처</label>
                                                    <div class="col-md-8 col-xs-9">
                                                      <div class="form-inline">
                                                          <div class="input-group">
                                                              <input type="text" class="form-control" id="phoneno" name="phoneno" value="{{ $userInfoData->phoneno }}">
                                                              <input class="btn btn-info waves-effect btn-xs ml-1" type="button" value="SMS 보내기">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-md-4 col-form-label">이메일</label>
                                                    <div class="col-md-8 col-xs-9">
                                                      <div class="form-inline">
                                                          <div class="input-group">
                                                              <input type="text" class="form-control" id="mem_email" name="mem_email" value="{{ $userInfoData->mem_email }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-md-4 col-form-label">로그정보</label>
                                                    <div class="col-md-8 col-xs-9">
                                                        <div class="form-inline">
                                                            <p class="input-group">
                                                                <p class="form-control-static mt-1 mb-1">
                                                                    로그정보
                                                                </p>
                                                            <p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- form end -->
                                            </div><!--col end-->
                                      @endif
                                    </div><!--row end-->
                                </div><!--col end-->
                            </div><!--row end-->
                        </div><!--nav-cc end-->
                    </div><!--tab-content end-->

                </div>
            </div><!-- 전체를 감싸고있는 박스 -->
