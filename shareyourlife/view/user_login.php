<?php if (!empty($_SESSION['falschpw']) AND $_SESSION['falschpw']): ?>
	<div class="falsch">
	Falsche Logindaten.
	</div>
	<?php else: ?>
	<?php endif ?>
<form class="form-horizontal" action="/user/authLog" method="post">
  <input type="email" placeholder="Beispiel@mail.com" required
  name="email"> <br>
    <input type="password" placeholder="password" required name="password">
       <div class="col-md-4">
        <input id="send" name="send" type="submit" class="btn btn-primary">
    </div>

</form>
<?php 
$_SESSION['falschpw']=false;
?>
