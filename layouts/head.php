<?php defined('_EXEC') or die; ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="{$lang}">
<!-- Global site tag (gtag.js) - Google Analytics -->
	<head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# article: http://ogp.me/ns/article#">
		<meta charset="UTF-8" />
		<meta content="text/html; charset=UTF-8" http-equiv="Content-Type" />
		{$dependencies.meta}

		<meta property="fb:app_id" content="302184056577324" />
		<meta property="og:type"   content="article" />
		<meta property="og:url"    content="Pon tu propio URL para el objeto aqu&#xed;" />
		<meta property="og:title"  content="Sample Article" />
		<meta property="og:image"  content="https://s-static.ak.fbcdn.net/images/devsite/attachment_blank.png" />

		<base href="{$base}">

		<title>{$vkye_title}</title>

		<!--Adaptive Responsive-->
		<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0" />
		<meta name="author" content="CodeMonkey" />
		<meta name="description" content="{$seo_description}" />
		<meta name="keywords" content="{$seo_keywords}" />


		<link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
		<link rel="stylesheet" href="{$path.css}valkyrie-material-design.min.css" type="text/css" media="all" />
		<link rel="stylesheet" href="{$path.css}theme.css" type="text/css" media="all" />

		<!-- material design icons -->
		<link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet">

		<!-- Global site tag (gtag.js) - Google Ads: 810034664 -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=AW-810034664"></script>
		<script>
		  window.dataLayer = window.dataLayer || [];
		  function gtag(){dataLayer.push(arguments);}
		  gtag('js', new Date());
		  gtag('config', 'AW-810034664');
		</script>

		<!-- Event snippet for Solicitud informacion conversion page In your html page, add the snippet and call gtag_report_conversion when someone clicks on the chosen link or button. -->
		<script> function gtag_report_conversion(url) { var callback = function () { if (typeof(url) != 'undefined') { window.location = url; } }; gtag('event', 'conversion', { 'send_to': 'AW-810034664/ptfCCMmHpPABEOjLoIID', 'event_callback': callback }); return false; } </script>

		<!-- Google Adwords -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=UA-112787509-1"></script>
		<script type="text/javascript" defer>
			window.dataLayer = window.dataLayer || [];
			function gtag(){dataLayer.push(arguments);}
			gtag("js", new Date());
			gtag("config", "UA-112787509-1");
		</script>

		<!-- Facebook Pixel Code -->
		<script>
			!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
			n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
			n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
			t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
			document,'script','https://connect.facebook.net/en_US/fbevents.js');
			fbq('init', '1897209410575058');
			fbq('track', 'PageView');
			fbq('track', 'CompleteRegistration');
		</script>
		<noscript>
			<img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=1897209410575058&ev=PageView&noscript=1" />
		</noscript>

		{$dependencies.css}
	</head>
	<body>
