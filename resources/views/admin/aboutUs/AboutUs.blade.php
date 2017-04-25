<!-- content start -->
<script src={{url("/admin/js/aboutus_app.js")}}></script>
<!-- <div id="slide-target"> -->
<div class="admin-content" id="admin-content">

    <div class="am-cf am-padding">
        <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">表格</strong> / <small>Table</small></div>
    </div>

    <div class="am-g">
        <div class="am-u-md-6 am-cf">
            <div class="am-fl am-cf">
                <div class="am-btn-toolbar am-fl">
                    <div class="am-btn-group am-btn-group-xs">
                        <button type="button" id="add" class="am-btn am-btn-default"><span class="am-icon-plus"></span> 新增</button>
                        <button type="button" class="am-btn am-btn-default"><span class="am-icon-save"></span> 保存</button>
                        <button type="button" class="am-btn am-btn-default"><span class="am-icon-archive"></span> 审核</button>
                        <button type="button" class="am-btn am-btn-default"><span class="am-icon-trash-o"></span> 删除</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="am-u-md-3 am-cf">
            <div class="am-fr">
                <div class="am-input-group am-input-group-sm">
                    <form action={{url('/admin/new')}} method="get">
                        <input style="width:179px;height:36px;" name="search" type="text" class="searchval am-form-field">
                        <span class="am-input-group-btn">
                    <input style="height:36px;width:56px;font-size: 1.4rem;" class="am-btn search am-btn-default" type="submit" value="搜索">
                  </span>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="am-g">
        <div class="am-u-sm-12">
            <div class="result_wrap">
                <div class="result_content">
                    <table class="table" id="about_table">
                        <tr style="">
                            <th style="width: 10%;">title</th>
                            <th style="width: 80%;">content</th>
                            <th style="width: 10%;">do work</th>
                        </tr>
                        @if(!empty($tasks))
                            @foreach($tasks as $k=>$v)
                                @if($k == 'id')
                                    @continue
                                @else
                                    <tr>
                                        <td>{{$k}}</td>
                                        <td>{{$tasks->$k}}</td>
                                        <td>
                                            <button  class="btn btn-info edit">编辑</button>
                                            <button class="btn btn-danger delete" <?= empty($v)?'disabled="true"':'' ?>>删除</button>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        @else
                            <tr id="noabout"><td colspan=4 style="text-align: center">暂无介绍</td></tr>
                        @endif
                    </table>
                </div>
            </div>
            <hr />
        </div>
    </div>
</div>
<!-- Large modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="exampleModalLabel">添加信息</h4>
            </div>
            <div class="modal-body">
                <form>
                    {{csrf_field()}}
                    <div class="form-group" id="infor_div">
                        <label for="message-text" class="control-label" >简介:</label>
                        <textarea class="form-control" name="infor" id="infor"></textarea>
                    </div>
                    <div class="form-group" id="service_div">
                        <label for="message-text" class="control-label" >产品服务:</label>
                        <textarea class="form-control" name="service" id="service"></textarea>
                    </div>
                    <div class="form-group" id="advantage_div">
                        <label for="message-text" class="control-label" >创新优势:</label>
                        <textarea class="form-control" name="advantage" id="advantage"></textarea>
                    </div>
                    <div class="form-group" id="contact_div">
                        <label for="message-text" class="control-label" >联系:</label>
                        <textarea class="form-control" name="contact" id="contact"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <span id="error_span" style="color: red"></span>
                <button type="button" class="btn btn-primary" id="submit_btm">Send message</button>
            </div>
        </div>
    </div>
</div>
<!-- </div> -->
<!-- content end -->