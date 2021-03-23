

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
                        <h1 class="subTitle">Aggiunta corso</h1>
                    </div>
				</div>
                <form action="server.php" enctype="text/plain" method="post">
                <input type="hidden" name="corso" value="true" />
                    <div class="row">
                        <div class="col-sm-10 col-sm-offset-1 ">
                            <label for="corso"><b>Inserisci l'Università</b></label>
                            <input type="text" name="universita" autofocus style="width:50%;" maxlength="100"   required>
                        </div> 
                    </div>
                    <div class="row marginetop">
                        <div class="col-sm-10 col-sm-offset-1 ">
                            <label for="corso"><b>Inserisci il nome del corso</b></label>
                            <input type="text" name="corso" autofocus style="width:50%;" maxlength="100"   required>
                        </div> 
                    </div>
                    <div class="row marginetop">
                        <div class="col-sm-10 col-sm-offset-1 ">
                            <input type="submit">Salva</input>
                        </div> 
                    </div> 				
                </form>
            </div>	
			 
			<?php include("footer.php"); ?>
			
			<!--------------------------------------------------------------------------------------
				
											FINE CORPO DELLA PAGINA 
				
			---------------------------------------------------------------------------------------->
				
		</div>
		
		<br>		
		
	</body>
	
</html>

