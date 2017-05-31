(function($){
  $(function(){

    $('.button-collapse').sideNav();
    $('.tooltipped').tooltip({delay: 5});
    $('select').material_select();
    $('.indicator').addClass('blue-grey');
  	$('.datepicker').pickadate({
  		format: 'dd-mm-yyyy',
  		selectMonths: true, 
  		selectYears: 20 
  	});
  }); // end of document ready
})(jQuery); // end of jQuery name space