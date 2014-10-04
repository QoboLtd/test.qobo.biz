<?php
/**
 * Qobo Web Tester
 * 
 * @author Leonid Mamchenkov <l.mamchenkov@qobo.biz>
 */

require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';
require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'lib' . DIRECTORY_SEPARATOR . 'WebTester' . DIRECTORY_SEPARATOR . 'autoload.php';

$result = null;

if (isset($_SERVER['REQUEST_METHOD']) && (strtoupper($_SERVER['REQUEST_METHOD']) == 'POST')) {
	$httpClient = new \GuzzleHttp\Client(['defaults'=>['headers'=>['User-Agent' => 'Qobo Web Tester - http://test.qobo.biz']]]);
	$httpClient->timeout = 5;

	$_POST['httpClient'] = $httpClient;
	
	$result = \WebTester\TestFactory::runTests($_POST);
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Qobo Web Tester</title>

    <!-- Bootstrap -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
	<!-- Sticky footer -->
	<link href="css/sticky-footer.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
	<nav class="navbar navbar-default" role="navigation">
		<div class="container">
			<div class="navbar-header">
				<a class="navbar-brand" href="<?php echo $_SERVER['PHP_SELF']; ?>">Qobo Web Tester</a>
			</div>

			<form class="navbar-form navbar-right" role="form" method="post">
				<div class="form-group">
					<input type="url" name="url" class="form-control" id="url" placeholder="http://www.qobo.biz" value="<?php echo empty($_POST['url']) ? 'http://www.qobo.biz' : $_POST['url']; ?>">
				</div>
				<input type="submit" class="btn btn-primary" value="Test">
			</form>
		</div>
	</nav>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<?php if (!empty($result)) : ?>
					<h3>Test Results</h3>
					<small>
						<strong>URL:</strong> <a target="_blank" href="<?php echo $_POST['url']; ?>"><?php echo $_POST['url']; ?></a><br />
						<strong>Date:</strong> <?php echo date('F j, Y, g:i a'); ?><br />
					</small>

					<br />

					<table class="table table-condensed">
						<thead>
							<tr>
								<th width="25%">Test</th>
								<th>Result</th>
								<th>Comment</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$result->rewind();
								while($result->valid()) {
									$test = $result->current();
									$last = $test->getLastResult();
									
									echo '<tr class="' . ($last->isSuccess() ? 'success' : 'danger') . '">';
									echo '<td>' . $test->getName() . '<br /><small>' . $test->getDescription() . '</small></td>';
									echo '<td>' . ($last->isSuccess() ? \WebTester\Result\Result::DEFAULT_DESCRIPTION_SUCCESS : \WebTester\Result\Result::DEFAULT_DESCRIPTION_FAIL) . '</td>';
									echo '<td><small>' . $last->getDescription() . '</small></td';
									echo '</tr>';

									$result->next();
								}
							?>
						</tbody>
					</table>
				<?php else: ?>
				<div class="well">
					<h4>Welcome to the Qobo Web Tester</h4>
					<p>Here, at Qobo, we strive to build high quality web site and applications.  In an effort to delivery the best possible results we've created a few tools to help us.  Qobo Web Tester is just one such tool.</p>
					<p>Use the form above to test URLs.  Qobo Web Tester will automagically examine the given page and provide you will some suggestions on how to make it better.</p>
				</div>
				<?php endif; ?>
			</div>

		</div>
	</div>

	<div class="footer">
		<div class="container">
			<p class="text-right text-muted">&copy; Copyright <?php echo date('Y'); ?> <a href="http://www.qobo.biz">Qobo Ltd</a></p>
		</div>
	</div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
  </body>
</html>
