(function($){
  $(function(){

    $('.button-collapse').sideNav();
    $('.tooltipped').tooltip({delay: 5});
    $('select').material_select();
    $('.indicator').addClass('blue-grey');
	$('.datepicker').pickadate({
		format: 'dd-mm-yyyy',
		selectMonths: true, // Creates a dropdown to control month
		selectYears: 20 // Creates a dropdown of 15 years to control year
	});
  }); // end of document ready
})(jQuery); // end of jQuery name space