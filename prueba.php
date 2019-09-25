<!DOCTYPE html>
<html>
<head>
	<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
	
</head>
	<body>
		<div class="verificar">
			<input type="text" name="email" onkeyup="comprueba_email();" id='email'/>
			<div id="result"></div>

			<script type="text/javascript">

				function comprueba_email(){
					var email = document.getElementById("email").value;
				    $.ajax({
				    	type : 'POST',
				        url : 'prueba1.php',//ruta del archivo donte estara la consulta a la bd
				        data : "email="+email,
				        success: function(r){
				            $('#result').html(r); 
				        }
				    });
				}
			</script>
		</div>
	</body>
</html>