<html>
	<head>
		<title>Patent用户中心</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="Author" content="HY，细说PHP" />
	</head>

	<frameset rows="72,*" cols="*" framespacing="0" frameborder="0" border="0">
 		<frame src="<{$url}>/top" name="top" scrolling="no" noresize="noresize" />
		<frameset cols="310, *">
  			<frame src="<{$url}>/menu/uid/<{$smarty.post.uid}>" name="menu" noresize="noresize" scrolling="yes" />
            <frame src="<{$url}>/main/uid/<{$smarty.post.uid}>" name="main" noresize="noresize" scrolling="yes"/>
               
            
            <{*
			<{if $smarty.get.message eq 1}>					
				<frame src="<{$app}>/message/index/uid/<{$smarty.get.uid}>" name="main" noresize="noresize" scrolling="yes"/>
			<{else}>
				<frame src="<{$app}>/dynamic/index/uid/<{$smarty.get.uid}>" name="main" noresize="noresize" scrolling="yes"/>
			<{/if}>
            *}>
  		    
		</frameset>
	</frameset>
</html>


