<?PHP
	require_once("./include/configSite.php");

	$configSite = new ConfigSite();

	$configSite->InitDB(/*hostname*/'earth.cs.utep.edu',
						/*username*/'cs5339team9fa14',
						/*password*/'cs5339!cs5339team9fa14',
						/*database name*/'cs5339team9fa14',
						/*table name 1*/'admin',
						/*table name 2*/'friend_request',
						/*table name 3*/'items',
						/*table name 4*/'master',
						/*table name 5*/'messages',
						/*table name 6*/'privacy',
						/*table name 8*/'user_posts',
						/*table name 9*/'users');
?>