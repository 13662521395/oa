<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;
use yii\helpers\Url;
use yii\bootstrap\Alert;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '角色管理';

$this->params['breadcrumbs'][] = $this->title;
?>

<div class="breadcrumbs" id="breadcrumbs">
    <script type="text/javascript">
        try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
    </script>

    <ol class="breadcrumb">
      <li><a href="index.php?r=oaaffiche/index"">首页</a>
      <li><a href="index.php?r=role/index"">角色管理</a>
      <li><a href="#">权限设置</a>
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

<div class="oa-role-index">
<p> </p>
<div class="col-xs-12">
    <div class="table-responsive">
        <table id="sample-table-1" class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th class="col-xs-2" style="text-align:center;">模块</th>
                    <th class="hidden-480 col-xs-2" style="text-align:center;">功能列表</th>
                    <th class="hidden-480 col-xs-8" style="text-align:center;">权限列表</th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td style="text-align:center;vertical-align:middle"><b>
                       公告</div></b></td>
                       <td style="text-align:center;vertical-align:middle"><b>
                       公告</div></b></td>
                       <td style="text-align:center;vertical-align:middle"><b>
                       公告</div></b></td>
                </tr>
                <tr>
                    

               
            
                    
            </tbody>
        </table>
    </div><!-- /.table-responsive -->
</div></div>
<td rowspan="2" style="text-align:center;vertical-align:middle"><b>
                   用户管理</div></b></td>
                </tr>
                <tr>
                    <td rowspan="2" style="text-align:center;vertical-align:middle"><b>
                   任务管理</div></b></td>
                </tr>
                <tr>
                    <td style="text-align:center;vertical-align:middle"><b>
                   职位管理</div></b></td>
                </tr>
                <tr>
                    <td style="text-align:center;vertical-align:middle"><b>
                   校区管理</div></b></td>
                </tr>
                <tr>
                    <td style="text-align:center;vertical-align:middle"><b>
                   部门管理</div></b></td>
                </tr>
                <tr>
                    <td style="text-align:center;vertical-align:middle"><b>
                   工作管理</div></b></td>
                </tr>
                <tr>
                    <td style="text-align:center;vertical-align:middle"><b>
                   组织管理</div></b></td>
                </tr>