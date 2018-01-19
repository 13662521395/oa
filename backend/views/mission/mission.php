<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use app\models\OaUser;
$session = Yii::$app->session;
$session->open();
/* @var $this yii\web\View */
/* @var $model app\models\OaMission */

date_default_timezone_set("Asia/Shanghai");
?>
<style>
    /*去掉谷歌默认黄色input框*/
    input:-webkit-autofill , textarea:-webkit-autofill, select:-webkit-autofill {
        -webkit-text-fill-color: #ededed !important;
        -webkit-box-shadow: 0 0 0px 1000px transparent  inset !important;
        background-color:transparent;
        background-image: none;
        transition: background-color 50000s ease-in-out 0s; //背景色透明  生效时长  过渡效果  启用时延迟的时间
    }
    input {
        background-color:transparent;
    }

    .panel{

        background-color:#EEEEEE ;
        min-height: 90%;
        margin-top: 2.0em;
        box-shadow: 0px 0px 3px  #666;  /*右  下  全 */
    }
    .label>a{color:#fff}
    .mission{
        -webkit-border-radius:3px;
        -moz-border-radius:3px;
        border-radius:3px;
        width:95%;
        min-height: 10%;
        margin:1.0em auto;
        background-color: #FFF;
        overflow: hidden;
        box-shadow:0px 0px 1px #666;
    }
    .status,.m_content,.person{
        float: left;
        margin:2px;
    }
    .status{
        width: 15%;
    }
    .m_content{
        width:65%;
        padding-top: 1.5em;
        word-wrap: break-word; word-break: normal;
    }
    .person{width: 15%;padding-top: 1.3em}
    .person>img{width: 80%;}
    .checkbox{
        width: 50%;
    }
    .m_import{
        display: none;
    }
    .biaoti{
        font-weight: bold;
    }
    textarea{
        min-height: 200px;
    }
    form{
        width: 80%;
        margin:0 auto;
    }
</style>

<div class="row clearfix">
        <div class="col-md-6 column">
            <div class="row clearfix">
                <div class="col-md-6 column">
                    <div class="panel panel-info" ondrop="drop(event)" ondragover="allowDrop(event)">
                        <blockquote><p class="biaoti">
                                待处理·5
                                <span class="label label-warning pull-right"> <a id="modal-503070" href="#modal-container-503070" data-toggle="modal">添加</a></span>
                            </p></blockquote>
                        <?php foreach ($rs as $k=>$val): ?>
                            <!--href="#modal-container-842957" data-toggle="modal"-->
                        <div class="mission" id="mission<?= $k?>" href="#modal-container-842957" data-toggle="modal" draggable='true' ondragstart="drag(event)"><!--style="background: rgba(238,238,238,0.7);"-->
                            <div class="status">
                                <div class="checkbox checkbox-danger">
                                    <input id="checkbox3" class="styled" type="checkbox">
                                    <label for="checkbox3">

                                    </label>
                                </div>
                            </div>
                            <div class="m_content">
                                <?=$val->m_content?>
                            </div>
                            <div class="person">
                                <?php
                                $filename=$val->oaUser['oa_uname'];
                                if(file_exists("assets/head/creat/".$filename.".jpg"))
                                {
                                    echo "<img src='assets/head/creat/$filename.jpg' class='img-circle' width='60'>";
                                }
                                else
                                {
                                    echo '<img src="assets/head/creat/ui-sam.jpg" class="img-circle" width="60">';
                                }
                                ?>
                            </div>
                            <span class="m_import"><?=$val->m_import?></span>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="col-md-6 column">
                    <div class="panel panel-info" ondrop="drop(event)" ondragover="allowDrop(event)">
                        <blockquote><p class="biaoti">
                                完成中·4
                        </p></blockquote>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 column">
            <div class="row clearfix">
                <div class="col-md-6 column">
                    <div class="panel panel-info" ondrop="drop(event)" ondragover="allowDrop(event)">
                        <blockquote><p class="biaoti">
                                待审核·2
                            </p></blockquote>

                    </div>
                </div>
                <div class="col-md-6 column">
                    <div class="panel panel-info" ondrop="drop(event)" ondragover="allowDrop(event)">
                        <blockquote><p class="biaoti">
                                已完成·2
                            </p></blockquote>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!--定位表单 添加-->
<div class="modal fade" id="modal-container-503070" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel">
                    添加任务
                </h4>
            </div>
            <div class="modal-body">
                <?php $form = ActiveForm::begin(); ?>
                <?= $form->field($model, 'm_content')->label('任务详情')->textarea(['rows'=>3]) ?>

                <?= $form->field($model, 'm_user')->HiddenInput(['value'=>$session->get('uid')])->label(false); ?>
                <?= $form->field($model, 'm_joinusers',['inputOptions' => ['multiple '=>'multiple ','class'=>'form-control','name'=>'OaMission[m_joinusers][]']])->label('参与人(Ctrl多选)')->dropdownList(ArrayHelper::map($joinusers, 'oa_uid', 'oa_nickname')) ?>

                <?= $form->field($model, 'm_import')->dropdownList(['1'=>'普通','2'=>'紧急','3'=>'非常紧急'],['prompt'=>'- - 请确定任务优先级 - -']) ?>

            </div>

            <div class="modal-footer">
                <button type="" class="btn btn-default" data-dismiss="modal">关闭</button>
                <input type="submit" name="sub" class="btn btn-success" >
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>


<!--显示修改页面-->

<div class="modal fade" id="modal-container-842957" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel">
                    标题
                </h4>
            </div>
            <div class="modal-body">
                内容...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button> <button type="button" class="btn btn-primary">保存</button>
            </div>
        </div>

    </div>

</div>
<script type="text/javascript">
      $(function () { $('#myModal').on('hide.bs.modal', function () {
        alert('嘿，我听说您喜欢模态框...');})
      });
</script>

<script type="text/javascript">
    function changeState(el) {
        if (el.readOnly) el.checked=el.readOnly=false;
        else if (!el.checked) el.readOnly=el.indeterminate=true;
    }
</script>
<script>
    //以下代码为默认判断任务优先级，并加不同颜色的边框
    $(document).ready(
        function () {
            var x = $(".m_import").length;
            for(i=0;i<x;i++)
            {
                var borders = $(".m_import").eq(i).text();
                if(borders==1)
                {
                    $(".mission").eq(i).css({"border-left":"2px solid #000"});
                }
                else if(borders==2)
                {
                    $(".mission").eq(i).css({"border-left":"2px solid #FFCE44"});
                }
                else if(borders==3)
                {
                    $(".mission").eq(i).css({"border-left":"2px solid #f00"});
                }
            }

        }
    );
    //以下代码为 鼠标经过-离开触发事件 边框变大
    $(".mission").hover(
        function () {
            var type = $(this).children().last().text();
            //m_import

            if(type==1) //普通
            {
                /*$(this).css({"border-left":"5px solid #000","transform":"2s all"});*/
                $(this).css({"box-shadow":"-3px 0px 0px #000","transform":"2s all"});
            }
            else if(type==2) //紧急
            {
                $(this).css({"box-shadow":"-3px 0px 0px #FFCE44","transform":"2s all"});
            }
            else if(type==3) //非常晋级
            {
                $(this).css({"box-shadow":"-3px 0px 0px #f00","transform":"2s all"});
            }

        },
        function () {
           var type = $(this).children().last().text();
            if(type==1)
            {
                $(this).css({"box-shadow":"0px 0px 1px #000"});
            }
            else if(type==2)
            {
                $(this).css({"box-shadow":"0px 0px 1px #FFCE44"});
            }
            else if(type==3)
            {
                $(this).css({"box-shadow":"0px 0px 1px #f00"});
            }

        }
    );
    //以下代码为鼠标开始拖动div块 ondrop="drop(event)" ondragover="allowDrop(event)
    function drag(ev)    //开始拖动目标
    {
        ev.dataTransfer.setData("Text",ev.target.id);
    }


    function allowDrop(ev)  //拖动经过终点
    {

        ev.preventDefault();
    }

    function drop(ev)    //降落目标
    {
        ev.preventDefault();
        var data=ev.dataTransfer.getData("Text");
        //alert(data);
        ev.target.appendChild(document.getElementById(data));
    }
    
    //添加任务
    $(".addmission").click(function () {
        $(".add").slideDown('slow');
        $("#container").css({"background":"rgba(0,0,0,0.5)"});
        $(".panel").css({"background":"rgba(0,0,0,0.)"});
        $(".mission").css({"background":"rgba(0,0,0,0.5)"});

    });
</script>