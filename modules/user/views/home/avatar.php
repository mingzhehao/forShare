<?php 
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
        
    <div class="page-header">
        <h1>
            个人设置
            <ul id="w0" class="nav nav-tabs"><li><a href="/user/site/index">个人信息</a></li>
                <li class="active"><a href="/user/site/avatar">修改头像</a></li>
                <li><a href="/user/site/password">修改密码</a></li>
                <li><a href="/user/site/third">第三方登录</a></li>
            </ul>    
        </h1>
    </div>

    <div class="preview">
        <div class="avatar-big">
            <img src="/uploads/avatar/000/02/88/93_avatar_big.jpg" alt="">  </div>
        <div class="avatar-middle">
            <img src="/uploads/avatar/000/02/88/93_avatar_middle.jpg" alt="">   </div>
        <div class="avatar-small">
            <img src="/uploads/avatar/000/02/88/93_avatar_small.jpg" alt="">    </div>
    </div>
        <?php
        $form = ActiveForm::begin([
            'id'    =>  'AvatarForm',
            'options'=>['enctype'=>'multipart/form-data'], // important
            //'name' => 'AvatarForm',
            'method' => 'post',
            'action' => '/User/avatar',
        ]);
         
         
        /**
        * uncomment for multiple file upload
        *
        echo $form->field($model, 'image[]')->widget(FileInput::classname(), [
            'options'=>['accept'=>'image/*', 'multiple'=>true],
            'pluginOptions'=>['allowedFileExtensions'=>['jpg','gif','png']
        ]);
        *
        */
        ?>
        <div class="form-group field-avatarform-x">
            <input type="hidden" id="x" class="form-control" name="AvatarForm[x]"> 
            <div class="help-block"></div>
        </div>
        <div class="form-group field-avatarform-y">
            <input type="hidden" id="y" class="form-control" name="AvatarForm[y]">
        </div>
        <div class="form-group field-avatarform-w">
            <input type="hidden" id="w" class="form-control" name="AvatarForm[w]">
        </div>
        <div class="form-group field-avatarform-h">
            <input type="hidden" id="h" class="form-control" name="AvatarForm[h]">
        </div>
        <div class="fileinput fileinput-new" data-provides="fileinput">
            <div class="fileinput-new thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;">
                <img src="/uploads/avatar/000/02/88/93_avatar_big.jpg" alt="">  </div>
            <div class="fileinput-preview fileinput-exists thumbnail" style="line-height: 10px;"></div>
            <div>
                <span class="btn btn-default btn-file">
                    <span class="fileinput-new">选择头像</span>
                    <span class="fileinput-exists">重新选择</span>
                    <input type="hidden" name="AvatarForm[file]" value=""><input type="file" id="avatarform-file" name="AvatarForm[file]">      </span>
                <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">取消</a>
                <button type="submit" class="btn btn-primary">修改</button> 
            </div>
        </div>
    <?php
        ActiveForm::end();
    ?>

<script type="text/javascript">
jQuery(document).ready(function () {
$(".fileinput").fileinput().on("change.bs.fileinput", function(){
    $(".fileinput-preview img").Jcrop({
        aspectRatio: 1,
        minSize: [120, 120],
        onSelect: showPreview,
        onChange: showPreview
    },function(){
        jcrop_api = this;
    });
}).on("clear.bs.fileinput", function(){jcrop_api.disable();});
function showPreview(c)
{
    $("#x").val(c.x);
    $("#y").val(c.y);
    $("#w").val(c.w);
    $("#h").val(c.h);

    var preview = $(".fileinput-preview img");
    $(".avatar-big img, .avatar-middle img, .avatar-small img").attr("src", preview.attr("src"));

    var rx = 200 / c.w;
    var ry = 200 / c.h;
    $(".avatar-big img").css({
        width: Math.round(rx * preview.width()) + "px",
        height: Math.round(ry * preview.height()) + "px",
        marginLeft: "-" + Math.round(rx * c.x) + "px",
        marginTop: "-" + Math.round(ry * c.y) + "px"
    });

    var rx = 120 / c.w;
    var ry = 120 / c.h;
    $(".avatar-middle img").css({
        width: Math.round(rx * preview.width()) + "px",
        height: Math.round(ry * preview.height()) + "px",
        marginLeft: "-" + Math.round(rx * c.x) + "px",
        marginTop: "-" + Math.round(ry * c.y) + "px"
    });

    var rx = 48 / c.w;
    var ry = 48 / c.h;
    $(".avatar-small img").css({
        width: Math.round(rx * preview.width()) + "px",
        height: Math.round(ry * preview.height()) + "px",
        marginLeft: "-" + Math.round(rx * c.x) + "px",
        marginTop: "-" + Math.round(ry * c.y) + "px"
    });
};
});</script>
