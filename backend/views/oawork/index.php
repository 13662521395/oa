<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\LinkPager;
use yii\helpers\Url;
use yii\bootstrap\Alert;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '山东柏瑞管理系统-课时管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div>
<!-- 模态框（Modal） -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
  <div class="modal-dialog">
    <div class="modal-content" >
      <div class="modal-header" >
      <h1>温馨提示</h1>
        
      </div>
      <div class="modal-body" style="margin-left:25px">
      您确定要删除吗?
      </div>
      
      <div class="modal-footer">
        <button type="button"  data-id='' class="btn btn-primary btn-sm" id="rde" data-dismiss="modal">确定</button>
        <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal">关闭
        </button>
      </div>
    </div><!-- /.modal-content -->
  </div>
</div><!-- /.modal --> 
<div>
<!-- 模态框（Modal） -->
<div class="modal fade" id="myModals" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
  <div class="modal-dialog">
    <div class="modal-content" >
      <div class="modal-header" >
      <h1>温馨提示</h1>
        
      </div>
      <div class="modal-bodys" style="margin-left:25px">
      
      </div>
     
      <div class="modal-footer">
  
        <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal">关闭
        </button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal -->

</div> 
<div class="breadcrumbs" id="breadcrumbs">
                <script type="text/javascript">
                    try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
                </script>

                <ol class="breadcrumb">
                  <li><a href="<?= Url::toRoute(['oaaffiche/index'])?>">首页</a></li>
                  <li>课时管理</li>
                </ol>

               <div class="nav-search" id="nav-search">
                    <form class="form-search">
                                <span class="input-icon">
                                    <input type="text" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off" />
                                    <i class="icon-search nav-search-icon"></i>
                                </span>
                    </form>
                </div><!-- 面包屑导航 -->
            </div>
<div>                           
                    <?php  if( Yii::$app->getSession()->hasFlash('success') ) {
                        echo Alert::widget([
                        'options' => [
                        'class' => 'alert-success', //这里是提示框的class
                        ],
                        'body' => Yii::$app->getSession()->getFlash('success'), //消息体
                        ]);
                    }
                    if( Yii::$app->getSession()->hasFlash('error') ) {
                        echo Alert::widget([
                        'options' => [
                        'class' => 'alert-error',
                        ],
                        'body' => Yii::$app->getSession()->getFlash('error'),
                        ]);
              } ?>
</div>
<div class="col-xs-12">
                    <?php $form = ActiveForm::begin(); ?>
               <div class="form-group" style="margin: 5px;">
               <label>教师 名称:</label>
               <input type="text" name="user" id="user"></input>
                  <button type="submit" name="submit" style="border-radius: 10px" class="btn btn-primary btn-sm">搜索</button>
                  <button type="reset" name="but" style="border-radius: 10px" class="btn btn-primary btn-sm">清空</button>
                  <a id="edit_btn" onclick="lookAction(1)" style="border-radius: 10px" class="btn btn-primary btn-sm" href="<?= Url::toRoute(['oawork/create'])?>"> 添加工作</a>
              <?php ActiveForm::end(); ?>
                    <div class="table-responsive">
                      <table id="sample-table-1" class="table table-striped table-bordered table-hover">
                        <thead>
                          <tr>
                            <th>序号</th>
                            <th>教师名称</th>
                            <th>科目</th>
                            <th>课时数</th>
                            <th>课时费</th>
                            <th>时间</th>
                            <th>操作</th>
                          </tr>
                        </thead>
                        <?php 
                          $a=yii::$app->request->get('page')?yii::$app->request->get('page'):1;
                          $i=$pagesize*($a-1)+1;
                        ?>
                        <?php foreach($countries as $aid){?>
                        <tbody>
                          <tr>
                            <td><?=$i++?></td>
                            <td><?=$aid->w_teacher?></td>
                            <td><?php switch ($aid->w_subjects) {
                                case '1':
                                  echo "语文"; 
                                    break;
                                case '2':
                                  echo "数学"; 
                                    break;
                                case '3':
                                  echo "英语"; 
                                    break;
                                case '4':
                                  echo "编程"; 
                                    break;
                                case '5':
                                  echo "美工"; 
                                    break;
                                default:
                                  echo "未定义";
                                    break;
                            }?></td>
                            <td><?=$aid->w_number?></td>
                            <td><?=$aid->w_fees?></td>
                            <td><?=date('Y-m-d',time($aid->w_time))?></td>
                            <td>
                                  <a class="btn btn-xs btn-info" style="border-radius:10px" href="<?= Url::toRoute(['oawork/update','id'=>$aid->w_id]); ?>"><i class="icon-edit bigger-120">修改</i></a>
                                  <a onclick="return false" style="border-radius:10px" class="btn btn-xs ids btn-danger" href="<?= Url::toRoute(['oawork/rdelete','id'=>$aid->w_id]); ?>"><i class="icon-trash bigger-120" data-toggle="modal" data-target="#myModal" name="<?=$aid->w_id?>">删除</i></a>
                              </div>

                            </td>
                            <?php } ?>
                          </tr>
                        </tbody>
                      </table>
                      <div class="infos">
                      <?php
                        echo LinkPager::widget([
                        'pagination' => $pages,
                        'nextPageLabel'=> '下一页',
                        'prevPageLabel'=>'上一页',
                        'firstPageLabel'=>'首页',
                        'lastPageLabel'=>'尾页',
                        ]);
                      ?>
                   </div>
                    </div><!-- /.table-responsive -->
                  </div>
<script>
$(function(){
  $(".ids").click(function (){
    var id = $(this).attr('href');
    $('#rde').attr('data-id',id);
    // console.log($('#rde').attr('data-id'));
  });
  $('#rde').click(function (){
    var ids = $('#rde').attr('data-id');
    $.get(ids,{a:1},function(data){
      if(data){
        $('.modal-bodys').html('删除成功');
        $('#myModals').modal();
        $("i[name='"+data+"']").parents('tr').remove();
      }
    });
  });
});
</script>