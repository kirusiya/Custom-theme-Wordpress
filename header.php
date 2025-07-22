<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package materialwp
 */

?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="theme-color" content="#711B46">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

	<?php // @codingStandardsIgnoreStart ?>
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">

	<?php wp_head(); ?>

	<script src="//cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.7/ScrollMagic.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.7/plugins/animation.gsap.min.js"></script>    
	<script src="//cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.7/plugins/debug.addIndicators.min.js"></script>
	<?php // @codingStandardsIgnoreEnd ?>
	

	<?php 
		
		$url=get_bloginfo('url');
		if($url=='https://www.cupastone.es'){
			//Analytics
			echo"<script>
					(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
					(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
					m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
					})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
     
					ga('create', 'UA-39589705-1', 'auto'); 
					ga('send', 'pageview');
			</script>";
			//Tag manager
			echo"<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
				new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
				j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
				'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
				})(window,document,'script','dataLayer','GTM-M9HQS7G');</script>";			

			//Pixel FB
			echo("		<script>
						!function(f,b,e,v,n,t,s)
						{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
						n.callMethod.apply(n,arguments):n.queue.push(arguments)};
						if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
						n.queue=[];t=b.createElement(e);t.async=!0;
						t.src=v;s=b.getElementsByTagName(e)[0];
						s.parentNode.insertBefore(t,s)}(window, document,'script',
						'https://connect.facebook.net/en_US/fbevents.js');
						fbq('init', '1223984518025438');
						fbq('track', 'PageView');
						</script>
						<noscript><img height='1' width='1' style='display:none'
						src='https://www.facebook.com/tr?id=1223984518025438&ev=PageView&noscript=1'/>
						</noscript>");
		}
		else if($url=='https://www.cupastone.fr'){
			//Analytics
			echo"    <script>
					(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
					(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
					m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
					})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
					
					  ga('create', 'UA-45949232-1', 'auto');
					  ga('send', 'pageview');
				</script>" ;
			echo"<!-- Google Tag Manager --><script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
					new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
					j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
					'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
					})(window,document,'script','dataLayer','GTM-NR6G2JP');</script><!-- End Google Tag Manager -->";
			//Pixel FB
			echo"
			<script>
					!function(f,b,e,v,n,t,s)
					{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
					n.callMethod.apply(n,arguments):n.queue.push(arguments)};
					if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
					n.queue=[];t=b.createElement(e);t.async=!0;
					t.src=v;s=b.getElementsByTagName(e)[0];
					s.parentNode.insertBefore(t,s)}(window, document,'script',
					'https://connect.facebook.net/en_US/fbevents.js');
					fbq('init', '163832178994669');
					fbq('track', 'PageView');
					</script>
					<noscript><img height='1' width='1' style='display:none'
					src='https://www.facebook.com/tr?id=163832178994669&ev=PageView&noscript=1'
					/></noscript>
			";
		}
		else if($url=='https://www.cupastone.com'){
			//Analytics
			echo"    <script>
					  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
					  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
					  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
					  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

					  ga('create', 'UA-84471651-1', 'auto');
					  ga('require', 'displayfeatures');
					  ga('require', 'linkid');
					  ga('send', 'pageview');

					</script>";
			echo"<!-- Google Tag Manager --><script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
					new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
					j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
					'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
					})(window,document,'script','dataLayer','GTM-K7FDWKS');</script><!-- End Google Tag Manager -->";
			//Pixel FB
			echo"
				<script>
					!function(f,b,e,v,n,t,s)
					{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
					n.callMethod.apply(n,arguments):n.queue.push(arguments)};
					if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
					n.queue=[];t=b.createElement(e);t.async=!0;
					t.src=v;s=b.getElementsByTagName(e)[0];
					s.parentNode.insertBefore(t,s)}(window, document,'script',
					'https://connect.facebook.net/en_US/fbevents.js');
					fbq('init', '2345219578965958');
					fbq('track', 'PageView');
					</script>
					<noscript><img height='1' width='1' style='display:none'
					src='https://www.facebook.com/tr?id=2345219578965958&ev=PageView&noscript=1'
					/></noscript>
			";
			
		}
		else if($url=='https://www.cupastone.pt'){
			echo"<script>
			  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

			  ga('create', 'UA-90670935-1', 'auto');
			  ga('send', 'pageview');
			</script>";
			//Pixel FB
			echo"<!-- Google Tag Manager --><script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-WL6VBSB');</script><!-- End Google Tag Manager -->";
			echo"
				<script>
					!function(f,b,e,v,n,t,s)
					{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
					n.callMethod.apply(n,arguments):n.queue.push(arguments)};
					if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
					n.queue=[];t=b.createElement(e);t.async=!0;
					t.src=v;s=b.getElementsByTagName(e)[0];
					s.parentNode.insertBefore(t,s)}(window, document,'script',
					'https://connect.facebook.net/en_US/fbevents.js');
					fbq('init', '380193923589334');
					fbq('track', 'PageView');
					</script>
					<noscript><img height='1' width='1' style='display:none'
					src='https://www.facebook.com/tr?id=380193923589334&ev=PageView&noscript=1'
					/></noscript>

			";
		}		
		else if($url=='https://www.cupastone.de'||$url=='www.cupastone.ch'){
			echo"<script>
				(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
				(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
				m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
				})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

				ga('create', 'UA-97553992-1', 'auto');
				ga('send', 'pageview');
				</script>";
				//Google Tag Manager
			echo"<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
				new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
				j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
				'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
				})(window,document,'script','dataLayer','GTM-M7669QG');</script>";
			//Pixel FB
			echo"
				<script>
				!function(f,b,e,v,n,t,s)
				{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
				n.callMethod.apply(n,arguments):n.queue.push(arguments)};
				if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
				n.queue=[];t=b.createElement(e);t.async=!0;
				t.src=v;s=b.getElementsByTagName(e)[0];
				s.parentNode.insertBefore(t,s)}(window, document,'script',
				'https://connect.facebook.net/en_US/fbevents.js');
				fbq('init', '1587129455085090');
				fbq('track', 'PageView');
				</script>
				<noscript><img height='1' width='1' style='display:none'
				src='https://www.facebook.com/tr?id=1587129455085090&ev=PageView&noscript=1'
				/></noscript>
			";
			
		}	
	
		//Origen para FM
		echo"<script>
		/**
		* utmcsr=SOURCE|utmcmd=MEDIUM[|utmccn=CAMPAIGN][|utmcct=CONTENT]
		* [|utmctr=TERM/KEYWORD]
		*/
		(function(document) {
		 
		  var referrer = document.referrer;
		  var gaReferral = {
			'utmcsr': '(direct)',
			'utmcmd': '(none)',
			'utmccn': '(not set)'
		  };
		  var thisHostname = document.location.hostname;
		  var thisDomain = getDomain_(thisHostname);
		  var referringDomain = getDomain_(document.referrer);
		  var sessionCookie = getCookie_('__utmzzses');
		  var cookieExpiration = new Date(+new Date() + 1000 * 60 * 60 * 24 * 30 );
		  var qs = document.location.search.replace('?', '');
		  var hash = document.location.hash.replace('#', '');
		  var gaParams = parseGoogleParams(qs + '#' + hash);
		  var referringInfo = parseGaReferrer(referrer);
		  var storedVals = getCookie_('__utmz') || getCookie_('__utmzz');
		  var newCookieVals = [];
		  var keyMap = {
			'utm_source': 'utmcsr',
			'utm_medium': 'utmcmd',
			'utm_campaign': 'utmccn',
			'utm_content': 'utmcct',
			'utm_term': 'utmctr',
			'gclid': 'utmgclid',
			'dclid': 'utmdclid'
		  };
		 
		  var keyFilter = ['utmcsr', 'utmcmd', 'utmccn', 'utmcct', 'utmctr'];
		  var keyName,
			 values,
			_val,
			_key,
			raw,
			key,
			len,
			i;
		 
		  if (sessionCookie && referringDomain === thisDomain) {
		 
			gaParams = null;
			referringInfo = null;
		 
		  }
		 
		  if (gaParams && (gaParams.utm_source || gaParams.gclid || gaParams.dclid)) {
		 
			for (key in gaParams) {
		 
			  if (typeof gaParams[key] !== 'undefined') {
		 
				keyName = keyMap[key];
				gaReferral[keyName] = gaParams[key];
		 
			  }
		 
			}
		 
		   if (gaParams.gclid || gaParams.dclid) {
		 
			gaReferral.utmcsr = 'google';
			gaReferral.utmcmd = gaReferral.utmgclid ? 'cpc' : 'cpm';
		 
		   }
		 
		  } else if (referringInfo) {
		 
			gaReferral.utmcsr = referringInfo.source;
			gaReferral.utmcmd = referringInfo.medium;
			if (referringInfo.term) gaReferral.utmctr = referringInfo.term;
		 
		  } else if (storedVals) {
		 
			values = {};
			raw = storedVals.split('|');
			len = raw.length;
		 
			for (i = 0; i < len; i++) {
		 
			  _val = raw[i].split('=');
			  _key = _val[0].split('.').pop();
			  values[_key] = _val[1];
		 
			}
		 
			gaReferral = values;
		 
		  }
		 
		  for (key in gaReferral) {
		 
			if (typeof gaReferral[key] !== 'undefined' && keyFilter.indexOf(key) >-1) {
		 
			  newCookieVals.push(key + '=' + gaReferral[key]);
		 
			}
		 
		  }
		 
		  if (!getCookie_('initialTrafficSource')) {
			writeCookie_('initialTrafficSource', newCookieVals.join('|'), cookieExpiration, '/', thisDomain);
		  }
		 
		  writeCookie_('__utmzzses', 1, null, '/', thisDomain);
		 
		  function parseGoogleParams(str) {
		 
			var campaignParams = ['source', 'medium', 'campaign', 'term', 'content'];
			var regex = new RegExp('(utm_(' + campaignParams.join('|') + ')|(d|g)clid)=.*?([^&#]*|$)', 'gi');
			var gaParams = str.match(regex);
			var paramsObj,
			  vals,
			  len,
			  i;
		 
			if (gaParams) {
		 
			  paramsObj = {};
			  len = gaParams.length;
		 
			  for (i = 0; i < len; i++) {
		 
				vals = gaParams[i].split('=');
		 
				if (vals) {
		 
				  paramsObj[vals[0]] = vals[1];
		 
				}
		 
			   }
		 
			 }
		 
			 return paramsObj;
		 
		  }
		 
		  function parseGaReferrer(referrer) {
		 
			if (!referrer) return;
		 
			var searchEngines = {
			  'daum.net': {
				'p': 'q',
				'n': 'daum'
			  },
			  'eniro.se': {
				'p': 'search_word',
				'n': 'eniro '
			   },
			  'naver.com': {
				'p': 'query',
				'n': 'naver '
			  },
			  'yahoo.com': {
				'p': 'p',
				'n': 'yahoo'
			  },
			  'msn.com': {
				'p': 'q',
				'n': 'msn'
			  },
			  'bing.com': {
				'p': 'q',
				'n': 'live'
			  },
			  'aol.com': {
				'p': 'q',
				'n': 'aol'
			  },
			  'lycos.com': {
				'p': 'q',
				'n': 'lycos'
			  },
			  'ask.com': {
				'p': 'q',
				'n': 'ask'
			  },
			  'altavista.com': {
				'p': 'q',
				'n': 'altavista'
			  },
			  'search.netscape.com': {
				'p': 'query',
				'n': 'netscape'
			  },
			  'cnn.com': {
				'p': 'query',
				'n': 'cnn'
			  },
			  'about.com': {
				'p': 'terms',
				'n': 'about'
			  },
			  'mamma.com': {
				'p': 'query',
				'n': 'mama'
			  },
			  'alltheweb.com': {
				'p': 'q',
				'n': 'alltheweb'
			  },
			  'voila.fr': {
				'p': 'rdata',
				'n': 'voila'
			  },
			  'search.virgilio.it': {
				'p': 'qs',
				'n': 'virgilio'
			  },
			  'baidu.com': {
				'p': 'wd',
				'n': 'baidu'
			  },
			  'alice.com': {
				'p': 'qs',
				'n': 'alice'
			  },
			  'yandex.com': {
				'p': 'text',
				'n': 'yandex'
			  },
			  'najdi.org.mk': {
				'p': 'q',
				'n': 'najdi'
			  },
			  'seznam.cz': {
				'p': 'q',
				'n': 'seznam'
			  },
			  'search.com': {
				'p': 'q',
				'n': 'search'
			  },
			  'wp.pl': {
				'p': 'szukaj ',
				'n': 'wirtulana polska'
			  },
			  'online.onetcenter.org': {
				'p': 'qt',
				'n': 'o*net'
			  },
			  'szukacz.pl': {
				'p': 'q',
				'n': 'szukacz'
			  },
			  'yam.com': {
				'p': 'k',
				'n': 'yam'
			  },
			  'pchome.com': {
				'p': 'q',
				'n': 'pchome'
			  },
			  'kvasir.no': {
				'p': 'q',
				'n': 'kvasir'
			  },
			  'sesam.no': {
				'p': 'q',
				'n': 'sesam'
			  },
			  'ozu.es': {
				'p': 'q',
				'n': 'ozu '
			  },
			  'terra.com': {
				'p': 'query',
				'n': 'terra'
			  },
			  'mynet.com': {
				'p': 'q',
				'n': 'mynet'
			  },
			 'ekolay.net': {
				'p': 'q',
				'n': 'ekolay'
			 },
			 'rambler.ru': {
			   'p': 'words',
			   'n': 'rambler'
			 },
			 'google': {
			   'p': 'q',
			   'n': 'google'
			 }
		   };
		   var a = document.createElement('a');
		   var values = {};
		   var searchEngine,
			 termRegex,
			 term;
		 
		   a.href = referrer;
		 
		   // Shim for the billion google search engines
		   if (a.hostname.indexOf('google') > -1) {
		 
			referringDomain = 'google';
		 
		   }
		 
		  if (searchEngines[referringDomain]) {
		 
			searchEngine = searchEngines[referringDomain];
			termRegex = new RegExp(searchEngine.p + '=.*?([^&#]*|$)', 'gi');
			term = a.search.match(termRegex);
		 
			values.source = searchEngine.n;
			values.medium = 'organic';
		 
			values.term = (term ? term[0].split('=')[1] : '') || '(not provided)';
		 
		  } else if (referringDomain !== thisDomain) {
		 
			values.source = a.hostname;
			values.medium = 'referral';
		 
		  }
		 
		   return values;
		 
		  }
		 
		function writeCookie_(name, value, expiration, path, domain) {
		 
			var str = name + '=' + value + ';';
			if (expiration) str += 'Expires=' + expiration.toGMTString() + ';';
			if (path) str += 'Path=' + path + ';';
			if (domain) str += 'Domain=' + domain + ';';
		 
			document.cookie = str;
		 
		}
		 
			  function getCookie_(name) {
		 
				var cookies = '; ' + document.cookie
				var cvals = cookies.split('; ' + name + '=');
		 
				if (cvals.length > 1) return cvals.pop().split(';')[0];
		 
			  }
		 
		function getDomain_(url) {
		 
		  if (!url) return;
		 
		  var a = document.createElement('a');
		  a.href = url;
		 
		  try {
		 
			return a.hostname.match(/[^.]*\.[^.]{2,3}(?:\.[^.]{2,3})?$/)[0];
		 
		  } catch(squelch) {}
		 
		 }
		 
		})(document);
		</script>";
	?>

