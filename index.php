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
	$httpClient = new \GuzzleHttp\Client();
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
				<a class="navbar-brand" href="#">Qobo Web Tester</a>
			</div>
		</div>
	</nav>
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<form role="form" method="post">
					<fieldset>
						<div class="form-group">
							<label for="url">URL to test</label>
							<input type="url" name="url" class="form-control" id="url" placeholder="http://www.qobo.biz" value="<?php echo empty($_POST['url']) ? 'http://www.qobo.biz' : $_POST['url']; ?>">
						</div>	
						<input type="submit" class="btn btn-primary" value="Test">
					</fieldset>
				</form>
			</div>
			<div class="col-md-6">
				<?php if (!empty($result)) : ?>
					<table class="table table-responsive table-condensed">
						<thead>
							<tr>
								<th colspan="3">Results</th>
							</tr>
							<tr>
								<th>Test</th>
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
									echo '<td>' . $test->getName() . '<br /><p class="text-muted">' . $test->getDescription() . '</p></td>';
									echo '<td>' . ($last->isSuccess() ? 'Pass' : 'Fail') . '</td>';
									echo '<td>' . $last->getDescription() . '</td';
									echo '</tr>';

									$result->next();
								}
							?>
						</tbody>
					</table>
				<?php endif; ?>
			</div>
		</div>
	</div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
  </body>
</html>
