
<?php
session_start();
/**
 * Class autoloader
 * @param string $class
 */

function __autoload($class)
{
	require realpath(dirname(__FILE__)) . '/app/' . str_replace('\\', '/', (string)$class) . '.php';
}
?>
<!DOCTYPE html>
<html>
	<body>
<?php
use controllers\game;


if (isset($_SESSION['game']) && !(isset($_REQUEST['restart']))) {
	$game = unserialize($_SESSION['game']);
} else {	
	$game = new Game();
	$_SESSION['game'] = serialize($game);
}
echo "<h1>ROUND ".$game->getRound()."</h1>";
if (isset($_POST) && isset($_POST['hit'])) {
	if (isset($_REQUEST['position']) && $_REQUEST['position'] !== '') {
		$position = (int)$_REQUEST['position'];					
	} else {
		$position = null;				
	}
	//echo "<script type='text/javascript'>alert($position);</script>";
	$story = $game->play($position);
	echo "<pre>$story</pre>";
	if ($game->isDead()) {
		echo "<script type='text/javascript'>alert('Game Over. Press Hit to start a new game...');</script>";	
		$game = new Game();
	}
	$_SESSION['game'] = serialize($game);
}
?>
<hr/>
<form id="hitForm" action="index.php" method="POST">

    <label for="lbForceHit">Force Hitting bee number </label> :
	<select id="position" name="position">
		<option value="">Random</option>
		<?php foreach ($game->getBees() as $pos => $bee) : ?>
			<?=  $aux = $pos; $aux++;  ?>
			<option value="<?=$pos;?>"><?="#$aux {$bee->getClass(1)} ({$bee->getCurrentLifespan()} / {$bee::$lifespan})";?></option>
		<?php endforeach ?>
		</select>


    <br/>

	<label for="debug">Debug Mode</label> :
	<input type="checkbox" id="debug" name="debug" value="1"
		<?php if (isset($_REQUEST['debug']) && $_REQUEST['debug']): ?> checked="checked"<?php endif ?>
		/>
	<br/><br/>		
    <input name="hit" type="submit" value="Hit!">
    <input name="restart" type="submit" value="Restart Game">
    	

</form>

	</body>
</html>
