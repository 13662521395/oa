<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use app\models\OaMission;
use app\models\OaUser;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;

date_default_timezone_set("Asia/Shanghai");

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '任务申请';
$this->params['breadcrumbs'][] = $this->title;

$session=Yii::$app->session;

$session->open();

$model = new OaUser();
?>
<html>
    <head>
        <title></title>
        <style type="text/css">
            .red{border-left:5px solid #f00;}
            .blue{border-left:5px solid #ffe78b;}
            .green{border-left:5px solid #00ff4d;}
        </style>
    </head>
<body>
<!-- InsertModal -->
<div class="modal fade" id="IndexModal" onclick="return leave()" aria-hidden="true" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style="padding:15px">
            <div class="modal-body">

            </div>
            <div class="dis" id="dd">
                备注：<input type="text" class="cat" />
                <button class="btn btn-sm btn-success" onclick="return play()">通过</button>
                <button class="btn btn-sm btn-danger" onclick="return player()">拒绝</button>
            </div>
        </div>
    </div>
</div>

<div class="breadcrumbs" id="breadcrumbs">
    <script type="text/javascript">
        try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
    </script>

    <ol class="breadcrumb">
        <li><a href="<?= Url::toRoute(['mission/index'])?>">首页</a></li>
        <li>任务</li>
    </ol>
</div>

<div class="col-sm-12 col-xs-12 widget-container-span">
    <div class="widget-box transparent">
        <div class="widget-header">
            <a href="<?= Url::toRoute(['mission/create'])?>"><button style="border-radius:10px;padding:2px 20px" class="btn btn-sm btn-primary">申请任务</button></a>
            <div class="widget-toolbar no-border">
                <ul class="nav nav-tabs" id="myTab2">
                    <li class="active">
                        <a data-toggle="tab" href="#home2">已申请</a>
                    </li>

                    <li>
                        <a data-toggle="tab" href="#profile2">进行中</a>
                    </li>

<!--                    <li>-->
<!--                        <a data-toggle="tab" href="#info2">已完成</a>-->
<!--                    </li>-->
                </ul>
            </div>
        </div>

        <div class="widget-body">
            <div class="widget-main padding-12 no-padding-left no-padding-right">
                <div class="tab-content padding-4">
                    <div id="home2" class="tab-pane in active">
                        <div class="slim-scroll" data-height="100">

            <div class="row">
                <div class="col-xs-12">

            <div class="table-responsive">
                <table id="sample-table-2" class="table table-striped table-bordered table-hover">
                    <thead>
                    <tr>
                        <th style="width:5%">
                       
                        </th>
                        <th>任务</th>
                        <th>申请人</th>
                        <th>预计时间</th>
                        <th>
                            <i class="icon-time bigger-110 hidden-480"></i>
                            申请时间
                        </th>

                        <th>
                            <i class="icon-time bigger-110 hidden-480"></i>
                            修改时间
                        </th>

                        <th class="hidden-480">截止日期</th>

                        <th style="width:20%"></th>
                    </tr>
                    </thead>

                    <tbody style="font-color:#fff">
               <?php foreach($data as $val){?>
                    <tr class="<?php if($val->m_import == 1){echo "green";}
                    else if($val->m_import == 2){echo "blue";}
                    else {echo "red";}?>">
                        <td>
                            <?= $val->m_id?>
                            <?php if($val->m_big_check != 0 && $val->m_biger_check != 0){?>
                            <a  style="border-radius:10px" onclick="return reday(this)" name="<?= $val->m_id;?>" ><button class="btn btn-xs btn-success aa" data-toggle="modal" data-target="#IndexModal">开始</button></a>
                            <?php }?>
                        </td>
                        <script>
                        function reday(obj){
                            var mis_id = $(obj).attr('name');
                            if(mis_id)
                            {
                                $("#dd").replaceWith(' 预计时间：<input type="text" class="yuj" value="0">小时<span class="yu1" style="color:#f00"></span><br /><button class="btn btn-sm btn-success tong">确定</button>' );
                                $(".tong").click(function(){1000
                                  var yuj = $(".yuj").val();
                                  if(yuj == 0)
                                  {
                                    $(".yu1").html('剩余时间为0，任务直接完成');
                                   
                                  }
                                  if(yuj == '' ){
                                     $(".yu1").html('剩余时间不能为空');
                                    
                                  }
                                  if((yuj != '') && (yuj != 0))
                                  {
                                    $.get("<?=Url::toRoute('mission/complete')?>",{mis_id:mis_id,yuj:yuj},function(date){
                                           if(date) history.go(0);
                                    });
                                  }
                                })
                              
                            }
                            
                        }
                        </script>
                        <td>
                            <?= $val->m_name?>
                        </td>

                        <input type="hidden" class="import" value="<?= $val->m_import?>" />

                        <td><?= $val->oaUser['oa_nickname'];?></td>
                        <td>
                            <?= $val->m_estima?>
                        </td>
                        <td class="hidden-480"><?= $val->m_creat_time?></td>
                        <td><?php if($val->m_edit_time == ''){
                                echo '近期未修改';
                            }else{
                                echo $val->m_edit_time;
                            }?></td>

                        <td class="hidden-480">
                            <?= $val->m_endtime?>
                        </td>

                        <td>
                            <a  style="border-radius:10px" href="#" class="btn btn-xs btn-success begin" onclick="return check(this)" name="<?= $val->m_id;?>" id="<?= $val->oaUser['oa_nickname'];?>" data-toggle="modal" data-target="#IndexModal">
                                <i class="icon-ok bigger-120" style="border-radius:10px">查看</i>
                            </a>

                           <?php if($val->m_big_check == 0){?>
                           <a  style="border-radius:10px" href="<?= Url::toRoute(['mission/update','id'=>$val->m_id])?>" class="btn btn-xs btn-primary">
                                    <i class="icon-edit bigger-120" style="border-radius:10px">修改</i>
                           </a>
                           <?php }?>

                           <?php if($val->m_big_check == 1 && $val->m_biger_check == 1){?>
                            <a  style="border-radius:10px" href="<?= Url::toRoute(['mission/indexson','id'=>$val->m_id])?>" class="btn btn-xs btn-default">
                                    <i class="icon-edit bigger-120" style="border-radius:10px">子任务</i>
                            </a>
                           <?php }?>

                           <?php if($val->m_big_check == 0){?>
                           <a  style="border-radius:10px" onclick="return confirm('您确定要删除吗？')" href="<?= Url::toRoute(['mission/delete','id'=>$val->m_id])?>" class="btn btn-xs btn-danger">
                                    <i class="icon-trash bigger-120">删除</i>
                           </a>
                           <?php }?>
                            

                        </td>
                    </tr>
               <?php }?>
                    </tbody>
                </table>
                    <?=
                        // 显示分页
                        LinkPager::widget([
                            'pagination' => $page,
                        ]);
                    ?>
            </div>
        </div>
    </div>

                        </div>
                    </div>

                    <div id="profile2" class="tab-pane">
                        <div class="slim-scroll" data-height="100">
                <div class="row">
                    <div class="col-xs-12">

                        <div class="table-responsive">
                            <table id="sample-table-2" class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th style="width:5%">

                                    </th>
                                    <th>任务</th>
                                    <th>申请人</th>
                                    <th>
                                        <i class="icon-time bigger-110 hidden-480"></i>
                                        申请时间
                                    </th>

                                    <th>
                                        <i class="icon-time bigger-110 hidden-480"></i>
                                        修改时间
                                    </th>

                                    <th class="hidden-480">截止日期</th>

                                    <th style="width:20%"></th>
                                </tr>
                                </thead>

                                <tbody style="font-color:#fff">
                                <?php foreach($mission as $val){?>
                                    <tr class="<?php if($val->m_import == 1){echo "green";}
                                    else if($val->m_import == 2){echo "blue";}
                                    else {echo "red";}?>">
                                        <td>
                                            <?= $val->m_id?>
                                        </td>

                                        <td>
                                            <?= $val->m_name?>
                                        </td>

                                        <input type="hidden" class="import" value="<?= $val->m_import?>" />

                                        <td><?=
                                            //                                $arr = explode(',',$val->m_joinusers);
                                            //                                $users = '';
                                            //                                $i = 0;
                                            //                                foreach($arr as $v){
                                            //                                    //echo $v;
                                            //                                    $user = OaUser::findOne($v);
                                            //
                                            //                                    $users.= $user['oa_nickname'].'，';
                                            //                                }
                                            //                                echo trim($users,'，');
                                            $val->oaUser['oa_nickname'];
                                            ?></td>
                                        <td class="hidden-480"><?= $val->m_creat_time?></td>
                                        <td><?php if($val->m_edit_time == ''){
                                                echo '近期未修改';
                                            }else{
                                                echo $val->m_edit_time;
                                            }?></td>

                                        <td class="hidden-480">
                                            <?= $val->m_endtime?>
                                        </td>

                                        <td>
                                                <a href="#" style="border-radius:10px" class="btn btn-xs btn-success begin" onclick="return checkll(this)" name="<?= $val->m_id;?>" id="<?= $val->oaUser['oa_nickname'];?>" data-toggle="modal" data-target="#IndexModal">
                                                    <i class="icon-ok bigger-120">查看</i>
                                                </a>

                                                <?php if($val->m_big_check == 0){?>
                                                    <a href="<?= Url::toRoute(['mission/update','id'=>$val->m_id])?>" class="btn btn-xs btn-primary">
                                                        <i class="icon-edit bigger-120">修改</i>
                                                    </a>
                                                <?php }?>

                                                <?php if($val->m_big_check == 1 && $val->m_biger_check == 1){?>
                                                    <a style="border-radius:10px" href="<?= Url::toRoute(['mission/indexson','id'=>$val->m_id])?>" class="btn btn-xs btn-default">
                                                        <i class="icon-edit bigger-120">子任务</i>
                                                    </a>
                                                <?php }?>

                                                <?php if($val->m_big_check == 0){?>
                                                    <a style="border-radius:10px" onclick="return confirm('您确定要删除吗？')" href="<?= Url::toRoute(['mission/delete','id'=>$val->m_id])?>" class="btn btn-xs btn-danger">
                                                        <i class="icon-trash bigger-120">删除</i>
                                                    </a>
                                                <?php }?>
                                        </td>
                                    </tr>
                                <?php }?>
                                </tbody>
                            </table>
                            <?=
                            // 显示分页
                            LinkPager::widget([
                                'pagination' => $page,
                            ]);
                            ?>
                        </div>
                    </div>
                </div>
                        </div>
                    </div>

<!--                    <div id="info2" class="tab-pane">-->
<!--                        <div class="slim-scroll" data-height="100">-->
<!--                            <p class="alert alert-info"></p>-->
<!--                        </div>-->
<!--                    </div>-->
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function check(obj){
        $.get("<?= Url::toRoute(['mission/ajax'])?>",{user_id:$(obj).attr('name')},function(e){
            var str = eval("("+e+")");
            var nickname = $(obj).attr('id');
            $('.modal-body').html('<p style="display:none" class="dog" name='+$(obj).attr('name')+'></p><p>申请人:&nbsp;&nbsp;'+nickname+'</p><p>任务详情:&nbsp;&nbsp;'+str['m_content']+'</p><p>申请时间:&nbsp;&nbsp;'+str['m_creat_time']+'</p><p>截至时间:&nbsp;&nbsp;'+str['m_endtime']+'</p>');
        });
    }
    function checkll(obj){
        $.get("<?= Url::toRoute(['mission/ajax'])?>",{user_id:$(obj).attr('name')},function(e){
            var str = eval("("+e+")");
            var nickname = $(obj).attr('id');
            $('.modal-body').html('<p style="display:none" class="dog" name='+$(obj).attr('name')+'></p><p>申请人:&nbsp;&nbsp;'+nickname+'</p><p>任务详情:&nbsp;&nbsp;'+str['m_content']+'</p><p>申请时间:&nbsp;&nbsp;'+str['m_creat_time']+'</p><p>截至时间:&nbsp;&nbsp;'+str['m_endtime']+'</p>');
            if(str['m_complete']==1){
                $('.dis').css('display','none');
            }
        });
    }

    function play(){
        $.get("<?= Url::toRoute(['mission/play'])?>",{userId:$('.dog').attr('name'),command:$('.cat').val()});
        location.reload(true);
    }

    function player(){
        $.get("<?= Url::toRoute(['mission/player'])?>",{userId:$('.dog').attr('name'),command:$('.cat').val()});
        location.reload(true);
    }
</script>
    </body>
</html>