</head>

<body <?php body_class(); ?> onload="document.body.style.opacity='1'">

	<?php
		$url=get_bloginfo('url');
		if($url=='https://www.cupastone.es'){
			//Analytics
			echo"<!-- Google Tag Manager (noscript) --><noscript>
				<iframe src='https://www.googletagmanager.com/ns.html?id=GTM-M9HQS7G'
					height='0' width='0' style='display:none;visibility:hidden'></iframe></noscript>
				<!-- End Google Tag Manager (noscript) -->";
		}
		elseif($url=='https://www.cupastone.de'){
			//Analytics
			echo"<noscript><iframe src='https://www.googletagmanager.com/ns.html?id=GTM-M7669QG'
				height='0' width='0' style='display:none;visibility:hidden'></iframe></noscript>
			";
		}
		elseif($url=='https://www.cupastone.pt'){
			//Analytics
			echo"<noscript><iframe src='https://www.googletagmanager.com/ns.html?id=GTM-WL6VBSB'
				height='0' width='0' style='display:none;visibility:hidden'></iframe></noscript>
			";
		}
		elseif($url=='https://www.cupastone.fr'){
			//Analytics
			echo"<noscript><iframe src='https://www.googletagmanager.com/ns.html?id=GTM-NR6G2JP'
				height='0' width='0' style='display:none;visibility:hidden'></iframe></noscript>
			";
		}		
		elseif($url=='https://www.cupastone.com'){
			//Analytics
			echo"<noscript><iframe src='https://www.googletagmanager.com/ns.html?id=GTM-K7FDWKS'
				height='0' width='0' style='display:none;visibility:hidden'></iframe></noscript>
			";
		}			

	?>

	<!-- Líneas verticales de fondo -->
	<div class="vertical-lines">
		<div></div>
		<div></div>
		<div></div>
		<div></div>
		<div></div>
		<div></div>
		<div></div>
		<div></div>
	</div>

	<div id="page" class="hfeed site">
		<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'materialwp' ); ?></a>

		<header id="masthead">
			<nav id="mastheadNav" class="navbar fixed-top navbar-dark scrolling-navbar navbar-expand-xl">

				<!-- Barra superior -->
				<div class="topbar">
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'topbar',
							'depth'          => 2,
							'container'      => false,
							'menu_class'     => 'navbar-nav justify-content-end',
							'fallback_cb'    => 'wp_bootstrap_navwalker::fallback',
							'walker'         => new wp_bootstrap_navwalker(),
						)
					);
					?>
				</div>

				<?php
				$urls_lang = get_languages();
				$lang_btn  = get_actual_language();
				?>

				<!-- Barra principal -->
				<div class="mainbar">

					<!-- Logo -->
					<a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
						<img class="img1" src="<?php echo esc_url( get_field( 'logotipo_blanco', 'options' ) ); ?>" alt="logo">
						<img class="img2" src="<?php echo esc_url( get_field( 'logotipo_color', 'options' ) ); ?>" alt="logo">
					</a>

					<!-- Menú -->
					<div class="collapse navbar-collapse" id="navbarSupportedContent">
						<?php
						wp_nav_menu(
							array(
								'theme_location' => 'primary',
								'depth'          => 2,
								'container'      => false,
								'menu_class'     => 'navbar-nav mx-auto',
								'fallback_cb'    => 'wp_bootstrap_navwalker::fallback',
								'walker'         => new wp_bootstrap_navwalker(),
							)
						);
						?>
						<div class="idiomas-sm d-sm-none text-center">
							<?php foreach ( $urls_lang as $lang ) : ?>
							<a href="<?php echo esc_html( $lang['url'] ); ?>/" class="mx-3">
								<?php
								if ( $lang['lang'] === $lang_btn ) {
									echo '<strong>' . esc_html( $lang['lang'] ) . '</strong>';
								} else {
									echo esc_html( $lang['lang'] );
								}
								?>
							</a>
							<?php endforeach; ?>
						</div>
					</div>

					<!-- Buscador / Idiomas -->
					<div class="col-der">

						<div class="header-search-form">
							<img id="iconSearch" src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/images/search.svg">
						</div>
						<div class="idiomas dropdown d-none d-sm-block">
							<a class="dropdown-toggle" href="#" id="dropdownLang" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<?php echo esc_html( $lang_btn ); ?>
							</a>
							<div class="dropdown-menu" aria-labelledby="dropdownLang">
								<?php foreach ( $urls_lang as $lang ) : ?>
								<a class="dropdown-item" href="<?php echo esc_html( $lang['url'] ); ?>/">
									<?php echo esc_html( $lang['lang'] ); ?>
								</a>
								<?php endforeach; ?>
							</div>
						</div>

						<!-- Botón móvil -->
						<button class="navbar-toggler hamburguer-button collapsed"
								type="button"
								data-toggle="collapse"
								data-target="#navbarSupportedContent"
								aria-controls="navbarSupportedContent"
								aria-expanded="false"
								aria-label="Toggle navigation">
							<div class="animated-icon"><span></span><span></span><span></span></div>
						</button>

					</div>

				</div>

			</nav>

			<!-- Formulario de búsqueda -->
			<div id="searchForm" style="display: none;">
				<img id="iconSearchClose" src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/images/close-menu-search.png" width="33">
				<img class="mb-5" src="<?php 										
				
										$url=get_bloginfo('url');
											if($url=='https://www.cupastone.es'){
												echo("https://www.cupastone.es/wp-content/uploads/2022/09/cupastone_espanol.png");
											}
											else if($url=='https://www.cupastone.fr'){
												echo("https://www.cupastone.fr/wp-content/uploads/sites/7/2022/09/cupastone_frances.png");
											}
											else if($url=='https://www.cupastone.com'){
												echo("https://www.cupastone.com/wp-content/uploads/sites/6/2022/09/cupastone_ingles.png");
											}
											else if($url=='https://www.cupastone.pt'){
												echo("https://www.cupastone.pt/wp-content/uploads/sites/4/2022/09/cupastone_portugues.png");
											}
											else if($url=='https://www.cupastone.de'){
												echo("https://www.cupastone.de/wp-content/uploads/sites/8/2022/09/cupastone_aleman.png");
											} ?>" alt="logo">
				<?php require get_stylesheet_directory() . '/searchform-menu.php'; ?>
			</div>

		</header>

		<div id="content" class="site-content">
