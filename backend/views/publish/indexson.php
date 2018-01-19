<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use app\models\OaMission;
use app\models\OaPublish;
use app\models\OaUser;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;

date_default_timezone_set("Asia/Shanghai");

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '子任务分配';
$this->params['breadcrumbs'][] = $this->title;

$session=Yii::$app->session;

$session->open();

$model = new OaUser();
?>
<style type="text/css">
    .red{border-left:5px solid #f00;}
    .blue{border-left:5px solid #ffe78b;}
    .green{border-left:5px solid #00ff4d;}
</style>
<div class="oa-mission-index">
    <div class="breadcrumbs" id="breadcrumbs">
        <script type="text/javascript">
            try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
        </script>

        <ol class="breadcrumb">
            <li><a href="<?= Url::toRoute(['oaaffiche/index'])?>">首页</a></li>
            <li><a href="<?= Url::toRoute(['publish/index'])?>">任务</a></li>
            <li>子任务</a></li>
        </ol>
    </div>
</div>

<!-- InsertModal -->
<div class="modal fade" id="IndexModal" aria-hidden="true" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style="padding:15px">
            <div class="modal-body">

            </div>
        </div>
    </div>
</div>

<div class="col-sm-12 col-xs-12 widget-container-span">
    <div class="widget-box transparent">
        <div class="widget-header">
            <a href="<?= Url::toRoute(['publish/createson'])?>"><button style="padding:2px 20px" class="btn btn-sm btn-primary">添加任务</button></a>
            <div class="widget-toolbar no-border">
                <ul class="nav nav-tabs" id="myTab2">
                    <li class="active">
                        <a data-toggle="tab" href="#home2">已发布</a>
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
                                                <th class="center">
                                                    <!--                            <label>-->
                                                    <!--                                <input type="checkbox" class="ace" />-->
                                                    <!--                                <span class="lbl"></span>-->
                                                    <!--                            </label>-->
                                                </th>
                                                <th>任务</th>
                                                <th>发布人</th>
                                                <th>执行人</th>
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

                                            <tbody>

                                            <?php if(empty($data)){
                                                echo "<script>alert('暂时未添加子任务');</script>";
                                            }?>
                                            <?php foreach($data as $val){?>
                                                <tr class="<?php if($val->p_import == 1){echo "green";}
                                                else if($val->p_import == 2){echo "blue";}
                                                else {echo "red";}?>">
                                                    <td class="center">
                                                        <?= $val->p_id?>
                                                        <a onclick="return confirm('确定要开始吗？')" href="<?= Url::toRoute(['publish/complete','id'=>$val->p_id])?>"><button class="btn btn-xs btn-success">开始</button></a>
                                                    </td>

                                                    <td>
                                                        <?= $val->p_name?>
                                                    </td>
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
                                                    <td><?php  $arr = explode(',',$val->p_joinusers);
                                                             $users = '';
                                                             $i = 0;
                                                             foreach($arr as $v){
                                                                //echo $v;
                                                                $user = OaUser::findOne($v);

                                                                $users.= $user['oa_nickname'].'，';
                                                             }
                                                             echo trim($users,'，');?></td>
                                                    <td class="hidden-480"><?= $val->p_create_time?></td>
                                                    <td><?php if($val->p_edit_time == ''){
                                                            echo '近期未修改';
                                                        }else{
                                                            echo $val->p_edit_time;
                                                        }?></td>

                                                    <td class="hidden-480">
                                                        <?= $val->p_endtime?>
                                                    </td>

                                                    <td>

                                                        <div class="visible-md visible-lg hidden-sm hidden-xs btn-group">
                                                            <a href="#" id="user"class="btn btn-sm btn-success" name="<?= $val->p_id;?>" value="<?= $val->oaUser['oa_nickname'];?>" onclick="return check(this)" data-toggle="modal" data-target="#IndexModal">
                                                                <i class="icon-ok bigger-120">查看</i>
                                                            </a>

                                                            <?php if(1){?>
                                                                <a href="<?= Url::toRoute(['publish/updateson','id'=>$val->p_id])?>" class="btn btn-sm btn-primary">
                                                                    <i class="icon-edit bigger-120">修改</i>
                                                                </a>
                                                            <?php }?>

                                                            <?php if(1){?>
                                                                <a onclick="return confirm('您确定要删除吗？')" class="btn btn-sm btn-danger" href="<?= Url::toRoute(['publish/deleteson','id'=>$val->p_id])?>">
                                                                    <i class="icon-trash bigger-120">删除</i>
                                                                </a>
                                                            <?php }?>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php }?>
                                            </tbody>
                                        </table>
                        <!--  分页  -->
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
                                                <th class="center">
                                                    <!--                            <label>-->
                                                    <!--                                <input type="checkbox" class="ace" />-->
                                                    <!--                                <span class="lbl"></span>-->
                                                    <!--                            </label>-->
                                                </th>
                                                <th>任务</th>
                                                <th>发布人</th>
                                                <th>执行人</th>
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

                                            <tbody>

                                            <?php foreach($publish as $val){?>
                                                <tr class="<?php if($val->p_import == 1){echo "green";}
                                                else if($val->p_import == 2){echo "blue";}
                                                else {echo "red";}?>">
                                                    <td class="center">
                                                        <?= $val->p_id?>
                                                    </td>

                                                    <td>
                                                        <?= $val->p_name?>
                                                    </td>
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
                                                    <td><?php  $arr = explode(',',$val->p_joinusers);
                                                        $users = '';
                                                        $i = 0;
                                                        foreach($arr as $v){
                                                            //echo $v;
                                                            $user = OaUser::findOne($v);

                                                            $users.= $user['oa_nickname'].'，';
                                                        }
                                                        echo trim($users,'，');?></td>
                                                    <td class="hidden-480"><?= $val->p_create_time?></td>
                                                    <td><?php if($val->p_edit_time == ''){
                                                            echo '近期未修改';
                                                        }else{
                                                            echo $val->p_edit_time;
                                                        }?></td>

                                                    <td class="hidden-480">
                                                        <?= $val->p_endtime?>
                                                    </td>

                                                    <td>

                                                        <div class="visible-md visible-lg hidden-sm hidden-xs btn-group">
                                                            <a href="#" id="user"class="btn btn-sm btn-success" name="<?= $val->p_id;?>" value="<?= $val->oaUser['oa_nickname'];?>" onclick="return checkll(this)" data-toggle="modal" data-target="#IndexModal">
                                                                <i class="icon-ok bigger-120">查看</i>
                                                            </a>

                                                            <?php if(1){?>
                                                                <a href="<?= Url::toRoute(['publish/updateson','id'=>$val->p_id])?>" class="btn btn-sm btn-primary">
                                                                    <i class="icon-edit bigger-120">修改</i>
                                                                </a>
                                                            <?php }?>

                                                            <?php if(1){?>
                                                                <a onclick="return confirm('您确定要删除吗？')" class="btn btn-sm btn-danger" href="<?= Url::toRoute(['publish/deleteson','id'=>$val->p_id])?>">
                                                                    <i class="icon-trash bigger-120">删除</i>
                                                                </a>
                                                            <?php }?>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php }?>
                                            </tbody>
                                        </table>
                                        <!--  分页  -->
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
        $.get("<?= Url::toRoute(['publish/ajax'])?>",{user_id:$(obj).attr('name')},function(e){
            var str = eval("("+e+")");
            var nickname = $(obj).attr('value');
            $('.modal-body').html('<p style="display:none" class="dog" name='+$(obj).attr('name')+'></p><p>发布人:&nbsp;&nbsp;'+nickname+'</p><p>任务详情:&nbsp;&nbsp;'+str['p_content']+'</p><p>申请时间:&nbsp;&nbsp;'+str['p_create_time']+'</p><p>截至时间:&nbsp;&nbsp;'+str['p_endtime']+'</p>');
        });
    }
    function checkll(obj){
        $.get("<?= Url::toRoute(['publish/ajax'])?>",{user_id:$(obj).attr('name')},function(e){
            var str = eval("("+e+")");
            var nickname = $(obj).attr('value');
            $('.modal-body').html('<p style="display:none" class="dog" name='+$(obj).attr('name')+'></p><p>发布人:&nbsp;&nbsp;'+nickname+'</p><p>任务详情:&nbsp;&nbsp;'+str['p_content']+'</p><p>申请时间:&nbsp;&nbsp;'+str['p_create_time']+'</p><p>截至时间:&nbsp;&nbsp;'+str['p_endtime']+'</p>');
            if(str['p_complete']==1){
                $('.dis').css('display','none');
            }
        });
    }
</script>


