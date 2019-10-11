$(document).ready(function() {


	$('.moin').click(function(){

		if($('#icon').hasClass('fa-minus-circle'))

		{
			$('form').slideUp(2000);
			$('#icon').addClass('fa-plus-circle').removeClass('fa-minus-circle');
		}

		else

		{
			$('form').slideDown(2000);
			$('#icon').addClass('fa-minus-circle').removeClass('fa-plus-circle');			
		}
	

	});


	
});

function myFunction(){
	var x = document.getElementById("assurer").value;
	var date_assurance_hidden = document.getElementById("date_assurance_hidden");

	if(x == 1)

	{

		date_assurance_hidden.style.display = "block";
	}
	if(x == 2 || x == 0)

	{

		date_assurance_hidden.style.display = "none";
	}
}

function MyFunction1(){
	var x = document.getElementById("assurer1").value;
	var date_assurance_hidden = document.getElementById("date_assurance_hidden1");

	if(x == 1)

	{

		date_assurance_hidden.style.display = "block";
	}
	if(x == 2 || x == 0)

	{

		date_assurance_hidden.style.display = "none";
	}
}


