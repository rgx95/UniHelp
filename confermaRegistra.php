<?php

session_start();

?>
<!DOCTYPE html>
<html lang="it">
<?php require("head.php"); ?>

	<body>
		<header>
			<?php require("navbar.php"); // IMPORTO LA NAVBAR ?>
		</header>
		<div class="height">   
			<?php //require("modal/import.php");  IMPORTO I MODAL DI BASE (login e profilo) ?>
			<!--------------------------------------------------------------------------------------
				
												CORPO DELLA PAGINA 
				
			---------------------------------------------------------------------------------------->
			 
			<div class="row sfondoSfocato sfondoSfocato2 marginetop">
				<div class="col-sm-6 col-sm-offset-3" class="view">
					<h1 class="titleOther">UniHelp</h1>
				</div>
			</div>
			<div class="container marginetop">
                <div class="row">
                    <div class="col-sm-6 col-sm-offset-2" class="view">
                        <h1 class="subTitle">Registrazione avvenuta con successo</h1>
                    </div>
				</div>
				<div class="row marginetop">
                    <div class="col-sm-6 col-sm-offset-2" class="view">
                        <h2 class="subTitle">Torna alla <a href="index.php">HOME</a></h2>
                    </div>
				</div> 
			</div>
			<?php include("footer.php"); ?>
			
			<!--------------------------------------------------------------------------------------
				
											FINE CORPO DELLA PAGINA 
				
			---------------------------------------------------------------------------------------->
				
		</div>
		
		<br>		
		
	</body>
	
</html>
