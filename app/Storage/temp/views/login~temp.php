<?php use System\Libs\Lang; use System\Libs\URL; ?><h2>Login</h2>
<form method="POST" action="<?php echo url('/authenticate'); ?>">
	Email: <input type="text" name="email"/> <br/>
	Password: <input type="text" name="password"/> <br/>
	<button type="submit">Login</button>
</form>
