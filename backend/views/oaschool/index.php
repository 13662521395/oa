<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\LinkPager;
use yii\helpers\Url;
use yii\bootstrap\Alert;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '山东柏瑞管理系统-校区';
$this->params['breadcrumbs'][] = $this->title;
?>
<!--<script type="text/javascript">
window.setTimeout(function() {
    $('.alert').alert('close');
}, 3000);
</script>-->
<div>
<!-- 模态框（Modal） -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
  <div class="modal-dialog">
    <div class="modal-content" >
      <div class="modal-header" >
      <h1>校区详情</h1>
        
      </div>
      <div class="modal-body" style="margin-left:20px">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal">关闭
        </button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal -->

</div> 
<div>
<!-- 模态框（Modal） -->
<div class="modal  fade" id="myModall" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
  <div class="modal-dialog">
    <div class="modal-content" >
      <div class="modal-header" >
      <h1>温馨提示</h1>
        
      </div>
      <div class="modal-bodyy" style="margin-left:20px">
            您确定要删除吗？
      </div>
      
      <div class="modal-footer">
        <button type="button"  data-id='' class="btn btn-primary btn-sm" id="rde" data-dismiss="modal">确定</button>
        <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal">关闭
        </button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal -->

</div> 
<div>
<!-- 模态框（Modal） -->
<div class="modal  fade" id="myModals" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
  <div class="modal-dialog">
    <div class="modal-content" >
      <div class="modal-header" >
      <h1>温馨提示</h1>
        
      </div>
      <div class="modal-bodys" style="margin-left:20px">
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
                  <li>校区</li>
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
               <div class="form-group" style="margin-top: 10px;">
               <label>校区 名称:</label>
               <input type="text" name="user" id="user"></input>
                  <button type="submit" name="submit"    class="btn btn-primary btn-sm" style="border-radius: 10px">搜索</button>
                  <button type="reset" name="but" class="btn btn-primary btn-sm" style="border-radius: 10px">清空</button>
                  <a id="edit_btn" onclick="lookAction(1)" class="btn btn-primary btn-sm" href="<?= Url::toRoute(['oaschool/create'])?>" style="border-radius: 10px"> 添加校区</a>
              <?php ActiveForm::end(); ?>
                    <div class="table-responsive">
                      <table id="sample-table-1" class="table table-striped table-bordered table-hover" style="margin-top:10px">
                        <thead>
                          <tr>
                            <th>序号</th>
                            <th>校区名称</th>
                            <th>学校编号</th>
                            <th>学校地址</th>
                            <th>校区简介</th>
                            <th>校区负责人</th>
                            <th>校区添加人</th>
                            <th>加入时间</th>
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
                            <td><?=$aid->school_name?></td>
                            <td><?=$aid->school_number?></td>
                            <td><?=$aid->school_address?></td>
                            <td><?php mb_strwidth($aid->school_syno,'utf8')>20;
                            $str = mb_strimwidth($aid->school_syno, 0, 20, '...', 'utf8');
                            echo $str;
                            ?></td>
                            <td><?=$aid->school_leader?></td>
                            <td><?=$aid->school_addper?></td>
                            <td><?=date('Y-m-d',time($aid->school_creattime))?></td>

                            <td>
                                  <a class="btn btn-xs btn-success" style="border-radius: 10px; border"><i class="icon-ok bigger-120" data-toggle="modal" data-target="#myModal" onclick="return fun1(this)" name="<?=$aid->school_id?>">查看</i></a>
                                  <a class="btn btn-xs btn-info " style="border-radius: 10px" href="<?= Url::toRoute(['oaschool/update','id'=>$aid->school_id]); ?>"><i class="icon-edit bigger-120">修改</i></a>
                                  <a class="btn btn-xs btn-danger ids" style="border-radius: 10px" onclick="return false" href="<?= Url::toRoute(['oaschool/rdelete','id'=>$aid->school_id]); ?>"><i class="icon-trash bigger-120" data-toggle="modal" data-target="#myModall" name="<?=$aid->school_id?>">删除</i></a>
                               

                                <!--<button class="btn btn-xs btn-warning">
                                  <i class="icon-flag bigger-120"></i>
                                </button>-->
                              
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
<script type="text/javascript">
    function fun1(obj)
    {
      var a=$(obj).attr('name');

      $.get("<?= Url::toRoute(['oaschool/ajax'])?>",{a:a},function(date)
      {
           var str = eval("("+date+")");
           $(".modal-body").html('<tr><td>校区名称：'+str['school_name']+'</td></tr>          <tr><td>学校编号：'+str['school_number']+'</td></tr>                             <tr><td>学校地址：'+str['school_address']+'</td></tr>                            <tr><td>校区简介：'+str['school_syno']+'</td></tr>                               <tr><td>校区负责人：'+str['school_leader']+'</td></tr>                           <tr><td>校区添加人：'+str['school_addper']+'</td></tr>')
      })
      return false;
    }
    $(".ids").click(function (){
      var id = $(this).attr('href')
      $('#rde').attr('data-id',id);
        // console.log($('#rde').attr('data-id'));

    });
   $('#rde').click(function (){
     var ids = $('#rde').attr('data-id')
     $.get(ids,function(data){
      if(data=='当前校区包含其他数据，不能删除')
      {
        $('.modal-bodys').html(data)
        $('#myModals').modal();
      }
      else{
        $('.modal-bodys').html('删除成功');
        $('#myModals').modal();
        $("i[name='"+data+"']").parent().parent().parent().parent().remove();
      }
     })
    });
</script>