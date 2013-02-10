<?php
	require_once 'include/DDR.class.php';
	
	isset($_REQUEST['R']) ? $R = $_REQUEST['R'] : $R = 10;
	isset($_REQUEST['L']) ? $L = $_REQUEST['L'] : $L = 20;
	isset($_REQUEST['N']) ? $N = $_REQUEST['N'] : $N = 10;
	isset($_REQUEST['Tl']) ? $Tl = $_REQUEST['Tl'] : $Tl = 5;
	isset($_REQUEST['Tr']) ? $Tr = $_REQUEST['Tr'] : $Tr = 10;
	isset($_REQUEST['time']) ? $time = $_REQUEST['time'] : $time = 1;
	isset($_REQUEST['interval']) ? $interval = $_REQUEST['interval'] : $interval = 0.1;
?>
<!DOCTYPE html>
<html>
	<head>
		<title></title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<link rel="stylesheet" href="include/style.css">
		<script src="include/jquery-1.9.1.min.js"></script>
		<script>
			$(document).ready(function(){})
		</script>
	</head>
	<body>
		<div>
			<form>
				<fieldset>
					<legend>Differential Drive Robot</legend>
					<dl>
						<dt>Wheel radius:</dt>
						<dd><input type="number" min="0" step="0.1" name="R" value="<?PHP echo $R; ?>"></dd>
						<dt>Wheel separation:</dt>
						<dd><input type="number" min="0" step="0.1" name="L" value="<?PHP echo $L; ?>"></dd>
					</dl>
					<dl>
						<dt>Ticks per spin:</dt>
						<dd><input type="number" min="0" step="1" name="N" value="<?PHP echo $N; ?>"></dd>
					</dl>
					<dl>
						<dt>Left wheel ticks:</dt>
						<dd><input type="number" step="1" name="Tl" value="<?PHP echo $Tl; ?>"></dd>
						<dt>Right wheel ticks:</dt>
						<dd><input type="number" step="1" name="Tr" value="<?PHP echo $Tr; ?>"></dd>
					</dl>
					<dl>
						<dt>Time:</dt>
						<dd><input type="number" min="0.1" step="0.1" name="time" value="<?PHP echo $time; ?>"></dd>
						<dt>Interval:</dt>
						<dd><input type="number" min="0.1" step="0.1" name="interval" value="<?PHP echo $interval; ?>"></dd>
					</dl>
					<dl>
						<dt></dt>
						<dd></dd>
						<dt></dt>
						<dd><input type="submit"</dd>
					</dl>
				</fieldset>
			</form>
		</div>
		<div>
			<table id="results">
				<thead>
					<th>Time</th>
					<th>Dl</th>
					<th>Dr</th>
					<th>x</th>
					<th>y</th>
					<th>ϕ</th>
				</thead>
				<tbody>
					<?PHP
						$DDR = new DDR($R, $L, $N);
						
						for($i = 0; $i <= $time+0.01; $i = $i + $interval){
							$move = $DDR->move($Tr/$time*$i, $Tl/$time*$i);
							$position = $DDR->position($move);
							echo '<tr>
								<td>'.$i.' s</td>
								<td>'.number_format($move['Dl'],4).'</td>
								<td>'.number_format($move['Dr'],4).'</td>
								<td>'.number_format($position['x'],4).'</td>
								<td>'.number_format($position['y'],4).'</td>
								<td>'.number_format($position['phi'],4).'</td>
								</tr>';
						}
					?>
				</tbody>
			</table>
		</div>
		
		<div id="footer">
			Check out the source code at: <a href="http://github.com/Jesuso/Differential-Drive/">github</a>
		</div>
	</body>
</html>
