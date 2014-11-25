<?PHP
	require_once("./configSite.php");

	$configSite = new ConfigSite();

	$configSite->InitDB(/*hostname*/'localhost',
						/*username*/'root',
						/*password*/'sk@t3low1432',
						/*database name*/'cs5339team9fa14',
						/*table name 1*/'admin',
						/*table name 2*/'friends',
						/*table name 3*/'friend_request',
						/*table name 4*/'items',
						/*table name 5*/'master',
						/*table name 6*/'messages',
						/*table name 7*/'students_master',
						/*table name 8*/'users');
?>