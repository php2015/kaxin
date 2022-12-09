<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:75:"/www/wwwroot/jdb/public/../application/index/view/wanlshop/goods/index.html";i:1609217500;s:60:"/www/wwwroot/jdb/application/index/view/layout/wanlshop.html";i:1621480908;}*/ ?>
<!DOCTYPE html>
<html lang="<?php echo $config['language']; ?>">
    <head>
        <meta charset="utf-8">
        <title><?php echo (isset($title) && ($title !== '')?$title:'卖家控制台'); ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
        <meta name="renderer" content="webkit">
        <meta name="author" content="FastAdmin">
        <link rel="shortcut icon" href="/assets/img/favicon.ico" />
        <link href="/assets/css/backend<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.css?v=<?php echo \think\Config::get('site.version'); ?>" rel="stylesheet">
        <link rel="stylesheet" href="/assets/css/skins/skin-red-light.css" type="text/css">
        <link rel="stylesheet" href="/assets/addons/wanlshop/css/chat.css" type="text/css">
        <!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
        <!--[if lt IE 9]>
          <script src="/assets/js/html5shiv.js"></script>
          <script src="/assets/js/respond.min.js"></script>
        <![endif]-->
        <script type="text/javascript">
            var require = {config: <?php echo json_encode($config ); ?>};
        </script>
        <style type="text/css">
            @media (max-width: 767px) {
                .fixed .content-wrapper,
                .fixed .right-side {
                    padding-top: 50px;
                }
            }
            #main {
                height: 100%;
                background: #f1f4f6;
                overflow-x: hidden;
                overflow-y: auto;
            }
            .skin-red-light .treeview-menu>li.active>a {
                color: #e74c3c;
            }
            [v-cloak] {
                display: none !important;
            }
            .text-cut {
                overflow: hidden;
                white-space: nowrap;
                text-overflow: ellipsis;
            }
            /* 修改默认样式 */
            .bootstrap-table .table:not(.table-condensed),
            .bootstrap-table .table:not(.table-condensed)>tbody>tr>td,
            .bootstrap-table .table:not(.table-condensed)>tbody>tr>th,
            .bootstrap-table .table:not(.table-condensed)>tfoot>tr>td,
            .bootstrap-table .table:not(.table-condensed)>tfoot>tr>th,
            .bootstrap-table .table:not(.table-condensed)>thead>tr>td {
                padding: 10px 8px;
            }
        </style>
    </head>

    <?php if(!IS_DIALOG): ?>
    <!-- <body class="skin-green sidebar-mini fixed" id="tabs"> -->
    <body class="sidebar-mini fixed skin-red-light" id="tabs">
        <div class="wrapper">
            <div id="wanlchat">
                <!-- 头部区域 -->
                <header id="header" class="main-header">
                    <a href="javascript:;" class="logo">
                        <!-- 迷你模式下Logo的大小为50X50 -->
                        <span class="logo-mini">商家</span>
                        <!-- 普通模式下Logo -->
                        <span class="logo-lg">商家后台</span>
                    </a>
                    <!-- 顶部通栏样式 -->
                    <nav class="navbar navbar-static-top">
                        <!--第一级菜单-->
                        <div id="firstnav">
                            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                                <span class="sr-only"><?php echo __('Toggle navigation'); ?></span><!-- 边栏切换按钮-->
                            </a>
                            <div class="navbar-custom-menu">
                                <ul class="nav navbar-nav">
                                    <!-- <li> <a href="<?php echo url('index/wanlshop.console/index'); ?>"><i class="fa fa-home" style="font-size:14px;"></i></a> </li> -->
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                            <i class="fa fa-paper-plane margin-r-5"></i>
                                        </a>
                                        <ul class="dropdown-menu wipecache">
                                            <li><a href="<?php echo url('index/wanlshop.goods/add'); ?>"><i class="fa fa-circle-o"></i> 发布宝贝</a></li>
                                            <li class="divider"></li>
                                            <li><a href="javascript:;" @click="toFind('new')"><i class="fa fa-circle-o"></i> 发布宝贝上新</a></li>
                                            <li><a href="javascript:;" @click="toFind('want')"><i class="fa fa-circle-o"></i> 发布种草</a></li>
                                            <li><a href="javascript:;" @click="toFind('show')"><i class="fa fa-circle-o"></i> 发布买家秀</a></li>
                                        </ul>
                                    </li>
                                    <!-- 即时通讯  open-->
                                    <li class="dropdown messages-menu" v-cloak>
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                            <i class="fa fa-comments margin-r-5"></i>
                                            <span class="label label-success" v-if="count > 0">{{count}}</span>
                                        </a>
                                        <div class="dropdown-menu wanl-chat-list">
                                            <div class="head">
                                                <div class="title">
                                                    <div>
                                                        <h3>{{shop.shopname}}</h3>
                                                        <span v-if="shopOnline == 1"><i class="fa fa-circle text-success margin-r-5"></i> H5在线</span>
                                                        <span v-else><i class="fa fa-circle text-gray margin-r-5"></i> IM连接异常</span>
                                                    </div>
                                                    <div style="font-size: 14px;">
                                                        <span class="active" @click="onAudio" v-if="isAudio"><i class="fa fa-volume-up text-red"></i></span> 
                                                        <span v-else @click="onAudio"><i class="fa fa-volume-off text-gray"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="list">
                                                <div class="empty" v-if="chatlist.length == 0">
                                                    <div class="main">
                                                        <img src="/assets/addons/wanlshop/img/default/find_default3x.png">
                                                        <p>没有找到任何联系人</p>
                                                    </div>
                                                </div>
                                                <div class="item" v-for="(item, index) in chatlist" :key="index" @click="otChat(index, 'main')">
                                                    <div class="portrait">
                                                        <img :src="cdnurl(item.avatar)"> 
                                                        <span class="online">
                                                            <i class="fa fa-circle text-success" v-if="item.isOnline == 1"></i>
                                                            <i class="fa fa-circle text-gray" v-else></i>
                                                        </span>
                                                    </div>
                                                    <div class="main">
                                                        <div class="user">
                                                            <span class="username text-cut">{{item.nickname}}</span>
                                                            <span class="time">{{timefriendly(item.createtime)}}</span>
                                                        </div>
                                                        <div class="info text-cut">
                                                            <span v-if="item.count > 0">
                                                                [未读{{item.count}}条]
                                                            </span> 
                                                            <span v-html="item.content"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>

                                    <!-- 账号信息下拉框 -->
                                    <li class="dropdown user user-menu">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                            <img src="<?php echo htmlentities(cdnurl($user['avatar'])); ?>" class="user-image" alt="<?php echo $user['username']; ?>">
                                            <span class="hidden-xs"><?php echo htmlentities($user['username']); ?></span>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <!-- User image -->
                                            <li class="user-header">
                                                <img src="<?php echo htmlentities(cdnurl($user['avatar'])); ?>" class="img-circle" alt="<?php echo $user['username']; ?>">
                                                <p>
                                                    <?php echo htmlentities($user['username']); ?>
                                                    <small><?php echo date("Y-m-d H:i:s",$user['logintime']); ?></small>
                                                </p>
                                            </li>
                                            <!-- Menu Body -->
                                            <li class="user-body">
                                                <div class="row">
                                                    <div class="col-xs-4 text-center">余额：<?php echo htmlentities($user['money']); ?></div>
                                                    <div class="col-xs-4 text-center">积分：<?php echo htmlentities($user['score']); ?></div>
                                                    <div class="col-xs-4 text-center">登录<?php echo htmlentities($user['successions']); ?>次</div>
                                                </div>
                                            </li>
                                            <!-- Menu Footer-->
                                            <li class="user-footer">
                                                <div class="pull-left">
                                                    <a href="<?php echo url('index/user/profile'); ?>" class="btn btn-primary"><i class="fa fa-user"></i> <?php echo __('Profile'); ?></a>
                                                </div>
                                                <div class="pull-left" style="margin-left: 10px;">
                                                    <a href="<?php echo url('index/wanlshop.shop/profile'); ?>" class="btn btn-primary"><i class="fa fa-user"></i>
                                                        <?php echo __('店铺资料'); ?></a>
                                                </div>
                                                <div class="pull-right">
                                                    <a href="<?php echo url('index/user/logout'); ?>" class="btn btn-danger"><i class="fa fa-sign-out"></i> <?php echo __('Logout'); ?></a>
                                                </div>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </nav>
                </header>




                <!-- 聊天窗口 -->
                <div class="wanl-chat" :class="{full: onFull}" :style="{left:screenWidth+'px', top:screenHeight+'px'}" ref="moveBtn" v-show="chatWindow" v-cloak>
                    <div class="list">
                        <ul>
                            <li v-for="(item, index) in wanlchat" :key="index" :class="{checked: chatSelect == index}" @click="onChat(index)">
                                <div class="portrait">
                                    <img :src="cdnurl(item.avatar)">
                                    <span class="badge bg-red" v-if="item.count > 0">{{item.count}}</span>
                                </div>
                                <div class="user-msg">
                                    <p>{{item.nickname}}</p>
                                    <div class="text-cut" v-html="item.content"></div>
                                </div>
                                <div class="list-close" @click.stop="delChat(index)">
                                    <div class="hover">
                                        <span class="fa fa-times-circle"></span>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <div class="main" v-if="chatSelect != null">
                        <div class="msgHead" @mousedown="down" @touchstart="down" @mousemove="move" @touchmove="move" @mouseup="end" @touchend="end" @touchcancel="end">
                            <img :src="cdnurl(wanlchat[chatSelect].avatar)">
                            <div>
                                <span class="name">{{wanlchat[chatSelect].nickname}}</span>
                                <p v-if="wanlchat[chatSelect].isOnline == 1"><i class="fa fa-circle text-success"></i> 在线</p>
                                <p v-else><i class="fa fa-circle text-gray"></i> 离线</p>
                            </div>
                            <!-- 窗口操作 -->
                            <span class="layui-layer-setwin">
                                <block v-if="onFull">
                                    <a class="layui-layer-ico layui-layer-max layui-layer-maxmin" href="javascript:;" @click="full"></a>
                                </block>
                                <block v-else>
                                    <a class="layui-layer-min" href="javascript:;" @click="miniChat"><cite></cite></a>
                                    <a class="layui-layer-ico layui-layer-max" href="javascript:;" @click="full"></a>
                                </block>
                                <a class="layui-layer-ico layui-layer-close layui-layer-close1" href="javascript:;" @click="closeChat"></a>
                            </span>
                        </div>

                        <div class="msgList" id="talk">
                            <ul>
                                <li :class="{my: item.form.id == shop.user_id}" v-for="(item, index) in chatContent" :key="index">
                                    <div class="chat-user">
                                        <img :src="cdnurl(item.form.id == shop.user_id ? shop.avatar : item.form.avatar)">
                                        <cite>
                                            <span>{{timefriendly(item.createtime)}}</span>
                                        </cite>
                                    </div>
                                    <!-- 文字消息 -->
                                    <div class="chat-text" v-if="item.message.type == 'text'" v-html="item.message.content.text"></div>
                                    <!-- 语音消息 -->
                                    <div class="chat-voice" v-if="item.message.type == 'voice'" @click="playVoice(item.message.content.url)">
                                        <span :style="{marginRight: item.message.content.length * 8 +'px'}"></span>{{item.message.content.length}} ”
                                    </div>
                                    <!-- 图片消息 -->
                                    <div class="chat-img" v-if="item.message.type == 'img'">
                                        <a :href="item.message.content.url" target="_blank"><img :src="cdnurl(item.message.content.url)" data-tips-image></a>
                                    </div>
                                    <!-- 商品消息 -->
                                    <div class="chat-goods" v-if="item.message.type == 'goods'">
                                        <img :src="cdnurl(item.message.content.image)">
                                        <div class="price text-orange">
                                            ￥ <span>{{item.message.content.price}}</span>
                                        </div>
                                        <div class="title">
                                            {{item.message.content.title}}
                                        </div>
                                    </div>
                                    <!-- 订单消息 -->
                                    <div class="chat-order" v-if="item.message.type == 'order'" @click="onOrder(item.message.content.id)">
                                        <div> 订单详情：</div>
                                        <div class="product">
                                            <div class="item" v-for="(order, index) in item.message.content.goods" :key="index">
                                                <img :src="cdnurl(order.image)"></img>
                                                <div class="details">
                                                    <div>
                                                        <span>{{order.title}}</span>
                                                    </div>
                                                    <div class="attribute">
                                                        <div class="text-orange">
                                                            ￥ {{order.price * order.number}}
                                                        </div>
                                                        <div>
                                                            <span>{{order.difference}} x {{order.number}}</span>
                                                            <span v-if="item.refund_status > 0">({{refundStatusText[item.refund_status]}})</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="describe">
                                            <div> <span>{{stateText[item.message.content.state-1]}}</span> </div>
                                            <div> <span>ID：</span> <span>{{item.message.content.order_no}}</span> </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <form class="inputBox" id="form">
                            <div class="tool">
                                <span class="fa fa-smile-o" @click="toggleBox"></span>
                                <label for="upImage" class="fa fa-picture-o upImage"></label>
                                <input type="file" id="upImage" @change="chatImage" style="display:none">
                            </div>
                            <div class="input">
                                <textarea id="content" placeholder="请输入消息" v-model="textarea" @keyup.ctrl.enter="submit" autofocus></textarea>
                            </div>
                            <div class="operation">
                                <button type="button" class="btn btn-danger" @click="submit">发送 Ctrl+Enter</button>
                            </div>
                        </form>
                        <div class="box-container" v-if="showBox" @click.self="toggleBox"> </div>
                        <div class="wanl-emoji" v-if="showBox">
                            <div class="title">
                                <div> {{TabCur}} </div>
                            </div>
                            <div class="subject" v-for="(emoji, groups) in emojiList.groups" :key="groups" v-if="TabCur == groups">
                                <div class="item">
                                    <span v-for="(item, index) in emoji" :key="index" @click="addEmoji(item.value)">
                                        <img :src="item.url" >
                                    </span>
                                </div>
                            </div>
                            <div class="emojiNav">
                                <div :class="item == TabCur ? 'emojibg' : ''" class="item" v-for="(item, index) in emojiList.categories" :key="index" :data-id="item" @click="tabSelect" >
                                    <img :src="emojiList.groups[item][0].url" >
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- 客服按钮 -->
                <div class="wanl-chat-mini-button" v-if="chatMiniWindow" @click="miniChat" v-cloak></div>
                <aside class="main-sidebar">
                    <!-- 左侧菜单栏 -->
                    <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 897px;">
                        <section class="sidebar" style="height: 897px; overflow: hidden; width: auto;">
                            <!-- 管理员信息 -->
                            <div class="user-panel hidden-xs">
                                <div class="pull-left image">
                                    <a href="<?php echo url('index/wanlshop.shop/profile'); ?>"><img src="<?php echo htmlentities(cdnurl($shop['avatar'])); ?>" class="img-circle"></a>
                                </div>
                                <div class="pull-left info">
                                    <p><?php echo $shop['shopname']; ?></p>
                                    <div v-cloak>
                                        <span v-if="shopOnline == 1"><i class="fa fa-circle text-success margin-r-5"></i> IM在线</span>
                                        <span v-else><i class="fa fa-circle text-gray margin-r-5"></i> IM连接异常</span>
                                    </div>
                                </div>
                            </div>
                            <!-- 菜单搜索 -->
                            <form action="" method="get" class="sidebar-form" onsubmit="return false;">
                                <div class="input-group">
                                    <input type="text" name="q" class="form-control" placeholder="搜索菜单">
                                    <span class="input-group-btn">
                                        <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                                        </button>
                                    </span>
                                    <div class="menuresult list-group sidebar-form hide" style="width: 210px;">
                                    </div>
                                </div>
                            </form>
                            <!-- 移动端一级菜单 -->
                            <div class="mobilenav visible-xs"> </div>
                            <!--如果想始终显示子菜单,则给ul加上show-submenu类即可,当multiplenav开启的情况下默认为展开-->
                            <ul class="sidebar-menu ">
                                <li class="treeview <?php echo in_array($config['controllername'],['wanlshop.console'])?'active':''; ?>">
                                    <a href="<?php echo url('index/wanlshop.console/index'); ?>">
                                        <i class="fa fa-dashboard fa-fw"></i> <span>控制台</span>
                                        <span class="pull-right-container"><small class="label pull-right bg-blue">hot</small></span>
                                    </a>
                                </li>
                                <li class="treeview <?php echo in_array($config['controllername'],['wanlshop.order','wanlshop.refund'])?'active':''; ?>">
                                    <a href="javascript:;">
                                        <i class="fa fa-leaf fa-fw"></i> <span>交易管理</span>
                                        <span class="pull-right-container"><i class="fa fa-angle-left"></i></span>
                                        <!-- <span class="pull-right-container"><small class="label pull-right bg-purple">new</small></span> -->
                                    </a>
                                    <ul class="treeview-menu <?php echo in_array($config['controllername'],['wanlshop.order','wanlshop.refund'])?'menu-open':''; ?>"
                                        style="display: <?php echo in_array($config['controllername'],['wanlshop.order','wanlshop.refund'])?'block':'none'; ?>;">
                                        <li class="<?php echo $config['controllername'].'.'.$config['actionname']=='wanlshop.order.index'?'active':''; ?>">
                                            <a href="<?php echo url('index/wanlshop.order/index'); ?>">
                                                <i class="fa fa-circle-o fa-fw"></i><span>订单管理</span>
                                            </a>
                                        </li>
                                        <li class="<?php echo $config['controllername'].'.'.$config['actionname']=='wanlshop.order.comment'?'active':''; ?>">
                                            <a href="<?php echo url('index/wanlshop.order/comment'); ?>">
                                                <i class="fa fa-circle-o fa-fw"></i><span>评论管理</span>
                                            </a>
                                        </li>
                                        <li class="<?php echo $config['controllername'].'.'.$config['actionname']=='wanlshop.refund.index'?'active':''; ?>">
                                            <a href="<?php echo url('index/wanlshop.refund/index'); ?>">
                                                <i class="fa fa-circle-o fa-fw"></i><span>退款管理</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="treeview <?php echo in_array($config['controllername'],['wanlshop.logistics']) ?'active':''; ?>">
                                    <a href="javascript:;">
                                        <i class="fa fa-rocket fa-fw"></i> <span>活动管理</span>
                                        <span class="pull-right-container"><i class="fa fa-angle-left"></i> </span>
                                    </a>
                                    <ul class="treeview-menu <?php echo in_array($config['controllername'],['wanlshop.logistics']) ?'menu-open':''; ?>" style="display: <?php echo in_array($config['controllername'],['wanlshop.logistics']) ?'block':'none'; ?>;">
                                        <li class="<?php echo $config['controllername'].'.'.$config['actionname']=='wanlshop.logistics.deliver'?'active':''; ?>">
                                            <a href="<?php echo url('index/wanlshop.logistics/deliver'); ?>">
                                                <i class="fa fa-circle-o fa-fw"></i><span>发货</span>
                                            </a>
                                        </li>
                                        <li class="<?php echo $config['controllername'].'.'.$config['actionname']=='wanlshop.logistics.template'?'active':''; ?>">
                                            <a href="<?php echo url('index/wanlshop.logistics/template'); ?>">
                                                <i class="fa fa-circle-o fa-fw"></i><span>运费模板</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="treeview <?php echo in_array($config['controllername'],['wanlshop.logistics']) ?'active':''; ?>">
                                    <a href="javascript:;">
                                        <i class="fa fa-rocket fa-fw"></i> <span>物流管理</span>
                                        <span class="pull-right-container"><i class="fa fa-angle-left"></i> </span>
                                    </a>
                                    <ul class="treeview-menu <?php echo in_array($config['controllername'],['wanlshop.logistics']) ?'menu-open':''; ?>" style="display: <?php echo in_array($config['controllername'],['wanlshop.logistics']) ?'block':'none'; ?>;">
                                        <li class="<?php echo $config['controllername'].'.'.$config['actionname']=='wanlshop.logistics.deliver'?'active':''; ?>">
                                            <a href="<?php echo url('index/wanlshop.logistics/deliver'); ?>">
                                                <i class="fa fa-circle-o fa-fw"></i><span>发货</span>
                                            </a>
                                        </li>
                                        <li class="<?php echo $config['controllername'].'.'.$config['actionname']=='wanlshop.logistics.template'?'active':''; ?>">
                                            <a href="<?php echo url('index/wanlshop.logistics/template'); ?>">
                                                <i class="fa fa-circle-o fa-fw"></i><span>运费模板</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="treeview <?php echo in_array($config['controllername'],['wanlshop.goods'])?'active':''; ?>">
                                    <a href="javascript:;">
                                        <i class="fa fa-shopping-bag fa-fw"></i> <span>宝贝管理</span>
                                        <span class="pull-right-container"><i class="fa fa-angle-left"></i> </span>
                                    </a>
                                    <ul class="treeview-menu <?php echo in_array($config['controllername'],['wanlshop.goods'])?'menu-open':''; ?>" style="display: <?php echo in_array($config['controllername'],['wanlshop.goods'])?'block':'none'; ?>;">
                                        <li class="<?php echo $config['controllername'].'.'.$config['actionname']=='wanlshop.goods.add'?'active':''; ?>">
                                            <a href="<?php echo url('index/wanlshop.goods/add'); ?>">
                                                <i class="fa fa-circle-o fa-fw"></i><span>发布宝贝</span>
                                            </a>
                                        </li>
                                        <li class="<?php echo $config['controllername'].'.'.$config['actionname']=='wanlshop.goods.index'?'active':''; ?>">
                                            <a href="<?php echo url('index/wanlshop.goods/index'); ?>">
                                                <i class="fa fa-circle-o fa-fw"></i><span>出售中的宝贝</span>
                                            </a>
                                        </li>
                                        <li class="<?php echo $config['controllername'].'.'.$config['actionname']=='wanlshop.goods.stock'?'active':''; ?>">
                                            <a href="<?php echo url('index/wanlshop.goods/stock'); ?>">
                                                <i class="fa fa-circle-o fa-fw"></i><span>仓库中的宝贝</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="treeview <?php echo in_array($config['controllername'],['wanlshop.shop','wanlshop.config'])?'active':''; ?>">
                                    <a href="javascript:;">
                                        <i class="fa fa-archive fa-fw"></i> <span>店铺管理</span>
                                        <span class="pull-right-container"><i class="fa fa-angle-left"></i> </span>
                                    </a>
                                    <ul class="treeview-menu <?php echo in_array($config['controllername'],['wanlshop.shop','wanlshop.config'])?'menu-open':''; ?>"
                                        style="display: <?php echo in_array($config['controllername'],['wanlshop.shop','wanlshop.config'])?'block':'none'; ?>;">
                                        <li class="<?php echo $config['controllername'].'.'.$config['actionname']=='wanlshop.shop.attachment'?'active':''; ?>">
                                            <a href="<?php echo url('index/wanlshop.shop/attachment'); ?>">
                                                <i class="fa fa-circle-o fa-fw"></i><span>图片空间</span>
                                            </a>
                                        </li>
                                        <li class="<?php echo $config['controllername'].'.'.$config['actionname']=='wanlshop.shop.index'?'active':''; ?>">
                                            <a href="<?php echo url('index/wanlshop.shop/index'); ?>">
                                                <i class="fa fa-circle-o fa-fw"></i><span>店铺装修</span>
                                            </a>
                                        </li>
                                        <li class="<?php echo $config['controllername'].'.'.$config['actionname']=='wanlshop.shop.category'?'active':''; ?>">
                                            <a href="<?php echo url('index/wanlshop.shop/category'); ?>">
                                                <i class="fa fa-circle-o fa-fw"></i><span>类目管理</span>
                                            </a>
                                        </li>
                                        <li class="<?php echo $config['controllername'].'.'.$config['actionname']=='wanlshop.shop.brand'?'active':''; ?>">
                                            <a href="<?php echo url('index/wanlshop.shop/brand'); ?>">
                                                <i class="fa fa-circle-o fa-fw"></i><span>品牌管理</span>
                                            </a>
                                        </li>
                                        <li class="<?php echo $config['controllername'].'.'.$config['actionname']=='wanlshop.shop.profile'?'active':''; ?>">
                                            <a href="<?php echo url('index/wanlshop.shop/profile'); ?>">
                                                <i class="fa fa-circle-o fa-fw"></i><span>店铺资料</span>
                                            </a>
                                        </li>
                                        <li class="<?php echo $config['controllername'].'.'.$config['actionname']=='wanlshop.config.index'?'active':''; ?>">
                                            <a href="<?php echo url('index/wanlshop.config/index'); ?>">
                                                <i class="fa fa-circle-o fa-fw"></i><span>店铺配置</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <!-- <li class="treeview">
                                        <a href="<?php echo url('index/user/index'); ?>">
                                                <i class="fa fa-user fa-fw"></i> <span>会员中心</span> 
                                                <span class="pull-right-container"> </span>
                                        </a> 
                                </li>
                                -->
                                <li class="treeview <?php echo in_array($config['controllername'],['wanlshop.find','wanlshop.coupon']) ? 'active':''; ?>">
                                    <a href="javascript:;">
                                        <i class="fa fa-th fa-fw text-red"></i> <span>应用中心</span>
                                        <span class="pull-right-container"><i class="fa fa-angle-left"></i> </span>
                                    </a>
                                    <ul class="treeview-menu <?php echo in_array($config['controllername'],['wanlshop.find','wanlshop.coupon']) ? 'menu-open':''; ?>"
                                        style="display: <?php echo in_array($config['controllername'],['wanlshop.find','wanlshop.coupon']) ? 'block':'none'; ?>;">
                                        <li class="<?php echo $config['controllername'].'.'.$config['actionname']=='wanlshop.find.index'?'active':''; ?>">
                                            <a href="<?php echo url('index/wanlshop.find/index'); ?>">
                                                <i class="fa fa-circle-o fa-fw"></i><span>社区种草</span>
                                            </a>
                                        </li>
                                        <li class="<?php echo $config['controllername'].'.'.$config['actionname']=='wanlshop.coupon.index'?'active':''; ?>">
                                            <a href="<?php echo url('index/wanlshop.coupon/index'); ?>">
                                                <i class="fa fa-circle-o fa-fw"></i><span>优惠券</span>
                                            </a>
                                        </li>
                                        <!-- <li class="<?php echo $config['controllername'].'.'.$config['actionname']=='wanlshop.operate.index'?'active':''; ?>">
                                                <a href="<?php echo url('index/wanlshop.operate/index'); ?>">
                                                        <i class="fa fa-circle-o fa-fw"></i><span>分销</span> 
                                                </a> 
                                        </li>
                                        <li class="<?php echo $config['controllername'].'.'.$config['actionname']=='wanlshop.operate.index'?'active':''; ?>">
                                                <a href="<?php echo url('index/wanlshop.operate/index'); ?>">
                                                        <i class="fa fa-circle-o fa-fw"></i><span>拼团</span> 
                                                </a> 
                                        </li>
                                        <li class="<?php echo $config['controllername'].'.'.$config['actionname']=='wanlshop.operate.index'?'active':''; ?>">
                                                <a href="<?php echo url('index/wanlshop.operate/index'); ?>">
                                                        <i class="fa fa-circle-o fa-fw"></i><span>砍价</span> 
                                                </a> 
                                        </li>
                                        <li class="<?php echo $config['controllername'].'.'.$config['actionname']=='wanlshop.operate.index'?'active':''; ?>">
                                                <a href="<?php echo url('index/wanlshop.operate/index'); ?>">
                                                        <i class="fa fa-circle-o fa-fw"></i><span>限时秒杀</span> 
                                                </a> 
                                        </li>
                                        -->
                                    </ul>
                                </li>
                                <li class="header">相关链接</li>
                                <?php if(empty($config['document']) || (($config['document'] instanceof \think\Collection || $config['document'] instanceof \think\Paginator ) && $config['document']->isEmpty())): ?>
                                <li><a href="javascript:;" onclick="layer.msg('平台尚未配置官方文档')"><i class="fa fa-list text-red"></i> <span>官方文档</span></a></li>
                                <?php else: ?>
                                <li><a href="<?php echo $config['document']; ?>" target="_blank"><i class="fa fa-list text-red"></i> <span>官方文档</span></a></li>
                                <?php endif; if(empty($config['qun']) || (($config['qun'] instanceof \think\Collection || $config['qun'] instanceof \think\Paginator ) && $config['qun']->isEmpty())): ?>
                                <li><a href="javascript:;" onclick="layer.msg('平台尚未配置QQ交流群')"><i class="fa fa-qq text-aqua"></i> <span>QQ交流群</span></a></li>
                                <?php else: ?>
                                <li><a href="<?php echo $config['qun']; ?>" target="_blank"><i class="fa fa-qq text-aqua"></i> <span>QQ交流群</span></a></li>
                                <?php endif; ?>
                            </ul>
                        </section>
                        <div class="slimScrollBar" style="background: rgba(0, 0, 0, 0.2); width: 8px; position: absolute; top: 0px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 1px; height: 897px;"></div>
                        <div class="slimScrollRail" style="width: 8px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51); opacity: 0.2; z-index: 90; right: 1px;"></div>
                    </div>
                </aside>
            </div>





            <div class="content-wrapper tab-content tab-addtabs">
                <div class="tab-pane active">
                    <div id="main" role="main">
                        <div class="tab-content tab-addtabs">
                            <div id="content">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

                                        <!-- RIBBON -->
                                        <div id="ribbon">
                                            <ol class="breadcrumb pull-left">
                                                <li><a href="dashboard" class="addtabsit"><i class="fa fa-dashboard"></i> 控制台</a></li>
                                            </ol>
                                            <ol class="breadcrumb pull-right">
                                                <li><a href="javascript:;"><?php echo (isset($title) && ($title !== '')?$title:''); ?></a></li>
                                            </ol>
                                        </div>

                                        <!-- END RIBBON -->
                                        <div class="content">
                                            <div class="panel panel-default panel-intro">
    <div class="panel-heading">
        <ul class="nav nav-tabs" data-field="status">
            <li class="active"><a href="#t-all" data-value="" data-toggle="tab"><?php echo __('All'); ?></a></li>
            <?php if(is_array($statusList) || $statusList instanceof \think\Collection || $statusList instanceof \think\Paginator): if( count($statusList)==0 ) : echo "" ;else: foreach($statusList as $key=>$vo): ?>
            <li><a href="#t-<?php echo $key; ?>" data-value="<?php echo $key; ?>" data-toggle="tab"><?php echo $vo; ?></a></li>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
    </div>
    <div class="panel-body">
        <div id="myTabContent" class="tab-content">
            <div class="tab-pane fade active in" id="one">
                <div class="widget-body no-padding">
                    <div id="toolbar" class="toolbar">
                        <a href="javascript:;" class="btn btn-primary btn-refresh" title="<?php echo __('Refresh'); ?>" ><i class="fa fa-refresh"></i> </a>
                        <a href="javascript:;" class="btn btn-success btn-add" title="<?php echo __('Add'); ?>" ><i class="fa fa-plus"></i> <?php echo __('Add'); ?></a>
                        <a href="javascript:;" class="btn btn-success btn-edit btn-disabled disabled" title="<?php echo __('Edit'); ?>" ><i class="fa fa-pencil"></i> <?php echo __('Edit'); ?></a>
                        <a href="javascript:;" class="btn btn-danger btn-del btn-disabled disabled" title="<?php echo __('Delete'); ?>" ><i class="fa fa-trash"></i> <?php echo __('Delete'); ?></a>
                        <div class="dropdown btn-group">
                            <a class="btn btn-primary btn-more dropdown-toggle btn-disabled disabled" data-toggle="dropdown"><i class="fa fa-cog"></i> <?php echo __('More'); ?></a>
                            <ul class="dropdown-menu text-left" role="menu">
                                <li><a class="btn btn-link btn-multi btn-disabled disabled" href="javascript:;" data-params="status=normal"><i class="fa fa-eye"></i> <?php echo __('Set to normal'); ?></a></li>
                                <li><a class="btn btn-link btn-multi btn-disabled disabled" href="javascript:;" data-params="status=hidden"><i class="fa fa-eye-slash"></i> <?php echo __('Set to hidden'); ?></a></li>
                            </ul>
                        </div>
                        <a class="btn btn-success btn-recyclebin btn-dialog" href="wanlshop/goods/recyclebin" title="<?php echo __('Recycle bin'); ?>"><i class="fa fa-recycle"></i> <?php echo __('Recycle bin'); ?></a>
                    </div>
                    <table id="table" class="table table-striped table-bordered table-hover table-nowrap"
                           data-operate-edit="wanlshop/goods/edit" 
                           data-operate-del="wanlshop/goods/del" 
                           width="100%">
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="/assets/js/require.min.js" data-main="/assets/js/require-wanlshop.min.js?v=<?php echo htmlentities($site['version']); ?>"></script>
  
    </body>
    <?php else: ?>
    <body class="inside-header inside-aside is-dialog">
        <div id="main" role="main">
            <div class="tab-content tab-addtabs">
                <div id="content">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="content">
                                <div class="panel panel-default panel-intro">
    <div class="panel-heading">
        <ul class="nav nav-tabs" data-field="status">
            <li class="active"><a href="#t-all" data-value="" data-toggle="tab"><?php echo __('All'); ?></a></li>
            <?php if(is_array($statusList) || $statusList instanceof \think\Collection || $statusList instanceof \think\Paginator): if( count($statusList)==0 ) : echo "" ;else: foreach($statusList as $key=>$vo): ?>
            <li><a href="#t-<?php echo $key; ?>" data-value="<?php echo $key; ?>" data-toggle="tab"><?php echo $vo; ?></a></li>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
    </div>
    <div class="panel-body">
        <div id="myTabContent" class="tab-content">
            <div class="tab-pane fade active in" id="one">
                <div class="widget-body no-padding">
                    <div id="toolbar" class="toolbar">
                        <a href="javascript:;" class="btn btn-primary btn-refresh" title="<?php echo __('Refresh'); ?>" ><i class="fa fa-refresh"></i> </a>
                        <a href="javascript:;" class="btn btn-success btn-add" title="<?php echo __('Add'); ?>" ><i class="fa fa-plus"></i> <?php echo __('Add'); ?></a>
                        <a href="javascript:;" class="btn btn-success btn-edit btn-disabled disabled" title="<?php echo __('Edit'); ?>" ><i class="fa fa-pencil"></i> <?php echo __('Edit'); ?></a>
                        <a href="javascript:;" class="btn btn-danger btn-del btn-disabled disabled" title="<?php echo __('Delete'); ?>" ><i class="fa fa-trash"></i> <?php echo __('Delete'); ?></a>
                        <div class="dropdown btn-group">
                            <a class="btn btn-primary btn-more dropdown-toggle btn-disabled disabled" data-toggle="dropdown"><i class="fa fa-cog"></i> <?php echo __('More'); ?></a>
                            <ul class="dropdown-menu text-left" role="menu">
                                <li><a class="btn btn-link btn-multi btn-disabled disabled" href="javascript:;" data-params="status=normal"><i class="fa fa-eye"></i> <?php echo __('Set to normal'); ?></a></li>
                                <li><a class="btn btn-link btn-multi btn-disabled disabled" href="javascript:;" data-params="status=hidden"><i class="fa fa-eye-slash"></i> <?php echo __('Set to hidden'); ?></a></li>
                            </ul>
                        </div>
                        <a class="btn btn-success btn-recyclebin btn-dialog" href="wanlshop/goods/recyclebin" title="<?php echo __('Recycle bin'); ?>"><i class="fa fa-recycle"></i> <?php echo __('Recycle bin'); ?></a>
                    </div>
                    <table id="table" class="table table-striped table-bordered table-hover table-nowrap"
                           data-operate-edit="wanlshop/goods/edit" 
                           data-operate-del="wanlshop/goods/del" 
                           width="100%">
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="/assets/js/require.min.js" data-main="/assets/js/require-wanlshop.min.js?v=<?php echo htmlentities($site['version']); ?>"></script>
    </body>
    <?php endif; ?>

</html>
