<html>
	<head>
		<title><{ $appname|truncate:200 }></title>
		<meta name="Author" content="HY" />
		<meta name="Keywords" content="<{$keywords}>" />
		<meta name="description" content="<{$description}>" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />		
		<link rel="stylesheet" type="text/css" href="<{$res}>/css/global.css">
		<link rel="stylesheet" type="text/css" href="<{$res}>/css/layout.css">
		<link rel="stylesheet" type="text/css" href="<{$res}>/css/print.css">
        <link rel="stylesheet" type="text/css" href="<{$res}>/css/main.css">
		<script src="<{$public}>/js/ajax3.0.js"></script>
		<script src="<{$res}>/js/common.js"></script>
		<script src="<{$res}>/js/win.js"></script>
        
		
	</head>
	<body>
		<div id="content">
			<div id="header">
				<div id="top">
					<div id="top_left">
						
						<{ if $smarty.session.login eq 1 }>
						  
                          <form action="<{$app}>/hyuser/hyindex" method="post">
                            &nbsp;欢迎回来&nbsp;<b><{ $smarty.session.username }></b>
                            |&nbsp;角色:
                            <a href="<{$app}>/login/role_select/name/<{$smarty.session.username}>" title="点击选择系统角色">
                            <span class="redh">【<{$smarty.session.role}>】</span>
                            </a>|
                            <input name="uid" type="hidden" size="10" value="<{$smarty.session.userid}>">&nbsp;
                            <input type="submit" name="usercenter1" value="用户中心">&nbsp;
                            <input type="submit" name="usercenter2" value="退出" formaction="<{$app}>/login/logout">&nbsp;
    
                          </form>        
                            
                                  
						<{ else }>
						<form action="<{$app}>/login/role_select" method="post">
							&nbsp;
							用户名:<input class="inputheight" name="username" type="text" size="10">&nbsp;
							密码:<input class="inputheight" name="userpwd" type="password" size="10">
							<input type="submit" name="loginsubmit" value="登录">&nbsp;
						</form>
						<{ /if }>
						
					</div>

					<div id="top_right">
                    
					</div>
				</div>
				
				<div id="logo">
					<br /><a href="http://www.gzgjd.com"><img border="0" width="300" height="50" alt="xscms_logo" src="<{$public}>/images/gzomelogo.gif"></a>
				</div>
                
                <{ if $smarty.session.login eq 1 }> 
				<div id="right_box">
                        <ul>
                            <form action="<{$app}>/search/index" method="post">
                                <{*选择专利、论文、报奖、成果登记中的一个*}>
                               
                                大类：<select name="ser_kind">
                                    <option value="<{$kind}>" selected="selected"><{$kind}></option>
                                    <option value="专利">专利</option>
                                    <option value="论文">论文</option>
                                    <option value="获奖情况" >获奖情况</option>
                                    <option value="成果登记">成果登记</option>
                                    </select>
                                    
                                <{*选择大类中的小类*}>
                                &nbsp;&nbsp;类型：<{$select_type}>
                                <{*
                                <select name="ser_type">
                                    <option value="<{$type}>" selected="selected"><{$type}></option>
                                    <option value="实用新型专利">实用新型专利</option>
                                    <option value="发明专利">发明专利</option>
                                    <option value="外观设计专利">外观设计专利</option>
                                    <option value="软件版权">软件版权</option>
                                    <option value="著作权">著作权</option>
                                    <option value="集成电路图">集成电路图</option>
                                    <option value="不限">(不限)</option>
                                </select>
                                *}>
                                
                                <{*选择大类中状态*}>
                                &nbsp;&nbsp;状态：<{$select_status}>
                                <{*
                                <select name="ser_status">
                                    <option value="<{$status}>" selected="selected"><{$status}></option>
                                    <option value="填报">填报</option>
                                    <option value="提交">提交</option>
                                    <option value="修改">修改</option>
                                    <option value="退回">退回</option>
                                    <option value="审核">审核</option>
                                    <option value="批准">批准</option>
                                    <option value="申报">申报</option>
                                    <option value="授权">授权</option>
                                    <option value="放弃">放弃</option>
                                    <option value="驳回">驳回</option>
                                    <option value="维护">维护</option>
                                    <option value="不限">(不限)</option>
                                </select>
                                *}>
                                <br />
                                <div class="nav"> </div>   
                                
                                题目：<input type="text"  name="ser_topic" size="30" value="<{$topic}>" maxlength="100">&nbsp;&nbsp;
                                部门：<input type="text"  name="ser_dept" size="20" value="<{$dept}>" maxlength="100">
                                <br />
                                <div class="nav"> </div>
                                                             
                                开始日期：<input type="text"  name="ser_start_date" size="15" value="<{$start_date}>" maxlength="30" placeholder="yyyy-mm-dd">&nbsp;&nbsp;
                                结束日期：<input type="text"  name="ser_end_date" size="15" value="<{$end_date}>" maxlength="30" placeholder="yyyy-mm-dd">&nbsp;&nbsp;
                                <input type="submit" value="搜 索">&nbsp;
                                <input type="reset" value="重 置"/>
                            </form>                    
                        </ul>                          
				</div>
   	            <{ else }>
                
                <{ /if }>
                
				<div class="nav"> </div>
			</div>	
			<div id="">	<{*-- id="menu"页面边长？？--*}>
				<ul>
					 <{*
                    <a href="<{$app}>">&nbsp;网站首页&nbsp;</a>|<a href="<{$app}>/hyuser/hyindex/uid/<{$smarty.session.userid}>">&nbsp;专利</a>&nbsp;|<a href="" >&nbsp;论文&nbsp;</a>
                    *}>
                    
                    <a href="<{$app}>">&nbsp;【网站首页】&nbsp;</a>|<a href="<{$app}>/index/index_patvalid">&nbsp;【专利】</a>&nbsp;|<a href="<{$app}>/index/index_thepub" >&nbsp;【论文】&nbsp;</a>
                    
                    <{*
                    <li><a href="<{$app}>">网站首页</a></li><li class="menudiv"> </li>
                    <li><a href="<{$app}>/patent/index">论文</a></a></li><li class="menudiv"> </li>
                    <li><a href="">论文</a></li><li class="menudiv"> </li>
                    *}>
                    
                    <{*
					<{ section name=li loop=$menu }>
						<li><a href="<{$app}>/list/index/pid/<{ $menu[li].id }>"><{ $menu[li].title }></a></li><li class="menudiv"> </li>
					<{ /section }>
                    *}>
                    
				</ul>			
			</div>
			<div class="nav"> </div>
			<div id="container">
			

