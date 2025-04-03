<div id="intro">
	<h3><?php echo htmlspecialchars($_SESSION['joueur_nom']) ?></h3>


	<h4><?= $_SESSION['joueur_argent'] ?> €</h4>
</div>
<br>
	<form method="get" action="index.php" id="formJeu">
	<table id="rouletteTable">

		<tr class="bborder">
			<td colspan="3"><input type="number" min="1" max="<?= $_SESSION['joueur_argent'] ?>" name="mise" placeholder="Votre mise" /></td>
		</tr>
		
		<tr class="bborder">
			<td id="textSliderNombre">Miser sur un nombre</td>
			<td>
			<!-- Rounded switch -->
			<label class="switch">
			  <input type="checkbox">
			  <span class="slider round" id="selecteurJeu"></span>
			</label> 
			</td>
			
			<td id="textSliderParite">Miser sur la parité</td>
		</tr>

		<tr class="bborder" id="trJeu">
			<td id="tdJeuNombre" colspan="3">
			<div class="blockJeu">
				Choisissez votre nombre<br><br>
				<input type="number" name="numero" min="1" max="36" />
			</div>
			</td>
			<td id="tdJeuParite" colspan="3">
			<div class="blockJeu">
				Choisissez la parité<br><br>
				
				<input id="btnRadioPair" class="checkBoxParite" name="parite" value="pair" type="radio">
				<label for="btnRadioPair" id="labelRadioPair" class="labelRadioParite">Pair</label>
				<input id="btnRadioImpair" class="checkBoxParite" name="parite" value="impair" type="radio">
				<label for="btnRadioImpair" id="labelRadioImpair" class="labelRadioParite">Impair</label>
			   
			</div>
			</td>
		</tr>

		<tr>
			<td colspan="3"><input type="submit" name="btnJouer" class="btn btn-success" value="Jouer" /></td>
		</tr>
		<tr>
			<td colspan="3"><a href="connexion.php?deco" id="quitButton" class="btn btn-danger">Quitter</a></td>
		</tr>
	</table>
	</form>
	
	
	<!-- Les scripts Javascript juste avant le <body> fermant -->
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
	<script type="text/javascript" src="script.js"></script>